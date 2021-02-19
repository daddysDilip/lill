<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LinkGroups;
use App\GroupLinksMapping as LinkMapping;
use App\UserLinks;
use Auth;

class LinkGroupsController extends Controller
{
    public function showAllGroups() {
        $user_id = Auth::guard('user')->user()->id;
        $LinkGroups = LinkGroups::fetchUserGroup($user_id);
        return view('link_group.groups',compact('LinkGroups'));
    }

    public function createLinkGroup() {
        $user_id = Auth::guard('user')->user()->id;
        $UserLinks = UserLinks::getUserLinks($user_id);
        return view('link_group.create',compact('UserLinks'));
    }

    public function insertLinkGroup(Request $request) {
        
        $Group = new LinkGroups();
        $Group->group_name = $request->group_name ?? '';
        $Group->user_id = Auth::guard('user')->user()->id ?? '';
        $Group->created_at = getDateTime();

        if($request->hasFile('group_icon')) {
            $file = $request->file('group_icon');
            $new_icon = time().rand(100,999)."-".$file->getClientOriginalName();
            $file->move(public_path().'/uploads/group_icon/', $new_icon);
            $Group->group_icon = $new_icon;
        }

        $check_group_exist = LinkGroups::where('group_name','=',strtolower($request->group_name))->get();

        if(count($check_group_exist) <= 0) {
            if($Group->save()) {
                if(!empty($request->user_links)) {
                    foreach($request->user_links as $links) {
                        $user_links[] = array(
                            'link_id' => $links,
                            'group_id' => $Group->id,
                            'created_at' => getDateTime()
                        );
                    }
                }

                LinkMapping::insert($user_links);
                
                return redirect()->route('user.links.groups')->with('success','Group created successfully');
            }
        } else {
            return redirect()->route('user.links.groups')->with('success','Failed to create link group. Please try again later.');
        }

    }

    public function viewGroupLinks($id) {
        if($id != "") {
            $GroupLinks = LinkGroups::leftJoin('groups_links_mapping as link_map','link_groups.id','=','link_map.group_id')
                    ->leftJoin('user_links','user_links.id','=','link_map.link_id')
                    ->where('link_groups.id',$id)
                    ->where('link_groups.user_id',Auth::guard('user')->user()->id)
                    ->select('link_groups.*','link_map.id as link_map_id','link_map.link_id as link_id','link_map.group_id as group_id','user_links.id as link_id','user_links.website_url','user_links.generated_link','user_links.link_title as link_title')
                    ->get();
            return view('tools.group_links_modal',compact('GroupLinks'));
        } else {
            echo "fail";
        }
    }

    public function deleteGroupLink(Request $request) {
        if($request->ajax() && $request->map_id != "") {
            $query = LinkMapping::where('id',$request->map_id)->delete();
            if($query) {
                return response()->json(['status' => 'success','msg' => 'Link deleted from group successfully.']);
            } else {
                return response()->json(['status' => 'fail','msg' => 'Failed to delete link. Please try again later.']);
            }
        } else {
            return response()->json(['status' => 'fail','msg' => 'Failed to delete link. Please try again later.']);
        }
    }

    public function deleteLinkGroup(Request $request) {
        if($request->ajax() && $request->group_id != "") {
            $group_links = LinkMapping::where('group_id',$request->group_id)->delete();
            $group = LinkGroups::where('id',$request->group_id)->delete();
            if($group_links && $group) {
                return response()->json(['status' => 'success','msg' => 'Group deleted successfully.']);
            } else {
                return response()->json(['status' => 'fail','msg' => 'Failed to delete group. Please try again later.']);
            }
        } else {
            return response()->json(['status' => 'fail','msg' => 'Failed to delete group. Please try again later.']);
        }
    }
}
