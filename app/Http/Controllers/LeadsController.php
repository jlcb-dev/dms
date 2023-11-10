<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use App\Models\LeadsInquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    public function index()
    {
        if (empty(session('user_name'))) {
            return redirect()->route('login')->with('message', 'Please Login to your account!');
        } else {
            $prefix = DB::connection('mysql_dms')->table("tbl_prefix")->get();

            $source = DB::connection('mysql_dms')->table("tbl_source")
                ->select(DB::raw('source_id, source_desc'))
                ->orderBy('sortby')->get();

            $lead_status = DB::connection('mysql_dms')->table("tbl_lead_status")
                ->select(DB::raw('statusid, status_desc, sorting'))
                ->where('include', '=', 'Y')
                ->orderBy('sorting')->get();

            $mop = DB::connection('mysql_dms')->table("tbl_mop")
                ->orderBy('mop_id')->get();

            $province = DB::connection('mysql_dms')->table("tbl_province")
                ->select(DB::raw('province_name, province_id'))
                ->orderByRaw("FIELD(province_name, 'Pampanga') DESC")
                ->orderBy('province_name')->get();

            $brand = DB::connection('mysql_dms')->table("tbl_brand_list")
                ->select(DB::raw('brandid, brand_name, groupid'))
                ->where('groupid', '=', 'CWI')
                ->orderBy('brand_name')->get();

            return view('leads.index', compact('prefix', 'source', 'lead_status', 'mop', 'province', 'brand'));
        }
    }

    public function fetch_town(Request $request)
    {

        $town = DB::connection('mysql_dms')->table("tbl_city_town")
            ->select(DB::raw('city_id, province_id, city_town_name'))
            ->where('province_id', '=', $request->province_id)
            ->orderBy('city_town_name')->get();

        //   $town = 'test';


        // $view_town = view('leads.index', compact('town'))->render();

        return response()->json(['town_data' => $town]);
    }

    public function fetch_town_update(Request $request)
    {

        $town2 = DB::connection('mysql_dms')->table("tbl_city_town")
            ->select(DB::raw('city_id, province_id, city_town_name'))
            ->where('province_id', '=', $request->province_id)
            ->orderBy('city_town_name')->get();

        //   $town = 'test';


        // $view_town = view('leads.index', compact('town'))->render();

        return response()->json(['town_data2' => $town2]);
    }

    public function fetch_zip(Request $request)
    {

        $zip_query = DB::connection('mysql_dms')->table("tbl_city_town")
            ->select(DB::raw('city_id, province_id, city_town_name, zip_code'))
            ->where('city_id', '=', $request->city_id)->first();

        $zipcode = $zip_query->zip_code;


        // $view_town = view('leads.index', compact('town'))->render();

        return response()->json(['zipcode_data' => $zipcode]);
    }

    public function fetch_model(Request $request)
    {

        $no_preferred = DB::connection('mysql_dms')
            ->table("tbl_model_variant")
            ->select(DB::raw('rec_id, year_model, brandid, model, variant, trans, model_var_des, dealer_code, groupid, companyid'))
            ->where('rec_id', '1375');

        $get_model = DB::connection('mysql_dms')
            ->table("tbl_model_variant")
            ->select(DB::raw('rec_id, year_model, brandid, model, variant, trans, model_var_des, dealer_code, groupid, companyid'))
            ->where('year_model', $request->veh_year_model)
            ->where('brandid', $request->veh_brand)
            ->union($no_preferred)
            //->orderByRaw("FIELD(rec_id, '1375') DESC")
            //->orderBy('model_var_des')
            ->get();

        return response()->json(['model_data' => $get_model]);
    }

    public function fetch_model_update(Request $request)
    {

        $no_preferred = DB::connection('mysql_dms')
            ->table("tbl_model_variant")
            ->select(DB::raw('rec_id, year_model, brandid, model, variant, trans, model_var_des, dealer_code, groupid, companyid'))
            ->where('rec_id', '1375');

        $get_model = DB::connection('mysql_dms')
            ->table("tbl_model_variant")
            ->select(DB::raw('rec_id, year_model, brandid, model, variant, trans, model_var_des, dealer_code, groupid, companyid'))
            ->where('year_model', $request->veh_year_model)
            ->where('brandid', $request->veh_brand)
            ->union($no_preferred)
            //->orderByRaw("FIELD(rec_id, '1375') DESC")
            //->orderBy('model_var_des')
            ->get();

        return response()->json(['model_data' => $get_model]);
    }

    //----Save Leads-----//
    public function postLeads(Request $request)
    {
        $companyid = "CWI-HO";

        $last_lead = Leads::where('companyid', $companyid)
            ->orderBy('lead_id', 'DESC')
            ->limit(1)
            ->selectRaw('CONCAT("PR", RIGHT(RIGHT(lead_id, 8) + 1 + 100000000, 8)) AS leadid')
            ->first();

        $lead_id = $last_lead ? $last_lead->leadid : "PR00000001";

        $last_lead_inq = LeadsInquiry::where('companyid', $companyid)
            ->orderBy('lead_inq_id', 'DESC')
            ->limit(1)
            ->selectRaw('CONCAT("INQ",right((right(lead_inq_id,8)+1)+100000000,8)) lead_inq_id')
            ->first();

        $lead_inq_id = $last_lead_inq ? $last_lead_inq->lead_inq_id : "INQ00000001";


        $se = User::select(DB::raw('full_name as se_name, emp_idno'))
            ->where('username', $request->user_name)
            ->first();

        $se_name = $se->se_name;
        $emp_id = $se->emp_idno;

        $date_now           = now();

        Leads::insert([

            'companyid'                 => $companyid,
            'lead_id'                   => $lead_id,
            'prefix'                    => $request->prefix,
            'last_name'                 => $request->last_name,
            'first_name'                => $request->first_name,
            'middle_name'               => $request->middle_name,
            'company_name'              => $request->company_name,
            'birth_date'                => $request->birth_date,
            'gender'                    => $request->gender,
            'occupation'                => $request->occupation,
            'address_no_street_brgy'    => $request->address_no_street_brgy,
            'address_town'              => $request->address_town,
            'address_town_id'           => $request->address_town_id,
            'address_province'          => $request->address_province,
            'address_province_id'       => $request->address_province_id,
            'zipcode'                   => $request->zipcode,
            'mobile_no'                 => $request->mobile_no,
            'mobile_no2'                => $request->mobile_no2,
            'tel_no'                    => $request->tel_no,
            'email_address'             => $request->email_address,
            'lead_source'               => $request->lead_source,
            'lead_status'               => $request->lead_status,
            'lead_type'                 => $request->lead_type,
            'emp_idno'                  => $emp_id,
            'se_name'                   => $se_name,
            'created_at'                => $date_now,
            'created_by'                => $request->user_name,

        ]);

        LeadsInquiry::insert([

            'companyid'             => $companyid,
            'lead_id'               => $lead_id,
            'lead_inq_id'           => $lead_inq_id,
            'lead_source'           => $request->lead_source,
            'veh_year_model'        => $request->veh_year_model,
            'veh_brand'             => $request->veh_brand,
            'veh_model'             => $request->veh_model,
            'veh_variant'           => $request->veh_variant,
            'veh_description'       => $request->veh_description,
            'veh_engine'            => $request->veh_engine,
            'veh_color'             => $request->veh_color,
            'lead_date'             => $request->lead_date,
            'lead_status'           => $request->lead_status,
            'lead_type'             => $request->lead_type,
            'emp_idno'              => $emp_id,
            'se_name'               => $se_name,
            'mode_of_payment'       => $request->mode_of_payment,
            'model_variant_id'      => $request->model_variant_id,
            'model_prefix'          => $request->model_prefix,
            'created_at'            => $date_now,
            'created_by'            => $request->user_name,

        ]);

        return response()->json(['message' => 'Success']);
    }

    //----Update Leads-----//
    public function updateLeads(Request $request)
    {


        if (Leads::where('rec_id', $request->rec_id)->exists()) {

            $se = User::select(DB::raw('full_name as se_name, emp_idno'))
                ->where('username', $request->user_name)
                ->first();

            $se_name = $se->se_name;
            $emp_id = $se->emp_idno;

            $date_now           = now();
            $update_user = Leads::where('rec_id', $request->rec_id)
                ->update([
                    'prefix' => $request->prefix, 'last_name' => $request->last_name, 'first_name' => $request->first_name, 'middle_name' => $request->middle_name,
                    'company_name' => $request->company_name, 'birth_date' => $request->birth_date, 'gender' => $request->gender, 'occupation' => $request->occupation,
                    'address_no_street_brgy' => $request->address_no_street_brgy, 'address_town' => $request->address_town, 'address_town_id' => $request->address_town_id,
                    'address_province' => $request->address_province, 'address_province_id' => $request->address_province_id, 'zipcode' => $request->zipcode,
                    'mobile_no' => $request->mobile_no, 'mobile_no2' => $request->mobile_no2, 'tel_no' => $request->tel_no,
                    'email_address' => $request->email_address, 'lead_source' => $request->lead_source,
                    'emp_idno' => $emp_id, 'se_name' => $se_name, 'updated_at' => $date_now, 'updated_by' => $request->user_name,
                ]);

            return response()->json(['message' => 'Update']);
        } else {
            return response()->json(['error' => 'Record doesn`t exist. Please check record ID']);
        }
    }

    //----Update Leads Inquiry-----//
    public function updateLeadsInq(Request $request)
    {

        if (LeadsInquiry::where('rec_id', $request->rec_id2)->where('lead_id', $request->lead_id)->where('lead_inq_id', $request->lead_inq_id)->exists()) {

            $se = User::select(DB::raw('full_name as se_name, emp_idno'))
                ->where('username', $request->user_name)
                ->first();

            $se_name = $se->se_name;
            $emp_id = $se->emp_idno;

            $date_now           = now();
            $update_user = LeadsInquiry::where('rec_id', $request->rec_id2)->where('lead_id', $request->lead_id)->where('lead_inq_id', $request->lead_inq_id)
                ->update([
                    'veh_year_model' => $request->veh_year_model, 'veh_brand' => $request->veh_brand, 'veh_model' => $request->veh_model,
                    'veh_variant' => $request->veh_variant, 'veh_description' => $request->veh_description, 'veh_engine' => $request->veh_engine, 'veh_color' => $request->veh_color,
                    'lead_date' => $request->lead_date, 'lead_status' => $request->lead_status, 'emp_idno' => $emp_id, 'se_name' => $se_name,
                    'mode_of_payment' => $request->mode_of_payment, 'model_variant_id' => $request->model_variant_id, 'model_prefix' => $request->model_prefix,
                    'updated_at' => $date_now, 'updated_by' => $request->user_name,
                ]);

            return response()->json(['message' => 'Update']);
        } else {
            return response()->json(['error' => 'Record doesn`t exist. Please check record ID']);
        }
    }

    //----Update New Leads Inquiry-----//
    public function updateLeadsNewInq(Request $request)
    {
        $companyid = "CWI-HO";

        $last_lead_inq = LeadsInquiry::where('companyid', $companyid)
            ->orderBy('lead_inq_id', 'DESC')
            ->limit(1)
            ->selectRaw('CONCAT("INQ",right((right(lead_inq_id,8)+1)+100000000,8)) lead_inq_id')
            ->first();

        $lead_inq_id = $last_lead_inq ? $last_lead_inq->lead_inq_id : "INQ00000001";

        $se = User::select(DB::raw('full_name as se_name, emp_idno'))
            ->where('username', $request->user_name)
            ->first();

        $se_name    = $se->se_name;
        $emp_id     = $se->emp_idno;
        $date_now   = now();

        $get_leads = Leads::select(DB::raw('lead_source, lead_type'))
            ->where('companyid', $companyid)
            ->where('lead_id', $request->lead_id_for_inq)
            ->first();

        $lead_source    = $get_leads->lead_source;
        $lead_type      = $get_leads->lead_type;

        if (Leads::where('companyid', $companyid)->where('lead_id', $request->lead_id_for_inq)->exists()) {

            LeadsInquiry::insert([

                'companyid'             => $companyid,
                'lead_id'               => $request->lead_id_for_inq,
                'lead_inq_id'           => $lead_inq_id,
                'lead_source'           => $lead_source,
                'veh_year_model'        => $request->veh_year_model,
                'veh_brand'             => $request->veh_brand,
                'veh_model'             => $request->veh_model,
                'veh_variant'           => $request->veh_variant,
                'veh_description'       => $request->veh_description,
                'veh_engine'            => $request->veh_engine,
                'veh_color'             => $request->veh_color,
                'lead_date'             => $request->lead_date,
                'lead_status'           => $request->lead_status,
                'lead_type'             => $lead_type,
                'emp_idno'              => $emp_id,
                'se_name'               => $se_name,
                'mode_of_payment'       => $request->mode_of_payment,
                'model_variant_id'      => $request->model_variant_id,
                'model_prefix'          => $request->model_prefix,
                'created_at'            => $date_now,
                'created_by'            => $request->user_name,

            ]);

            $view_leads_inq = LeadsInquiry::where('companyid', $companyid)
                ->where('lead_id', $request->lead_id_for_inq)
                ->get();

            return response()->json(['message' => 'Update', 'view_leads_inq' => $view_leads_inq,]);
        } else {
            return response()->json(['error' => 'Record doesn`t exist. Please check record ID']);
        }
    }

    public function leads_view(Request $request)
    {

        if (empty(session('user_name'))) {
            return redirect()->route('login')->with('message', 'Please Login to your account!');
        } else {

            $prx = DB::connection('mysql_dms')->table("tbl_prefix")
                ->select(DB::raw('prefix_id'))
                ->orderBy('prefix_id')->get();

            $source = DB::connection('mysql_dms')->table("tbl_source")
                ->select(DB::raw('source_id, source_desc'))
                ->orderBy('sortby')->get();

            $lead_status2 = DB::connection('mysql_dms')->table("tbl_lead_status")
                ->select(DB::raw('statusid, status_desc, sorting'))
                ->where('include', '=', 'Y')
                ->orderBy('sorting')->get();

            $mop = DB::connection('mysql_dms')->table("tbl_mop")
                ->orderBy('mop_id')->get();


            $province = DB::connection('mysql_dms')->table("tbl_province")
                ->select(DB::raw('province_name, province_id'))
                ->orderByRaw("FIELD(province_name, 'Pampanga') DESC")
                ->orderBy('province_name')->get();

            $brand = DB::connection('mysql_dms')->table("tbl_brand_list")
                ->select(DB::raw('brandid, brand_name, groupid'))
                ->where('groupid', '=', 'CWI')
                ->orderBy('brand_name')->get();



            $companyid  = "CWI-HO";
            $view_leads = Leads::where('companyid', $companyid)
                ->where('lead_type', $request->lead_type)
                ->orderBy('lead_id')
                ->get();


            return view('leads.leads_view', compact('view_leads', 'source', 'province', 'prx', 'lead_status2', 'mop', 'brand'));
        }
    }

    public function fetchUpdateLeads(Request $request)
    {
        $rec_id         =  $request->rec_id;
        $companyid      = "CWI-HO";
        $update_leads   = Leads::where('companyid', $companyid)
            ->where('rec_id', $rec_id)
            ->first();

        $rec_id                 = $update_leads->rec_id;
        $companyid2             = $update_leads->companyid;
        $lead_id                = $update_leads->lead_id;
        $prefix                 = $update_leads->prefix;
        $last_name              = $update_leads->last_name;
        $first_name             = $update_leads->first_name;
        $middle_name            = $update_leads->middle_name;
        $birth_date             = $update_leads->birth_date;
        $gender                 = $update_leads->gender;
        $company_name           = $update_leads->company_name;
        $occupation             = $update_leads->occupation;
        $address_no_street_brgy = $update_leads->address_no_street_brgy;
        $address_town           = $update_leads->address_town;
        $address_town_id        = $update_leads->address_town_id;
        $address_province       = $update_leads->address_province;
        $address_province_id    = $update_leads->address_province_id;
        $zipcode                = $update_leads->zipcode;
        $mobile_no              = $update_leads->mobile_no;
        $mobile_no2             = $update_leads->mobile_no2;
        $tel_no                 = $update_leads->tel_no;
        $email_address          = $update_leads->email_address;
        $lead_source            = $update_leads->lead_source;

        $view_leads_inq = LeadsInquiry::where('companyid', $companyid2)
            ->where('lead_id', $lead_id)
            ->get();

        return response()->json([
            'rec_id'                    => $rec_id,
            'prefix'                    => $prefix,
            'last_name'                 => $last_name,
            'first_name'                => $first_name,
            'middle_name'               => $middle_name,
            'birth_date'                => $birth_date,
            'gender'                    => $gender,
            'company_name'              => $company_name,
            'occupation'                => $occupation,
            'address_no_street_brgy'    => $address_no_street_brgy,
            'address_town'              => $address_town . '|' . $address_town_id,
            'address_province'          => $address_province . '|' . $address_province_id,
            'city_id'                   => $address_town_id,
            'zipcode'                   => $zipcode,
            'mobile_no'                 => $mobile_no,
            'mobile_no2'                => $mobile_no2,
            'tel_no'                    => $tel_no,
            'email_address'             => $email_address,
            'lead_source'               => $lead_source,
            'lead_id'                   => $lead_id,
            'view_leads_inq'            => $view_leads_inq,
        ]);
    }

    public function fetchUpdateLeadsInq(Request $request)
    {
        $rec_id2         =  $request->rec_id;
        $lead_id2        =  $request->lead_id;
        $lead_inq_id2    =  $request->lead_inq_id;
        $companyid2      = "CWI-HO";
        $update_leads_inq   = LeadsInquiry::where('companyid', $companyid2)
            ->where('rec_id', $rec_id2)
            ->where('lead_id', $lead_id2)
            ->where('lead_inq_id', $lead_inq_id2)
            ->first();

        $rec_id                 = $update_leads_inq->rec_id;
        $companyid              = $update_leads_inq->companyid;
        $lead_id                = $update_leads_inq->lead_id;
        $lead_inq_id            = $update_leads_inq->lead_inq_id;
        $lead_source            = $update_leads_inq->lead_source;
        $veh_year_model         = $update_leads_inq->veh_year_model;
        $veh_brand              = $update_leads_inq->veh_brand;
        $veh_model              = $update_leads_inq->veh_model;
        $veh_variant            = $update_leads_inq->veh_variant;
        $veh_description        = $update_leads_inq->veh_description;
        $veh_engine             = $update_leads_inq->veh_engine;
        $veh_color              = $update_leads_inq->veh_color;
        $lead_date              = $update_leads_inq->lead_date;
        $lead_status            = $update_leads_inq->lead_status;
        $lead_type              = $update_leads_inq->lead_type;
        $emp_idno               = $update_leads_inq->emp_idno;
        $se_name                = $update_leads_inq->se_name;
        $mode_of_payment        = $update_leads_inq->mode_of_payment;
        $model_prefix           = $update_leads_inq->model_prefix;
        $model_variant_id       = $update_leads_inq->model_variant_id;




        return response()->json([
            'rec_id'                 => $rec_id,
            'companyid'              => $companyid,
            'lead_id'                => $lead_id,
            'lead_inq_id'            => $lead_inq_id,
            'lead_source'            => $lead_source,
            'veh_year_model'         => $veh_year_model,
            'veh_brand'              => $veh_brand,
            'veh_model'              => $veh_model,
            'veh_variant'            => $veh_variant,
            'veh_description'        => $veh_description,
            'veh_engine'             => $veh_engine,
            'veh_color'              => $veh_color,
            'lead_date'              => $lead_date,
            'lead_status'            => $lead_status,
            'lead_type'              => $lead_type,
            'emp_idno'               => $emp_idno,
            'se_name'                => $se_name,
            'mode_of_payment'        => $mode_of_payment,
            'model_prefix'           => $model_prefix,
            'model_variant_id'       => $model_variant_id,

        ]);
    }

    public function load_leads_inq(Request $request)
    {
        $view_leads_inq = LeadsInquiry::where('companyid', $request->companyid)
            ->where('lead_id', $request->lead_id)
            ->get();

        return view('leads.leads-modal', compact('view_leads_inq'));
    }

    public function leadSearch(Request $request)
    {
        $leads_data = Leads::search($request->search_data)
            ->orderBy('last_name')
            ->get();

        $search = $request->search_data;

        return view('leads.index', compact('leads_data', 'search'));
    }
}
