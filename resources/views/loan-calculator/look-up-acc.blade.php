<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="lookup_accssrs">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="lookup_accssrsModalTitle">Accs. & Other Items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <input class="form-control form-control-sm" id="myInput_acc" type="text" placeholder="Search...">
                    <br>
                    <ul class="list-group" id="myList_acc">

                        @isset($accessories)

                            @foreach ($accessories as $row)
                                @php
                                    $acc_id = $row->accessories_id;
                                    $acc_desc = $row->accessories_description;
                                    $acc_amt = $row->accessories_amount;
                                @endphp
                                <li class="list-group-item list-group-item-action accssrs_listItem" data-accsrs="{{ $acc_id."|".$acc_desc."|".$acc_amt }}">
                                    {{ $acc_desc }}
                                </li>
                            @endforeach

                        @endisset
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#myInput_acc").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myList_acc li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
