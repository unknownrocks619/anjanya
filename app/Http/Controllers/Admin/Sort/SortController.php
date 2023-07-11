<?php

namespace App\Http\Controllers\Admin\Sort;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SortController extends Controller
{

    /**
     * Reorder element based on sort_by column on model
     *
     * @param Request $request
     * @param string $model_name
     * @param int|null $mode_id
     *
     * @return Response
     *
     */
    public function reorder(Request  $request, string $model_name, int $mode_id = null)
    {
        $modelClassText = '\\App\Models\\' . $model_name;
        $modelClass = new $modelClassText();
        $getContent = $modelClass->whereIn('id', array_keys($request->post()))->get();
        $sortableID = $request->post();
        foreach ($getContent as $content) {
            if (isset($sortableID[$content->getKey()])) {
                $content->sort_by = $sortableID[$content->getKey()];
                $content->save();
            }
        }

        return $this->json(true, 'Data re-order success.');
    }
}
