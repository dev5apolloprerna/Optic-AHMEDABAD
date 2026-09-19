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

        .st-btn button {
            border: none;
            background: #b95828;
            padding: 5px 20px;
            color: white;
            border-radius: 4px;
            margin: 0px 3px;
            font-weight: 500;

        }

        .stall-maintxt {
            font-weight: 600;
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

        .ss {
            background: white;
            padding: 35px;
            border-radius: 12px;
        }
    </style>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content" style="background: #1b4e9b;">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100  mt-90">

                            <div class="row mt-4 mb-5  align-items-center ss">

                                <div class="col-lg-6">
                                    <div>
                                        <img class="img-fluid"
                                            src="{{ asset('assets/images/designer-stall-accept.jpg') }}" />
                                    </div>
                                </div>

                                <?php
                                $dynamicdate = DB::table('dates')->where('id', 1)->first();
                                ?>

                                <div class="col-lg-6">
                                    <div>
                                        <h3 class="stl-head">Designer Stall Setup Duration</h3>
                                    </div>
                                    <div class="ys-stall">
                                        <p><i class="fa-solid fa-circle-dot"></i> Designer Stall Possession:
                                            {{ $dynamicdate->stall_design_accept_date1 }}
                                            @11:00 am</p>
                                        <p><i class="fa-solid fa-circle-dot"></i> Designer Stall setup allowed only till
                                            {{ $dynamicdate->stall_design_accept_date2 }} @10:00 pm</p>
                                        <p><i class="fa-solid fa-circle-dot"></i> No work will be allowed beyond 10:00 pm on
                                            {{ $dynamicdate->stall_design_accept_date2 }}</p>

                                    </div><br /> <br />
                                    <strong>For Safety & Security reason Select Stall Designer From Optic Expo Official
                                        Vendor
                                        Panel.</strong>
                                    <div class="mt-1">
                                        <p style="font-weight:bold;">Designer Stall Charges</p>
                                        <ol>
                                            <li>Up to 20 sqm :- Rs. 5000 + 18% GST</li>
                                            <li>21 sqm to 30 sqm :- Rs. 7000 + 18% GST</li>
                                            <li>Above 30 sqm :- Rs. 10000 + 18% GST</li>
                                        </ol>
                                    </div>
                                    <p>Charges towards extra usage of Electricity & Housekeeping to be paid by stall
                                        designer.</p>
                                    <p>Please tab Ok for your acceptance. <button name="submit"
                                            style="background: #4CAF50;
                                                    color: white;
                                                    border: none;
                                                    font-size: 16px;
                                                    padding: 2px 10px;"
                                            onclick="checkok();">OK</button></p>

                                    <div id="hidetext" style="display: none;">

                                        <section>
                                            <div class="container">
                                                <div class="row justify-content-center mt-5">
                                                    <div class="col-lg-12">
                                                        <div class="stall-maintxt">
                                                            <p><i class="fa-sharp fa-solid fa-arrow-right"></i> Inform your
                                                                vendor to forward this form along with the charges on under
                                                                mention email <a href="mailto:dirapm.aakar@gmail.com">
                                                                    (dirapm.aakar@gmail.com) </a>. </p>
                                                            <p><i class="fa-sharp fa-solid fa-arrow-right"></i> No
                                                                possession without vendor registration.</p>
                                                            <!--<p>-->
                                                            <!--    <a href="{{ route('User.StallDesignFormPDF') }}"-->
                                                            <!--        target="_blank" class="st-btn"><button-->
                                                            <!--            style="cursor: pointer;">Download-->
                                                            <!--            Vendor Registration Form</button></a></p>-->
                                                            
                                                            <p>
                                                                    <a href="{{ asset('assets/front/pdf/OPTIC-Vendor-Registration-2026.pdf') }}"
                                                                       target="_blank"
                                                                       class="st-btn">
                                                                        <button style="cursor: pointer;">
                                                                            Download Vendor Registration Form
                                                                        </button>
                                                                    </a>
                                                                </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
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

@section('scripts')
    <script>
        function checkok() {
            $("#hidetext").show();
        }
    </script>
@endsection
