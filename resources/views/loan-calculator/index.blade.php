@extends('layouts.main')

@section('content')

    {{-- Session --}}
    <input type="hidden" id="user_name" value="{{ session('user_name') }}">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold">Auto Financing Computation</h5>
            <form method="POST" action="" class="needs-validation" novalidate>
                @csrf
                <div class="row">

                    <div class="col-sm-6">

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="veh_description" class="col-form-label col-form-label-sm">Vehicle Unit
                                        Description:</label>
                                    <input value="2022 MITSUBISHI MIRAGE G4 GLX 1.5G CVT" type="text"
                                        class="form-control form-control-sm" id="veh_description" name="veh_description"
                                        placeholder="Vehicle Description" required>
                                    <div class="invalid-feedback">
                                        Enter Vehicle Unit Description.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <div class="form-group">
                                    <label for="veh_unit_price" class="col-form-label col-form-label-sm">Vehicle Unit
                                        Price:</label>
                                    <input type="text" class="form-control form-control-sm" id="veh_unit_price"
                                        placeholder="Unit Price" required>
                                    <div class="invalid-feedback">
                                        Enter Vehicle Unit Price.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <div class="form-group">
                                    <label for="veh_discount" class="col-form-label col-form-label-sm">Vehicle Unit
                                        Discount:</label>
                                    <input type="text" class="form-control form-control-sm" id="veh_discount"
                                        value="" placeholder="Unit Discount">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-n2">
                                <div class="form-group">
                                    <label for="vehicle_net_price" class="col-form-label col-form-label-sm">Vehicle Unit Net
                                        Price:</label>
                                    <input type="text" class="form-control form-control-sm" id="vehicle_net_price"
                                        placeholder="Unit Net Price" readonly>
                                    <div class="invalid-feedback">
                                        Enter Vehicle Unit Net Price.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <label class="col-form-label col-form-label-sm" for="user_password">Down Payment:</label>
                                <div class="input-group input-group-sm ">
                                    <input type="text" class="form-control col-4" id="txt_dp_percentage"
                                        placeholder="0.00" required>
                                    <input type="hidden" id="txt_dp_percentage_val">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">%</span>
                                    </div>
                                    <input type="text" class="form-control text-right col-8" id="txt_down_payment"
                                        placeholder="Down Payment" required>
                                    <div class="invalid-feedback">
                                        Enter Down Payment.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <div class="form-group">
                                    <label for="amt_financed" class="col-form-label col-form-label-sm">Amount
                                        Financed:</label>
                                    <input type="text" class="form-control form-control-sm" id="amt_financed"
                                        placeholder="Amount Financed" readonly>
                                    <div class="invalid-feedback">
                                        Enter Amount Financed.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <div class="form-group">
                                    <label for="dp_discount" class="col-form-label col-form-label-sm">Down Payment
                                        Discount:</label>
                                    <input type="text" class="form-control form-control-sm" id="dp_discount"
                                        placeholder="Down Payment Discount">
                                    <div class="invalid-feedback">
                                        Enter Down Payment Discount.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <label for="fin_term" class="col-form-label col-form-label-sm">Financing Term:</label>
                                <select class="custom-select custom-select-sm" id="fin_term" required>
                                    <option value="">Choose...</option>
                                    <option value="12">12 Months</option>
                                    <option value="18">18 Months</option>
                                    <option value="24">24 Months</option>
                                    <option value="36">36 Months</option>
                                    <option value="48">48 Months</option>
                                    <option value="60">60 Months</option>
                                    <!-- <option value="72">72 Months</option> -->
                                </select>
                                <div class="invalid-feedback">
                                    Select Financing Term.
                                </div>
                            </div>

                            <div class="col-sm-6 mt-n2">
                                <div class="form-check"><br>
                                    <div class="form-inline">
                                        <input id="chkbox" name="checkboxall" value=""
                                            class="form-check-input mr-2 ml-n3" type="checkbox">
                                        <label for="checkboxall" class="col-form-label">Desired Monthly
                                            Amortization</label>
                                    </div>
                                </div>
                            </div>

                            <div id="div_mnthly_amrt" class="col-sm-6 mt-n2">
                                <div class="form-group">
                                    <label for="mnthly_amrt" class="col-form-label col-form-label-sm">Monthly
                                        Amortization:</label>
                                    <input type="text" class="form-control form-control-sm" id="mnthly_amrt"
                                        placeholder="Monthly Amortization">
                                    <div class="invalid-feedback">
                                        Enter Monthly Amortization
                                    </div>
                                </div>
                            </div>

                        </div>

                        @include('loan-calculator.accessories')
                    </div>

                    <div class="col-sm-6 mt-2">
                        <div id="veh_quotation" class="table-responsive col-sm-12">

                            <div class="card mb-2">
                                <div class="card-body" id="content">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p class="text-primary text-danger" style="font-size: 15px;">Your computed
                                                indicative
                                                results are:</p>
                                        </div>
                                        <div class="col-sm-4 text-end .hidden-print">
                                            <button type="button" id="printButton" class="btn btn-sm btn-primary hidden-print"><i
                                                    class="fas fa-print"></i>
                                                Print PDF</button>
                                        </div>
                                    </div>
                                    <div id="veh_quotation2">
                                        <div class="form-group">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Vehicle Unit
                                                Description:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_veh"></span></label>
                                        </div>
                                        <div class="form-group mt-n3">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Vehicle Unit Net
                                                Price:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_price"></span></label>
                                        </div>
                                        <div class="form-group mt-n3">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Down
                                                Payment:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_dp"></span></label>
                                        </div>
                                        <div class="form-group mt-n3">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Amount
                                                Financed:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_amnt_fin"></span></label>
                                        </div>
                                        <div class="form-group mt-n3">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Number of
                                                Payments:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_fin_term"></span></label>
                                        </div>
                                        <div class="form-group mt-n3">
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-4 fw-bold">Monthly
                                                Amortization:</label>
                                            <label for="veh_description"
                                                class="col-form-label col-form-label-sm col-sm-6"><span
                                                    id="result_mthly_amrt"></span></label>
                                        </div>

                                        <table id="accssrs_tbl"
                                            class="table table-sm table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="100%" colspan="3" class="text-center align-middle">FULL
                                                        CASH
                                                        REQUIREMENTS</th>
                                                </tr>
                                                <tr>
                                                    <th width="35%" class="text-center align-middle">Description</th>
                                                    <th width="35%" class="text-center align-middle">Amount</th>
                                                    <th width="30%" class="text-center align-middle">Free</th>
                                                </tr>

                                            </thead>
                                            <tr align='center'>
                                                <td class='align-middle text-left'>Cash / Downpayment</td>
                                                <td class='align-middle text-right'><span id="cash_dp"></span></td>
                                                <td class='align-middle text-left'></td>
                                            </tr>
                                            <tbody id="cash_requirements">

                                            </tbody>
                                            <tr align='center'>
                                                <td class='align-middle text-left'>LESS: Down Payment Discount</td>
                                                <td class='align-middle text-right'><span id="result_dp_discount"></span></td>
                                                <td class='align-middle text-left'></td>
                                            </tr>
                                            <tr align='center'>
                                                <td class='align-middle text-right fw-bold' class="fw-bold">Total</td>
                                                <td class='align-middle text-right'><span class="fw-bold"
                                                        id="total_cash_dp"></span></td>
                                                <td class='align-middle'></td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-sm table-hover" id=""
                                            style="font-size: 13px !important;" nowrap>
                                            <thead nowrap>
                                                <tr>
                                                    <th class="text-center align-middle" colspan="7" width="100%">Other
                                                        Monthly Amortization</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="text-left align-middle" width="20%">Financing Terms</th>
                                                    <th id="lbl_12_months" class="text-center align-middle" width="13%">12
                                                        Months</th>
                                                    <th id="lbl_18_months" class="text-center align-middle" width="13%">18
                                                        Months</th>
                                                    <th id="lbl_24_months" class="text-center align-middle" width="13%">24
                                                        Months</th>
                                                    <th id="lbl_36_months" class="text-center align-middle" width="13%">36
                                                        Months</th>
                                                    <th id="lbl_48_months" class="text-center align-middle" width="13%">48
                                                        Months</th>
                                                    <th id="lbl_60_months" class="text-center align-middle" width="13%">60
                                                        Months</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left align-middle" width="20%">Monthly Amortization
                                                    </th>
                                                    <th id="" class="text-center align-middle 12_months"
                                                        width="13%">
                                                        <span id="12_months"></span>
                                                    </th>
                                                    <th id="" class="text-center align-middle 18_months"
                                                        width="13%">
                                                        <span id="18_months"></span>
                                                    </th>
                                                    <th id="" class="text-center align-middle 24_months"
                                                        width="13%">
                                                        <span id="24_months"></span>
                                                    </th>
                                                    <th id="" class="text-center align-middle 36_months"
                                                        width="13%">
                                                        <span id="36_months"></span>
                                                    </th>
                                                    <th id="" class="text-center align-middle 48_months"
                                                        width="13%">
                                                        <span id="48_months"></span>
                                                    </th>
                                                    <th id="" class="text-center align-middle 60_months"
                                                        width="13%">
                                                        <span id="60_months"></span>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text-danger" style="font-size: 13px;font-style:italic;">Disclaimer: The
                                            figures
                                            in this computation only serve as a guide and may change without prior notice.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-info btn-sm me-2 px-4" id="btnReset">Reset</button>
            <button type="button" class="btn btn-success btn-sm me-2 px-4" id="btnCompute">Compute</button>
        </div>
    </div>

    <script>
        $('#printButton').click(function() {

            var veh_description = $("#veh_description").val();
            var veh_unit_price = $("#vehicle_net_price").val();
            var txt_down_payment = $("#txt_down_payment").val();
            var txt_dp_percentage = accounting.formatMoney($("#txt_dp_percentage").val(), "", 2, ",", ".");
            var amt_financed = $("#amt_financed").val();
            var fin_term = $("#fin_term").val();
            var mnthly_amrt = $("#mnthly_amrt").val();

            var m12_months = $("#12_months").html();
            var m18_months = $("#18_months").html();
            var m24_months = $("#24_months").html();
            var m36_months = $("#36_months").html();
            var m48_months = $("#48_months").html();
            var m60_months = $("#60_months").html();

             var tbodyContent  = $("#cash_requirements").html();
             var veh_quotation  = $("#veh_quotation2").html();
             
           
        
            $.ajax({
                url: '{{ route('generatePdf') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    "veh_description": veh_description,
                    "veh_unit_price": veh_unit_price,
                    "txt_down_payment": txt_down_payment,
                    "txt_dp_percentage": txt_dp_percentage,
                    "amt_financed": amt_financed,
                    "fin_term": fin_term,
                    "mnthly_amrt": mnthly_amrt,
                    "m12_months": m12_months,
                    "m18_months": m18_months,
                    "m24_months": m24_months,
                    "m36_months": m36_months,
                    "m48_months": m48_months,
                    "m60_months": m60_months,
                    "tbodyContent": tbodyContent,
                    "veh_quotation": veh_quotation
                },
                success: function(response) {
                    if (response.url) {
                        // Use the URL provided in the response
                        var pdfUrl = response.url;
                        // Open the PDF in a new tab
                        window.open(pdfUrl);
                    } else {
                        alert('Failed to generate PDF.');
                    }

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire('Kindly check your internet connection.', '', 'error')
                }
            });

        });


        $('#veh_description').on('input', function() {
            let value = $(this).val().replace("'", "`").toUpperCase();
        $("#veh_description").val(value);
    });

    $('#veh_quotation').hide();
    $('#btnCompute').click(function() {

        if ($("#chkbox").is(':checked')) {
            //desiredMonthAmortization()
        } else {
            MonthlyAmortization()
        }

        var veh_description = $("#veh_description").val();
        var veh_unit_price = $("#vehicle_net_price").val();
        var txt_down_payment = $("#txt_down_payment").val();
        var txt_dp_percentage = accounting.formatMoney($("#txt_dp_percentage").val(), "", 2, ",", ".");
        var amt_financed = $("#amt_financed").val();
        var fin_term = $("#fin_term").val();
        var mnthly_amrt = $("#mnthly_amrt").val();

        if ($('.needs-validation')[0].checkValidity() === false) {
            Swal.fire('Kindly fill out required fields.', '', 'error')
            event.stopPropagation();
        } else {

            if ($("#chkbox").is(':checked')) {
                desiredMonthAmortization()
            } else {
                MonthlyAmortization()
                //computeDP();
                computeDP_percentage()
                // MonthlyAmortization();
                CashRequirements();
            }

            $("#result_veh").html(veh_description);
            $("#result_price").html(veh_unit_price);
            $("#result_dp").html(txt_down_payment + " (" + txt_dp_percentage + "%)");
            $("#result_amnt_fin").html(amt_financed);
            $("#result_fin_term").html(fin_term + " MONTHS");
            $("#result_mthly_amrt").html(mnthly_amrt);
            $('#veh_quotation').show();

        }
        $('.needs-validation').addClass('was-validated');
    });

    $('#btnReset').click(function() {

        $("#veh_description").val(null);
        $("#veh_unit_price").val(null);
        $("#veh_discount").val(null);
        $("#vehicle_net_price").val(null);
        $("#txt_dp_percentage").val(null);
        $("#txt_down_payment").val(null);
        $("#fin_term").val(null);
        $("#mnthly_amrt").val(null);
        $('#veh_quotation').hide();

    });

    $('#veh_unit_price').change(function() {
        var veh_unit_price = $("#veh_unit_price").val();
        $("#veh_unit_price").val(accounting.formatMoney(veh_unit_price, "", 2, ",", "."));
    });
    $('#veh_discount').change(function() {
        var veh_discount = $("#veh_discount").val();
        $("#veh_discount").val(accounting.formatMoney(veh_discount, "", 2, ",", "."));
    });
    $('#txt_down_payment').change(function() {
        var txt_down_payment = $("#txt_down_payment").val();
        $("#txt_down_payment").val(accounting.formatMoney(txt_down_payment, "", 2, ",", "."));
    });
    $('#dp_discount').change(function() {
        var dp_discount = $("#dp_discount").val();
        $("#dp_discount").val(accounting.formatMoney(dp_discount, "", 2, ",", "."));
    });
    $('#mnthly_amrt').change(function() {
        var mnthly_amrt = $("#mnthly_amrt").val();
        $("#mnthly_amrt").val(accounting.formatMoney(mnthly_amrt, "", 2, ",", "."));
    });

    $('#veh_unit_price').on('input', function() {
        computeAutoLoan();
        computeDP();
    });
    $('#veh_discount').on('input', function() {
        computeAutoLoan();
        computeDP();
    });

    $('#txt_dp_percentage').on('input', function() {
        computeDP();
    });

    $('#txt_down_payment').on('input', function() {
        computeDP_percentage();
    });

    $('#fin_term').change(function() {

        if ($("#chkbox").is(':checked')) {
            desiredMonthAmortization()
        } else {
            //MonthlyAmortization()
        }
    });

    $('#chkbox').click(function() {
        if ($("#chkbox").is(':checked')) {
            $("#div_mnthly_amrt").show();
        } else {
            $("#div_mnthly_amrt").hide();
        }
    });

    $("#div_mnthly_amrt").hide();

    function desiredMonthAmortization() {

        var vehicle_net_price = accounting.unformat($("#vehicle_net_price").val());
        var mnthly_amrt = accounting.unformat($("#mnthly_amrt").val());
        var fin_term = $("#fin_term").val();

        var rate_12 = 1 + (12 / 100);
        var rate_18 = 1 + (15 / 100);
        var rate_24 = 1 + (28 / 100);
        var rate_36 = 1 + (36 / 100);
        var rate_48 = 1 + (44 / 100);
        var rate_60 = 1 + (54 / 100);
        var rate_72 = 1 + (0 / 100);

        var amt_fin_twelve_mo = (mnthly_amrt * 12) / rate_12;
        var amt_fin_eighteen_mo = (mnthly_amrt * 18) / rate_18;
        var amt_fin_twntyfour_mo = (mnthly_amrt * 24) / rate_24;
        var amt_fin_thrtysix_mo = (mnthly_amrt * 36) / rate_36;
        var amt_fin_frtyeight_mo = (mnthly_amrt * 48) / rate_48;
        var amt_fin_sixty_mo = (mnthly_amrt * 60) / rate_60;

        if (fin_term == '12') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_twelve_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_twelve_mo;
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
        } else if (fin_term == '18') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_eighteen_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_eighteen_mo;
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
        } else if (fin_term == '24') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_twntyfour_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_twntyfour_mo;
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
        } else if (fin_term == '36') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_thrtysix_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_thrtysix_mo;
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
        } else if (fin_term == '48') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_frtyeight_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_frtyeight_mo;
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
        } else if (fin_term == '60') {
            $("#amt_financed").val(accounting.formatMoney(amt_fin_sixty_mo.toFixed(), "", 2, ",", "."));
            var down_payment = vehicle_net_price - amt_fin_sixty_mo.toFixed();
            $("#txt_down_payment").val(accounting.formatMoney(down_payment.toFixed(), "", 2, ",", "."));
            //alert(amt_fin_sixty_mo)
        }
        CashRequirements();
        computeDP_percentage();
    }

    // function MonthlyAmortizationX() {

    //     var fin_term = $("#fin_term").val();
    //     var amt_financed = accounting.unformat($("#amt_financed").val());

    //     var rate_12 = 1 + (12 / 100);
    //     var rate_18 = 1 + (15 / 100);
    //     var rate_24 = 1 + (28 / 100);
    //     var rate_36 = 1 + (36 / 100);
    //     var rate_48 = 1 + (44 / 100);
    //     var rate_60 = 1 + (54 / 100);
    //     var rate_72 = 1 + (0 / 100);

    //     var twelve_mo = (amt_financed * eval(rate_12)) / 12;
    //     var eighteen_mo = (amt_financed * eval(rate_18)) / 18;
    //     var twntyfour_mo = (amt_financed * eval(rate_24)) / 24;
    //     var thrtysix_mo = (amt_financed * eval(rate_36)) / 36;
    //     var frtyeight_mo = (amt_financed * eval(rate_48)) / 48;
    //     var sixty_mo = (amt_financed * eval(rate_60)) / 60;
    //     //var svntytwo_mo  = (amt_financed * eval(rate_72)) / 72;

    //     if (fin_term == '12') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(twelve_mo, "", 0, ",", "."));
    //         $(".12_months").hide();
    //         $("#lbl_12_months").hide();
    //         $(".18_months").show();
    //         $("#lbl_18_months").show();
    //         $(".24_months").show();
    //         $("#lbl_24_months").show();
    //         $(".36_months").show();
    //         $("#lbl_36_months").show();
    //         $(".48_months").show();
    //         $("#lbl_48_months").show();
    //         $(".60_months").show();
    //         $("#lbl_60_months").show();
    //     } else if (fin_term == '18') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(eighteen_mo, "", 0, ",", "."));
    //         $(".12_months").show();
    //         $("#lbl_12_months").show();
    //         $(".18_months").hide();
    //         $("#lbl_18_months").hide();
    //         $(".24_months").show();
    //         $("#lbl_24_months").show();
    //         $(".36_months").show();
    //         $("#lbl_36_months").show();
    //         $(".48_months").show();
    //         $("#lbl_48_months").show();
    //         $(".60_months").show();
    //         $("#lbl_60_months").show();
    //     } else if (fin_term == '24') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(twntyfour_mo, "", 0, ",", "."));
    //         $(".12_months").show();
    //         $("#lbl_12_months").show();
    //         $(".18_months").show();
    //         $("#lbl_18_months").show();
    //         $(".24_months").hide();
    //         $("#lbl_24_months").hide();
    //         $(".36_months").show();
    //         $("#lbl_36_months").show();
    //         $(".48_months").show();
    //         $("#lbl_48_months").show();
    //         $(".60_months").show();
    //         $("#lbl_60_months").show();
    //     } else if (fin_term == '36') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(thrtysix_mo, "", 0, ",", "."));
    //         $(".12_months").show();
    //         $("#lbl_12_months").show();
    //         $(".18_months").show();
    //         $("#lbl_18_months").show();
    //         $(".24_months").show();
    //         $("#lbl_24_months").show();
    //         $(".36_months").hide();
    //         $("#lbl_36_months").hide();
    //         $(".48_months").show();
    //         $("#lbl_48_months").show();
    //         $(".60_months").show();
    //         $("#lbl_60_months").show();
    //     } else if (fin_term == '48') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(frtyeight_mo, "", 0, ",", "."));
    //         $(".12_months").show();
    //         $("#lbl_12_months").show();
    //         $(".18_months").show();
    //         $("#lbl_18_months").show();
    //         $(".24_months").show();
    //         $("#lbl_24_months").show();
    //         $(".36_months").show();
    //         $("#lbl_36_months").show();
    //         $(".48_months").hide();
    //         $("#lbl_48_months").hide();
    //         $(".60_months").show();
    //         $("#lbl_60_months").show();
    //     } else if (fin_term == '60') {
    //         $("#mnthly_amrt").val(accounting.formatMoney(sixty_mo, "", 0, ",", "."));
    //         $(".12_months").show();
    //         $("#lbl_12_months").show();
    //         $(".18_months").show();
    //         $("#lbl_18_months").show();
    //         $(".24_months").show();
    //         $("#lbl_24_months").show();
    //         $(".36_months").show();
    //         $("#lbl_36_months").show();
    //         $(".48_months").show();
    //         $("#lbl_48_months").show();
    //         $(".60_months").hide();
    //         $("#lbl_60_months").hide();
    //     }
    //     $("#12_months").html(accounting.formatMoney(twelve_mo, "", 0, ",", "."));
    //     $("#18_months").html(accounting.formatMoney(eighteen_mo, "", 0, ",", "."));
    //     $("#24_months").html(accounting.formatMoney(twntyfour_mo, "", 0, ",", "."));
    //     $("#36_months").html(accounting.formatMoney(thrtysix_mo, "", 0, ",", "."));
    //     $("#48_months").html(accounting.formatMoney(frtyeight_mo, "", 0, ",", "."));
    //     $("#60_months").html(accounting.formatMoney(sixty_mo, "", 0, ",", "."));

    // }

    function MonthlyAmortization() {
        var fin_term = $("#fin_term").val();
        var amt_financed = accounting.unformat($("#amt_financed").val());

        var rates = {
            '12': 0.12,
            '18': 0.15,
            '24': 0.28,
            '36': 0.36,
            '48': 0.44,
            '60': 0.54
        };

        var months = ['12', '18', '24', '36', '48', '60'];

        // Calculate monthly amortization
        var monthly_amortization = amt_financed * (1 + rates[fin_term]) / parseInt(fin_term);

        // Display the result
        $("#mnthly_amrt").val(accounting.formatMoney(monthly_amortization, "", 0, ",", "."));

        // Show/hide elements
        months.forEach(function(month) {
            if (month == fin_term) {
                $("." + month + "_months, #lbl_" + month + "_months").hide();
            } else {
                $("." + month + "_months, #lbl_" + month + "_months").show();
            }
        });

        // Update values for each month
        months.forEach(function(month) {
            $("#" + month + "_months").html(accounting.formatMoney(amt_financed * (1 + rates[month]) / parseInt(
                month), "", 0, ",", "."));
        });
    }


    function computeDP() {
        //-----Compute DownPayment / Amount Finance -----//
        var vehicle_net_price = accounting.unformat($("#vehicle_net_price").val());
        var txt_dp_percentage = accounting.unformat($("#txt_dp_percentage").val());
        var txt_down_payment = accounting.unformat($("#txt_down_payment").val());

        var percentage = txt_dp_percentage / 100;
        var down_payment = eval(vehicle_net_price) * eval(percentage);

        $("#txt_down_payment").val(accounting.formatMoney(down_payment, "", 0, ",", "."));

        var amount_financed = vehicle_net_price - down_payment;
        $("#amt_financed").val(accounting.formatMoney(amount_financed, "", 0, ",", "."));

    }

    function computeDP_percentage() {
        //-----Compute DownPayment Percentage/ Amount Finance -----//
        var vehicle_net_price = accounting.unformat($("#vehicle_net_price").val());
        var txt_dp_percentage = accounting.unformat($("#txt_dp_percentage").val());
        var txt_down_payment = accounting.unformat($("#txt_down_payment").val());

        var dp_percentage = (txt_down_payment / vehicle_net_price) * 100;

        $("#txt_dp_percentage").val(accounting.formatMoney(dp_percentage, "", 4, ",", "."));
        $("#txt_dp_percentage_val").val(dp_percentage);

        var amount_financed = vehicle_net_price - txt_down_payment;
        $("#amt_financed").val(accounting.formatMoney(amount_financed, "", 2, ",", "."));

    }

    function computeAutoLoan() {
        //----- Vehicle Selling Price -----//
        var veh_unit_price = accounting.unformat($("#veh_unit_price").val());
        var veh_discount = accounting.unformat($("#veh_discount").val());

        var vehicle_net_price = veh_unit_price - veh_discount;
        $("#vehicle_net_price").val(accounting.formatMoney(vehicle_net_price, "", 2, ",", "."));
        //-----End Vehicle Selling Price -----//
    }

    $('#txt_dp_percentage').change(function() {
        var txt_dp_percentage = $("#txt_dp_percentage").val();
        if (txt_dp_percentage > 100) {
            txt_dp_percentage = 0;
            $("#txt_dp_percentage_val").val(txt_dp_percentage);
            $("#txt_dp_percentage").val(txt_dp_percentage);

            Swal.fire('Percentage should not be greater than 100%', '', 'error')
        }
        computeDP();
    });

    $('#txt_dp_percentage').on('input', function() {
        $("#txt_dp_percentage").val($(this).val().replace("%", ""));
        $("#txt_dp_percentage").val($(this).val().replace("'", ""));
    });
    $('#amt_financed').on('input', function() {
        $("#amt_financed").val($(this).val().replace("%", ""));
        $("#amt_financed").val($(this).val().replace("'", ""));
    });

    function CashRequirements() {

        $("#cash_requirements").html(null);
        var arr_length;
        var chkArray = [];
        var arr_acc_amt = [];
        var arr_accesories = [];
        var arr_check_free = [];
        var total_cash_dp = 0;
        var txt_down_payment = $("#txt_down_payment").val();
        var dp_discount = $("#dp_discount").val();
        $("#cash_dp").html(txt_down_payment);

        var rowLength = document.getElementById("accssrs_tbl").rows.length;
        //alert(rowLength)
        for (var i = 2; i < rowLength; i++) {

            arr_acc_amt[i] = $("#acc_amt_" + i).val();
            arr_accesories[i] = $("#txtinpt_free_" + i).val();
            arr_check_free[i] = $("#check_free" + i).val();


            if ($("#chkbox" + i).is(':checked')) {
                var check_free = "FREE (" + accounting.formatMoney(arr_acc_amt[i], "", 2, ",", ".") + ")";
                var amount = "0.00";
            } else {
                var check_free = "NO";
                var amount = accounting.formatMoney(arr_acc_amt[i], "", 2, ",", ".");
                total_cash_dp += eval(arr_acc_amt[i]);
            }
            var markup2 = " <tr>\n\
                            <td class='text-left align-middle'>" + arr_accesories[i] + " </td>\n\
                            <td class='text-right align-middle'>" + amount + " </td>\n\
                            <td class='text-center align-middle'>" + check_free + " </td>\n\
                        </tr>";

            $("#cash_requirements").append(markup2);

        }

        var total_cash_req = 0;
        total_cash_req = accounting.unformat(txt_down_payment) + total_cash_dp - accounting.unformat(dp_discount);
        $("#total_cash_dp").html(accounting.formatMoney(total_cash_req, "", 2, ",", "."));
        $("#result_dp_discount").html(accounting.formatMoney(dp_discount, "", 2, ",", "."));

    }

    $(".accssrs_listItem").click(function(event) {

        var accsrs = $(this).data("accsrs");
        var arr_accsrs = accsrs.split("|");

        var acc_id = arr_accsrs[0];
        var acc_desc = arr_accsrs[1];
        var acc_amt = arr_accsrs[2];

        var rowLength = document.getElementById("accssrs_tbl").rows.length;
        var existing = null;

        for (var z = 0; z <= rowLength; z++) {
            var chk_ifexist = $("#chk_ifexist" + z).val();
            if (acc_id == chk_ifexist) {
                existing = "EXIST";
                break;
            }
        }

        if (existing == "EXIST") {
            Swal.fire('Duplicate Record', 'You have already included this item for this quotation.', 'error')
        } else {
            var markup = `
                                    <tr align='center'>
                                        <td style='display: none;'><input type='hidden' value='${acc_id}' id='chk_ifexist${rowLength}'></td>
                                        <td class='align-middle'>${acc_desc}<input type='hidden' id='txtinpt_free_${rowLength}' value='${acc_desc}'/><input type='checkbox' class='chk_acc_id' value='${acc_id}' style='display: none;' checked ></td>
                                        <td class='align-middle text-right'> <input type='text' class='form-control form-control-sm' id='acc_amt_${rowLength}' value='' required></td>
                                        <td class='align-middle'> <input type='hidden' id='check_free${rowLength}' value=''> <input id='chkbox${rowLength}' onClick='checkFree(${rowLength})' type='checkbox' class='cbofree' data-cbofree='${acc_id}' value='Y'></td>
                                        <td class='text-center'> <button class='btn btn-light del_accsrs' data-del_accsrs='nn|nc|${acc_id}' type='button' data-toggle='tooltip' data-placement='top' title='Remove Row'> <i class='fa fa-trash text-danger'></i></button></td>
                                    </tr>`;
                $("#acctb_body").append(markup);

            }

            $("#lookup_accssrs").modal('hide');
        });

        $(document).on("click", ".del_accsrs", function() {
            var arr_data = [];
            var data = $(this).data("del_accsrs");
            arr_data = data.split("|");

            var quotation_id = arr_data[0];
            var companyid = arr_data[1];
            var accsriesid = arr_data[2];

            if (quotation_id == 'nn' && companyid == 'nc') {
                $(this).parents("tr").remove();
                Swal.fire('Successfully Removed', '', 'error')
            }
        });
    </script>
@endsection
@include('loan-calculator.look-up-acc')
