<?php

namespace App\Http\Controllers\Admin\Seo;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SeoRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    //

    public function store(Request $request, $model)
    {
        $request->validate([
            'seo_title' => 'required'
        ]);

        $model = $request->post('model_name')::find($model);

        $getPreviousSeo = $model->getSeo;
        if ($getPreviousSeo) {
            $getPreviousSeo->delete();
        }

        $seo = new Seo();
        $seo->fill([
            'title'         => $request->post('seo_title'),
            'keyword'       => $request->post('seo_keyword'),
            'description'   => $request->post('seo_description')
        ]);

        if (!$seo->save()) {
            return $this->json(false, 'Unable to save record.');
        }
        $seoRelation = new SeoRelation();
        $seoRelation->fill([
            'seo_id'        => $seo->getKey(),
            'relation'      => $model->getTable(),
            'relation_id'   => $model->getKey()
        ]);

        if (!$seoRelation->save()) {
            return $this->json(false, 'Unable to update record.');
        }

        return $this->json(true, 'Seo Information Updated.');
    }

    public function remove_seo(SeoRelation $relation)
    {

        if (!$relation->delete()) {
            return $this->json(false, 'Unable to remove seo information.');
        }
        return $this->json(true, 'Seo information removed.');
    }
}
