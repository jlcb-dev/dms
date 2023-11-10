@extends('layouts.main')

@section('content')

    {{-- Session --}}
    <input type="hidden" id="user_name" value="{{ session('user_name') }}">

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="fw-bold">My Leads</h4>
                </div>
                <div class="col-sm-4 text-end">
                    <a class="btn btn-sm btn-primary" href="{{ url('leads', request('lead_type')) }}"><i
                            class="fa-solid fa-plus"></i>&nbsp;Add New Leads</a>
                </div>
            </div>
            <form action="" class="" method="post">
                @csrf
                <div class="table-responsive mt-4">
                    <table class="table table table-striped table-bordered table-sm table-hover" id="dtbLeads">
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
                            @foreach ($view_leads as $row_leads)
                                @php
                                    $seq_no = $loop->iteration;
                                    $rec_id = $row_leads->rec_id;
                                    $lead_id = $row_leads->lead_id;
                                    $prefix = $row_leads->prefix;
                                    $first_name = $row_leads->first_name;
                                    $middle_name = $row_leads->middle_name;
                                    $last_name = $row_leads->last_name;
                                    $company_name = $row_leads->company_name;
                                    $lead_status = $row_leads->lead_status;

                                    $full_name = $prefix . ' ' . $last_name . ', ' . $first_name . ', ' . $middle_name;

                                @endphp
                                <tr class="nowrap">
                                    <td class="text-center">{{ $lead_id }}</td>
                                    <td class="text-start">{{ $full_name }}</td>
                                    <td class="text-start">{{ $company_name }}</td>
                                    <td class="text-center">{{ $lead_status }}</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">

                                        {{-- <button class="btn btn-sm btn-primary btnEdit"><i class="fa-solid fa-user-pen me-1"></i></button> --}}

                                        <button type="button" id="btnEdit" value="{{ $rec_id }}"
                                            class="btn btn-sm btn-primary btnEdit"><i class="fa-solid fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on("click", "#btnAddVehInuiry", function(event) {
            $('.needs-validation2').removeClass('was-validated');
            var secondModal = new bootstrap.Modal(document.getElementById('viewLeadsInqModal'), {
                backdrop: 'static',
                keyboard: false
            });
            secondModal.show();
            $('#modalLabel').html('Add New Vehicle Inquiry ');
            $('#status').val('Add');

            $("#rec_id2").val('');
            $("#lead_id").val('');
            $("#lead_inq_id").val('');
            $("#lead_date").val('');
            $("#veh_year_model").val('');
            $('#model').html(
                '<option value="">Select Year Model First</option>'
            );
            $("#veh_model").val('');
            $("#veh_variant").val('');
            $("#veh_description").val('');
            $("#model_prefix").val('');
            $("#model_variant_id").val('');
            $("#veh_engine").val('');
            $("#veh_color").val('');
            $("#lead_status").val('');
            $("#mode_of_payment").val('');
            $('#btnSaveInq').prop("disabled", false);

        });

        function UpdateLeadsInq() {

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

            var rec_id2 = $("#rec_id2").val();
            var lead_id = $("#lead_id").val();
            var lead_inq_id = $("#lead_inq_id").val();
            var status = $("#status").val();
            var lead_id_for_inq = $("#lead_id_for_inq").val();

            if (status == 'Add') {
                var route = "{{ route('updateLeadsNewInq') }}";
                $('#btnSaveInq').prop("disabled", true);
            } else if (status == 'Update') {
                var route = "{{ route('updateLeadsInq') }}";
                $('#btnSaveInq').prop("disabled", false);
            }

            $.ajax({
                url: route,
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
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
                    "lead_type": lead_type,
                    "rec_id2": rec_id2,
                    "lead_id": lead_id,
                    "lead_inq_id": lead_inq_id,
                    "lead_id_for_inq": lead_id_for_inq
                },

                success: function(response) {

                    if ($.trim(response.message) == 'Update') {
                        if (status == 'Add') {
                            $('#leadsDataContainerTR').html('')
                            var leadsDataContainer = $('#leadsDataContainerTR');
                            var viewLeadsInq = response.view_leads_inq;

                            // Generate HTML based on the data and append it to the container
                            var html = '';
                            viewLeadsInq.forEach(function(lead) {
                                html += `
                                    <tr>
                                        <td class="text-center">${lead.lead_id}</td>
                                        <td class="text-center">${lead.lead_inq_id}</td>
                                        <td class="text-start">${lead.veh_description}</td>
                                        <td class="text-center">${lead.lead_status}</td>
                                        <td class="text-center">${lead.lead_date}</td>
                                        <td class="text-center">
                                            <button value="${lead.rec_id}|${lead.lead_id}|${lead.lead_inq_id}" id="btnEditInq" type="button" class="btn btn-sm btn-primary btnEditInq">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                                // Add other fields as needed

                                //  alert(lead.lead_inq_id)
                            });

                            leadsDataContainer.html(html);
                            Swal.fire('Successfully Added New Leads Vehicle Inquiry.', '', 'success')
                        } else if (status == 'Update') {
                            Swal.fire('Successfully Updated Leads Vehicle Inquiry.', '', 'success')
                        }
                    } else {
                        Swal.fire(response.error, '', 'error')
                        $('#btnSaveInq').prop("disabled", false);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire('Kindly check your internet connection.', '', 'error')
                }
            }); //AJAX-END	

        }

        $(document).on("click", "#btnSaveInq", function(event) {

            event.preventDefault();
            if ($('.needs-validation2')[0].checkValidity() === false) {
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
                                UpdateLeadsInq()
                                resolve()
                            }, 2000)
                        })
                    }
                })

            }
            $('.needs-validation2').addClass('was-validated');
        });

        function UpdateLeads() {

            var rec_id = $("#rec_id").val();
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

            var user_name = $("#user_name").val();

            $.ajax({
                url: '{{ route('updateLeads') }}',
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
                    "user_name": user_name,
                    "rec_id": rec_id
                },

                success: function(response) {

                    if ($.trim(response.message) == 'Update') {
                        Swal.fire('Successfully Updated Leads Customer Information.', '', 'success')

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
                                UpdateLeads()
                                resolve()
                            }, 2000)
                        })
                    }
                })

            }
            $('.needs-validation').addClass('was-validated');
        });

        $(document).on("click", ".btnEditInq", function(event) {

            //var secondModal = new bootstrap.Modal(document.getElementById('viewLeadsInqModal'));
            var secondModal = new bootstrap.Modal(document.getElementById('viewLeadsInqModal'), {
                backdrop: 'static',
                keyboard: false
            });
            secondModal.show();

            $('#modalLabel').html('Edit Vehicle Inquiry ');
            $('#status').val('Update');
            $('#btnSaveInq').prop("disabled", false);
            var data = $(this).val();
            var data_arr = data.split("|");
            var rec_id = data_arr[0];
            var lead_id = data_arr[1];
            var lead_inq_id = data_arr[2];

            $.ajax({
                url: '{{ route('fetchUpdateLeadsInq') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "rec_id": rec_id,
                    "lead_id": lead_id,
                    "lead_inq_id": lead_inq_id
                },
                success: function(data) {
                    $("#rec_id2").val(data.rec_id);
                    $("#lead_id").val(data.lead_id);
                    $("#lead_inq_id").val(data.lead_inq_id);
                    $("#lead_date").val(data.lead_date);
                    $("#veh_year_model").val(data.veh_year_model);
                    $("#veh_brand").val(data.veh_brand);
                    $("#veh_model").val(data.veh_model);
                    $("#veh_variant").val(data.veh_variant);
                    $("#veh_description").val(data.veh_description);
                    $("#model_prefix").val(data.model_prefix);
                    $("#model_variant_id").val(data.model_variant_id);
                    $("#veh_engine").val(data.veh_engine);
                    $("#veh_color").val(data.veh_color);
                    $("#lead_status").val(data.lead_status);
                    $("#mode_of_payment").val(data.mode_of_payment);
                    veh_year_model(data.model_variant_id)
                }
            });


        });


        $(document).on("click", ".btnEdit", function(event) {
            $('.needs-validation').removeClass('was-validated');
            //var firstModal = new bootstrap.Modal(document.getElementById('viewLeadsModal'));
            var firstModal = new bootstrap.Modal(document.getElementById('viewLeadsModal'), {
                backdrop: 'static',
                keyboard: false
            });
            var rec_id = $(this).val();
            firstModal.show();
            $.ajax({
                url: '{{ route('fetchUpdateLeads') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "rec_id": rec_id
                },
                success: function(data) {
                    $("#rec_id").val(data.rec_id);
                    $("#prefix").val(data.prefix);
                    $("#last_name").val(data.last_name);
                    $("#first_name").val(data.first_name);
                    $("#middle_name").val(data.middle_name);
                    $("#birth_date").val(data.birth_date);
                    $("#gender").val(data.gender);
                    $("#company_name").val(data.company_name);
                    $("#occupation").val(data.occupation);
                    $("#address_no_street_brgy").val(data.address_no_street_brgy);
                    // $("#address_town").val(data.address_town);
                    $("#address_province").val(data.address_province);
                    address_town(data.city_id)

                    $("#zipcode").val(data.zipcode);
                    $("#mobile_no").val(data.mobile_no);
                    $("#mobile_no2").val(data.mobile_no2);
                    $("#tel_no").val(data.tel_no);
                    $("#email_address").val(data.email_address);
                    $("#lead_source").val(data.lead_source);
                    $("#lead_id_for_inq").val(data.lead_id);

                    var leadsDataContainer = $('#leadsDataContainerTR');
                    var viewLeadsInq = data.view_leads_inq;

                    // Generate HTML based on the data and append it to the container
                    var html = '';
                    viewLeadsInq.forEach(function(lead) {
                        html += `
                            <tr>
                                <td class="text-center">${lead.lead_id}</td>
                                <td class="text-center">${lead.lead_inq_id}</td>
                                <td class="text-start">${lead.veh_description}</td>
                                <td class="text-center">${lead.lead_status}</td>
                                <td class="text-center">${lead.lead_date}</td>
                                <td class="text-center">
                                    <button value="${lead.rec_id}|${lead.lead_id}|${lead.lead_inq_id}" id="btnEditInq" type="button" class="btn btn-sm btn-primary btnEditInq">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        // Add other fields as needed

                        //  alert(lead.lead_inq_id)
                    });

                    leadsDataContainer.html(html);
                    // $.each(data.view_leads_inq, function(key, row_leads) {
                    //     $("#leadsDataContainerTR").append('<td>' + row_leads.companyid + '</td>');

                    //   //  alert(row_leads.companyid)
                    // });
                }
            });

        });

        function address_town(city_id) {

            var address_province = $("#address_province").val();
            var prov_arr = address_province.split("|");
            var province_id = prov_arr[1];

            $.ajax({
                url: '{{ route('fetch_town_update') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "province_id": province_id
                },
                success: function(data) {
                    $('#address_town').html('<option value="">Select Town </option>');
                    $.each(data.town_data2, function(key, row_town) {
                        $("#address_town").append('<option value="' + row_town.city_town_name +
                            '|' + row_town.city_id + '" ' + (row_town.city_id == city_id ?
                                'selected' : '') + ' >' + row_town.city_town_name +
                            '</option>');
                    });

                }
            });

        }

        function veh_year_model(model_variant_id) {

            //var txtyearmodel = $(this).find(':selected').data('id')
            var veh_year_model = $("#veh_year_model").val();
            var veh_brand = $("#veh_brand").val();

            if (veh_year_model) {

                $.ajax({
                    url: '{{ route('fetch_model_update') }}',
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
                                row_model.trans + '|' + row_model.model_var_des + '" ' + (row_model
                                    .rec_id == model_variant_id ? 'selected' : '') + ' >' +
                                veh_year_model + ' ' + row_model.model_var_des + '</option>'
                            );
                        });


                    }
                });
            }

        }

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

        $(document).ready(function() {
            $('#dtbLeads').DataTable({
                "lengthMenu": [
                    [7, 10, 25, 50, 100, -1],
                    [7, 10, 25, 50, 100, "All"]
                ]

            });
        });
    </script>
@endsection
@include('leads.leads-modal')
@include('leads.leads-inq-modal')
