<?php

namespace App\Imports;

use App\UserLinks;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class ImportLinks implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $link_data = get_url_data($row[0],$row[2]);
        
        $userid = Auth::guard('user')->user()->id;
        
        $user_link_limit = get_user_plan($userid)->total_links ?? 0;
        $count_user_links = get_user_links_count($userid);
        
        if($user_link_limit == 0 || $count_user_links < $user_link_limit) {
            if(check_link_exist($row[0])) {
                
                $userLinks = UserLinks::find(get_link_by_url($row[0])->id);
                $userLinks->userid = $userid;
                $userLinks->website_url = $row[0];
                $userLinks->generated_link = $link_data['link'];
                $userLinks->link_title = $link_data['title'];
                $userLinks->link_type = $row[2];
                $userLinks->ip_address = get_ip();
                $userLinks->status = 0;
                $userLinks->status = 1;
                $userLinks->updated_at = getDateTime();
                $userLinks->save();

            } else {
                return new UserLinks([
                    'userid' => $userid,
                    'website_url' => $row[0],
                    'generated_link' => $link_data['link'],
                    'link_title' => $link_data['title'],
                    'link_type' => $row[2],
                    'link_code' => $link_data['code'],
                    'ip_address' => get_ip(),
                    'domain' => "",
                    'tags' => "",
                    'qr_code' => generate_qr($row[0]),
                    'isGuestLink' => 0,
                    'status' => 1,
                    'created_at' => getDateTime()    
                ]);
            }
        }
    }
}
