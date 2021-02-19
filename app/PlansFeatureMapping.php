<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlansFeatureMapping extends Model
{
    public function features() {
        return $this->hasMany('App\PlansFeatureMapping','feature_id','id')
                ->leftJoin('plans_features_mapping','plans_features_mapping.feature_id','=','plans_features.id')
                ->where('plans_features_mapping.status',1);
    }
}
