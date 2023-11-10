<div class="modal fade" id="viewLeadsModal">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="lookup_empnameModalTitle"><i
                        class="fa-solid fa-user-pen me-1"></i>Edit Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post" novalidate>
                    @csrf
                    <div class="row">
                        <input id="rec_id" type="hidden" value="">
                        {{-- Row 1 --}}
                        <div class="col-sm-3 mb-1">
                            <label for="prefix" class="form-label-sm text-dark fw-medium">Prefix <span
                                    class="text-danger fw-bold">*</span></label>
                            <select name="prefix" id="prefix" class="form-select form-select-sm" required>
                                <option value="" selected disabled>Choose</option>
                                @isset($prx)
                                    @foreach ($prx as $row_prefix)
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
                            <input name="last_name" id="last_name" type="text" class="form-control form-control-sm"
                                placeholder="Last Name" required>
                            <div class="invalid-feedback">Please enter Last Name</div>
                        </div>
                        <div class="col-sm-3 mb-1">
                            <label for="first_name" class="form-label-sm text-dark fw-medium">First Name<span
                                    class="text-danger fw-bold">*</span></label>
                            <input name="first_name" id="first_name" type="text" class="form-control form-control-sm"
                                placeholder="First Name" required>
                            <div class="invalid-feedback">Please enter First Name</div>
                        </div>

                        <div class="col-sm-3 mb-1">
                            <label for="middle_name" class="form-label-sm text-dark fw-medium">Middle Name<span
                                    class="text-danger fw-bold">*</span></label>
                            <input name="middle_name" id="middle_name" type="text"
                                class="form-control form-control-sm" placeholder="Middle Name">
                            <div class="invalid-feedback">Please enter Middle Name</div>
                        </div>

                        {{-- Row 2 --}}
                        <div class="col-sm-2 mb-1">
                            <label for="birth_date" class="form-label-sm text-dark fw-medium">Date of Birth</label>
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
                            <select name="gender" id="gender" class="form-select form-select-sm" required>
                                <option value="" selected disabled>Choose</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                            <div class="invalid-feedback"> Please select Gender</div>
                        </div>
                        {{-- <div class="col-sm-2 mb-1">
                            <div class="form-group form-group-sm mb-1">
                                <label for="gender" class="form-label-sm text-dark fw-medium">Gender <span class="text-danger fw-bold">*</span></label>
                            
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input gender" name="gender" id="M" value="M" required>Male&nbsp;&nbsp;
                                    <input type="radio" class="form-check-input gender" name="gender" id="F" value="F" required>Female
                                    <div class="invalid-feedback">
                                        Enter Gender
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-sm-6 mb-1">
                            <label for="company_name" class="form-label-sm text-dark fw-medium">Company</label>
                            <input name="company_name" id="company_name" type="text"
                                class="form-control form-control-sm" placeholder="Company">
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="occupation" class="form-label-sm text-dark fw-medium">Occupation</label>
                            <input name="occupation" id="occupation" type="text"
                                class="form-control form-control-sm" placeholder="Occupation">
                        </div>
                        {{-- Row 3 --}}
                        <div class="col-sm-6 mb-1">
                            <label for="address_no_street_brgy" class="form-label-sm text-dark fw-medium">Address
                                (No, Street, Subdivision, Barangay)</label>
                            <input name="address_no_street_brgy" id="address_no_street_brgy" type="text"
                                class="form-control form-control-sm" placeholder="Address (No, Street, Subdivision)">
                            <div class="invalid-feedback">Enter Address (No, Street, Subdivision, Barangay)</div>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="address_town" class="form-label-sm text-dark fw-medium">Town</label>
                            <select name="address_town" id="address_town" class="form-select form-select-sm">
                                <option value="">Select province first</option>
                            </select>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="address_province" class="form-label-sm text-dark fw-medium">Province</label>
                            <select name="address_province" id="address_province" class="form-select form-select-sm">
                                <option value="" selected disabled>Choose</option>
                                @isset($province)
                                    @foreach ($province as $row_prov)
                                        <option value="{{ $row_prov->province_name . '|' . $row_prov->province_id }}">
                                            {{ $row_prov->province_name }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-sm-2 mb-1">
                            <label for="zipcode" class="form-label-sm text-dark fw-medium">Zip Code</label>
                            <input name="zipcode" id="zipcode" type="text" class="form-control form-control-sm"
                                placeholder="Zip Code">
                        </div>
                        {{-- Row 4 --}}
                        <div class="col-sm-2 mb-1">
                            <label for="mobile_no" class="form-label-sm text-dark fw-medium">Primary Mobile No.
                                <span class="text-danger fw-bold">*</span></label>
                            <input name="mobile_no" id="mobile_no" type="text"
                                class="form-control form-control-sm" placeholder="Primary Mobile No." required>
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
                            <input name="tel_no" id="tel_no" type="text" class="form-control form-control-sm"
                                placeholder="Home Phone">
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
                            <select name="lead_source" id="lead_source" class="form-select form-select-sm" required>
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
                </form>
                <hr>

                <h5 class="fw-bold">Vehicle Inquiry</h5>
                <div class="table-responsive mt-4">
                    <table class="table table table-striped table-bordered table-sm table-hover" id="">
                        <thead class="text-center align-middle nowrap" nowrap>
                            <tr>
                                <th width="10%">Lead ID</th>
                                <th width="15%">Lead Inquiry ID</th>
                                <th width="40%">Vehicle Description</th>
                                <th width="10%">Status</th>
                                <th width="10%">Inquiry Date</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="leadsDataContainerTR">
                             <!-- Placeholder for leads data -->
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <div class="me-auto">
                    <button id="btnSave" class="btn btn-success px-5 me-3"><i class="fa-solid fa-plus me-1"></i>Save</button>
                    <button type="button" id="btnAddVehInuiry" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i>&nbsp;Add New Vehicle Inquiry
                    </button>
                </div>
                <button type="button" class="btn  btn-secondary px-5 ms-auto" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
