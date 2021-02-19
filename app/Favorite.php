<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "user_link_favorites";

    public static function getFavoriteLinkByUserId($userId) {
        return Favorite::leftJoin('user_links','user_link_favorites.link_id','=','user_links.id')
                        ->where('user_link_favorites.userid',$userId)
                        ->select('user_links.*','user_link_favorites.id as favorite_id','user_link_favorites.userid as userid','user_link_favorites.link_id as link_id','user_link_favorites.created_at as favorite_link_created_at','user_link_favorites.updated_at as favorite_link_updated_at')
                        ->get();
    }
}
