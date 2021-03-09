<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\SiteLogs as Log;
use App\UserLinks;
use App\LinksReport;

class UserController extends Controller
{

    protected $User;

    public function __construct() {
        $this->User = Auth::guard('admin')->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "users";
        $subMenu = "manage_users";
        $UserData = User::select('users.*','role.id as roleid','role.name as role_name')
                    ->leftJoin('site_roles as role','users.roleid','=','role.id')
                    ->whereIn('users.roleid',[1,2,3,4,5])
                    ->get();
        
        //Adding Log Details.
        $moduleId = get_module("manage_users");
        $log = add_log('info','Viewing users data.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('users.index',compact('activeMenu','subMenu','UserData'));
    }

    public function showCustomers() {
        $activeMenu = "reports";
        $subMenu = "manage_customers";
        $CustomerData = User::select('users.*','role.id as roleid','role.name as role_name')
                    ->leftJoin('site_roles as role','users.roleid','=','role.id')
                    ->whereIn('users.roleid',[4])
                    ->get();
        //Adding Log Details.
        $moduleId = get_module("manage_customers");
        $log = add_log('info','Viewing customers data.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('reports.manage-customers',compact('activeMenu','subMenu','CustomerData'));

    }

    public function viewCustomerDetail($id) {
        
        $activeMenu = "reports";
        $subMenu = "manage_customers";
        $CustomerData = User::leftJoin('site_roles','users.roleid','=','site_roles.id')
                                ->where('users.id',$id)
                                ->select('users.*','site_roles.id as roleid','site_roles.name as role_name')
                                ->first();
                                /*->leftJoin('country','users.country','=','country.id')
                                ->leftJoin('state','users.state','=','state.id')
                                ->leftJoin('city','users.city','=','city.id')
                                ,'country.id as country','country.name as country_name','state.id as state','state.name as state_name','city.id as city','city.name as city_name'
                                */
        
        //Adding Log Details.
        $moduleId = get_module("view_customer");
        $log = add_log('info','Viewing customer detail data.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('reports.view-customer-detail',compact('activeMenu','subMenu','CustomerData'));
    }

    public function viewLinkStatistics($id) {
        $monthly_report = LinksReport::select(DB::raw("count(id) as total_clicks,MONTHNAME(created_at) as month,YEAR(created_at) as year"))->where('link_id',$id)->whereYear('created_at',date('Y'))->groupBy('month')->get();
        if(!empty($monthly_report) || count($monthly_report) > 0) {
            $months = ['January '.date('Y'),'February '.date('Y'),'March '.date('Y'),'April '.date('Y'),'May '.date('Y'),'June '.date('Y'),'July '.date('Y'),'August '.date('Y'),'September '.date('Y'),'October '.date('Y'),'November '.date('Y'),'December    '.date('Y')];
            return response()->json(['monthly_report' => $monthly_report,'months'=>$months]);
        } else {
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        $activeMenu = "users";
        $subMenu = "manage_users";
        $Country = get_country();
        $Role = get_roles();
        
        //Adding Log Details.
        $moduleId = get_module("create_user");
        $log = add_log('info','View add user data form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
        
        return view('users.create',compact('activeMenu','subMenu','Country','Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required','string'],
            'lastname' => ['required','string'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users'],
            // 'country' => ['required'],
            // 'state' => ['required'],
            // 'city' => ['required'],
            'role' => ['required'],
        ]); 

        //Adding Log Details.
        $moduleId = get_module("store_user");

        try {
            if(User::where(['email'=>$request->input('email')])->first()) {
                return redirect()->route('users')->with('error','User already exist.');
            } else {
                $date = date('Y-m-d h:i:s');
                $user = new User();
                $user->firstname = $request->input('firstname');
                $user->lastname = $request->input('lastname');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                // $user->country = $request->input('country');
                // $user->state = $request->input('state');
                // $user->city = $request->input('city');            
                $user->roleid = $request->input('role');
                $user->status = empty($request->input('status')) ? 0 : $request->input('status');
                $user->created_at = $date;
                
                if($user->save()) {
                    //Adding Log Data.
                    $log = add_log('info','Inserting user data.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

                    return redirect()->route('users')->with('success','User registered successfully.');    
                } else {
                    return redirect()->route('users')->with('error','Failed to register user.');    
                }
            }
        } catch (Exception $ex) {
            
            //Adding Log Data.
            $log = add_log('error','Failed to add user -> '.$ex,$moduleId,Auth::guard('admin')->user()->id,getDateTime());

            return redirect()->route('users')->with('error','Failed to register user.');
        }

    }

    public function changeUserStatus(Request $request) {
        $userid = $request->userid;
        $status = ($request->status == 1 ? 0 : 1);
        if(!empty($userid)) {
            $user = User::where('id',$userid)
                                ->update(['status' => $status]);

            if($user) {
                echo "success";
            } else {
                echo "fail";
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $User = User::find($id);
        $activeMenu = "users";
        $subMenu = "manage_users";
        // $Country = get_country();
        // $State = get_state();
        // $City = get_city();
        $Role = get_roles();

        //Adding Log Data.
        $moduleId = get_module("edit_user");
        $log = add_log('info','View edit user form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('users.create',compact('activeMenu','subMenu','Role','User'));
        //,'Country','State','City'
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $validatedData = $request->validate([
            'firstname' => ['required','string'],
            'lastname' => ['required','string'],
            'email' => ['required','string', 'email', 'max:255'],
            'contactno' => ['required'],
            // 'country' => ['required'],
            // 'state' => ['required'],
            // 'city' => ['required'],
            'role' => ['required']
        ]);

        $moduleId = get_module("update_user");

        try {
            $date = date('Y-m-d h:i:s');
            $user = User::find($id);
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->contactno = $request->input('contactno');
            // $user->country = $request->input('country');
            // $user->state = $request->input('state');
            // $user->city = $request->input('city');            
            $user->roleid = $request->input('role');
            $user->status = empty($request->input('status')) ? 0 : $request->input('status');
            $user->updated_at = $date;

            if($user->save()) {
                //Adding Log Data.
                $log = add_log('info','User details edit successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

                return redirect()->route('users')->with('success','User details updated successfully.');    
            } else {
                return redirect()->route('users')->with('error','Failed to update user.');    
            }
        } catch (Exception $ex) {
            //Adding Log Data.
            $log = add_log('error','Failed to edit user details -> '.$ex,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('users')->with('error','Failed to update user.');    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkEmailExist(Request $request) {
        if($request->ajax() && $request->input('email') != "") {
            $check_email = User::where('email',$request->input('email'))->get();
        }
        return response()->json(count($check_email) > 0 ? true : false);
    }

    public function checkUserPassword(Request $request) {
        $query = '';
        if($request->ajax() && $request->input('old_pass') != "") {
            $query = Hash::check($request->input('old_pass'),Auth::guard('admin')->user()->password);
        }
        return response()->json($query);
    }
    

    public function showEditProfile() {
        $activeMenu = "edit_profile";
        $subMenu = "general";

        //Adding Log Data.
        $moduleId = get_module("edit_profile");
        $log = add_log('info','Viewing edit profile.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('users.my_account',compact('activeMenu','subMenu'));
    }

    public function viewChangePassword() {
        $activeMenu = "edit_profile";
        $subMenu = "change_password";

        //Adding Log Data.
        $moduleId = get_module("change_password");
        $log = add_log('info','Viewing change password.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('users.my_account',compact('activeMenu','subMenu'));
    }

    public function updateProfile(Request $request,$id) {
        $validatedData = $request->validate([
            'firstname' => ['required','string'],
            'lastname' => ['required','string'],
            'email' => ['required','string', 'email', 'max:255'],
            'contactno' => ['required'],
            // 'country' => ['required'],
            // 'state' => ['required'],
            // 'city' => ['required'],
        ]);
        
        $moduleId = get_module("edit_user");

        try {
            $user = User::find($id);

            $image = $request->file('user_profile');
            if($request->hasFile('user_profile')) {

                if(Auth::guard('admin')->user()->user_profile != "") {
                    echo $old_path = public_path().'\uploads\user_profile\\'.Auth::guard('admin')->user()->user_profile;
                    if(file_exists($old_path)) {
                        unlink($old_path);
                    }
                }

                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/user_profile/'), $new_name);
                $user->user_profile = $new_name;            
            }

            $date = date('Y-m-d h:i:s');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->contactno = $request->input('contactno');
            // $user->country = $request->input('country');
            // $user->state = $request->input('state');
            // $user->city = $request->input('city');            
            $user->updated_at = $date;

            if($user->save()) {
                //Adding Log Data.
                $log = add_log('info','Updating user details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                
                return redirect()->route('user.edit.profile')->with('success','Your profile has been updated successfully.');
            } else {
                return redirect()->route('user.edit.profile')->with('error','Failed to update your profile.');
            }
            
        } catch (Exception $e) {
            //Adding Log Data.
            $log = add_log('error','Failed to update user details -> '.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());

            return redirect()->route('user.edit.profile')->with('error','Failed to update your profile.');
        }        
    }

    public function changePassword(Request $request) {
        $user = User::find(Auth::guard('admin')->user()->id);  
        $user->password = Hash::make($request->new_password);
        $user->updated_at = getDateTime();

        if($user->save()) {
            return redirect()->route('user.view.change.password')->with('success','Password changed successfully.');
        } else {
            return redirect()->route('user.view.change.password')->with('error','Failed to change password.');
        }
    }
}
