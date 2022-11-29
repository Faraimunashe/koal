<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('admin.notice', [
            'notices' => $notices
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string']
        ]);

        try{
            $notice = new Notice();
            $notice->title = $request->title;
            $notice->content = $request->content;
            $notice->save();

            return redirect()->back()->with('success', 'successfully  added new notice');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'notice_id' => ['required', 'integer']
        ]);

        try{
            $notice = Notice::find($request->notice_id);
            $notice->delete();

            return redirect()->back()->with('success', 'successfully  deleted notice');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
