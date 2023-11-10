<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsInquiry extends Model
{
    use HasFactory;

    
    protected $connection   = 'mysql_dms';
    protected $table        = 'tbl_lead_inquiry';

    protected $fillable = [
        'rec_id',
        'companyid',
        'lead_id',
        'lead_inq_id',
        'lead_source',
        'veh_year_model',
        'veh_brand',
        'veh_model',
        'veh_variant',
        'veh_description',
        'veh_engine',
        'veh_color',
        'lead_date',
        'lead_status',
        'lead_type',
        'se_name',
        'mode_of_payment',
        'model_prefix',
        'model_code',
        'model_variant_id',
        'sales_cond_no',
        'sales_vsi_no',
        'sales_vsi_date',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];


}
