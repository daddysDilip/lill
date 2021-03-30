<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\SitePermissions as Permission;
use App\SiteLogs as Log;
use App\SiteRoles as Roles;
use DB;
use Redirect;

class PermissionController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('admin')->user() == null) {
            return Redirect::to('shortly-admin')->send();
        }
    }
    public function index() {
        $activeMenu = "users";
        $subMenu = "manage_permissions";

        //Adding Log Data.
        $moduleId = get_module("manage_permissions");
        $log = add_log("info","Viewing permission details.",$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        $Roles = Roles::where('status',1)->get();

        if (!get_user_permission("manage_permissions","view")) {
            return redirect(403);
        }

        return view('users.manage_permission',compact('activeMenu','subMenu','Roles'));
    }

    public function fetchPermission(Request $request) {

        $roleId = $request->roleId;
        
        $PermissionData =  DB::select("
            select tm.id as moduleId,tm.name as moduleName,tm.status as moduleStatus,
            tr.id as roleId,tr.name as roleName,
            tp.*
            from site_modules as tm
            cross join site_roles as tr
            left join site_permissions as tp
            on tm.id=tp.moduleid and tr.id=tp.roleid where tm.status = 1 and tr.id = '".$roleId."'");

        $activeMenu = "users";
        $subMenu = "manage_permissions";

        //Adding Log Data.
        $moduleId = get_module("manage_permissions");
        $log = add_log("info","Viewing permission details.",$moduleId,Auth::guard('admin')->user()->id,getDateTime());

        $Roles = Roles::where('status',1)->get();
        $current_role = $roleId;

        // echo "<pre>";
        // print_r($PermissionData);

        return view('users.manage_permission',compact('activeMenu','subMenu','Roles','PermissionData','current_role'));
    }

    public function addPermission(Request $request) {

        if($request->roleId != "" && $request->moduleId != "" && $request->value != "" && $request->type != "") {
            
            $roleId = $request->roleId;
            $moduleId = $request->moduleId;
            $value = $request->value;
            $type = $request->type;
            
            $check_perm = Permission::where(['roleid'=>$roleId,'moduleid'=>$moduleId])->get();

            //Adding Log Data.
            // $moduleId = get_module("store_permission");
            $log = add_log("info","Permission udpated successfully.",$moduleId,Auth::guard('admin')->user()->id,getDateTime());

            //Check if permission type is add
            if($type == "add") {
                /**
                 * Value = 1 Then insert "add" permission
                 * Value = 0 Then update "add" permission
                 */                
                if($value == 1 && count($check_perm) < 1) {
                    $permission = new Permission;
                    
                    $permission->roleid = $roleId;
                    $permission->moduleid = $moduleId;
                    $permission->add = $value;
                    $permission->edit = null;
                    $permission->delete = null;
                    $permission->view = null;

                    if($permission->save()) {
                        echo "success";
                    } else {
                        echo "fail";
                    } 

                } else if($value == 0) {
                    
                    $data = array(
                        'add' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else if($value == 1 && count($check_perm) > 0) {
                    
                    $data = array(
                        'add' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }

                
            } 
            
            if($type == "edit") {
                /**
                 * Value = 1 Then insert "edit" permission
                 * Value = 0 Then update "edit" permission
                 */
                if($value == 1 && count($check_perm) < 1) {
                    $permission = new Permission;
                    
                    $permission->roleid = $roleId;
                    $permission->moduleid = $moduleId;
                    $permission->add = null;
                    $permission->edit = $value;
                    $permission->delete = null;
                    $permission->view = null;

                    if($permission->save()) {
                        echo "success";
                    } else {
                        echo "fail";
                    } 
                } else if($value == 0) {
                    
                    $data = array(
                        'edit' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else if($value == 1 && count($check_perm) > 0) {

                    $data = array(
                        'edit' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            }

            if($type == "delete") {
                /**
                 * Value = 1 Then insert "edit" permission
                 * Value = 0 Then update "edit" permission
                 */
                if($value == 1 && count($check_perm) < 1) {
                    $permission = new Permission;
                    
                    $permission->roleid = $roleId;
                    $permission->moduleid = $moduleId;
                    $permission->add = null;
                    $permission->edit = null;
                    $permission->delete = $value;
                    $permission->view = null;

                    if($permission->save()) {
                        echo "success";
                    } else {
                        echo "fail";
                    } 
                } else if($value == 0) {
                    
                    $data = array(
                        'delete' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else if($value == 1 && count($check_perm) > 0) {

                    $data = array(
                        'delete' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            }

            if($type == "view") {
                /**
                 * Value = 1 Then insert "edit" permission
                 * Value = 0 Then update "edit" permission
                 */
                if($value == 1 && count($check_perm) < 1) {
                    $permission = new Permission;
                    
                    $permission->roleid = $roleId;
                    $permission->moduleid = $moduleId;
                    $permission->add = null;
                    $permission->edit = null;
                    $permission->delete = null;
                    $permission->view = $value;

                    if($permission->save()) {
                        echo "success";
                    } else {
                        echo "fail";
                    } 
                } else if($value == 0) {
                    
                    $data = array(
                        'view' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                } else if($value == 1 && count($check_perm) > 0) {

                    $data = array(
                        'view' => $value
                    );

                    $permission = Permission::where([
                        'roleid' => $roleId,
                        'moduleid' => $moduleId
                    ])->update($data);

                    if($permission) {
                        echo "success";
                    } else {
                        echo "fail";
                    }
                }
            }
        }
    }

    public function savePermission(Request $request) {

        try{

        if($request->all() != null && $request->has('permission')){
            if(count($request->get('permission')) > 0){
                $permissions =$request->get('permission');
                foreach($permissions as $permission){
                    $per_count = total_rows('site_permissions', array('moduleid'=>$permission['moduleId'], 'roleid'=>$permission['roleId']));

                    if(isset($permission['add']) || isset($permission['edit'])  || isset($permission['view'])  || isset($permission['delete']) ||  $per_count > 0 ){
                    

                        if($per_count == 0){
                            $perm = new Permission;
                            $perm->roleid = $permission['roleId'];
                            $perm->moduleid = $permission['moduleId'];
                            $perm->add = (isset($permission['add']) ? $permission['add']: null);
                            $perm->edit = (isset($permission['edit']) ? $permission['edit']: null);
                            $perm->delete = (isset($permission['delete']) ? $permission['delete']: null);
                            $perm->view = (isset($permission['view']) ? $permission['view']: null);
                            $perm->save();
                        }else{
                            $data =array(
                             'add'=>(isset($permission['add']) ? $permission['add']: null),
                             'edit'=>(isset($permission['edit']) ? $permission['edit']: null),
                             'delete'=>(isset($permission['delete']) ? $permission['delete']: null),
                             'view'=>(isset($permission['view'])  ? $permission['view']: null),
                            );
                             $perm = Permission::where([
                                'roleid' => $permission['roleId'],
                                'moduleid' => $permission['moduleId']
                            ])->update($data);
                        }

                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Permission Saved Successfully');
        }catch (Exception $e) {
            Log::error("Failed to save permission -> ".$e);
        }
    }
}
