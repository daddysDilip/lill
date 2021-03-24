<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Client;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\ClientLog;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Socialite;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        
        //$this->middleware('guest:client')->except('logout');
    }

    public function showClientSigninForm() {
        $title = "Signin";
        return view('auth.client_login',compact('title'));
    }

    public function clientLogin(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $accountStatus = $this->checkRestrictUser($request);

        if($accountStatus == false) {
            return redirect()->back()->with('error','Your account is currently suspended. Please try again later or contact support for the same.');
        }

        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            
            //return redirect()->intended('/writer');
        }

        // echo Str::camel('this is camel case link');
        // echo "<br/><br/>";
        // $string = 'this is dashed link';
        // echo $string_with_dashes = str_replace(' ','-',$string);
        //echo $this->toCamelCase("This is string");
        //return view('client_dashboard');
        
        $suggest_string1 = $this->get_sanitized_string($this->get_url_data("www.daddyscode.com"));
        $suggest_final_string1 = $this->generate_code_from_array($this->remove_duplicates($suggest_string1), "normal");

        $suggest_string2 = $this->get_sanitized_string("Daddys");
        $suggest_final_string2 = $this->generate_code_from_array($this->remove_duplicates($suggest_string2), "dashed");

        $suggest_string3 = $this->get_sanitized_string($this->get_url_data("www.daddyscode.com"));
        $suggest_final_string3 = $this->generate_code_from_array($this->remove_duplicates($suggest_string3), "camel");
        

        echo $table = "<table border='1'>
            <thead>
            <tr>
                <th>Link Type</th>
                <th>Orignal String</th>
                <th>Converted String</th>
                <th>Meta Title</th>
            </tr>  
            </thead> 
            <tbody style='text-align:center;'>
                <tr>
                    <td>Shortest Link</td>
                    <td>-</td>
                    <td>short.ly/".$this->random_link(7)."</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Random Link</td>
                    <td>-</td>
                    <td>short.ly/".$this->random_link(5)."</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Normal Suggested Link with > 2 words in meta title</td>
                    <td>http://www.daddyscode.com</td>
                    <td>short.ly/".$suggest_final_string1."</td>
                    <td>".$this->get_sanitized_string($this->get_url_data("www.daddyscode.com"))."</td>
                </tr>
                <tr>
                    <td>Dashed Suggested Link with < 2 words in meta title</td>
                    <td>http://www.daddyscode.com</td>
                    <td>short.ly/".$suggest_final_string2."</td>
                    <td>".$this->get_sanitized_string("Daddy's")."</td>
                </tr>
                <tr>
                    <td>CamelCase Suggested Link</td>
                    <td>http://www.daddyscode.com</td>
                    <td>short.ly/".$suggest_final_string3."</td>
                    <td>".$this->get_sanitized_string($this->get_url_data("www.daddyscode.com"))."</td>
                </tr>
            </tbody>
        </table>";

        //echo count(str_word_count($string));  
        //return $this->unique_word_count($string);

        //$this->get_repeated_words("DaddysCode Surat Based Web Development Agency | Web Design");
        // echo str_word_count($text);
        //  echo $text_array[8];

    }

    // function get_url_data($url) {
    //     $parse_url = parse_url($url, PHP_URL_SCHEME);
    //     if(!empty($parse_url)) {
    //         $tags = get_meta_tags($url);
    //         return $tags['title'];
    //     } else {
    //         $new_url = "http://".$url;
    //         $tags = get_meta_tags($new_url);
    //         return $tags['title'];
    //     }
    // }

    

    

    

    

    

    

    /**
     * LCFIRST - Converts first character into lowercase.
     * str_replace - Replaces some characters with some other characters in a string.
     * UCWORDS - Converts first character of each word in a string to uppercase.
     * STRTR - Translates certain characters in a string. E.g., strtr("Hilla Warld", "ia", "eo");
     */

    function toCamelCase($str) {
        $i = array("-","_");
        $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
        $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
        $str = str_replace($i, ' ', $str);
        $str = str_replace(' ', '', ucwords(strtolower($str)));
        $str = strtolower(substr($str,0,1)).substr($str,1);
        
        return lcfirst(str_replace(' ', '', ucwords(strtr($str, '_-', ''))));;
    }

    


    public function checkRestrictUser($request) {
        $client = Client::where('email',$request->email)->where('status',1)->first();
        if(!empty($client)) {
            return true;
        }
        return false;
    }
}
