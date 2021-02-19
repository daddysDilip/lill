<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkUniqueClicks extends Model
{
    protected $table = "link_unique_clicks_report";
    protected $fillable = ['link_id','report_id','created_at'];
    public $timestamps = false;

    public static function addUniqueClick($data) {
        return LinkUniqueClicks::insert($data);
    }
}
