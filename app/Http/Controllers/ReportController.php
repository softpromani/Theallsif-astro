<?php

namespace App\Http\Controllers;

use App\Models\Astrologer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Exception;

class ReportController extends Controller
{
    public function callReport()
    {
        if (request()->ajax()) {
            $astrogers = Astrologer::latest()->get();
            return Datatables::of($astrogers)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.report.call_report');
    }

    public function chatReport()
    {

        if (request()->ajax()) {
            $astrogers = Astrologer::latest()->get();
            return Datatables::of($astrogers)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.report.chat_report');
    }
    public function revenueReport()
    {
        return view('admin.report.revenue_report');
    }
}
