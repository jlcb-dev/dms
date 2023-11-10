<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        if (empty(session('user_name'))) {
            return redirect()->route('login')->with('message', 'Please Login to your account!');
        }

        $delivered = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'D')
        ->count();

        $hot = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'Hot')
        ->count();

        $warm = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'Warm')
        ->count();

        $cold = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'Cold')
        ->count();

        $fordelivery = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'FD')
        ->count();


        $wafa = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'WAFA')
        ->count();

        $inactive = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'FD')
        ->count();


        $lostSales = DB::connection('mysql_dms')->table("tbl_lead_inquiry as a")
        ->leftJoin('tbl_leads as b', function ($join) {
            $join->on('b.companyid', '=', 'a.companyid')
                ->on('b.lead_id', '=', 'a.lead_id');
        })
        ->where('a.lead_status', 'LS')
        ->count();




        return view('home.index',compact('delivered','hot','warm','cold','fordelivery','wafa','inactive','lostSales'));
    }
}
