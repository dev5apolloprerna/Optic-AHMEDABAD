@extends('layouts.front')
@section('content')
<!--<section>-->
<!--    <div class="head-menu-s">-->
<!--        <h3 class="fr-head">Floor Plan</h3>-->
<!--        <p>-->
<!--            <a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontFloor_Plan') }}">Floor plan</a>-->
<!--        </p>-->
<!--    </div>-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center mt-40">-->
<!--            <div class="col-lg-12">-->

<!--                <div>-->
<!--                    <img class="img-fluid" src="{{ asset('assets/front/img/optic-fplan.jpg') }}" alt="">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->


<!--/*    .reg-f {*/-->
<!--/*        background: #fff;*/-->
<!--/*        padding: 20px;*/-->
<!--/*        margin: 20px 0px;*/-->
<!--/*        border: 1px solid #f37820;*/-->
<!--/*        background: #E6EDF5;*/-->
<!--/*    }*/-->

<!--/*    .contact_form_inp_2_checkbox {*/-->
<!--/*        width: 100%;*/-->
<!--/*        float: left;*/-->
<!--/*        padding: 15px 0 0 0;*/-->
<!--/*    }*/-->

<!--/*    .sb-btn {*/-->
<!--/*        border: none;*/-->
<!--/*        background: #f76d2f;*/-->
<!--/*        padding: 10px 50px;*/-->
<!--/*        margin-top: 22px;*/-->
<!--/*        border-radius: 8px;*/-->
<!--/*        color: white;*/-->
<!--/*        text-transform: uppercase;*/-->
<!--/*        font-weight: 600;*/-->
<!--/*    }*/-->




<!--<section class="contact padding-top padding-bottom">-->
<!--    <div class="head-menu-s">-->
<!--        <h3 class="fr-head">Floor plan</h3>-->
<!--        <p>-->
            
<!--        </p>-->
<!--    </div>-->
<!--    <h3 style="color:red;text-align: center;">Online Visitor Registration Is Closed. <br> Now Registered At Venue</h3>-->
<!--    <div class="container">-->

<!--        <div class="row justify-content-center mt-40">-->
<!--            <div class="col-lg-6">-->
<!--                <div class="reg-f" style="border: 1px solid #f37820;background: #E6EDF5;">-->
<!--                    <form action="{{ route('FrontFloor_Plan_store') }}" method="post">-->
<!--                        @csrf-->

<!--                        <div class="row mt-4">-->
<!--                            <div class="col-lg-6">-->
<!--                                <p class="form-txt">Name<span style="color:red ;">*</span></p>-->
<!--                                <input name="name" type="text" placeholder="Your Name*" value="{{ old('name') }}"-->
<!--                                    required="" autocomplete="off" maxlength="25">-->
<!--                            </div>-->
<!--                            <div class="col-lg-6">-->
<!--                                <p class="form-txt">Company Name<span style="color:red ;">*</span></p>-->
<!--                                <input name="companyName" type="text" placeholder="Your Company Name*"-->
<!--                                    value="{{ old('companyName') }}" required="" autocomplete="off" maxlength="50">-->
<!--                            </div>-->
<!--                            <div class="col-lg-6">-->
<!--                                <p class="form-txt">Phone<span style="color:red ;">*</span></p>-->
<!--                                <input name="mobile" type="text" maxlength="10" minlength="10"-->
<!--                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"-->
<!--                                    placeholder="Your Phone*" value="{{ old('mobile') }}" required=""-->
<!--                                    autocomplete="off">-->
<!--                            </div>-->
<!--                            <div class="col-lg-6">-->
<!--                                <p class="form-txt">Email<span style="color:red ;">*</span></p>-->
<!--                                <input name="email" type="email" placeholder="Your Email*" value="{{ old('email') }}"-->
<!--                                    required="" autocomplete="off" maxlength="50">-->
<!--                            </div>-->

<!--                        </div>-->

<!--                        <div class="mt-3">-->
<!--                            <button type="submit" class="sb-btn">Submit</button>-->
<!--                        </div>-->

