<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEnquiry extends Model
{
    protected $table = "user_enquiry";
    public $timestamps = false;

    public static function addEnquiry($data) {
        return UserEnquiry::insert($data);
    }

    public static function updateEnquiry($id,$data) {
        return UserEnquiry::where('id',$id)->update($data);
    }
}
