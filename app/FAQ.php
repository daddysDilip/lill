<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = "site_faq";
    public $timestamps = false;
    protected $fillable = ['id','question','answer','status'];

    public static function addFAQ($data) {
        return FAQ::insert($data);
    }

    public static function getActiveFAQ() {
        return FAQ::where('status',1)->get();
    }
}
