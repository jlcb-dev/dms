<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
class LoancalcuController extends Controller
{
    public function index()
    {
        if (empty(session('user_name'))) {
            return redirect()->route('login')->with('message', 'Please Login to your account!');
        }

        $accessories = DB::connection('mysql_dms')->table("tbl_accessories")
            ->select(DB::raw('accessories_id, accessories_description, accessories_amount'))
            ->where('active_item', '=', 'Y')->get();


        return view('loan-calculator.index', compact('accessories'));
    }

    public function generatePdf(Request $request)
    {
   
        $data = [
            'result_veh' => $request->veh_description,
            'result_price' => $request->veh_unit_price,
            'result_dp' => $request->txt_down_payment,
            'result_dp_erc' => $request->txt_dp_percentage,
            'result_amnt_fin' => $request->amt_financed,
            'result_fin_term' => $request->fin_term,
            'result_mthly_amrt' => $request->mnthly_amrt,
            'm12_months' => $request->m12_months,
            'm18_months' => $request->m18_months,
            'm24_months' => $request->m24_months,
            'm36_months' => $request->m36_months,
            'm48_months' => $request->m48_months,
            'm60_months' => $request->m60_months,
            'tbodyContent' => $request->tbodyContent,
            'veh_quotation' => $request->veh_quotation,
        ];

        $pdf = PDF::loadView('loan-calculator.quotationPDF', $data);

        // Generate the PDF content
        $pdfContent = $pdf->output();

        // Generate a unique filename for the PDF
        $filename = 'Vehicle_Quotation_' . uniqid() . '.pdf';
        // Save the PDF to a temporary storage location
        Storage::disk('public')->put($filename, $pdfContent);
        // Return the URL to access the saved PDF
        return response()->json(['url' => Storage::url($filename)]);
        
    }
}
