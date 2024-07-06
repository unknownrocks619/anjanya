<?php
namespace App\Plugins\Product\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Plugins\Product\Http\Models\StoreProduct;
use App\Classes\Plugins\Hook;
use App\Jobs\ProductEnquiry;
use App\Plugins\Product\Http\Models\ProductCategory;
use App\Plugins\Product\Http\Models\StoreProductAdditional;
use App\Plugins\Product\Http\Models\StoreProductVideo;
use Illuminate\Http\Request;

class WebProductController extends Controller {

    protected $plugin_name = 'Product';

    public function load(string $slug) {
        $product = StoreProduct::where('slug',$slug)->where('status',true)->firstOrFail();

        // get first product category.
        $category = $product->productCategories()->first();
        $data = [
            'extends'   => 'master',
            'product'      => $product,
            'category'  => $category
        ];

        return view('Product::frontend.products.product-detail',$data);
    }

    public function submitProductEnquiry(Request $request, StoreProduct $product, string $slug) {
        
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
        ]);

        $subject = 'Enquiry  -  ' . $product->name;
        $message  = "";
        $message .= "<div style='font-size:34px; font-weight: bold;margin-top:10px;'>Product Name: ". $product->name ."</div>";
        $message .= '<div style="margin-top:10px; font-size: 20px;">';
        $message .= "<span style='font-weight:bold'>Full Name : </span>". $request->post('full_name');
        $message .= " <br />";
        $message .= "<span style='font-weight:bold'>Email: </span>" . $request->post('email');
        $message .= "<br />";
        $message .= "<span style='font-weight:bold'>Phone Number  : </span>". $request->post('phone_number');
        $message .= "<br />";
        $message .= "<br />";
        $message .= "<span style='font-weight:bold'>Message:  </span>";
        $message .= "</div>";
        $message .= '<div style="margin-top:10px; margin-bottom:10px; border:2px solid #000000; background: #3fd85457;padding: 10px;font-size: 20px;">';
            $message .= $request->post('message');
        $message .= '</div>';

        $params  = [
            'email'     => $request->post('email'),
            'subject'   => $subject,
            'message'   => $message,
            'phone'     => $request->post('phone_number'),
            'full_name' => $request->post('full_name')
        ];

        if (ProductEnquiry::dispatchSync($params)) {
            return $this->json(false, 'Failed send email.');
        }

        return $this->json(true,'Message Sent');
    }
}