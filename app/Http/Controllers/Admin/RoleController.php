<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiteRoles as Roles;
use Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "users";
        $subMenu = "manage_roles";
        $RoleData = Roles::all();

        //Adding Log Data.
        $moduleId = get_module("manage_roles");
        $log = add_log('info','View role details.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('roles.index',compact('activeMenu','subMenu','RoleData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRole()
    {
        $activeMenu = "users";
        $subMenu = "manage_roles";

        //Adding Log Data.
        $moduleId = get_module("create_role");
        $log = add_log('info','View add role form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('roles.create',compact('activeMenu','subMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'role' => ['required','string']
        ]);
        
        $moduleId = get_module("store_role");

        try {
            if(Roles::where(['name'=>$request->input('role')])->first()) {
                return redirect()->route('roles')->with('error','Role already exist.');
            } else {
                $date = getDateTime();
                $role = new Roles();
                $role->name = $request->input('role');
                $role->status = empty($request->input('status')) ? 0 : $request->input('status');
                $role->created_at = $date;

                if($role->save()) {
                    //Adding Log Data.
                    $log = add_log('info','Role added successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('roles')->with('success','Role added successfully.');    
                } else {
                    //Adding Log Data.
                    $log = add_log('error','Failed to add role.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                    return redirect()->route('roles')->with('error','Failed to add role.');    
                }
            }
        } catch (Exception $e) {
            $log = add_log('error','Failed to add role ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('roles')->with('error','Failed to add role.');
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
    public function editRole($id)
    {
        $activeMenu = "users";
        $subMenu = "manage_roles";
        $Role = Roles::find($id);

        //Adding Log Data.
        $moduleId = get_module("edit_role");
        $log = add_log('info','Viewing role edit form.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        return view('roles.create',compact('activeMenu','subMenu','Role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => ['required','string']
        ]);

        //Adding Log Data.
        $moduleId = get_module("update_role");

        try {
            $role = Roles::find($id);
            $role->name = $request->input('role');
            $role->status = empty($request->input('status')) ? 0 : $request->input('status');
            $role->updated_at = getDateTime();

            if($role->save()) {
                $log = add_log('info','Role updated successfully.',$moduleId,Auth::guard('admin')->user()->id,getDateTime());
                return redirect()->route('roles')->with('success','Role updated successfully.');    
            } else {
                return redirect()->route('roles')->with('error','Failed to update role.');    
            }
        } catch (Exception $e) {
            $log = add_log('error','Failed to update role ->'.$e,$moduleId,Auth::guard('admin')->user()->id,getDateTime());
            return redirect()->route('roles')->with('error','Failed to update role.');    
        }
    }

    public function changeRoleStatus(Request $request) {
        $roleid = $request->roleid;
        $status = ($request->status == 1 ? 0 : 1);
        if(!empty($roleid)) {
            $role = Roles::where('id',$roleid)
                                ->update(['status' => $status]);

            if($role) {
                echo "success";
            } else {
                echo "fail";
            }

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
}
