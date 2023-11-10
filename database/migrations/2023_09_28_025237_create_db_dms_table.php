<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_brand_list', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('brandid', 5)->nullable();
            $table->string('brand_name', 100)->nullable();
            $table->integer('brand_count')->nullable();
            $table->string('groupid', 10)->nullable();
            $table->char('include', 1)->nullable()->default('Y');
        });

        Schema::create('tbl_city_town', function (Blueprint $table) {
            $table->integer('city_id', true);
            $table->integer('province_id')->nullable();
            $table->string('city_town_name', 50)->nullable();
            $table->string('zip_code', 4)->nullable();
        });

        Schema::create('tbl_lead_inquiry', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('companyid', 10)->nullable()->index('byCompany');
            $table->string('lead_id', 11)->nullable()->index('byLeadID');
            $table->string('lead_inq_id', 11)->nullable()->index('byLeadInqID');
            $table->string('lead_source', 10)->nullable();
            $table->string('veh_year_model', 4)->nullable();
            $table->string('veh_brand', 20)->nullable();
            $table->string('veh_model', 50)->nullable();
            $table->string('veh_description', 100)->nullable();
            $table->string('veh_engine', 20)->nullable();
            $table->string('veh_color', 20)->nullable();
            $table->string('lead_date', 50)->nullable();
            $table->string('lead_status', 20)->nullable();
            $table->string('lead_type', 1)->nullable();
            $table->string('emp_idno', 20)->nullable();
            $table->string('se_name', 50)->nullable();
            $table->string('mode_of_payment', 3)->nullable();
            $table->string('model_prefix', 100)->nullable();
            $table->string('model_code', 100)->nullable();
            $table->integer('model_variant_id')->nullable();
            $table->string('sales_cond_no', 10)->nullable();
            $table->string('sales_vsi_no', 10)->nullable();
            $table->string('sales_vsi_date', 10)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
        });

        Schema::create('tbl_lead_status', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('statusid', 20)->nullable();
            $table->string('status_desc', 100)->nullable();
            $table->string('sorting', 11)->nullable();
            $table->string('include', 1)->nullable()->default('Y');
        });

        Schema::create('tbl_leads', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('companyid', 10)->nullable()->index('byCompany');
            $table->string('lead_id', 10)->nullable()->index('byLeadID');
            $table->string('prefix', 8)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('first_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->string('company_name', 80)->nullable();
            $table->string('birth_date', 20)->nullable();
            $table->string('gender', 6)->nullable();
            $table->string('occupation', 60)->nullable();
            $table->string('address_no_street_brgy', 150)->nullable();
            $table->string('address_town', 20)->nullable();
            $table->string('address_town_id', 10)->nullable();
            $table->string('address_province', 20)->nullable();
            $table->string('address_province_id', 50)->nullable();
            $table->string('zipcode', 4)->nullable();
            $table->string('mobile_no', 100)->nullable();
            $table->string('mobile_no2', 100)->nullable();
            $table->string('tel_no', 100)->nullable();
            $table->string('tel_no2', 100)->nullable();
            $table->string('email_address', 100)->nullable();
            $table->string('lead_source', 10)->nullable();
            $table->string('lead_status', 20)->nullable();
            $table->string('lead_type', 1)->nullable();
            $table->string('emp_idno', 20)->nullable();
            $table->string('se_name', 50)->nullable();
            $table->string('next_activity', 100)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 100)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
        });

        Schema::create('tbl_model_variant', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('dealer_code', 20)->nullable();
            $table->string('branch_code', 20)->nullable();
            $table->string('groupid', 20)->nullable();
            $table->string('companyid', 60)->nullable();
            $table->string('modelvar_code', 100)->nullable();
            $table->string('option_code', 5)->nullable();
            $table->integer('year_model')->nullable();
            $table->string('brandid', 20)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('variant', 100)->nullable();
            $table->string('trans', 5)->nullable();
            $table->string('model_var_des', 150)->nullable();
            $table->string('active', 1)->nullable()->default('Y');
            $table->string('fsl_id', 20)->nullable();
            $table->string('date_added', 100)->nullable();
            $table->string('added_by', 20)->nullable();
            $table->string('model_prefix', 100)->nullable();
        });

        Schema::create('tbl_mop', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('mop_id', 3)->nullable();
            $table->string('mop_description', 25)->nullable();
        });

        Schema::create('tbl_prefix', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('prefix_id', 20)->nullable();
        });

        Schema::create('tbl_province', function (Blueprint $table) {
            $table->integer('province_id', true);
            $table->string('province_name', 50)->nullable();
            $table->string('phone_area_code', 5)->nullable();
        });

        Schema::create('tbl_source', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->string('source_id', 10)->nullable()->index('bySrcID');
            $table->string('source_desc', 80)->nullable();
            $table->string('sortby', 20)->nullable();
            $table->string('description', 1000)->nullable();
        });

        Schema::create('tbl_users', function (Blueprint $table) {
            $table->integer('rec_id', true);
            $table->integer('usercode')->index('byUserCode');
            $table->string('emp_idno', 12)->nullable()->index('byEmpID');
            $table->string('username', 40)->nullable();
            $table->string('password', 150)->nullable();
            $table->string('default_password', 150)->nullable();
            $table->string('full_name', 50)->nullable();
            $table->string('email_address', 50)->nullable();
            $table->string('mobile_no', 13)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('active', 1)->nullable();
            $table->string('access_rights', 20)->nullable();
            $table->string('change_password', 1)->nullable();
            $table->dateTime('change_date')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('created_by', 20)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('updated_by', 20)->nullable();
            $table->dateTime('modified_at')->nullable();
            $table->string('modified_by', 20)->nullable();
            $table->dateTime('deactivated_at')->nullable();
            $table->string('deactivated_by', 20)->nullable();
            $table->string('is_admin', 1)->nullable()->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');

        Schema::dropIfExists('tbl_source');

        Schema::dropIfExists('tbl_province');

        Schema::dropIfExists('tbl_prefix');

        Schema::dropIfExists('tbl_mop');

        Schema::dropIfExists('tbl_model_variant');

        Schema::dropIfExists('tbl_leads');

        Schema::dropIfExists('tbl_lead_status');

        Schema::dropIfExists('tbl_lead_inquiry');

        Schema::dropIfExists('tbl_city_town');

        Schema::dropIfExists('tbl_brand_list');
    }
};
