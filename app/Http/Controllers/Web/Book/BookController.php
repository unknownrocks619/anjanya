<?php

namespace App\Http\Controllers\Web\Book;

use App\Classes\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookBundle;
use App\Models\Category;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Project;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\PdfParser\StreamReader;
use setasign\Fpdi\Tcpdf\Fpdi;

use Smalot\PdfParser\Parser;
use TCPDF;

class BookController extends Controller
{

    public $stepToNumber = [
        'step_one'  => 1,
        'step_two'  => 2,
        'step_three'    => 3,
        'step_four'     => 4,
        'step_five'     => 5,
        'step_six'      => 6
    ];

    //
    public function index()
    {

        $products = Product::with(['getAuthor' => function ($query) {
            $query->with('getCountry');
        }])->where('status', 'active')->get();

        $categoryWithProduct = [];
        foreach ($products as $product) {
            foreach ($product->categories as $category) {
                $categoryWithProduct[$category][] = $product;
            }
        }

        $categories = Category::whereIn('id', array_keys($categoryWithProduct))->where('active', true)->get();
        $allCategory = Category::where('active', true)->where('category_type', 'books')->get();
        return $this->user_theme('books.list', ['categories' => $categories, 'catProduct' => $categoryWithProduct, 'allCategory' => $allCategory]);
    }
    public function bundle_list(Menu $menu = null)
    {
        $bookBundle = BookBundle::where('active', true)->get();
        return $this->user_theme('books.bundle', ['bundles' => $bookBundle, 'menu' => $menu]);
    }

    public function bundle_show(string $bundle)
    {
        $bundle = BookBundle::where('slug', $bundle)
            ->with(['getImage', 'getComponents', 'getSeo'])
            ->where('active', true)
            ->first();
        if (!$bundle) {
            abort(404);
        }

        $defaultSeo = $bundle->getSeo;
        $isLanding = false;
        $isFooter = false;
        return $this->user_theme('bundle.show', ['bundle' => $bundle, 'defaultSeo' => $defaultSeo, 'isLanding' => $isLanding, 'isFooter' => $isFooter]);
    }

    public function bookByCategory($category)
    {
        $category = Category::slug('category', $category)->where('active', true)->first();
        $products = Product::whereJsonContains('categories', $category->getKey())->get();

        if (!$category) {
            abort(404);
        }

        $categoryWithProduct = [];
        foreach ($products as $product) {
            foreach ($product->categories as $category) {
                $categoryWithProduct[$category][] = $product;
            }
        }

        $allCategory = Category::where('active', true)->where('category_type', 'books')->get();;
    }
    public function profile_book_list($current_tab = 'all_books')
    {
        $tabs = [
            'all_books' => Book::where('status', '!=', '_begin')->where('user_id', auth()->guard('web')->id())->get(),
            'in_review' => Book::where('status', 'pending')->where('user_id', auth()->guard('web')->id())->get(),
            'published' => Book::where('status', 'active')->where('user_id', auth()->guard('web')->id())->get(),
        ];

        return $this->user_theme('books.profile', ['tabs' => $tabs, 'current_tab' => $current_tab]);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with(['getAuthor' => function ($query) {
                $query->with(['getCountry']);
            }, 'getRecommendedProject', 'getRecommendedProject' => function ($query) {
                $query->with('getDonationBreaks');
            }])
            ->first();

        $recommendedProject = $product->recommendeProduct();

        return $this->user_theme('books.detail', ['product' => $product, 'recommendedProject' => $recommendedProject]);
    }

    public function showDefaultProductModal(Request $request, $product)
    {
        $request->validate(['amount' => 'required']);

        $request->validate(['amount' => 'required']);
        if (!$request->has('type') || ($request->get('type') && $request->get('type') != 'bundle')) {
            $product = Product::where('status', 'active')->with(['getRecommendedProject'])->first();
            $view = $this->user_theme('books.modal.default-selection', ['product' => $product, 'amount' => $request->post('amount')])->render();
        } else {

            $bundle = BookBundle::find($product);
            $view = $this->user_theme('bundle.modal.project-list', ['product' => $bundle, 'amount' => $request->post('amount')])->render();
        }
        return response($view);
    }


    public function upload(Request  $request, Book $book = null, $current_tab = 'step_zero')
    {

        if (!auth()->guard('web')->check()) {
            return $this->user_theme('books.upload-prevent');
        }

        if ($current_tab == 'back') {
            return $this->step_back($request, $book);
        }

        if (!$book) {

            $book = new Book;
            $book->fill([
                'status' => "_begin",
                'user_id'   => auth()->guard('web')->id()
            ]);

            $book->save();
            $this->setBookUploadConfig('step_zero');
        }

        if (!$this->getStep()) {
            $this->setBookUploadConfig($current_tab ?? 'step_zero');
        }

        if ($request->isMethod('post')) {

            return $this->{$this->getStep()}($request, $book, $current_tab);
        }

        return $this->user_theme('books.upload', ['book' => $book, 'current_tab' => $this->getStep()]);
    }

