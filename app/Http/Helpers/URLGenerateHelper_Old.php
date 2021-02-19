<?php

function random_link($limit) {
    // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';         
    // return substr(str_shuffle($str_result),0, $length_of_string);
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}

function check_guest_link_exist($url,$ip) {
    $result = DB::table('user_links')->where('website_url',$url)->where('ip_address',$ip)->first();
    if(!empty($result)) {
        return true;
    } 
    return false;
}

function get_user_link($url,$ip) {
    $result = DB::table('user_links')->where('website_url',$url)->where('ip_address',$ip)->first();
    if(!empty($result)) {
        return $result;
    } 
    return false;
}

function get_link_by_code($code) {
    $result = DB::table('user_links')->where('link_code',$code)->select('id','generated_link')->first();
    if(!empty($result)) {
        return $result;
    } 
    return false;
}

function get_ip() {
    return request()->ip();
}

function get_domain($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return str_replace('.com','',$regs['domain']);
    }
    return false;
}

function get_url_data($url) {
    $url = file_get_contents(trim($url));
    $match = preg_match("/<title>(.*)<\/title>/i", $url, $matches);
    if(!empty($matches[1])) {
        
        //str_replace using 039 code replaces single quote from the string. And then preg_replace removes special chars.
        $remove_special_chars = str_replace("039",'',preg_replace("/[^A-Za-z0-9 ]/",'',$matches[1]));

        //Finally returing string with removing extra white spaces.
        return "IN";

    } else {
        //Else return domain name / website name.
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return str_replace('.com','',$regs['domain']);
        }
        return false;
    }
}

function generate_code_from_array($arr,$suggest_type) {
    if(!empty($arr)) {
        $count = count(explode(",",$arr));
        $remove_comma = explode(",",$arr);
        if($count > 1) {
            $first_word = preg_replace('/\s+/', ' ', strtolower($remove_comma[0]));
            $last_word = preg_replace('/\s+/', ' ', strtolower($remove_comma[$count-1]));
            $code = strtolower($this->random_link(5));
            if($suggest_type == "normal") {
                return str_replace(' ', '', $first_word.$last_word.$code);
            } else if($suggest_type == "dashed") {
                return str_replace(' ', '', $first_word."-".$last_word."-".$this->random_link(5));
            } else if($suggest_type == "camel") {
                return str_replace(' ', '', Str::camel($first_word.$last_word.$this->random_link(5)));
            }
        } else {
            $new_string = $remove_comma[0];
            if($suggest_type == "normal") {
                return str_replace(' ', '', strtolower($new_string.$this->random_link(5)));
            } else if($suggest_type == "dashed") {
                return str_replace(' ', '', strtolower($new_string."-".$this->random_link(5)));
            } else if($suggest_type == "camel") {
                return str_replace(' ', '', Str::camel(strtolower($new_string.$this->random_link(5))));
            }
        }
    }
}

?>