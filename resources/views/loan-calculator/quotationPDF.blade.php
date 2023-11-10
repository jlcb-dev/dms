<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <style>
        @media print {
            .dont-print {
                display: none;
            }
        }

        .text-danger {
            font-size: 15px;
            color: blue;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .col-form-label {
            padding-top: calc(0.375rem + 1px);
            padding-bottom: calc(0.375rem + 1px);
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5;
        }

        .col-form-label-sm {
            padding-top: calc(0.25rem + 1px);
            padding-bottom: calc(0.25rem + 1px);
            font-size: 0.875rem;
        }

        .col-sm-1 {
            flex: 0 0 auto;
            width: 8.33333333%;
        }

        .col-sm-2 {
            flex: 0 0 auto;
            width: 16.66666667%;
        }

        .col-sm-3 {
            flex: 0 0 auto;
            width: 25%;
        }

        .col-sm-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }

        .col-sm-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }

        .col-sm-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .col-sm-7 {
            flex: 0 0 auto;
            width: 58.33333333%;
        }

        .col-sm-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }

        .col-sm-9 {
            flex: 0 0 auto;
            width: 75%;
        }

        .col-sm-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }

        .col-sm-11 {
            flex: 0 0 auto;
            width: 91.66666667%;
        }

        .col-sm-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.55rem;
            vertical-align: top;
            border-top: 1px solid #e9ecef;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e9ecef;
        }

        .table tbody+tbody {
            border-top: 2px solid #e9ecef;
        }

        .table .table {
            background-color: #fff;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 1px solid #e9ecef;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #e9ecef;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody+tbody {
            border: 0;
        }

    </style>

</head>

<body>
    
    {!! $veh_quotation !!}


</body>


</html>
