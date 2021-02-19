<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkType extends Model
{
    protected $table = "link_types";
    protected $guarded = ['id','type','status'];

    public static function getLinkTypes() {
        return LinkType::where('status',1)->get();
    }
}
