@extends('layouts.front')
@section('content')

<style>
    /* ==================================================
       CONTACT PAGE DESIGN
    ================================================== */

    .contact-page {
        position: relative;
        overflow: hidden;
        padding-bottom: 75px;
        background:
            radial-gradient(
                circle at 8% 25%,
                rgba(245, 124, 32, 0.10),
                transparent 25%
            ),
            radial-gradient(
                circle at 92% 80%,
                rgba(27, 78, 155, 0.10),
                transparent 28%
            ),
            linear-gradient(
                145deg,
                #ffffff 0%,
                #f6f9fd 55%,
                #fff9f5 100%
            );
    }

    .contact-page::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: 0.4;
        pointer-events: none;
        background-image:
            linear-gradient(
                rgba(27, 78, 155, 0.035) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(27, 78, 155, 0.035) 1px,
                transparent 1px
            );
        background-size: 34px 34px;
    }

    .contact-page .container {
        position: relative;
        z-index: 1;
    }

    .contact-page .row.mt-40 {
        margin-top: 55px !important;
    }

    /* Main contact card */

    .contact-page .con-box {
        position: relative;
        overflow: hidden;
        padding: 42px;
        border: 1px solid rgba(27, 78, 155, 0.11);
        border-radius: 26px;
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(245, 124, 32, 0.11),
                transparent 32%
            ),
            linear-gradient(
                145deg,
                #ffffff 0%,
                #f8fbff 58%,
                #fffaf6 100%
            );
        box-shadow:
            0 30px 70px rgba(12, 45, 89, 0.14),
            0 8px 24px rgba(12, 45, 89, 0.07);
    }

    .contact-page .con-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        width: 100%;
        height: 6px;
        background: linear-gradient(
            90deg,
            #082f63 0%,
            #1b4e9b 52%,
            #f57c20 52%,
            #ff9a50 100%
        );
    }

    .contact-page .con-box::after {
        content: "";
        position: absolute;
        right: -75px;
        bottom: -85px;
        width: 190px;
        height: 190px;
        border: 35px solid rgba(245, 124, 32, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Contact rows */

    .contact-page .con-box > .d-flex {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center !important;
        gap: 16px;
        margin-bottom: 18px !important;
        padding: 18px;
        border: 1px solid #dce5ef;
        border-radius: 15px;
        background: rgba(248, 251, 255, 0.92);
        box-shadow: 0 7px 18px rgba(12, 45, 89, 0.045);
        transition:
            transform 0.25s ease,
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease;
    }

    .contact-page .con-box > .d-flex:last-child {
        margin-bottom: 0 !important;
    }

    .contact-page .con-box > .d-flex:hover {
        border-color: rgba(245, 124, 32, 0.48);
        background: #ffffff;
        box-shadow:
            0 12px 26px rgba(12, 45, 89, 0.08),
            0 4px 12px rgba(245, 124, 32, 0.08);
        transform: translateY(-3px);
    }

    /* Icon wrapper */

    .contact-page .con-box > .d-flex > p:first-child {
        flex: 0 0 auto;
        margin: 0 !important;
    }

    .contact-page .con-box i {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        padding: 0;
        border-radius: 13px;
        background: linear-gradient(
            145deg,
            #f57c20 0%,
            #ff9b52 100%
        );
        color: #ffffff;
        font-size: 18px;
        line-height: 1;
        box-shadow:
            0 10px 22px rgba(245, 124, 32, 0.28),
            inset 0 1px 0 rgba(255, 255, 255, 0.28);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .contact-page .con-box > .d-flex:hover i {
        transform: scale(1.06);
        box-shadow:
            0 13px 27px rgba(245, 124, 32, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.28);
    }

    /* Contact text */

    .contact-page .con-box > .d-flex > p:last-child,
    .contact-page .con-box > .d-flex > div {
        flex: 1;
        min-width: 0;
        margin: 0;
        color: #284663;
        font-size: 15px;
        font-weight: 500;
        line-height: 1.75;
    }

    .contact-page .con-box > .d-flex > div p {
        margin: 0 !important;
        color: #284663;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .contact-page .con-box > .d-flex:first-child > p:last-child {
        font-weight: 500;
    }

    .contact-page .con-box > .d-flex:first-child > p:last-child::first-line {
        color: #123c6a;
        font-weight: 800;
    }

    /* Phone icon direction */

    .contact-page .con-box .fa-phone,
    .contact-page .con-box .fa-phone-alt {
        transform: scaleX(-1);
    }

    .contact-page .con-box > .d-flex:hover .fa-phone,
    .contact-page .con-box > .d-flex:hover .fa-phone-alt {
        transform: scaleX(-1) scale(1.06);
    }

    /* Responsive */

    @media (max-width: 991px) {
        .contact-page {
            padding-bottom: 60px;
        }

        .contact-page .row.mt-40 {
            margin-top: 40px !important;
        }

        .contact-page .con-box {
            padding: 35px 28px;
        }
    }

    @media (max-width: 767px) {
        .contact-page {
            padding-bottom: 45px;
        }

        .contact-page .row.mt-40 {
            margin-top: 30px !important;
        }

        .contact-page .con-box {
            padding: 28px 20px;
            border-radius: 20px;
        }

        .contact-page .con-box > .d-flex {
            gap: 13px;
            padding: 15px;
            border-radius: 13px;
        }

        .contact-page .con-box i {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            font-size: 16px;
        }

        .contact-page .con-box > .d-flex > p:last-child,
        .contact-page .con-box > .d-flex > div,
        .contact-page .con-box > .d-flex > div p {
            font-size: 14px;
            line-height: 1.65;
        }
    }

    @media (max-width: 420px) {
        .contact-page .con-box {
            padding: 25px 15px;
        }

        .contact-page .con-box > .d-flex {
            padding: 13px;
        }

        .contact-page .con-box i {
            width: 40px;
            height: 40px;
        }
    }
</style>

    <!-- contact us start  -->
    <section class="contact-page">
        <div class="head-menu-s">
            <h3 class="fr-head">CONTACT US</h3>
            <!--<p><a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontContact') }}">Contact us</a></p>-->
        </div>
        <div class="container">
            <div class="row mt-40">
                <div class="col-lg-6 mx-auto" data-aos="zoom-in-right">
                    <div class="con-box">
                
                    <!-- Address -->
                    <div class="d-flex align-items-start mb-3">
                        <p class="me-3 mb-0">
                            <i class="fas fa-map-marker"></i>
                        </p>
                        <p class="mb-0">
                            Aries Events Pvt. Ltd.
                            Block-2, 403, Dev Aurum,<br>
                            Anandnagar Cross Road,
                            Prahlad Nagar Road,<br>
                            Ahmedabad-380015.
                        </p>
                    </div>
                
                    <!-- Phone -->
                    <div class="d-flex align-items-start mb-3">
                        <p class="me-3 mb-0">
                            <i class="fas fa-phone"></i>
                        </p>
                        <div>
                            <!--<p class="mb-0">079 - 40193925</p>-->
                            <p class="mb-0">+91 98989 70009</p>
                        </div>
                    </div>
                
                    <!-- Email -->
                    <div class="d-flex align-items-start">
                        <p class="me-3 mb-0">
                            <i class="fas fa-envelope"></i>
                        </p>
                        <p class="mb-0">dirapm.aakar@gmail.com</p>
                    </div>
                
                </div>
                </div>
                <!--<div class="col-lg-6" data-aos="zoom-in-left">
                    <div class="map con-box">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.3084853695473!2d72.51282731428229!3d23.012442922482844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b2a26751499%3A0x5708f037e8a18907!2sAries%20Events%20Pvt.%20Ltd!5e0!3m2!1sen!2sin!4v1656743515678!5m2!1sen!2sin"
                            width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>  -->
            </div>
        </div>
    </section>
    <!-- contact us End  -->
@endsection
