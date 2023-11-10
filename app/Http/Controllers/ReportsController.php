<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    public function index()
    {
        if (empty(session('user_name'))) {
            return redirect()->route('login')->with('message', 'Please Login to your account!');
        }

        $lead_status = DB::connection('mysql_dms')->table("tbl_lead_status")
            ->select(DB::raw('statusid, status_desc, sorting'))
            ->where('include', '=', 'Y')
            ->orderBy('sorting')->get();

        return view('reports.index', compact('lead_status'));
    }

    public function fetch_leads(Request $request)
    {

        $date           = $request->date;
        $lead_status    = $request->lead_status;
        $companyid = 'CWI-HO';

        if ($lead_status == 'ALL') {
            $leads = Leads::where('companyid', $companyid)
                ->orderBy('lead_id')
                ->get();
        } else {
            $leads = Leads::where('companyid', $companyid)
                ->where('lead_status', $lead_status)
                ->orderBy('lead_id')
                ->get();
        }



        $viewLeads = view('reports.tbl-leads-summary', compact('leads'))->render();

        return response()->json(['leads_data' => $viewLeads]);
    }
}