    public function step_zero(Request $request, Book $book = null)
    {
        $request->validate([
            'file' => 'required|mimes:pdf'
        ]);

        if ($book->user_id != auth()->guard('web')->id()) {
            return $this->json(false, 'Invalid Configuration');
        }

        $sessionID = session()->getId();

        if (!session()->get($sessionID) || !isset(session()->get($sessionID)['book_controller'])) {
            return $this->json(false, 'Invalid Configuration');
        }

        // upload book
        $fileUpload = FileUpload::upload($request->file('file'), $book);
        $uploadedBook = $fileUpload[0]['file'];
        $relation = $fileUpload[0]['relation'];

        $book->book = $uploadedBook->getKey();
        $book->status = 'draft';
        $book->upload_stage = "step_zero";
        $book->save();

        $this->setBookUploadConfig('step_one');
        return $this->bookUploaderHandler($book);
    }

    public function step_one(Request $request, Book $book)
    {

        $sessionID = session()->getId();
        $currentConfig = session()->get($sessionID);

        if (!$book->book_validated) {
            $this->setBookUploadConfig('step_one');
        } else {
            if ($book->upload_stage != 'step_one') {
                $book->upload_stage = 'step_one';
                $book->save();
            }
            $this->setBookUploadConfig('step_two');
        }
        return $this->bookUploaderHandler($book);
    }

    public function step_two(Request $request, Book $book)
    {

        if (!$book->book_validated) {
            $this->setBookUploadConfig('step_one');
            return $this->json(true, '', 'redirect', ['location' => redirect()->route('frontend.books.upload_user', ['book' => $book, 'current_tab' => $this->getStep()])]);
        }

        if ($book->upload_stage != 'step_two') {
            $book->upload_stage = 'step_two';
            $book->save();
        }
        if ($request->getMethod() == 'POST') {
            $this->updateBook($request, $book);
            $this->setBookUploadConfig('step_three');
        }

        return $this->bookUploaderHandler($book);
    }

    public function step_three(Request $request, Book $book)
    {
        if (!$book->book_title  || !$book->full_description) {
            $this->setBookUploadConfig('step_two');
            return $this->bookUploaderHandler($book);
        }
        if ($request->getMethod() == 'POST') {

            $request->validate(
                ['cat_id' => 'required|array|between:1,5'],
                [
                    'cat_id.required' => 'Please Select atleast one Category',
                    'cat_id.array' => 'Invalid category', 'cat_id.between' => 'Upto 5 categories only.'
                ]
            );
            $book->categories = array_keys($request->post('cat_id'));
            $book->upload_stage = 'step_three';
            $book->save();
            $this->setBookUploadConfig('step_four');
        }

        return $this->bookUploaderHandler($book);
    }


    public function step_four(Request $request, Book $book)
    {
        if ($request->getMethod() == 'POST') {
            $project = Project::where('active', true)->where('id', $request->post('project'))->first();

            if (!$project) {
                return $this->json(false, 'Please select atleast one project.');
            }
            $book->default_project = $request->post('project');
            $book->upload_stage = 'step_four';
            $book->save();
            $this->setBookUploadConfig('step_five');
        }
        return $this->bookUploaderHandler($book);
    }

    public function step_five(Request $request, Book $book)
    {
        if (!$book->default_project) {
            $this->setBookUploadConfig('step_four');
            return $this->bookUploaderHandler($book);
        }
        $book->status = "pending";
        $book->upload_stage = 'complete';
        $book->save();
        $this->setBookUploadConfig('step_six');

        return $this->bookUploaderHandler($book);
    }

    public function step_six(Request $request, Book $book)
    {
        $view = $this->bookUploaderHandler($book);
        // $this->setBookUploadConfig('step_zero');
        return $view;
    }

    public function bookUploaderHandler(Book $book)
    {
        $view = $this->user_theme('books.partials.' . $book::BOOK_UPLOAD_STAGE[$this->getStep()], ['book' => $book, 'current_step' => $this->getStep()])->render();
        return $this->json(true, '', 'bookUploaderNext', ['view' => $view, 'path' => route('frontend.books.upload_user', ['book' => $book, 'current_tab' => $this->getStep()]), 'current_step' => $this->getStep()]);
    }

    public function updateBook(Request $request, Book $book)
    {

        $request->validate(
            [
                'book_title' => 'required',
                'book_description' => 'required|min:10',
                'canva_book' => 'nullable|active_url',
                'parent_email' => 'nullable|email'

            ]
        );

        if ($request->has('book_title')) {
            $book->book_title = $request->post('book_title');
            $book->full_description = strip_tags($request->post('book_description'));
            $book->canva_link = $request->post('canva_book');
        }

        if ($request->has('categories')) {
            $book->categories = $request->post('categories');
        }
        if ($request->post('parent_email')) {
            $book->parent_email = $request->post('parent_email');

            $user = auth()->guard('web')->user();

            if (!$user->parent_email) {
                $user->parent_email = $request->post('parent_email');
                $user->save();
            }
        }

        if ($book->isDirty()) {
            $book->save();
        }
    }

