<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserLinks;
use Auth;
use App\CustomClass\ExportLinks;
use App\Imports\ImportLinks;
use Excel;
use Log;

class BulkLinksController extends Controller
{
    public function showExportLinks() {
        $tab = "export_links";
        $UserLinks = UserLinks::getUserLinks(Auth::guard('user')->user()->id);
        return view('bulk_links.index',compact('tab','UserLinks'));
    }

    public function exportLinks(Request $request) {
        if($request->has('user_links')) {
            foreach($request->user_links as $links) {
                $query = UserLinks::get_link_by_id($links);
                $linkArr[] = array(
                    'Destination URL' => $query->website_url,
                    'Short URL' => $query->generated_link,
                    'Title' => $query->link_title,
                    'Code' => $query->link_code
                );
            }
            return Excel::download(new ExportLinks($linkArr), 'User_Links_Report'.getDateTime().'.xlsx');
        }
    }

    public function showImportLinks(Request $request) {
        $tab = "import_links";
        return view('bulk_links.index',compact('tab'));
    }

    public function downloadImportSampleFile() {
        $path_to_file = public_path()."/uploads/ImportSample.xlsx";
        Log::info($path_to_file);
        return \Response::download($path_to_file,'ImportSample.xlsx');
    }

    public function importLinks(Request $request) {
        if($request->hasFile('import_links')) {
            $real_path = $request->file('import_links')->store('temp');
            $stored_path = storage_path('app').'/'.$real_path;
            $data = Excel::import(new ImportLinks, $real_path);
            if($data) {
                return redirect()->back()->with('success','Links imported successfully.');
            } else {
                return redirect()->back()->with('error','Failed to import links. Please try again later.');
            }
        }
    }
}
