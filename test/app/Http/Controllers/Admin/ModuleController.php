<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SiteModules as Modules;
use Auth;
use App\SitePermissions as Permission;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeMenu = "users";
        $subMenu = "manage_modules";
        $ModuleData = Modules::all();

        //Adding Log Data.
        $moduleId = get_module("manage_modules");
        $log = !empty($moduleId) ? add_log('info','View modules detail.',$moduleId,Auth::user()->id,getDateTime()) : '';

        return view('modules.index',compact('activeMenu','subMenu','ModuleData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createModule()
    {
        $activeMenu = "users";
        $subMenu = "manage_modules";

        //Adding Log Data.
        $moduleId = get_module("create_module");
        $log = !empty($moduleId) ? add_log('info','View create module form.',$moduleId,Auth::user()->id,getDateTime()) : "";

        return view('modules.create',compact('activeMenu','subMenu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeModule(Request $request)
    {
        $validatedData = $request->validate([
            'module' => ['required','string']
        ]); 

        
        $moduleId = get_module("store_module");

        try {
            if(Modules::where(['name'=>$request->input('module')])->first()) {
                return redirect()->route('modules')->with('error','Module already exist.');
            } else {
                $date = getDateTime();
                $module = new Modules();
                $module->name = $request->input('module');
                $module->status = empty($request->input('status')) ? 0 : $request->input('status');
                $module->created_at = $date;

                if($module->save()) {


                    //Adding Default Admin Permission.
                    $permission = new Permission();
                    $permission->roleid = 0;
                    $permission->moduleid = $module->id;
                    $permission->add = 1;
                    $permission->edit = 1;
                    $permission->delete = 1;
                    $permission->view = 1;
                    $permission->created_at = getDateTime();
                    $permission->save();

                    //Adding Log Data.
                    $log = !empty($moduleId) ? add_log('info','Inserting new module.',$moduleId,Auth::user()->id,getDateTime()) : "";

                    return redirect()->route('modules')->with('success','Module added successfully.');    
                } else {
                    return redirect()->route('modules')->with('error','Failed to add module.');    
                }
            }
        } catch (Excpetion $e) {
            //Adding Log Data.
            $log = !empty($moduleId) ? add_log('info','Failed to insert module ->'.$e,$moduleId,Auth::user()->id,getDateTime()) : "";
            return redirect()->route('modules')->with('error','Failed to add module.');    
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
    public function editModule($id)
    {
        $activeMenu = "users";
        $subMenu = "manage_modules";
        $Module = Modules::find($id);

        //Adding Log Data.
        $moduleId = get_module("edit_module");
        $log = !empty($moduleId) ? add_log('info','View edit module form.',$moduleId,Auth::user()->id,getDateTime()) : "";

        return view('modules.create',compact('activeMenu','subMenu','Module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateModule(Request $request, $id)
    {
        $validatedData = $request->validate([
            'module' => ['required','string']
        ]);

        $moduleId = get_module("edit_module");

        try {
            $date = getDateTime();
            $module = Modules::find($id);
            $module->name = $request->input('module');
            $module->status = empty($request->input('status')) ? 0 : $request->input('status');
            $module->updated_at = $date;

            if($module->save()) {
                //Adding Log Data.
                $log = !empty($moduleId) ? add_log('info','Module udpated successfully.',$moduleId,Auth::user()->id,getDateTime()) : "";
                
                return redirect()->route('modules')->with('success','Module updated successfully.');    
            } else {
                return redirect()->route('modules')->with('error','Failed to update module.');    
            }    
        } catch (Exception $e) {
            //Adding Log Data.
            $log = !empty($moduleId) ? add_log('info','Failed to udpate module ->'.$e,$moduleId,Auth::user()->id,getDateTime()) : "";

            return redirect()->route('modules')->with('error','Failed to update module.'); 
        }

    }

    public function changeModuleStatus(Request $request) {
        $moduleid = $request->moduleid;
        $status = ($request->status == 1 ? 0 : 1);
        if(!empty($moduleid)) {
            $module = Modules::where('id',$moduleid)
                                ->update(['status' => $status]);

            if($module) {
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
