<?php

namespace App\Http\Controllers\Admin\Book;

use App\Classes\Helpers\FileUpload;
use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function __construct()
    {
        app('hooks')->registerHooks('seo.seo-edit', new Hook('books.seo.tab', function () {
            return  [
                'name' => __('admin/book/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));
        app('hooks')->registerHooks('image.image-edit', new Hook('books.image.tab', function () {
            return  [
                'name' => __('admin/book/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
    }

    public function index()
    {
        $books = Book::where('status', '!=', '_begin')
            ->where('status', '!=', 'draft')
            ->with(['getAuthor', 'getSelectedProject'])->get();
        return $this->admin_theme('books.index', ['books' => $books]);
    }

    public function edit(Request $request, Book $book = null, $current_tab = 'general')
    {
        if (!$book) {
            $book = new Book;
            $book->fill(['status' => '_begin']);
            $book->save();
            return redirect()->route('admin.book.edit', ['book' => $book, 'current_tab' => 'general']);
        }

        if ($request->post()) {
            return $this->update($request, $book);
        }

        $book->load(['getImage', 'getSeo']);
        $tabs = [
            'general'   => $book,
            'book-preview'  => $book
        ];
        $tabs = array_merge($tabs, app('hooks')->catchHooks('books.seo.tab', []));
        $tabs = array_merge($tabs, app('hooks')->catchHooks('books.image.tab', []));

        return $this->admin_theme('books.edit', ['tabs' => $tabs, 'book' => $book, 'current_tab' => $current_tab]);
    }

    public function update(Request $request, Book $book)
    {

        $request->validate([
            'book_title'    => 'required',
            'author'        => 'required',
            'project'       => 'required',
            'status'        => 'required|in:' . implode(',', array_keys(Book::STATUS)),
            'categories'    => 'required|array'
        ]);

        $book->fill([
            'user_id' => $request->post('author'),
            'book_title' => $request->post('book_title'),
            'slug'      => $book::getSlug(($request->has('slug') && $request->post('slug')) ? $request->post('slug') : $request->post('book_title'), $book),
            'intro_text'    => $request->post('intro_text'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'status'            => $request->post('status'),
            'default_project'   => $request->post('project'),
            'categories'        => $request->post('categories'),
            'is_converted'      => $request->has('convert') ? true : false,
            'canva_link'        => $request->post('canva_link')
        ]);

        try {
            $book->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $this->json(false, 'Unable to update book information.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Book Information updated.');
    }

    public function uploadBook(Request $request, Book $book = null)
    {
        $request->validate([
            'file'  => 'required|mimes:pdf'
        ]);

        if (!$book) {
            $book = new Book();
            $book->fill(['status' => '_being']);
            $book->save();
        }

        $bookUpload = FileUpload::upload($request->file('file'), $book);
        $book->book = $bookUpload[0]['file']->getKey();
        $bookUpload[0]['relation']->delete();
        $book->save();
        return $this->json(true, 'Pdf has been uploaded.', 'redirect', ['location' => route('admin.book.edit', ['book' => $book, 'current_tab' => 'book-preview'])]);
    }

    public function deleteBook(Book $book)
    {
        $book->delete();

        return $this->json(true, 'Book Deleted.', 'reload');
    }
}