    public function destroy(Request $request, Book $book = null)
    {
        if ($book) {
            $book->delete();
        }
        if ($request->has('_ref') && $request->_ref == 'dashboard') {
            return $this->json(true, '', 'redirect', ['location' => route('frontend.users.dashboard')]);
        }
        $this->setBookUploadConfig('step_zero');
        return $this->json(true, '', 'redirect', ['location' => route('frontend.books.upload')]);
    }


    private function setBookUploadConfig($step): void
    {
        $sessionID = session()->getId();

        // in mean time generate images and pages using other library.
        $currentConfig = session()->get($sessionID);

        if (!isset($currentConfig['book_controller'])) {
            $currentConfig = ['book_controller' => []];
        }

        $currentConfig['book_controller'] = ['step' => $step];
        session()->put($sessionID, $currentConfig);
    }

    private function getStep(): string
    {

        $sessionID = session()->getId();
        $currentConfig = session()->get($sessionID);

        if (!isset($currentConfig['book_controller'])) {
            return '';
        }

        return $currentConfig['book_controller']['step'];
    }

    public function validate_book(Book $book)
    {
        ini_set('memory_limit', -1);
        $pageAttribute =
            ['_hasFirstPageBlank' => false, '_hasSafeMargin' => false, '_hasPageEven' => false, '_hasCover' => true, '_bookSize' => false];
        $view = 'books.partials.book_validate_success';

        if ($book->book_validated) {

            $pageAttribute =
                ['_hasFirstPageBlank' => true, '_hasSafeMargin' => true, '_hasPageEven' => true, '_hasCover' => true, '_bookSize' => true];
            $validate_message_view = $this->user_theme($view, ['book' => $book])->render();
            $this->setBookUploadConfig('step_two');

            return $this->json(true, '', 'validateBook', ['values' => $pageAttribute, 'keys' => ['_hasSafeMargin', '_hasFirstPageBlank', '_bookSize', '_hasPageEven', '_hasCover'], 'validation_message' => $validate_message_view]);
        }

        $fileModel = Image::find($book->book);
        $pdfPath = public_path($fileModel->filepath);

        $pdf = new \setasign\Fpdi\Fpdi();
        $pdfSourceFile = $pdf->setSourceFile($pdfPath);

        if ($pdfSourceFile % 2 == 0) {
            $pageAttribute['_hasPageEven'] = true;
        }

        $pageID = 2;
        $tplIdIndex = $pdf->importPage($pageID);
        $size = $pdf->getTemplateSize($tplIdIndex);

        if (number_format($size['width'], 0) == 297 && number_format($size['height'], 0) == 210 && $size['orientation'] == 'L') {
            $pageAttribute['_bookSize'] = true;
        }
        $secondContent = $pdf->Output('', 'S');

        // Extract the coordinates of the content
        preg_match_all('/([0-9]+\.[0-9]+)/', $secondContent, $matches);
        $leftMargin = $matches[0][0];
        $topMargin = $matches[0][1];
        $rightMargin = $matches[0][2];
        $bottomMargin = $matches[0][3];

        if (number_format($leftMargin, 0) >= 1 && number_format($rightMargin) <= '842' && number_format($topMargin, 0) >= 595 && number_format($bottomMargin) >= 7.62) {
            $pageAttribute['_hasSafeMargin'] = true;
        }

        $pdfSourceFile = $pdf->setSourceFile(($pdfPath));
        $tpiLastIndex = $pdf->importPage($pdfSourceFile - 1);
        $lastPageContent = $pdf->Output('', 'S');

        $parser = new Parser();
        $firstPageParser = $parser->parseContent($secondContent);
        $secondPageParser = $parser->parseContent($lastPageContent);


        if ($firstPageParser->getPages()[0]->getContent() == $secondPageParser->getPages()[0]->getContent()) {

            $pageAttribute['_hasFirstPageBlank'] = true;
        }

        $valid = true;
        foreach ($pageAttribute as $key => $value) {

            if (!$value) {
                $valid = false;
                $view  = 'books.partials.book_validation_failed';
            }
        }
        if ($valid) {
            $book->book_validated = true;
            $book->save();
            $this->setBookUploadConfig('step_one');
        }
        $validate_message_view = $this->user_theme($view, ['book' => $book])->render();

        return $this->json(true, '', 'validateBook', ['values' => $pageAttribute, 'keys' => ['_hasSafeMargin', '_hasFirstPageBlank', '_bookSize', '_hasPageEven', '_hasCover'], 'validation_message' => $validate_message_view]);
    }

    public function step_back(Request $request, Book $book)
    {
        $currentStep = $this->stepToNumber[$this->getStep()];
        $currentStep = ($currentStep == 1) ? $currentStep : $currentStep - 1;
        $currentStep = array_search($currentStep, $this->stepToNumber);
        $this->setBookUploadConfig($currentStep);
        $request->setMethod('GET');
        // $userResponse =  $this->user_theme('books.upload', ['book' => $book, 'current_tab' => $this->getStep()])->render();
        return  $this->{$currentStep}($request, $book);
    }
}
