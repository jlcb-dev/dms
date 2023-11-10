@extends('layouts.main')

@section('content')
    {{-- Session --}}
    <input type="hidden" id="user_name" value="{{ session('user_name') }}">
    <input type="hidden" id="lead_type" value="{{ request('lead_type') }}">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="fw-bold"><i class="fa-solid fa-user-plus">&nbsp;</i>Leads</h4>
                </div>
                <div class="col-sm-4 text-end">
                    <a class="btn btn-sm btn-secondary px-4" href="{{ url('list-of-leads', request('lead_type')) }}">Back</a>
                </div>
            </div>
            <hr>

            {{------------------------------- Multi Form -------------------------------}}
            <div id="multi_form" class="multisteps-form">
                <!--progress bar-->
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <div class="multisteps-form__progress">
                            {{-- <button class="multisteps-form__progress-btn js-active" type="button"
                                title="Customer Information">Verify</button> --}}
                            <button class="multisteps-form__progress-btn js-active" type="button"
                                title="Customer Information">Customer Information</button>
                            <button class="multisteps-form__progress-btn" type="button" title="Other Access">Vehicle
                                Information</button>
                        </div>
                    </div>
                </div>
                {{-- Start Forms {{ route('postUser') }} --}}
                <section class="multisteps-form__form">

                    <!-- step two -->
                    {{-- <div class="multisteps-form__panel p-4 rounded bg-white js-active" data-animation="scaleIn">
                        <h5 class="fw-bold">Verify</h5>
                        <div class="multisteps-form__content">
                            <div class="row">
                                <form action="{{ route('leadSearch') }}">
                                    <div class="col-sm-8 mb-1">
                                        <div class="input-group">
                                            <input name="search_data" id="search_data" type="text"
                                                class="form-control form-control-sm"
                                                placeholder="Search by Last  Name, First Name, Middle Name, or Company Name"
                                                required>
                                            <button id="md_lookup" class="btn btn-sm btn-primary" type="submit"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>

                                    </div>
                                </form>
                                @isset($leads_data)
                                    @if (count($leads_data) === 0)
                                        <div class="mt-4">
                                            <h5 class="text-danger fw-bold">No leads found. Proceed with the encoding.</h5>
                                        </div>
                                    @else
                                        <div class="table-responsive mt-4">
                                            <table class="table table table-striped table-bordered table-sm table-hover"
                                                id="dtbLeads">
                                                <thead class="text-center align-middle nowrap" nowrap>
                                                    <tr>
                                                        <th width="15%">Lead ID</th>
                                                        <th width="30%">Prospect Name</th>
                                                        <th width="20%">Company Name</th>
                                                        <th width="10%">Status</th>
                                                        <th width="10%">Inquiry Date</th>
                                                        <th width="15%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leads_data as $row)
                                                        @php
                                                            $seq_no = $loop->iteration;
                                                            $rec_id_a = $row->rec_id;
                                                            $lead_id_a = $row->lead_id;
                                                            $prefix_a = $row->prefix;
                                                            $first_name_a = $row->first_name;
                                                            $middle_name_a = $row->middle_name;
                                                            $last_name_a = $row->last_name;
                                                            $company_name_a = $row->company_name;
                                                            $lead_status_a = $row->lead_status;

                                                            $full_name_a = $prefix_a . ' ' . $last_name_a . ', ' . $first_name_a . ', ' . $middle_name_a;

                                                        @endphp
                                                        <tr class="nowrap">
                                                            <td class="text-center">{{ $lead_id_a }}</td>
                                                            <td class="text-start">{{ $full_name_a }}</td>
                                                            <td class="text-start">{{ $company_name_a }}</td>
                                                            <td class="text-center">{{ $lead_status_a }}</td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center">

                                                                <button type="button" id="btnEdit"
                                                                    value="{{ $rec_id_a }}" data-backdrop="false"
                                                                    data-bs-toggle="modal" data-bs-target="#viewLeadsModal"
                                                                    class="btn btn-sm btn-primary btnEdit"><i
                                                                        class="fa-solid fa-edit"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endisset

                            </div>

                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button id="btnNext1" class="btn btn-primary btn-lg fs-5 js-btn-next" type="button"
                                title="Next">Next</button>
                        </div>
                    </div> --}}
                    <form action="{{ route('postLeads') }}" class="multisteps-form__form needs-validation" method="post"
                        novalidate>
                        @csrf
                        <!-- step two -->
                        <div class="multisteps-form__panel p-4 rounded bg-white js-active" data-animation="scaleIn">

                            <h5 class="fw-bold">Customer Information</h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    {{-- Row 1 --}}
                                    <div class="col-sm-3 mb-1">
                                        <label for="prefix" class="form-label-sm text-dark fw-medium">Prefix <span
                                                class="text-danger fw-bold">*</span></label>
                                        <select name="prefix" id="prefix" class="form-select form-select-sm" required>
                                            <option value="" selected disabled>Choose</option>
                                            @isset($prefix)
                                                @foreach ($prefix as $row_prefix)
                                                    <option value="{{ $row_prefix->prefix_id }}">
                                                        {{ $row_prefix->prefix_id }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <div class="invalid-feedback"> Please select Prefix</div>
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="last_name" class="form-label-sm text-dark fw-medium">Last Name<span
                                                class="text-danger fw-bold">*</span></label>
                                        <input name="last_name" id="last_name" type="text"
                                            class="form-control form-control-sm" placeholder="Last Name" required>
                                        <div class="invalid-feedback">Please enter Last Name</div>
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="first_name" class="form-label-sm text-dark fw-medium">First Name<span
                                                class="text-danger fw-bold">*</span></label>
                                        <input name="first_name" id="first_name" type="text"
                                            class="form-control form-control-sm" placeholder="First Name" required>
                                        <div class="invalid-feedback">Please enter First Name</div>
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="middle_name" class="form-label-sm text-dark fw-medium">Middle
                                            Name<span class="text-danger fw-bold">*</span></label>
                                        <input name="middle_name" id="middle_name" type="text"
                                            class="form-control form-control-sm" placeholder="Middle Name" required>
                                        <div class="invalid-feedback">Please enter Middle Name</div>
                                    </div>

                                    {{-- Row 2 --}}
                                    <div class="col-sm-2 mb-1">
                                        <label for="birth_date" class="form-label-sm text-dark fw-medium">Date of
                                            Birth</label>
                                        <div class="input-group input-group-sm">
                                            <input id="birth_date" name="birth_date" type="text"
                                                class="form-control form-control-sm" placeholder="Date of Birth"
                                                onkeydown="return false;">
                                            <span id="clickdate" class="input-group-text"><i
                                                    class="fa-solid fa-calendar-days"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="gender" class="form-label-sm text-dark fw-medium">Gender <span
                                                class="text-danger fw-bold">*</span></label>
                                        <select name="gender" id="gender" class="form-select form-select-sm"
                                            required>
                                            <option value="" selected disabled>Choose</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <div class="invalid-feedback"> Please select Gender</div>
                                    </div>
                               
                                    <div class="col-sm-6 mb-1">
                                        <label for="company_name"
                                            class="form-label-sm text-dark fw-medium">Company</label>
                                        <input name="company_name" id="company_name" type="text"
                                            class="form-control form-control-sm" placeholder="Company">
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="occupation"
                                            class="form-label-sm text-dark fw-medium">Occupation</label>
                                        <input name="occupation" id="occupation" type="text"
                                            class="form-control form-control-sm" placeholder="Occupation">
                                    </div>

                                    {{-- Row 3 --}}
                                    <div class="col-sm-6 mb-1">
                                        <label for="address_no_street_brgy"
                                            class="form-label-sm text-dark fw-medium">Address
                                            (No, Street, Subdivision, Barangay)</label>
                                        <input name="address_no_street_brgy" id="address_no_street_brgy" type="text"
                                            class="form-control form-control-sm"
                                            placeholder="Address (No, Street, Subdivision)">
                                        <div class="invalid-feedback">Enter Address (No, Street, Subdivision, Barangay)
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="address_town" class="form-label-sm text-dark fw-medium">Town</label>
                                        <select name="address_town" id="address_town" class="form-select form-select-sm">
                                            <option value="">Select province first</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="address_province"
                                            class="form-label-sm text-dark fw-medium">Province</label>
                                        <select name="address_province" id="address_province"
                                            class="form-select form-select-sm">
                                            <option value="" selected disabled>Choose</option>
                                            @isset($province)
                                                @foreach ($province as $row_prov)
                                                    <option
                                                        value="{{ $row_prov->province_name . '|' . $row_prov->province_id }}">
                                                        {{ $row_prov->province_name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="zipcode" class="form-label-sm text-dark fw-medium">Zip Code</label>
                                        <input name="zipcode" id="zipcode" type="text"
                                            class="form-control form-control-sm" placeholder="Zip Code">
                                    </div>

                                    {{-- Row 4 --}}
                                    <div class="col-sm-2 mb-1">
                                        <label for="mobile_no" class="form-label-sm text-dark fw-medium">Primary Mobile
                                            No.
                                            <span class="text-danger fw-bold">*</span></label>
                                        <input name="mobile_no" id="mobile_no" type="text"
                                            class="form-control form-control-sm" placeholder="Primary Mobile No."
                                            required>
                                        <div class="invalid-feedback">Please enter Mobile No.</div>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="mobile_no2" class="form-label-sm text-dark fw-medium">Secondary Mobile
                                            No.</label>
                                        <input name="mobile_no2" id="mobile_no2" type="text"
                                            class="form-control form-control-sm" placeholder="Secondary Mobile No.">
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="tel_no" class="form-label-sm text-dark fw-medium">Home Phone</label>
                                        <input name="tel_no" id="tel_no" type="text"
                                            class="form-control form-control-sm" placeholder="Home Phone">
                                    </div>

                                    <div class="col-sm-4 mb-1">
                                        <label for="email_address" class="form-label-sm text-dark fw-medium">Email
                                            Address</label>
                                        <input name="email_address" id="email_address" type="text"
                                            class="form-control form-control-sm" placeholder="Email Address">
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="lead_source" class="form-label-sm text-dark fw-medium">Source <span
                                                class="text-danger fw-bold">*</span></label>
                                        <select name="lead_source" id="lead_source" class="form-select form-select-sm"
                                            required>
                                            <option value="" selected disabled>Choose</option>
                                            @isset($source)
                                                @foreach ($source as $row_source)
                                                    <option value="{{ $row_source->source_id }}">
                                                        {{ $row_source->source_desc }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <div class="invalid-feedback"> Please select Source </div>
                                    </div>

                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button id="btnNext1" class="btn btn-primary btn-lg fs-5 js-btn-next" type="button"
                                    title="Next">Next</button>
                            </div>

                        </div>
                        <!-- step three -->
                        <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
                            <h5 class="fw-bold">Vehicle Information</h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    {{-- Row 1 --}}
                                    <div class="col-sm-3 mb-1">
                                        <label for="lead_date" class="form-label-sm text-dark fw-medium">Inquiry
                                            Date</label>
                                        <div class="input-group input-group-sm">
                                            <input id="lead_date" name="lead_date" type="text"
                                                class="form-control form-control-sm" placeholder="Inquiry Date"
                                                onkeydown="return false;" required>
                                            <span id="clickdate2" class="input-group-text"><i
                                                    class="fa-solid fa-calendar-days"></i></span>
                                            <div class="invalid-feedback"> Please select Inquiry Date. </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="veh_year_model" class="form-label-sm text-dark fw-medium">Year
                                            Model</label>
                                        <select name="veh_year_model" id="veh_year_model"
                                            class="form-select form-select-sm" required>
                                            <option value=""> Select Year</option>
                                            @foreach (range(date('Y') + 1, 2010) as $row_year)
                                                <option value="{{ $row_year }}">{{ $row_year }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select Year Model</div>
                                    </div>

                                    <div class="col-sm-2 mb-1">
                                        <label for="veh_brand" class="form-label-sm text-dark fw-medium">Brand</label>
                                        <select name="veh_brand" id="veh_brand" class="form-select form-select-sm"
                                            required>
                                            @isset($brand)
                                                @foreach ($brand as $row_brand)
                                                    <option value="{{ $row_brand->brandid }}">
                                                        {{ $row_brand->brand_name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>

                                    <div class="col-sm-5 mb-1">
                                        <label for="model" class="form-label-sm text-dark fw-medium">Model
                                            Description</label>
                                        <select name="model" id="model" class="form-select form-select-sm"
                                            required>
                                            <option value=""> Select Year Model First</option>
                                        </select>
                                        <div class="invalid-feedback">Please select Model</div>
                                    </div>

                                    <input id="veh_model" type="hidden" value="">
                                    <input id="veh_variant" type="hidden" value="">
                                    <input id="veh_description" type="hidden" value="">
                                    <input id="model_prefix" type="hidden" value="">
                                    <input id="model_variant_id" type="hidden" value="">


                                    <div class="col-sm-3 mb-1">
                                        <label for="veh_engine" class="form-label-sm text-dark fw-medium">Transmission
                                            (MT/AT)</label>
                                        <select name="veh_engine" id="veh_engine" class="form-select form-select-sm">
                                            <option value="" selected disabled> Select Transmission</option>
                                            <option value="AT"> Automatic (AT)</option>
                                            <option value="CVT"> Automatic (CVT)</option>
                                            <option value="MT"> Manual (MT)</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="veh_color" class="form-label-sm text-dark fw-medium">Preferred
                                            Color</label>
                                        <input name="veh_color" id="veh_color" type="text"
                                            class="form-control form-control-sm" placeholder="Color">
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="lead_status" class="form-label-sm text-dark fw-medium">Lead
                                            Status</label>
                                        <select name="lead_status" id="lead_status" class="form-select form-select-sm"
                                            required>
                                            <option value="" selected disabled> Choose</option>
                                            @isset($lead_status)
                                                @foreach ($lead_status as $row_status)
                                                    <option value="{{ $row_status->statusid }}">
                                                        {{ $row_status->status_desc }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <div class="invalid-feedback">Please select Lead Status</div>
                                    </div>

                                    <div class="col-sm-3 mb-1">
                                        <label for="mode_of_payment" class="form-label-sm text-dark fw-medium">Preferred
                                            Mode
                                            of Payment</label>
                                        <select name="mode_of_payment" id="mode_of_payment"
                                            class="form-select form-select-sm">
                                            <option value="" selected disabled> Choose</option>
                                            @isset($mop)
                                                @foreach ($mop as $row_mop)
                                                    <option value="{{ $row_mop->mop_id }}">
                                                        {{ $row_mop->mop_description }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-grid gap-2 col-sm-6">
                                            <button class="btn btn-outline-primary btn-lg fs-5 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                        </div>
                                        <div class="d-grid gap-2 col-sm-6">
                                            <button id="btnSave" class="btn btn-success btn-lg fs-5"
                                                type="button">Save</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>    
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script>
        //$("#multi_form").hide();
        //----- Save/Update Leads -----//

        function SaveLeads() {

            var prefix = $("#prefix").val();
            var last_name = $("#last_name").val();
            var first_name = $("#first_name").val();
            var middle_name = $("#middle_name").val();
            var birth_date = $("#birth_date").val();
            var gender = $("#gender").val();
            var company_name = $("#company_name").val();
            var occupation = $("#occupation").val();
            var address_no_street_brgy = $("#address_no_street_brgy").val();
            var address_town_arr = $("#address_town").val();
            var town_arr = address_town_arr.split('|');
            var address_town = town_arr[0];
            var address_town_id = town_arr[1];
            var address_province_arr = $("#address_province").val();
            var prov_arr = address_province_arr.split('|');
            var address_province = prov_arr[0];
            var address_province_id = prov_arr[1];
            var zipcode = $("#zipcode").val();
            var mobile_no = $("#mobile_no").val();
            var mobile_no2 = $("#mobile_no2").val();
            var tel_no = $("#tel_no").val();
            var email_address = $("#email_address").val();
            var lead_source = $("#lead_source").val();

            var lead_date = $("#lead_date").val();
            var veh_year_model = $("#veh_year_model").val();
            var veh_brand = $("#veh_brand").val();
            var veh_model = $("#veh_model").val();
            var veh_variant = $("#veh_variant").val();
            var veh_description = $("#veh_description").val();
            var model_prefix = $("#model_prefix").val();
            var model_variant_id = $("#model_variant_id").val();
            var veh_engine = $("#veh_engine").val();
            var veh_color = $("#veh_color").val();
            var lead_status = $("#lead_status").val();
            var mode_of_payment = $("#mode_of_payment").val();

            var user_name = $("#user_name").val();
            var lead_type = $("#lead_type").val();

            $('#btnSave').prop("disabled", true);

            $.ajax({
                url: '{{ route('postLeads') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "prefix": prefix,
                    "last_name": last_name,
                    "first_name": first_name,
                    "middle_name": middle_name,
                    "birth_date": birth_date,
                    "gender": gender,
                    "company_name": company_name,
                    "occupation": occupation,
                    "address_no_street_brgy": address_no_street_brgy,
                    "address_town": address_town,
                    "address_town_id": address_town_id,
                    "address_province": address_province,
                    "address_province_id": address_province_id,
                    "zipcode": zipcode,
                    "mobile_no": mobile_no,
                    "mobile_no2": mobile_no2,
                    "tel_no": tel_no,
                    "email_address": email_address,
                    "lead_source": lead_source,

                    "lead_date": lead_date,
                    "veh_year_model": veh_year_model,
                    "veh_brand": veh_brand,
                    "veh_model": veh_model,
                    "veh_variant": veh_variant,
                    "veh_description": veh_description,
                    "model_prefix": model_prefix,
                    "model_variant_id": model_variant_id,
                    "veh_engine": veh_engine,
                    "veh_color": veh_color,
                    "lead_status": lead_status,
                    "mode_of_payment": mode_of_payment,
                    "user_name": user_name,
                    "lead_type": lead_type

                },

                success: function(response) {

                    //alert(user_recid)
                    if ($.trim(response.message) == 'Success') {
                        Swal.fire('Successfully Added.', '', 'success')
                    } else {
                        Swal.fire(response.error, '', 'error')
                        $('#btnSave').prop("disabled", false);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire('Kindly check your internet connection.', '', 'error')
                }
            }); //AJAX-END	

        }

        $(document).on("click", "#btnSave", function(event) {

            event.preventDefault();
            if ($('.needs-validation')[0].checkValidity() === false) {
                Swal.fire('Kindly fill out required fields.', '', 'error')
                event.stopPropagation();
            } else {

                Swal.fire({
                    title: 'Save Record?',
                    text: "Are you sure you want to save this data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#858796',
                    confirmButtonText: 'YES',
                    cancelButtonText: 'NO',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            setTimeout(function() {
                                SaveLeads()
                                resolve()
                            }, 2000)
                        })
                    }
                })

            }
            $('.needs-validation').addClass('was-validated');
        });

        $("#address_province").change(function() {

            var address_province = $("#address_province").val();
            var prov_arr = address_province.split('|');

            var province_name = prov_arr[0];
            var province_id = prov_arr[1];

            $.ajax({
                url: '{{ route('fetch_town') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "province_id": province_id
                },
                success: function(data) {
                    $('#address_town').html('<option value="">Select Town </option>');
                    $.each(data.town_data, function(key, row_town) {
                        $("#address_town").append('<option value="' + row_town.city_town_name +
                            '|' + row_town.city_id + '">' + row_town.city_town_name +
                            '</option>');
                    });
                    $("#zipcode").val('');
                }
            });

        });

        $("#address_town").change(function() {

            var address_town = $("#address_town").val();
            var town_arr = address_town.split('|');

            var city_town_name = town_arr[0];
            var city_id = town_arr[1];

            $.ajax({
                url: '{{ route('fetch_zip') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "city_id": city_id
                },
                success: function(data) {
                    $("#zipcode").val(data.zipcode_data);
                }
            });

        });

        $('#veh_year_model').on('change', function() {

            //var txtyearmodel = $(this).find(':selected').data('id')
            var veh_year_model = $("#veh_year_model").val();
            var veh_brand = $("#veh_brand").val();

            if (veh_year_model) {

                $.ajax({
                    url: '{{ route('fetch_model') }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        "veh_year_model": veh_year_model,
                        "veh_brand": veh_brand
                    },
                    success: function(data) {
                        $('#model').html(
                            '<option value="1375" selected>No Preferred Vehicle Model Yet. </option>'
                        );
                        $.each(data.model_data, function(key, row_model) {
                            $("#model").append('<option value="' + row_model.rec_id +
                                '|' + row_model.model + '|' + row_model.variant + '|' +
                                row_model.trans + '|' + row_model.model_var_des + '">' +
                                veh_year_model + ' ' + row_model.model_var_des + '</option>'
                            );
                        });
                        $("#veh_model").val('');
                        $("#veh_variant").val('');
                        $("#veh_engine").val('');
                        $("#veh_description").val('');
                        $("#model_prefix").val('');
                        $("#model_variant_id").val('');

                    }
                });
            }

        });

        $('#model').on('change', function() {

            var veh_year_model = $("#veh_year_model").val();
            var veh_description = $("#model").val();
            var veh_desc_arr = veh_description.split('|');

            var model_variant_id = veh_desc_arr[0];
            var veh_model = veh_desc_arr[1];
            var veh_variant = veh_desc_arr[2];
            var veh_engine = veh_desc_arr[3];
            var veh_description = veh_desc_arr[4];

            $("#veh_model").val(veh_model);
            $("#veh_variant").val(veh_variant);
            $("#veh_engine").val(veh_engine);
            $("#veh_description").val(veh_year_model + ' ' + veh_description);
            $("#model_prefix").val(veh_model);
            $("#model_variant_id").val(model_variant_id);
        });


        $(document).ready(function() {

            $('input[name="birth_date"]').singleDatePicker();
            $('input[name="lead_date"]').singleDatePicker();
            //Disable right click on specific input field
            $("#birth_date").on("contextmenu", function(e) {
                return false;
            });
            $("#lead_date").on("contextmenu", function(e) {
                return false;
            });

            $("#clickdate").click(function() {
                $("#birth_date").focus();
            });
            $("#clickdate2").click(function() {
                $("#lead_date").focus();
            });

        });

        $.fn.singleDatePicker = function() {
            $(this).on("apply.daterangepicker", function(e, picker) {
                picker.element.val(picker.startDate.format(picker.locale.format));
                //setAge(picker.startDate);
            });
            return $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                autoApply: true
            });
        };

        //DOM elements
        const DOMstrings = {
            stepsBtnClass: 'multisteps-form__progress-btn',
            stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
            stepsBar: document.querySelector('.multisteps-form__progress'),
            stepsForm: document.querySelector('.multisteps-form__form'),
            stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
            stepFormPanelClass: 'multisteps-form__panel',
            stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
            stepPrevBtnClass: 'js-btn-prev',
            stepNextBtnClass: 'js-btn-next'
        };

        //remove class from a set of items
        const removeClasses = (elemSet, className) => {
            elemSet.forEach(elem => {
                elem.classList.remove(className);
            });
        };
        //return exect parent node of the element
        const findParent = (elem, parentClass) => {
            let currentNode = elem;
            while (!currentNode.classList.contains(parentClass)) {
                currentNode = currentNode.parentNode;
            }
            return currentNode;
        };
        //get active button step number
        const getActiveStep = elem => {
            return Array.from(DOMstrings.stepsBtns).indexOf(elem);
        };
        //set all steps before clicked (and clicked too) to active
        const setActiveStep = activeStepNum => {
            //remove active state from all the state
            removeClasses(DOMstrings.stepsBtns, 'js-active');
            //set picked items to active
            DOMstrings.stepsBtns.forEach((elem, index) => {
                if (index <= activeStepNum) {
                    elem.classList.add('js-active');
                }
            });
        };
        //get active panel
        const getActivePanel = () => {
            let activePanel;
            DOMstrings.stepFormPanels.forEach(elem => {
                if (elem.classList.contains('js-active')) {
                    activePanel = elem;
                }
            });
            return activePanel;
        };
        //open active panel (and close unactive panels)
        const setActivePanel = activePanelNum => {
            //remove active class from all the panels
            removeClasses(DOMstrings.stepFormPanels, 'js-active');
            //show active panel
            DOMstrings.stepFormPanels.forEach((elem, index) => {
                if (index === activePanelNum) {
                    elem.classList.add('js-active');
                    setFormHeight(elem);
                }
            });
        };
        //set form height equal to current panel height
        const formHeight = activePanel => {
            const activePanelHeight = activePanel.offsetHeight;
            DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
        };
        const setFormHeight = () => {
            const activePanel = getActivePanel();
            formHeight(activePanel);
        };
        //STEPS BAR CLICK FUNCTION
        DOMstrings.stepsBar.addEventListener('click', e => {
            //check if click target is a step button
            const eventTarget = e.target;
            if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
                return;
            }
            //get active button step number
            const activeStep = getActiveStep(eventTarget);
            //set all steps before clicked (and clicked too) to active
            setActiveStep(activeStep);
            //open active panel
            setActivePanel(activeStep);
        });
        //PREV/NEXT BTNS CLICK
        DOMstrings.stepsForm.addEventListener('click', e => {
            const eventTarget = e.target;
            //check if we clicked on `PREV` or NEXT` buttons
        if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList
                .contains(`${DOMstrings.stepNextBtnClass}`))) {
            return;
        }
        //find active panel
        const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
        let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);
        //set active step and active panel onclick
        if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
                activePanelNum--;
            } else {
                activePanelNum++;
            }
            setActiveStep(activePanelNum);
            setActivePanel(activePanelNum);
        });
        //SETTING PROPER FORM HEIGHT ONLOAD
        window.addEventListener('load', setFormHeight, false);
        //SETTING PROPER FORM HEIGHT ONRESIZE
        window.addEventListener('resize', setFormHeight, false);
    </script>
@endsection
