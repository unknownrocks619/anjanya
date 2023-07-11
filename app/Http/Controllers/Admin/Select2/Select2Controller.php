<?php

namespace App\Http\Controllers\Admin\Select2;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Select2Controller extends Controller
{


    public function select2AjaxResponse(array $result = [], int $totalRecord = 0): Response
    {
        return response(['results' => $result, 'count_filtered' => (!$totalRecord) ?  count($result) : $totalRecord]);
    }

    public function countries(Request $request, $countryCode  = null)
    {
        $countries = Country::select('id', 'name as text');

        if ($request->get('search')) {
            $countries->where('name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $countries = $countries->get()->toArray();

        return $this->select2AjaxResponse($countries);
    }

    public function states(Request $request, Country $country)
    {
        $cities = City::select('id', 'name as text')->where('country_id', $country->getKey());

        if ($request->get('search')) {
            $cities->where('name', 'like', '%' . $request->get('search') . '%');
        }

        return $this->select2AjaxResponse($cities->get()->toArray());
    }

    public function categories(Request $request)
    {

        $categoriesQuery = Category::select('id', 'category_name as text');

        if ($request->get('search')) {
            $categoriesQuery->where('catgory_name', 'like', '%' . $request->get('search') . '%');
        }
        return $this->select2AjaxResponse($categoriesQuery->get()->toArray());
    }

    public function pages(Request $request)
    {
        $pageQuery = Page::select('id', 'title as text');

        if ($request->get('search')) {
            $pageQuery->where('title', 'like', '%' . $request->get('search') . '%');
        }
        return $this->select2AjaxResponse($pageQuery->get()->toArray());
    }
    public function posts(Request $request)
    {
        $postQuery = Post::select('id', 'title as text')->where('status', 'active');
        if ($request->get('search')) {
            $postQuery->where('title', 'like', '%' . htmlspecialchars($request->post('search')) . '%');
        }
        return $this->select2AjaxResponse($postQuery->get()->toArray());
    }
}
