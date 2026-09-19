@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 100%;
            float: left;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        input[type="number"] {
            min-width: 50px;
        }

        .bg-primary {
            background: #1b4e9b !important;
        }

        .bg-secondary{
            background: rgb(247 168 48) !important;
        }
        
        .apexcharts-xaxis-label {
            font-weight: bold !important;
            font-size: 14px !important;
            fill: #000 !important;
        }
        
        
        .apexcharts-bar-series .apexcharts-bar-area {
          min-height: 10px !important;
        }
    </style>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                        <div class="flex-grow-1">
                                            <?php if(Auth::user()->role_id == 1){ ?>
                                            <h4 class="fs-16 mb-1">Dashboard</h4>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                @if(Auth::user()->role_id == 1)
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-primary">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                            Book My Stall</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $Brochure }}">0</span>
                                                        </h4>
                                                        <a href="{{ route('brochure.index') }}"
                                                            class="text-decoration-underline text-white-50">
                                                            View More
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-secondary ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                            Visitor</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $Visiter }}">0</span>
                                                        </h4>
                                                        <a href="{{ route('visitor.index') }}"
                                                            class="text-decoration-underline text-white-50">View
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-primary ">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                           International Visitor</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $InternationalVisitor }}">0</span>
                                                        </h4>
                                                        <a href="{{ route('visitor.international_index') }}"
                                                            class="text-decoration-underline text-white-50">View
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-secondary">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                            Floor Plan</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $FloorPlan }}">0</span>
                                                        </h4>
                                                        <a href="{{ route('floor_plan.index') }}"
                                                            class="text-decoration-underline text-white-50">View
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <!--begin:: Widgets/Product Sales-->
                                        <div class="m-portlet m-portlet--skin-dark m-portlet--bordered-semi m--bg-brand">
                                            <div class="m-portlet__head">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h2 class="text-light mt-large he-home">
                                                            Visitor Date Wise Count
                                                        </h2>
                                                    </div>
                                                </div>
                                                <div class="m-portlet__head-tools">
                                                </div>
                                            </div>
                                            <div class="m-portlet__body">
                                                <div class="m-widget25">
                                                    <table class="table table-bordered dt-responsive" width="100%">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Count</th>
                                                        </tr>
                                                        @foreach ($VisiterDate as $visitDates)
                                                            <tr>
                                                                <th>{{ $visitDates->visitDate }}</th>
                                                                <th>{{ $visitDates->count }}</th>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                     <div class="col-xl-12">
                                        <div class="card">
        
                                            <div class="card-body">
                                                <div id="country_chart" style="min-height: 400px;"></div>

                                            </div><!-- end card-body -->
                                        </div><!-- end card -->
                                    </div>
                                    
                                    <style>
                                    .apexcharts-xaxis text {
                                        white-space: pre-line !important;
                                    }
                                    </style>
                                @elseif(Auth::user()->role_id == 3)
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-primary">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                            Total Register</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $empregistration }}">0</span>
                                                        </h4>
                                                        <!--<a href="{{ route('brochure.index') }}"-->
                                                        <!--    class="text-decoration-underline text-white-50">-->
                                                        <!--    View More-->
                                                        <!--</a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate bg-primary">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="text-uppercase fw-bold text-white-50 text-truncate mb-0">
                                                            Today's Register</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-bold ff-secondary text-white mb-4"><span
                                                                class="counter-value" data-target="{{ $emp_today_registration }}">0</span>
                                                        </h4>
                                                        <!--<a href="{{ route('brochure.index') }}"-->
                                                        <!--    class="text-decoration-underline text-white-50">-->
                                                        <!--    View More-->
                                                        <!--</a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif 

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> {{ env('APP_NAME') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

<?php
$visitors = App\Models\Visitor::selectRaw('COUNT(state) as statecount, state')
    ->where('isDelete', 0)
    ->whereNotNull('state')
    ->where('state', '!=', '')
    ->groupBy('state')
    ->orderBy('statecount', 'desc')
    ->get();
?>


@endsection

@section('scripts')
<script>
    window.Apex = {}; // override any older ApexCharts version
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.48.0"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

   var options = {
    chart: {
        height: 350,
        type: 'bar'
    },
    plotOptions: {
        bar: {
            distributed: true,
            borderRadius: 4,
            columnWidth: '50%',
            dataLabels: {
                position: 'top'
            }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val;
        },
        offsetY: -20,
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            colors: ['#ff0000']
        }
    },
    series: [{
        name: 'Visitors by State',
        data: [
            @foreach($visitors as $v)
                {{ $v->statecount }},
            @endforeach
        ]
    }],
    xaxis: {
        
        categories: [
            @foreach($visitors as $v)
                "{{ $v->state }}",
            @endforeach
        ],
         labels: {
        style: { fontSize: '12px', fontWeight: 800 },
        formatter: function(value) {
            // Break long label manually
            if (value === "Dadra & Nagar Haveli") {
                return "Dadra &\nNagar Haveli"; // SVG WILL BREAK LINE
            }
            return value;
        }
    }
    }
};

var chart = new ApexCharts(document.querySelector("#country_chart"), options);
chart.render();

});
</script>

@endsection
