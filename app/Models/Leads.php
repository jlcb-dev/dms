<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Leads extends Model
{
    use HasFactory, Searchable;

    protected $connection   = 'mysql_dms';
    protected $table        = 'tbl_leads';
    protected $primaryKey   = 'rec_id';
    protected $fillable = [
        'rec_id',
        'companyid',
        'lead_id',
        'prefix',
        'last_name',
        'first_name',
        'middle_name',
        'company_name',
        'birth_date',
        'gender',
        'occupation',
        'address_no_street_brgy',
        'address_town',
        'address_town_id`',
        'address_province',
        'address_province_id',
        'zipcode',
        'mobile_no',
        'mobile_no2',
        'tel_no',
        'tel_no2',
        'email_address',
        'lead_source',
        'lead_status',
        'lead_type',
        'emp_idno',
        'se_name',
        'next_activity',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function toSearchableArray()

    {

        return [

            'last_name'         => $this->last_name,
            'first_name'        => $this->first_name,
            'middle_name'       => $this->middle_name,
            'company_name'      => $this->middle_name
        ];

    }
}
