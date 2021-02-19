<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = "plans";

    public function feature_mapping() {
        return $this->hasMany('App\PlansFeatureMapping','plan_id','id')
                ->leftJoin('plans_features as feature','plans_feature_mappings.feature_id','=','feature.id')
                ->select(
                    'plans_feature_mappings.*',
                    'feature.id as feature_id',
                    'feature.plan_type_id as plan_type_id',
                    'feature.title as title',
                    'feature.short_description as short_description',
                    'feature.feature_type as feature_type',
                    'feature.feature_text as feature_text'
                )
                ->where('plans_feature_mappings.status',1);
    }
}
