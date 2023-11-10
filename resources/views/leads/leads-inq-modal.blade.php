<div class="modal fade" id="viewLeadsInqModal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="lookup_empnameModalTitle"><i
                        class="fa-solid fa-user-pen me-1"></i><span id="modalLabel"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation2" method="post" novalidate>
                    <div class="row">
                        <input id="rec_id2" type="hidden" value="">
                        <input id="lead_id" type="hidden" value="">
                        <input id="lead_inq_id" type="hidden" value="">
                        <input id="status" type="hidden" value="">
                        <input id="lead_id_for_inq" type="hidden" value="">
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
                                @isset($lead_status2)
                                    @foreach ($lead_status2 as $row_status)
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

                    </div>
                </form>    

            </div>
        
            <div class="modal-footer">
                <div class="me-auto">
                    <button id="btnSaveInq" class="btn btn-success px-5 me-3"><i class="fa-solid fa-plus me-1"></i>Save</button>
                </div>
                <button type="button" class="btn  btn-secondary px-5 ms-auto" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
