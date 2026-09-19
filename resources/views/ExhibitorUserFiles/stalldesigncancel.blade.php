@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

    <style>
        p {
            font-size: 18px;
        }

        ol>li {
            font-size: 16px;
        }

        .ys-stall {
            margin-top: 10px;
        }

        .ys-stall p {
            margin-bottom: 2px;
            font-size: 16px;

        }

        .stl-head {
            text-align: center;
            background: #b95828;
            padding: 10px 5px;
            border-radius: 4px;
            color: white;
            text-transform: uppercase;
            font-size: 20px;
        }
    </style>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content" style="background:
#1b4e9b;">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">


                            <div class="row mt-4 mb-5  align-items-center"
                                style="background: white;
                                        padding: 35px;
                                        border-radius: 12px;">
                                <div class="col-lg-6">
                                    <div>
                                        <img class="img-fluid"
                                            src="{{ asset('assets/images/designer-stall-cancel.jpeg') }}" />
                                    </div>
                                </div>

                                <?php
                                $dynamicdate = DB::table('dates')->where('id', 1)->first();
                                ?>

                                <div class="col-lg-6">
                                    <div class="ys-stall">
                                        <h3 class="stl-head">Stall Setup Duration</h3>
                                        <p><i class="fa-solid fa-circle-dot"></i> Octornorm Stall Possession:
                                            {{ $dynamicdate->stall_design_cancel_date }}
                                            @11:00 am</p>
                                        <p><i class="fa-solid fa-circle-dot"></i> Stall setup allowed only till
                                            {{ $dynamicdate->stall_design_cancel_date }} @10:00 pm</p>
                                        <p><i class="fa-solid fa-circle-dot"></i> No work will be allowed beyond 10:00 pm on
                                            {{ $dynamicdate->stall_design_cancel_date }}</p>
                                    </div>

                                    <div class="mt-3">
                                        <p style="font-weight:bold">Facilities per 9 sqm:</p>
                                        <ol>
                                            <li>Name on Facia</li>
                                            <li>1 Table</li>
                                            <li>2 Chairs</li>
                                            <li>1 Socket of 5 AMP</li>
                                            <li>3 Spot Light</li>
                                            <li>1 Waste Paper Basket</li>
                                            <li>General Security</li>
                                            <li>Invitation Card</li>
                                            <li>Non woven carpet in stall area</li>
                                        </ol>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                
                <div class=" d-flex justify-content-end mb-2">
                                        <button type="button"
                                            onclick="window.location='{{ route('exhibitordashboard') }}'"
                                            class="btn btn-success btn-user float-right" style="background-color:#5d2e26 !important">
                                            Back
                                        </button>
                                    </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->


@endsection
