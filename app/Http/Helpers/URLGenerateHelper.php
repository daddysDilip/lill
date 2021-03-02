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

function pr($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function get_map_country()
{
    $country = [
        [
            "code3"=> "ABW",
            "name"=> "Aruba",
            "value"=> 0,
            "code"=> "AW"
        ],
        [
            "code3"=> "AFG",
            "name"=> "Afghanistan",
            "value"=> 0,
            "code"=> "AF"
        ],
        [
            "code3"=> "AGO",
            "name"=> "Angola",
            "value"=> 0,
            "code"=> "AO"
        ],
        [
            "code3"=> "ALB",
            "name"=> "Albania",
            "value"=> 0,
            "code"=> "AL"
        ],
        [
            "code3"=> "AND",
            "name"=> "Andorra",
            "value"=> 0,
            "code"=> "AD"
        ],
        [
            "code3"=> "ARE",
            "name"=> "United Arab Emirates",
            "value"=> 0,
            "code"=> "AE"
        ],
        [
            "code3"=> "ARG",
            "name"=> "Argentina",
            "value"=> 0,
            "code"=> "AR"
        ],
        [
            "code3"=> "ARM",
            "name"=> "Armenia",
            "value"=> 0,
            "code"=> "AM"
        ],
        [
            "code3"=> "ASM",
            "name"=> "American Samoa",
            "value"=> 0,
            "code"=> "AS"
        ],
        [
            "code3"=> "ATG",
            "name"=> "Antigua and Barbuda",
            "value"=> 0,
            "code"=> "AG"
        ],
        [
            "code3"=> "AUS",
            "name"=> "Australia",
            "value"=> 0,
            "code"=> "AU"
        ],
        [
            "code3"=> "AUT",
            "name"=> "Austria",
            "value"=> 0,
            "code"=> "AT"
        ],
        [
            "code3"=> "AZE",
            "name"=> "Azerbaijan",
            "value"=> 0,
            "code"=> "AZ"
        ],
        [
            "code3"=> "BDI",
            "name"=> "Burundi",
            "value"=> 0,
            "code"=> "BI"
        ],
        [
            "code3"=> "BEL",
            "name"=> "Belgium",
            "value"=> 0,
            "code"=> "BE"
        ],
        [
            "code3"=> "BEN",
            "name"=> "Benin",
            "value"=> 0,
            "code"=> "BJ"
        ],
        [
            "code3"=> "BFA",
            "name"=> "Burkina Faso",
            "value"=> 0,
            "code"=> "BF"
        ],
        [
            "code3"=> "BGD",
            "name"=> "Bangladesh",
            "value"=> 0,
            "code"=> "BD"
        ],
        [
            "code3"=> "BGR",
            "name"=> "Bulgaria",
            "value"=> 0,
            "code"=> "BG"
        ],
        [
            "code3"=> "BHR",
            "name"=> "Bahrain",
            "value"=> 0,
            "code"=> "BH"
        ],
        [
            "code3"=> "BHS",
            "name"=> "Bahamas, The",
            "value"=> 0,
            "code"=> "BS"
        ],
        [
            "code3"=> "BIH",
            "name"=> "Bosnia and Herzegovina",
            "value"=> 0,
            "code"=> "BA"
        ],
        [
            "code3"=> "BLR",
            "name"=> "Belarus",
            "value"=> 0,
            "code"=> "BY"
        ],
        [
            "code3"=> "BLZ",
            "name"=> "Belize",
            "value"=> 0,
            "code"=> "BZ"
        ],
        [
            "code3"=> "BMU",
            "name"=> "Bermuda",
            "value"=> 0,
            "code"=> "BM"
        ],
        [
            "code3"=> "BOL",
            "name"=> "Bolivia",
            "value"=> 0,
            "code"=> "BO"
        ],
        [
            "code3"=> "BRA",
            "name"=> "Brazil",
            "value"=> 0,
            "code"=> "BR"
        ],
        [
            "code3"=> "BRB",
            "name"=> "Barbados",
            "value"=> 0,
            "code"=> "BB"
        ],
        [
            "code3"=> "BRN",
            "name"=> "Brunei Darussalam",
            "value"=> 0,
            "code"=> "BN"
        ],
        [
            "code3"=> "BTN",
            "name"=> "Bhutan",
            "value"=> 0,
            "code"=> "BT"
        ],
        [
            "code3"=> "BWA",
            "name"=> "Botswana",
            "value"=> 0,
            "code"=> "BW"
        ],
        [
            "code3"=> "CAF",
            "name"=> "Central African Republic",
            "value"=> 0,
            "code"=> "CF"
        ],
        [
            "code3"=> "CAN",
            "name"=> "Canada",
            "value"=> 0,
            "code"=> "CA"
        ],
        [
            "code3"=> "CHE",
            "name"=> "Switzerland",
            "value"=> 0,
            "code"=> "CH"
        ],
        [
            "code3"=> "CHL",
            "name"=> "Chile",
            "value"=> 0,
            "code"=> "CL"
        ],
        [
            "code3"=> "CHN",
            "name"=> "China",
            "value"=> 0,
            "code"=> "CN"
        ],
        [
            "code3"=> "CIV",
            "name"=> "Cote d'Ivoire",
            "value"=> 0,
            "code"=> "CI"
        ],
        [
            "code3"=> "CMR",
            "name"=> "Cameroon",
            "value"=> 0,
            "code"=> "CM"
        ],
        [
            "code3"=> "COD",
            "name"=> "Congo, Dem. Rep.",
            "value"=> 0,
            "code"=> "CD"
        ],
        [
            "code3"=> "COG",
            "name"=> "Congo, Rep.",
            "value"=> 0,
            "code"=> "CG"
        ],
        [
            "code3"=> "COL",
            "name"=> "Colombia",
            "value"=> 0,
            "code"=> "CO"
        ],
        [
            "code3"=> "COM",
            "name"=> "Comoros",
            "value"=> 0,
            "code"=> "KM"
        ],
        [
            "code3"=> "CPV",
            "name"=> "Cabo Verde",
            "value"=> 0,
            "code"=> "CV"
        ],
        [
            "code3"=> "CRI",
            "name"=> "Costa Rica",
            "value"=> 0,
            "code"=> "CR"
        ],
        [
            "code3"=> "CUB",
            "name"=> "Cuba",
            "value"=> 0,
            "code"=> "CU"
        ],
        [
            "code3"=> "CUW",
            "name"=> "Curacao",
            "value"=> 0,
            "code"=> "CW"
        ],
        [
            "code3"=> "CYM",
            "name"=> "Cayman Islands",
            "value"=> 0,
            "code"=> "KY"
        ],
        [
            "code3"=> "CYP",
            "name"=> "Cyprus",
            "value"=> 0,
            "code"=> "CY"
        ],
        [
            "code3"=> "CZE",
            "name"=> "Czech Republic",
            "value"=> 0,
            "code"=> "CZ"
        ],
        [
            "code3"=> "DEU",
            "name"=> "Germany",
            "value"=> 0,
            "code"=> "DE"
        ],
        [
            "code3"=> "DJI",
            "name"=> "Djibouti",
            "value"=> 0,
            "code"=> "DJ"
        ],
        [
            "code3"=> "DMA",
            "name"=> "Dominica",
            "value"=> 0,
            "code"=> "DM"
        ],
        [
            "code3"=> "DNK",
            "name"=> "Denmark",
            "value"=> 0,
            "code"=> "DK"
        ],
        [
            "code3"=> "DOM",
            "name"=> "Dominican Republic",
            "value"=> 0,
            "code"=> "DO"
        ],
        [
            "code3"=> "DZA",
            "name"=> "Algeria",
            "value"=> 0,
            "code"=> "DZ"
        ],
        [
            "code3"=> "ECU",
            "name"=> "Ecuador",
            "value"=> 0,
            "code"=> "EC"
        ],
        [
            "code3"=> "EGY",
            "name"=> "Egypt, Arab Rep.",
            "value"=> 0,
            "code"=> "EG"
        ],
        [
            "code3"=> "ESP",
            "name"=> "Spain",
            "value"=> 0,
            "code"=> "ES"
        ],
        [
            "code3"=> "EST",
            "name"=> "Estonia",
            "value"=> 0,
            "code"=> "EE"
        ],
        [
            "code3"=> "ETH",
            "name"=> "Ethiopia",
            "value"=> 0,
            "code"=> "ET"
        ],
        [
            "code3"=> "FIN",
            "name"=> "Finland",
            "value"=> 0,
            "code"=> "FI"
        ],
        [
            "code3"=> "FJI",
            "name"=> "Fiji",
            "value"=> 0,
            "code"=> "FJ"
        ],
        [
            "code3"=> "FRA",
            "name"=> "France",
            "value"=> 0,
            "code"=> "FR"
        ],
        [
            "code3"=> "FRO",
            "name"=> "Faroe Islands",
            "value"=> 0,
            "code"=> "FO"
        ],
        [
            "code3"=> "FSM",
            "name"=> "Micronesia, Fed. Sts.",
            "value"=> 0,
            "code"=> "FM"
        ],
        [
            "code3"=> "GAB",
            "name"=> "Gabon",
            "value"=> 0,
            "code"=> "GA"
        ],
        [
            "code3"=> "GBR",
            "name"=> "United Kingdom",
            "value"=> 0,
            "code"=> "GB"
        ],
        [
            "code3"=> "GEO",
            "name"=> "Georgia",
            "value"=> 0,
            "code"=> "GE"
        ],
        [
            "code3"=> "GHA",
            "name"=> "Ghana",
            "value"=> 0,
            "code"=> "GH"
        ],
        [
            "code3"=> "GIB",
            "name"=> "Gibraltar",
            "value"=> 0,
            "code"=> "GI"
        ],
        [
            "code3"=> "GIN",
            "name"=> "Guinea",
            "value"=> 0,
            "code"=> "GN"
        ],
        [
            "code3"=> "GMB",
            "name"=> "Gambia, The",
            "value"=> 0,
            "code"=> "GM"
        ],
        [
            "code3"=> "GNB",
            "name"=> "Guinea-Bissau",
            "value"=> 0,
            "code"=> "GW"
        ],
        [
            "code3"=> "GNQ",
            "name"=> "Equatorial Guinea",
            "value"=> 0,
            "code"=> "GQ"
        ],
        [
            "code3"=> "GRC",
            "name"=> "Greece",
            "value"=> 0,
            "code"=> "GR"
        ],
        [
            "code3"=> "GRD",
            "name"=> "Grenada",
            "value"=> 0,
            "code"=> "GD"
        ],
        [
            "code3"=> "GRL",
            "name"=> "Greenland",
            "value"=> 0,
            "code"=> "GL"
        ],
        [
            "code3"=> "GTM",
            "name"=> "Guatemala",
            "value"=> 0,
            "code"=> "GT"
        ],
        [
            "code3"=> "GUM",
            "name"=> "Guam",
            "value"=> 0,
            "code"=> "GU"
        ],
        [
            "code3"=> "GUY",
            "name"=> "Guyana",
            "value"=> 0,
            "code"=> "GY"
        ],
        [
            "code3"=> "HKG",
            "name"=> "Hong Kong SAR, China",
            "value"=> 0,
            "code"=> "HK"
        ],
        [
            "code3"=> "HND",
            "name"=> "Honduras",
            "value"=> 0,
            "code"=> "HN"
        ],
        [
            "code3"=> "HRV",
            "name"=> "Croatia",
            "value"=> 0,
            "code"=> "HR"
        ],
        [
            "code3"=> "HTI",
            "name"=> "Haiti",
            "value"=> 0,
            "code"=> "HT"
        ],
        [
            "code3"=> "HUN",
            "name"=> "Hungary",
            "value"=> 0,
            "code"=> "HU"
        ],
        [
            "code3"=> "IDN",
            "name"=> "Indonesia",
            "value"=> 0,
            "code"=> "ID"
        ],
        [
            "code3"=> "IMN",
            "name"=> "Isle of Man",
            "value"=> 0,
            "code"=> "IM"
        ],
        [
            "code3"=> "IND",
            "name"=> "India",
            "value"=> 0,
            "code"=> "IN"
        ],
        [
            "code3"=> "IRL",
            "name"=> "Ireland",
            "value"=> 0,
            "code"=> "IE"
        ],
        [
            "code3"=> "IRN",
            "name"=> "Iran, Islamic Rep.",
            "value"=> 0,
            "code"=> "IR"
        ],
        [
            "code3"=> "IRQ",
            "name"=> "Iraq",
            "value"=> 0,
            "code"=> "IQ"
        ],
        [
            "code3"=> "ISL",
            "name"=> "Iceland",
            "value"=> 0,
            "code"=> "IS"
        ],
        [
            "code3"=> "ISR",
            "name"=> "Israel",
            "value"=> 0,
            "code"=> "IL"
        ],
        [
            "code3"=> "ITA",
            "name"=> "Italy",
            "value"=> 0,
            "code"=> "IT"
        ],
        [
            "code3"=> "JAM",
            "name"=> "Jamaica",
            "value"=> 0,
            "code"=> "JM"
        ],
        [
            "code3"=> "JOR",
            "name"=> "Jordan",
            "value"=> 0,
            "code"=> "JO"
        ],
        [
            "code3"=> "JPN",
            "name"=> "Japan",
            "value"=> 0,
            "code"=> "JP"
        ],
        [
            "code3"=> "KAZ",
            "name"=> "Kazakhstan",
            "value"=> 0,
            "code"=> "KZ"
        ],
        [
            "code3"=> "KEN",
            "name"=> "Kenya",
            "value"=> 0,
            "code"=> "KE"
        ],
        [
            "code3"=> "KGZ",
            "name"=> "Kyrgyz Republic",
            "value"=> 0,
            "code"=> "KG"
        ],
        [
            "code3"=> "KHM",
            "name"=> "Cambodia",
            "value"=> 0,
            "code"=> "KH"
        ],
        [
            "code3"=> "KIR",
            "name"=> "Kiribati",
            "value"=> 0,
            "code"=> "KI"
        ],
        [
            "code3"=> "KNA",
            "name"=> "St. Kitts and Nevis",
            "value"=> 0,
            "code"=> "KN"
        ],
        [
            "code3"=> "KOR",
            "name"=> "Korea, Rep.",
            "value"=> 0,
            "code"=> "KR"
        ],
        [
            "code3"=> "KWT",
            "name"=> "Kuwait",
            "value"=> 0,
            "code"=> "KW"
        ],
        [
            "code3"=> "LAO",
            "name"=> "Lao PDR",
            "value"=> 0,
            "code"=> "LA"
        ],
        [
            "code3"=> "LBN",
            "name"=> "Lebanon",
            "value"=> 0,
            "code"=> "LB"
        ],
        [
            "code3"=> "LBR",
            "name"=> "Liberia",
            "value"=> 0,
            "code"=> "LR"
        ],
        [
            "code3"=> "LBY",
            "name"=> "Libya",
            "value"=> 0,
            "code"=> "LY"
        ],
        [
            "code3"=> "LCA",
            "name"=> "St. Lucia",
            "value"=> 0,
            "code"=> "LC"
        ],
        [
            "code3"=> "LIE",
            "name"=> "Liechtenstein",
            "value"=> 0,
            "code"=> "LI"
        ],
        [
            "code3"=> "LKA",
            "name"=> "Sri Lanka",
            "value"=> 0,
            "code"=> "LK"
        ],
        [
            "code3"=> "LSO",
            "name"=> "Lesotho",
            "value"=> 0,
            "code"=> "LS"
        ],
        [
            "code3"=> "LTU",
            "name"=> "Lithuania",
            "value"=> 0,
            "code"=> "LT"
        ],
        [
            "code3"=> "LUX",
            "name"=> "Luxembourg",
            "value"=> 0,
            "code"=> "LU"
        ],
        [
            "code3"=> "LVA",
            "name"=> "Latvia",
            "value"=> 0,
            "code"=> "LV"
        ],
        [
            "code3"=> "MAC",
            "name"=> "Macao SAR, China",
            "value"=> 0,
            "code"=> "MO"
        ],
        [
            "code3"=> "MAF",
            "name"=> "St. Martin (French part)",
            "value"=> 0,
            "code"=> "MF"
        ],
        [
            "code3"=> "MAR",
            "name"=> "Morocco",
            "value"=> 0,
            "code"=> "MA"
        ],
        [
            "code3"=> "MCO",
            "name"=> "Monaco",
            "value"=> 0,
            "code"=> "MC"
        ],
        [
            "code3"=> "MDA",
            "name"=> "Moldova",
            "value"=> 0,
            "code"=> "MD"
        ],
        [
            "code3"=> "MDG",
            "name"=> "Madagascar",
            "value"=> 0,
            "code"=> "MG"
        ],
        [
            "code3"=> "MDV",
            "name"=> "Maldives",
            "value"=> 0,
            "code"=> "MV"
        ],
        [
            "code3"=> "MEX",
            "name"=> "Mexico",
            "value"=> 0,
            "code"=> "MX"
        ],
        [
            "code3"=> "MHL",
            "name"=> "Marshall Islands",
            "value"=> 0,
            "code"=> "MH"
        ],
        [
            "code3"=> "MKD",
            "name"=> "Macedonia, FYR",
            "value"=> 0,
            "code"=> "MK"
        ],
        [
            "code3"=> "MLI",
            "name"=> "Mali",
            "value"=> 0,
            "code"=> "ML"
        ],
        [
            "code3"=> "MLT",
            "name"=> "Malta",
            "value"=> 0,
            "code"=> "MT"
        ],
        [
            "code3"=> "MMR",
            "name"=> "Myanmar",
            "value"=> 0,
            "code"=> "MM"
        ],
        [
            "code3"=> "MNE",
            "name"=> "Montenegro",
            "value"=> 0,
            "code"=> "ME"
        ],
        [
            "code3"=> "MNG",
            "name"=> "Mongolia",
            "value"=> 0,
            "code"=> "MN"
        ],
        [
            "code3"=> "MNP",
            "name"=> "Northern Mariana Islands",
            "value"=> 0,
            "code"=> "MP"
        ],
        [
            "code3"=> "MOZ",
            "name"=> "Mozambique",
            "value"=> 0,
            "code"=> "MZ"
        ],
        [
            "code3"=> "MRT",
            "name"=> "Mauritania",
            "value"=> 0,
            "code"=> "MR"
        ],
        [
            "code3"=> "MUS",
            "name"=> "Mauritius",
            "value"=> 0,
            "code"=> "MU"
        ],
        [
            "code3"=> "MWI",
            "name"=> "Malawi",
            "value"=> 0,
            "code"=> "MW"
        ],
        [
            "code3"=> "MYS",
            "name"=> "Malaysia",
            "value"=> 0,
            "code"=> "MY"
        ],
        [
            "code3"=> "NAM",
            "name"=> "Namibia",
            "value"=> 0,
            "code"=> "NA"
        ],
        [
            "code3"=> "NCL",
            "name"=> "New Caledonia",
            "value"=> 0,
            "code"=> "NC"
        ],
        [
            "code3"=> "NER",
            "name"=> "Niger",
            "value"=> 0,
            "code"=> "NE"
        ],
        [
            "code3"=> "NGA",
            "name"=> "Nigeria",
            "value"=> 0,
            "code"=> "NG"
        ],
        [
            "code3"=> "NIC",
            "name"=> "Nicaragua",
            "value"=> 0,
            "code"=> "NI"
        ],
        [
            "code3"=> "NLD",
            "name"=> "Netherlands",
            "value"=> 0,
            "code"=> "NL"
        ],
        [
            "code3"=> "NOR",
            "name"=> "Norway",
            "value"=> 0,
            "code"=> "NO"
        ],
        [
            "code3"=> "NPL",
            "name"=> "Nepal",
            "value"=> 0,
            "code"=> "NP"
        ],
        [
            "code3"=> "NRU",
            "name"=> "Nauru",
            "value"=> 0,
            "code"=> "NR"
        ],
        [
            "code3"=> "NZL",
            "name"=> "New Zealand",
            "value"=> 0,
            "code"=> "NZ"
        ],
        [
            "code3"=> "OMN",
            "name"=> "Oman",
            "value"=> 0,
            "code"=> "OM"
        ],
        [
            "code3"=> "PAK",
            "name"=> "Pakistan",
            "value"=> 0,
            "code"=> "PK"
        ],
        [
            "code3"=> "PAN",
            "name"=> "Panama",
            "value"=> 0,
            "code"=> "PA"
        ],
        [
            "code3"=> "PER",
            "name"=> "Peru",
            "value"=> 0,
            "code"=> "PE"
        ],
        [
            "code3"=> "PHL",
            "name"=> "Philippines",
            "value"=> 0,
            "code"=> "PH"
        ],
        [
            "code3"=> "PLW",
            "name"=> "Palau",
            "value"=> 0,
            "code"=> "PW"
        ],
        [
            "code3"=> "PNG",
            "name"=> "Papua New Guinea",
            "value"=> 0,
            "code"=> "PG"
        ],
        [
            "code3"=> "POL",
            "name"=> "Poland",
            "value"=> 0,
            "code"=> "PL"
        ],
        [
            "code3"=> "PRI",
            "name"=> "Puerto Rico",
            "value"=> 0,
            "code"=> "PR"
        ],
        [
            "code3"=> "PRK",
            "name"=> "Korea, Dem. People’s Rep.",
            "value"=> 0,
            "code"=> "KP"
        ],
        [
            "code3"=> "PRT",
            "name"=> "Portugal",
            "value"=> 0,
            "code"=> "PT"
        ],
        [
            "code3"=> "PRY",
            "name"=> "Paraguay",
            "value"=> 0,
            "code"=> "PY"
        ],
        [
            "code3"=> "PSE",
            "name"=> "West Bank and Gaza",
            "value"=> 0,
            "code"=> "PS"
        ],
        [
            "code3"=> "PYF",
            "name"=> "French Polynesia",
            "value"=> 0,
            "code"=> "PF"
        ],
        [
            "code3"=> "QAT",
            "name"=> "Qatar",
            "value"=> 0,
            "code"=> "QA"
        ],
        [
            "code3"=> "ROU",
            "name"=> "Romania",
            "value"=> 0,
            "code"=> "RO"
        ],
        [
            "code3"=> "RUS",
            "name"=> "Russian Federation",
            "value"=> 0,
            "code"=> "RU"
        ],
        [
            "code3"=> "RWA",
            "name"=> "Rwanda",
            "value"=> 0,
            "code"=> "RW"
        ],
        [
            "code3"=> "SAU",
            "name"=> "Saudi Arabia",
            "value"=> 0,
            "code"=> "SA"
        ],
        [
            "code3"=> "SDN",
            "name"=> "Sudan",
            "value"=> 0,
            "code"=> "SD"
        ],
        [
            "code3"=> "SEN",
            "name"=> "Senegal",
            "value"=> 0,
            "code"=> "SN"
        ],
        [
            "code3"=> "SGP",
            "name"=> "Singapore",
            "value"=> 0,
            "code"=> "SG"
        ],
        [
            "code3"=> "SLB",
            "name"=> "Solomon Islands",
            "value"=> 0,
            "code"=> "SB"
        ],
        [
            "code3"=> "SLE",
            "name"=> "Sierra Leone",
            "value"=> 0,
            "code"=> "SL"
        ],
        [
            "code3"=> "SLV",
            "name"=> "El Salvador",
            "value"=> 0,
            "code"=> "SV"
        ],
        [
            "code3"=> "SMR",
            "name"=> "San Marino",
            "value"=> 0,
            "code"=> "SM"
        ],
        [
            "code3"=> "SOM",
            "name"=> "Somalia",
            "value"=> 0,
            "code"=> "SO"
        ],
        [
            "code3"=> "SRB",
            "name"=> "Serbia",
            "value"=> 0,
            "code"=> "RS"
        ],
        [
            "code3"=> "STP",
            "name"=> "Sao Tome and Principe",
            "value"=> 0,
            "code"=> "ST"
        ],
        [
            "code3"=> "SUR",
            "name"=> "Suriname",
            "value"=> 0,
            "code"=> "SR"
        ],
        [
            "code3"=> "SVK",
            "name"=> "Slovak Republic",
            "value"=> 0,
            "code"=> "SK"
        ],
        [
            "code3"=> "SVN",
            "name"=> "Slovenia",
            "value"=> 0,
            "code"=> "SI"
        ],
        [
            "code3"=> "SWE",
            "name"=> "Sweden",
            "value"=> 0,
            "code"=> "SE"
        ],
        [
            "code3"=> "SWZ",
            "name"=> "Swaziland",
            "value"=> 0,
            "code"=> "SZ"
        ],
        [
            "code3"=> "SXM",
            "name"=> "Sint Maarten (Dutch part)",
            "value"=> 0,
            "code"=> "SX"
        ],
        [
            "code3"=> "SYC",
            "name"=> "Seychelles",
            "value"=> 0,
            "code"=> "SC"
        ],
        [
            "code3"=> "SYR",
            "name"=> "Syrian Arab Republic",
            "value"=> 0,
            "code"=> "SY"
        ],
        [
            "code3"=> "TCA",
            "name"=> "Turks and Caicos Islands",
            "value"=> 0,
            "code"=> "TC"
        ],
        [
            "code3"=> "TCD",
            "name"=> "Chad",
            "value"=> 0,
            "code"=> "TD"
        ],
        [
            "code3"=> "TGO",
            "name"=> "Togo",
            "value"=> 0,
            "code"=> "TG"
        ],
        [
            "code3"=> "THA",
            "name"=> "Thailand",
            "value"=> 0,
            "code"=> "TH"
        ],
        [
            "code3"=> "TJK",
            "name"=> "Tajikistan",
            "value"=> 0,
            "code"=> "TJ"
        ],
        [
            "code3"=> "TKM",
            "name"=> "Turkmenistan",
            "value"=> 0,
            "code"=> "TM"
        ],
        [
            "code3"=> "TLS",
            "name"=> "Timor-Leste",
            "value"=> 0,
            "code"=> "TL"
        ],
        [
            "code3"=> "TON",
            "name"=> "Tonga",
            "value"=> 0,
            "code"=> "TO"
        ],
        [
            "code3"=> "TTO",
            "name"=> "Trinidad and Tobago",
            "value"=> 0,
            "code"=> "TT"
        ],
        [
            "code3"=> "TUN",
            "name"=> "Tunisia",
            "value"=> 0,
            "code"=> "TN"
        ],
        [
            "code3"=> "TUR",
            "name"=> "Turkey",
            "value"=> 0,
            "code"=> "TR"
        ],
        [
            "code3"=> "TUV",
            "name"=> "Tuvalu",
            "value"=> 0,
            "code"=> "TV"
        ],
        [
            "code3"=> "TZA",
            "name"=> "Tanzania",
            "value"=> 0,
            "code"=> "TZ"
        ],
        [
            "code3"=> "UGA",
            "name"=> "Uganda",
            "value"=> 0,
            "code"=> "UG"
        ],
        [
            "code3"=> "UKR",
            "name"=> "Ukraine",
            "value"=> 0,
            "code"=> "UA"
        ],
        [
            "code3"=> "URY",
            "name"=> "Uruguay",
            "value"=> 0,
            "code"=> "UY"
        ],
        [
            "code3"=> "USA",
            "name"=> "United States",
            "value"=> 0,
            "code"=> "US"
        ],
        [
            "code3"=> "UZB",
            "name"=> "Uzbekistan",
            "value"=> 0,
            "code"=> "UZ"
        ],
        [
            "code3"=> "VCT",
            "name"=> "St. Vincent and the Grenadines",
            "value"=> 0,
            "code"=> "VC"
        ],
        [
            "code3"=> "VEN",
            "name"=> "Venezuela, RB",
            "value"=> 0,
            "code"=> "VE"
        ],
        [
            "code3"=> "VGB",
            "name"=> "British Virgin Islands",
            "value"=> 0,
            "code"=> "VG"
        ],
        [
            "code3"=> "VIR",
            "name"=> "Virgin Islands (U.S.)",
            "value"=> 0,
            "code"=> "VI"
        ],
        [
            "code3"=> "VNM",
            "name"=> "Vietnam",
            "value"=> 0,
            "code"=> "VN"
        ],
        [
            "code3"=> "VUT",
            "name"=> "Vanuatu",
            "value"=> 0,
            "code"=> "VU"
        ],
        [
            "code3"=> "WSM",
            "name"=> "Samoa",
            "value"=> 0,
            "code"=> "WS"
        ],
        [
            "code3"=> "YEM",
            "name"=> "Yemen, Rep.",
            "value"=> 0,
            "code"=> "YE"
        ],
        [
            "code3"=> "ZAF",
            "name"=> "South Africa",
            "value"=> 0,
            "code"=> "ZA"
        ],
        [
            "code3"=> "ZMB",
            "name"=> "Zambia",
            "value"=> 0,
            "code"=> "ZM"
        ],
        [
            "code3"=> "ZWE",
            "name"=> "Zimbabwe",
            "value"=> 0,
            "code"=> "ZW"
        ]
    ];
    return $country;
}

function object_to_array($data)
{
    return json_decode(json_encode($data),true);
}

?>