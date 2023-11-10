@extends('layouts.main')

@section('content')
 
    {{-- ---- Content --- --}}
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-delivered">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">DELIVERED</div>
                        <div class="widget-subheading">-</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>@isset($delivered) {{ $delivered }} @endisset</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-hot">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">HOT</div>
                        <div class="widget-subheading">-</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>@isset($hot) {{ $hot }} @endisset</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-warm">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">WARM</div>
                        <div class="widget-subheading">-</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>@isset($warm) {{ $warm }} @endisset</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-cold">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">COLD</div>
                        <div class="widget-subheading">-</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>@isset($cold) {{ $cold }} @endisset</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">FOR DELIVERY</div>
                            <div class="widget-subheading">-</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-success">@isset($fordelivery) {{ $fordelivery }} @endisset</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">APPROVED FINANCING</div>
                            <div class="widget-subheading">-</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-danger">@isset($wafa) {{ $wafa }} @endisset</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">LOST SALES</div>
                            <div class="widget-subheading">-</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning">@isset($lostSales) {{ $lostSales }} @endisset</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content">
                <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="widget-heading">IN-ACTIVE</div>
                            <div class="widget-subheading">-</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-info">@isset($inactive) {{ $inactive }} @endisset</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
