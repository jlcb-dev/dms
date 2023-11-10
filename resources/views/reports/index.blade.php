@extends('layouts.main')

@section('content')
    <h3 class="fw-bold">SUMMARY OF LEADS</h3>
    <form  class="multisteps-form__form needs-validation" method="post" >
        @csrf
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-sm-2">
                        <label for="lead_status" class="form-label-sm text-dark fw-medium fw-semibold">LEADS STATUS</label>
                    </div>
                    <div class="col-sm-3 ml-n5">
                        <select class="form-select form-select-sm text-start" name="lead_status" id="lead_status">
                            <option value="ALL">All</option>
                            @isset($lead_status)
                                @foreach ($lead_status as $row_status)
                                    <option value="{{ $row_status->statusid }}">
                                        {{ $row_status->status_desc }}
                                    </option>
                                @endforeach
                            @endisset
                            </option>
                        </select>

                    </div>
                    <div class="col-sm-1">
                        <label for="date" class="form-label-sm text-dark fw-medium fw-semibold">AS OF</label>
                    </div>
                    <div class="col-sm-2 ml-n4">
                        <div class="input-group input-group-sm">
                            <input id="date" name="date" type="text" class="form-control form-control-sm"
                                value="{{ date('m/d/Y') }}" placeholder="Date" onkeydown="return false;" required>
                            <span id="clickdate" class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="btnGO" class="btn btn-sm btn-primary px-3"> GO</button>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <div id="leads_data"></div>
                </div>

            </div>
        </div>
    </form>





    <script>

        $("#btnGO").click(function(event) {
            fetch_leads();

        });

        fetch_leads()
        function fetch_leads() {

            var date = $("#date").val();
            var lead_status = $("#lead_status").val();
         
            if (lead_status != '') {
                $.ajax({
                    url: '{{ route('fetch_leads') }}',
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        "date": date,
                        "lead_status": lead_status
                    },
                    success: function(data) {
                        $('#leads_data').html(data.leads_data);
                        
                    }
                });
            } else {
                $('#leads_data').html(null);
          
            }
        }

        $(document).ready(function() {

            $('input[name="date"]').singleDatePicker();
            //Disable right click on specific input field
            $("#birth_date").on("contextmenu", function(e) {
                return false;
            });

            $("#clickdate").click(function() {
                $("#date").focus();
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
    </script>
@endsection
