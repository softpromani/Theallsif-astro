<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Error;
use App\Models\Faq;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function faq()
    {

        if (request()->ajax()) {
            $faqs = Faq::latest()->get();
            return Datatables::of($faqs)
                ->addIndexColumn()
                ->addColumn('answer', function ($row) {
                    $ht = '';
                    $ht .= $row->answer;
                    return $ht;
                })
                ->addColumn('action', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('faq_edit')) {
                        $ht .= '<a href="' . route("admin.faqEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('faq_delete')) {
                        $ht .= ' <form action="' . route("admin.astrologer.destroy", $id) . '" method="post" style="display:inline">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    }
                    return $ht;
                })
                ->rawColumns(['action', 'answer'])
                ->make(true);
        }
        return view('admin.webpages.faqpage');
    }

    public function faqAdd(Request $request)
    {
        $request->validate([
            'faq' => 'required',
            'answer' => 'required',
        ]);
        try {
            if ($request->id != null) {
                $id = Crypt::decrypt($request->id);
                $res = Faq::find($id)->update(
                    [
                        'faq' => $request->faq,
                        'answer' => $request->answer,
                    ]
                );
                if ($res) {
                    return redirect()->back()->with('success', 'Faq Updated Sucessfully');
                } else {
                    return redirect()->back()->with('error', 'Faq not Update ');
                }
            } else {
                $res = Faq::create(
                    [
                        'faq' => $request->faq,
                        'answer' => $request->answer,
                    ]
                );
                if ($res) {
                    return redirect()->back()->with('success', 'Faq Added Sucessfully');
                } else {
                    return redirect()->back()->with('error', 'Faq not Add ');
                }
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function faqEdit($id)
    {
        $ids = Crypt::decrypt($id);
        $faq = Faq::find($ids);
        return view('admin.webpages.faqpage', compact('faq'));
    }
}
