<table class="table table table-striped table-bordered table-sm table-hover" id="dtbLeads">
    <thead class="text-center align-middle nowrap" nowrap>
        <tr>
            <th width="10%">Lead ID</th>
            <th width="35%">Prospect Name</th>
            <th width="35%">Company Name</th>
            <th width="10%">Status</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($leads as $row_leads)
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

            <tr class=" align-middle">
                <td class="text-center">{{ $row_leads->lead_id }}</td>
                <td class="text-start">{{ $full_name }}</td>
                <td class="text-start">{{ $company_name }}</td>
                <td class="text-center">{{ $lead_status }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
