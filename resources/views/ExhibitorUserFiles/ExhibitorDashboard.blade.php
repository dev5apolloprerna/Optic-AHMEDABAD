@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

    <style>
        .card-body {
            
            text-align: center;
            border-radius:15px !important;
            overflow: hidden;
        }

        .card-detail {
            padding: 42px 0px;
            border-radius:15px;
        }

        .st-btn button {
            border: none;
            background: #EFC61A;
            background: linear-gradient(172deg, #ff8a00 0%, #dc3545 100%);
            padding: 5px 20px;
            color: white;
            border-radius: 4px;
            margin: 0px 3px;
        }

        .st-btn-btn button {
           border: none;
    background: #f4516c;
    background: #521500;
    padding: 5px 20px;
    color: #ffffff;
     background: linear-gradient(172deg, #ff8a00 0%, #dc3545 100%);
            padding: 5px 20px;
            color: white;
    border-radius: 4px;
    margin: 0px 3px;
}
        }

        //
        .st-btn button:hover {
            background-color: #002B17;
            transition: 0.2 all;
            color: white;
        }

        .crd-txt {
               font-size: 20px;
    text-transform: uppercase;
    font-weight: 700;
        }
        
           .stl-head{
          text-align: center;
    background: #ff8a00;
    padding: 10px 5px;
    /* border-radius: 4px; */
    color: white;
    text-transform: uppercase;
    font-size: 20px;
    margin-bottom: 0px;
        }
        
        
    </style>
    
    <style>
        /* LEFT PANEL DESIGN */
.welcome-box {
    background: linear-gradient(172deg, #ff8a00 0%, #dc3545 100%);
    color: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    transition: 0.3s ease;
}

.welcome-box:hover {
    transform: translateY(-5px);
}

/* TITLE */
.welcome-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
    color:#fff;
}

/* SUBTEXT */
.welcome-sub {
    font-size: 16px;
    line-height: 1.7;
    opacity: 0.95;
}

/* FEATURES */
.feature-item {
    background: rgba(255,255,255,0.1);
    padding: 12px 15px;
    border-radius: 10px;
    margin-bottom: 10px;
    font-size: 15px;
    transition: 0.3s;
}

.feature-item:hover {
    background: rgba(255,255,255,0.2);
}

/* CTA */
.cta-box {
    background: #FF9800;
    color: #000;
    padding: 12px 15px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 15px; text-align:center;
}

.fix-height{
    height:443px !important;
    border-radius:15px !important;
    overflow: hidden;
}

        @media (min-width: 1024.1px) {
        [data-layout="horizontal"] .page-content {
            margin-top: 70px !important;
        }
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
                                            <!--<h4 class="fs-16 mb-1">Stall Design</h4>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <section class="mt-50">
                                <div class="container">
                                    <div class="row justify-content-center mt-3 mb-3">
                                        <div class="col-lg-6 mb-4">
                                            <div class="welcome-box p-4">
                                                <h2 class="welcome-title">Welcome to Optic Expo Dashboard</h2>
                                                
                                                <p class="welcome-sub">
                                                    You are now part of a powerful business platform. This dashboard is designed to help you maximize your reach and manage everything smoothly.
                                                </p>
                                                
                                                <p class="mb-0">Make sure you utilize all features:</p>
                            
                                                <div class="features mt-2">
                                                    <div class="feature-item">
                                                         Invite your clients directly through <strong>WhatsApp invites</strong>
                                                    </div>
                                                    <div class="feature-item">
                                                         Pre-register your visitors for hassle-free access
                                                    </div>
                                                    
                                                    <div class="feature-item">
                                                         Complete all exhibitor services, documentation, and requirements
                                                    </div>
                                                </div>
                            
                                                <!--<div class="cta-box mt-2">-->
                                                <!--    ðŸ‘‰ Start now and ensure maximum visibility, better connections, and a successful exhibition experience-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 ">
                                            <div class="card-body fix-height">
                                                  <div class="border"><h3 class="stl-head">Stall Design</h3></div>
                                                <div class="card-img">
                                                    <img class="img-fluid"
                                                        src="{{ asset('assets/images/exebution-stall-designer-1.png') }}"
                                                        alt="">
                                                </div>
                                                <div class="card-detail">
                                                    <p class="crd-txt" style="font-size: 24px;">Are you Designing your
                                                        Stall?</p>
                                                    <a href="{{ route('User.StallDesignAccept') }}" class="st-btn-btn">
                                                        <button style="cursor: pointer;">Yes</button>
                                                    </a>
                                                    <a href="{{ route('User.StallDesignCancel') }}" class="st-btn">
                                                        <button style="cursor: pointer;">No</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="cta-box mt-2">
                                                     Start now and ensure maximum visibility, better connections, and a successful exhibition experience
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

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
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Â© Earthcon Expo.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->


@endsection