<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<style>
    /* ==================================================
       FLOOR PLAN FORM AREA ONLY
    ================================================== */

    .floor-form-section {
        position: relative;
        padding: 65px 0 85px;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 10% 15%,
                rgba(247, 109, 47, 0.12),
                transparent 28%
            ),
            radial-gradient(
                circle at 92% 85%,
                rgba(10, 49, 96, 0.12),
                transparent 30%
            ),
            linear-gradient(135deg, #f8fbff 0%, #edf3f9 55%, #fff8f3 100%);
    }

    .floor-form-section::before {
        content: "";
        position: absolute;
        inset: 0;
        opacity: 0.45;
        pointer-events: none;
        background-image:
            linear-gradient(
                rgba(10, 49, 96, 0.035) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(10, 49, 96, 0.035) 1px,
                transparent 1px
            );
        background-size: 35px 35px;
    }

    .floor-form-section::after {
        content: "";
        position: absolute;
        right: -130px;
        bottom: -150px;
        width: 350px;
        height: 350px;
        border: 65px solid rgba(247, 109, 47, 0.06);
        border-radius: 50%;
        pointer-events: none;
    }

    .floor-form-section .container {
        position: relative;
        z-index: 1;
    }

    .floor-form-section .reg-f {
        position: relative;
        overflow: hidden;
        margin: 0;
        padding: 42px;
        border: 1px solid rgba(10, 49, 96, 0.1) !important;
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.96) !important;
        box-shadow:
            0 30px 70px rgba(10, 49, 96, 0.14),
            0 8px 25px rgba(10, 49, 96, 0.07);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .floor-form-section .reg-f::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(
            90deg,
            #0a3160 0%,
            #15559a 50%,
            #f76d2f 50%,
            #ff9a50 100%
        );
    }

    .floor-form-section .reg-f::after {
        content: "";
        position: absolute;
        right: -65px;
        bottom: -75px;
        width: 175px;
        height: 175px;
        border: 32px solid rgba(247, 109, 47, 0.055);
        border-radius: 50%;
        pointer-events: none;
    }

    .floor-form-section .reg-f form {
        position: relative;
        z-index: 1;
    }

    .floor-form-section .reg-f .row {
        margin-right: -10px;
        margin-left: -10px;
    }

    .floor-form-section .reg-f .row > div {
        padding-right: 10px;
        padding-left: 10px;
        margin-bottom: 22px;
    }

    .floor-form-section .form-txt {
        margin: 0 0 9px;
        color: #0a3160;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.4;
    }

    .floor-form-section .form-txt span {
        display: inline-block;
        margin-left: 3px;
        color: #f76d2f !important;
    }

    .floor-form-section .reg-f input {
        width: 100%;
        height: 54px;
        padding: 0 17px;
        border: 1px solid #d8e2ed;
        border-radius: 12px;
        outline: none;
        background: #f8fafd;
        color: #102f54;
        font-size: 15px;
        font-weight: 500;
        box-shadow:
            inset 0 1px 2px rgba(10, 49, 96, 0.025),
            0 5px 15px rgba(10, 49, 96, 0.035);
        transition:
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease,
            transform 0.25s ease;
    }

    .floor-form-section .reg-f input::placeholder {
        color: #8b9aab;
        font-weight: 400;
        opacity: 1;
    }

    .floor-form-section .reg-f input:hover {
        border-color: #b6c7da;
        background: #ffffff;
    }

    .floor-form-section .reg-f input:focus {
        border-color: #f76d2f;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(247, 109, 47, 0.11),
            0 9px 22px rgba(10, 49, 96, 0.08);
        transform: translateY(-1px);
    }

    .floor-form-section .sb-btn {
        position: relative;
        min-width: 175px;
        overflow: hidden;
        margin-top: 0;
        padding: 14px 50px;
        border: none;
        border-radius: 12px;
        outline: none;
        background: linear-gradient(135deg, #f76d2f 0%, #f58b3d 100%);
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow:
            0 13px 28px rgba(247, 109, 47, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .floor-form-section .sb-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -110%;
        width: 70%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.35),
            transparent
        );
        transform: skewX(-20deg);
        transition: left 0.55s ease;
    }

    .floor-form-section .sb-btn:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow:
            0 18px 35px rgba(247, 109, 47, 0.38),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .floor-form-section .sb-btn:hover::before {
        left: 145%;
    }

    .floor-form-section .sb-btn:active {
        transform: translateY(-1px);
    }

    .floor-form-section .mt-3 {
        margin-top: 0 !important;
        text-align: center;
    }

    @media (max-width: 991px) {
        .floor-form-section {
            padding: 55px 0 70px;
        }

        .floor-form-section .reg-f {
            padding: 35px 28px;
        }
    }

    @media (max-width: 767px) {
        .floor-form-section {
            padding: 40px 0 55px;
        }

        .floor-form-section .reg-f {
            padding: 30px 20px 25px;
            border-radius: 20px;
        }

        .floor-form-section .reg-f .row > div {
            margin-bottom: 18px;
        }

        .floor-form-section .reg-f input {
            height: 52px;
        }

        .floor-form-section .sb-btn {
            width: 100%;
            min-width: 0;
            padding: 14px 25px;
        }
    }
    
    /* Visitor form heading */

