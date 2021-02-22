<?php

function random_link($limit) {
    // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';         
    // return substr(str_shuffle($str_result),0, $length_of_string);
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}

function check_guest_link_exist($url,$ip,$link_type) {
    $result = DB::table('user_links')->where('website_url',$url)->where('ip_address',$ip)->where('link_type',$link_type)->first();
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
    $result = DB::table('user_links')->where('link_code',$code)->select('id','generated_link','website_url')->first();
    if(!empty($result)) {
        return $result;
    } 
    return false;
}

function check_link_exist($url) {
    $result = DB::table('user_links')->where('website_url',$url)->get();
    if(!empty($result) && count($result) > 0) {
        return true;
    }
    return false;
}

function get_link_by_url($url) {
    $result = DB::table('user_links')->where('website_url',$url)->first();
    if(!empty($result)) {
        return $result;
    }
    return false;
}

function get_ip() {
    return request()->ip();
}

function get_domain($url) {
    // $pieces = parse_url($url);
    // $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
    // if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    //     return str_replace('.com','',$regs['domain']);
    // }
    // return false;
    return basename($url);
}

function get_title($url){
    if(strlen($url)>0) {
        $page = file_get_contents($url);
        $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
        return $title;
    }
}

function remove_duplicates($string) {
    $string_array = explode(" ", $string);
    return $final_string = implode(", ",array_unique($string_array));
}

function get_url_data($url,$link_type) {

    //Contains https but not contains www
    if((substr($url, 0, 8) == 'https://') && !(substr($url, 0, 11) == 'https://www')) {
        $filter_url = str_replace('https://', '', $url);
        $url = "https://www.".$filter_url;
        return get_meta_data($url,$link_type,"full-url");
    } 
    //Contains https and www
    else if((substr($url, 0, 8) == 'https://') && (substr($url, 0, 11) == 'https://www')) {
        return get_meta_data($url,$link_type,"full-url");
    } 
    //Contains http but not contains www
    else if((substr($url, 0, 7) == 'http://') && !(substr($url, 0, 10) == 'http://www')) {
        $filter_url = str_replace('http://', '', $url);
        $url = "https://www.".$filter_url;
        return get_meta_data($url,$link_type,"full-url");
    } 
    //Contains http and www
    else if((substr($url, 0, 7) == 'http://') && (substr($url, 0, 10) == 'http://www')) {
        $filter_url = str_replace('http://www.', '', $url);
        $url = "https://www.".$filter_url;
        return get_meta_data($url,$link_type,"full-url");
    } 
    //Contains www but not contains http or https
    else if (!(substr($url, 0, 7) == 'http://') && !(substr($url, 0, 8) == 'https://') && (substr($url, 0, 3) == 'www')) {
        $url = "https://".$url;
        return get_meta_data($url,$link_type,"full-url");            
    } else {
        $url = "https://www.".$url;
        return get_meta_data($url,$link_type,"full-url");
    }
}

function get_guest_url_data($url) {
    $final_url = '';
    //Contains https but not contains www
    if((substr($url, 0, 8) == 'https://') && !(substr($url, 0, 11) == 'https://www')) {
        $final_url = $url;
    } 
    //Contains https and www
    else if((substr($url, 0, 8) == 'https://') && (substr($url, 0, 11) == 'https://www')) {
        $final_url = $url;
    } 
    //Contains http but not contains www
    else if((substr($url, 0, 7) == 'http://') && !(substr($url, 0, 10) == 'http://www')) {
        $final_url = $url;
    } 
    //Contains http and www
    else if((substr($url, 0, 7) == 'http://') && (substr($url, 0, 10) == 'http://www')) {
        $final_url = $url;
    } 
    //Contains www but not contains http or https
    else if (!(substr($url, 0, 7) == 'http://') && !(substr($url, 0, 8) == 'https://') && (substr($url, 0, 3) == 'www')) {
        $final_url = $url;
    } 
    //Neither contains https || https & www.
    else {
        $final_url = $url;
    }
    
    $code = random_link(4);
    if(!empty($final_url)) {
        return ['generated_link' => URL::to('/')."/".$code,'final_url' => $final_url,'code' => $code];
        // return ['generated_link' => "https://www.".config('app.name')."/".$code,'final_url' => $final_url,'code' => $code];
    }
}

function get_guest_url__link_type_data($url,$type) {
    $final_url = '';
    //Contains https but not contains www
    if((substr($url, 0, 8) == 'https://') && !(substr($url, 0, 11) == 'https://www')) {
        $final_url = $url;
    } 
    //Contains https and www
    else if((substr($url, 0, 8) == 'https://') && (substr($url, 0, 11) == 'https://www')) {
        $final_url = $url;
    } 
    //Contains http but not contains www
    else if((substr($url, 0, 7) == 'http://') && !(substr($url, 0, 10) == 'http://www')) {
        $final_url = $url;
    } 
    //Contains http and www
    else if((substr($url, 0, 7) == 'http://') && (substr($url, 0, 10) == 'http://www')) {
        $final_url = $url;
    } 
    //Contains www but not contains http or https
    else if (!(substr($url, 0, 7) == 'http://') && !(substr($url, 0, 8) == 'https://') && (substr($url, 0, 3) == 'www')) {
        $final_url = $url;
    } 
    //Neither contains https || https & www.
    else {
        $final_url = $url;
    }

    $domain = get_domain($final_url);
    $code = generate_guest_link_code($domain,$type);
    if(!empty($final_url)) {
        return ['generated_link' => URL::to('/')."/".$code,'final_url' => $final_url,'code' => $code];
    }
}

function get_meta_data($url,$link_type,$type) {
    try {
        $get_data = file_get_contents(trim($url));
        $match = preg_match("/<title>(.*)<\/title>/i", $get_data, $matches);
        if(!empty($matches[1]) && $get_data == TRUE && $type == "full-url") {

            //str_replace using 039 code replaces single quote from the string. And then preg_replace removes special chars.
            $remove_special_chars = str_replace("039",'',preg_replace("/[^A-Za-z0-9 ]/",'',$matches[1]));

            //Finally returing string with removing extra white spaces.
            $title = preg_replace('/\s+/', ' ', $remove_special_chars);
            $code = generate_code_from_array(remove_duplicates($title), $link_type);
            return ['title' => $title,'code' => $code,'link' => URL::to('/')."/".$code];

        } else {
            
            //Remove special chars and return the website name.
            $title = preg_replace("/[^A-Za-z0-9 ]/",'',get_domain($url));
            $code = generate_code_from_array(remove_duplicates($title), $link_type);
            return ['title' => $title,'code' => $code,'link' => URL::to('/')."/".$code];
            //return ['title' => $title,'link' => URL::to('/')."/".generate_code_from_array(remove_duplicates($title), $link_type)];

        }
    } catch (Exception $e) {
        $title = preg_replace("/[^A-Za-z0-9 ]/",'',get_domain($url));
        $code = generate_code_from_array(remove_duplicates($title), $link_type);
        return ['title' => $title,'code' => $code,'link' => URL::to('/')."/".$code];
    }
}

function generate_qr($link) {
    return "data:image/png;base64,".base64_encode(QrCode::format('png')->size(300)->generate($link));
}

function generate_code_from_array($arr,$suggest_type) {
    
    if(!empty($arr)) {
        $count = count(explode(",",$arr));
        $remove_comma = explode(",",$arr);
        if($count > 1) {
            $first_word = preg_replace('/\s+/', ' ', strtolower($remove_comma[0]));
            $last_word = preg_replace('/\s+/', ' ', strtolower($remove_comma[$count-1]));
            $code = strtolower(random_link(5));
            if($suggest_type == "1") {
                return random_link(3);
            } else if($suggest_type == "2") {
                return random_link(5);
            } else if($suggest_type == "3") {
                return str_replace(' ', '', $first_word.$last_word.$code);
            } else if($suggest_type == "4") {
                return str_replace(' ', '', $first_word."-".$last_word."-".random_link(5));
            } else if($suggest_type == "5") {
                return str_replace(' ', '', Str::camel($first_word.$last_word.random_link(5)));
            }
        } else {
            $new_string = $remove_comma[0];
            if($suggest_type == "1") {
                return random_link(3);
            } else if($suggest_type == "2") {
                return random_link(5);
            }else if($suggest_type == "3") {
                return str_replace(' ', '', strtolower($new_string.random_link(5)));
            } else if($suggest_type == "4") {
                return str_replace(' ', '', strtolower($new_string."-".random_link(5)));
            } else if($suggest_type == "5") {
                return str_replace(' ', '', Str::camel(strtolower($new_string.random_link(5))));
            }
        }
    }
}

function generate_guest_link_code($url,$suggest_type) {
    $code = strtolower(random_link(3));
    $shuffle = substr(str_shuffle($url),0,2);
    if($suggest_type == "1") {
        return random_link(3);
    } else if($suggest_type == "2") {
        return random_link(5);
    } else if($suggest_type == "3") {
        return str_replace(' ', '', $shuffle.$code);
    } else if($suggest_type == "4") {
        return str_replace(' ', '', $shuffle."-".$code);
    } else if($suggest_type == "5") {
        return str_replace(' ', '', Str::camel($shuffle."-".$code));
    }
}

function sanitize_domain($url)
{
    $url = str_ireplace('www.', '', $url);
    $sHost = parse_url($url, PHP_URL_HOST);
    return $sHost;
}

function get_favicon($url)
{
    $sApiUrl = 'http://www.google.com/s2/favicons?domain='.$url;
    //$sDomainName = sanitize_domain($url);
    return $sApiUrl;
}

function get_link_count($link_id) {
    return $count = DB::table('links_reports')->where('link_id',$link_id)->count();
}

function get_link_date($date) {
    return strtoupper(date('F d Y', strtotime($date)));
}

function get_link_full_date($date) {
    return strtoupper(date('F d Y, H A', strtotime($date)));
}

function get_settings($key) {
    return DB::table('settings')->where('key',$key)->first();
}

?>