.floor-form-section .visitor-form-heading {
    position: relative;
    margin-bottom: 32px;
    padding-bottom: 17px;
    text-align: center;
}

.floor-form-section .visitor-form-heading p {
    margin: 0;
    color: #082f63;
    font-size: 26px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.3px;
}

.floor-form-section .visitor-form-heading::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 55px;
    height: 4px;
    border-radius: 20px;
    background: #f37820;
    transform: translateX(-50%);
}

@media (max-width: 767px) {
    .floor-form-section .visitor-form-heading {
        margin-bottom: 27px;
    }

    .floor-form-section .visitor-form-heading p {
        font-size: 22px;
    }
}
</style>

<section class="contact padding-top padding-bottom">

    {{-- Existing breadcrumb remains exactly the same --}}
    <div class="head-menu-s">
        <h3 class="fr-head">Floor plan</h3>
        <p>
            <!--<a href="{{ route('FrontIndex') }}">Home </a> / Floor plan-->
        </p>
    </div>

    {{-- Only form area redesigned --}}
    <div class="floor-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                    <div class="reg-f">
                        <form action="{{ route('FrontFloor_Plan_store') }}" method="post">
                            @csrf
                            <div class="visitor-form-heading">
        <p>Explore the Floor Plan & Stall Availability</p>
    </div>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                    <p class="form-txt">
                                        Name<span style="color:red;">*</span>
                                    </p>

                                    <input
                                        name="name"
                                        type="text"
                                        placeholder="Your Name*"
                                        value="{{ old('name') }}"
                                        required=""
                                        autocomplete="off"
                                        maxlength="25"
                                    >
                                </div>

                                <div class="col-lg-6">
                                    <p class="form-txt">
                                        Company Name<span style="color:red;">*</span>
                                    </p>

                                    <input
                                        name="companyName"
                                        type="text"
                                        placeholder="Your Company Name*"
                                        value="{{ old('companyName') }}"
                                        required=""
                                        autocomplete="off"
                                        maxlength="50"
                                    >
                                </div>

                                <div class="col-lg-6">
                                    <p class="form-txt">
                                        Phone<span style="color:red;">*</span>
                                    </p>

                                    <input
                                        name="mobile"
                                        type="text"
                                        maxlength="10"
                                        minlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        placeholder="Your Phone*"
                                        value="{{ old('mobile') }}"
                                        required=""
                                        autocomplete="off"
                                    >
                                </div>

                                <div class="col-lg-6">
                                    <p class="form-txt">
                                        Email<span style="color:red;">*</span>
                                    </p>

                                    <input
                                        name="email"
                                        type="email"
                                        placeholder="Your Email*"
                                        value="{{ old('email') }}"
                                        required=""
                                        autocomplete="off"
                                        maxlength="50"
                                    >
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="sb-btn">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection