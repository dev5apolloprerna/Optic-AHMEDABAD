@extends('layouts.front')
@section('content')
    <style>
        .top-info-bar{
            display:none !important;
        }
    
        .reg-f {
            background: #fff;
            padding: 20px;
            margin: 20px 0px;
            border: 1px solid #f37820;
            background: #E6EDF5;
        }

        .contact_form_inp_2_checkbox {
            width: 100%;
            float: left;
            padding: 15px 0 0 0;
        }

        .sb-btn {
            border: none;
            background: #f76d2f;
            padding: 10px 50px;
            margin-top: 22px;
            border-radius: 8px;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }
    </style>

    <style>
    /* ==================================================
       VISITOR REGISTRATION FORM DESIGN ONLY
    ================================================== */
    
    p.text-success {
        position: relative;
        z-index: 1;
        margin: 0px auto;
        padding: 14px 18px;
        border: 1px solid rgba(32, 145, 91, 0.18);
        border-radius: 11px;
        background: rgba(32, 145, 91, 0.07);
        color: #168351 !important;
        font-size: 15px !important;
        font-weight: 700;
        width:600px;
    }
    
    @media (max-width:567px) {
        p.text-success {
            width:350px;
            text-align:start;
        }
    }

    .visitor-registration-page .reg-f {
        position: relative;
        overflow: hidden;
        margin: 28px 0 60px;
        padding: 42px;
        border: 1px solid rgba(13, 54, 101, 0.12);
        border-radius: 26px;
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(247, 109, 47, 0.10),
                transparent 28%
            ),
            linear-gradient(
                145deg,
                #ffffff 0%,
                #f7faff 58%,
                #fffaf6 100%
            );
        box-shadow:
            0 30px 70px rgba(8, 37, 75, 0.14),
            0 8px 24px rgba(8, 37, 75, 0.06);
    }

    .visitor-registration-page .reg-f::before {
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
            #15589f 52%,
            #f37820 52%,
            #ff9b52 100%
        );
    }

    .visitor-registration-page .reg-f::after {
        content: "";
        position: absolute;
        right: -80px;
        bottom: -95px;
        width: 210px;
        height: 210px;
        border: 38px solid rgba(243, 120, 32, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .visitor-registration-page .reg-f form {
        position: relative;
        z-index: 1;
    }

    /* Form rows */

    .visitor-registration-page .reg-f form > .d-flex {
        display: flex !important;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 20px;
        margin-top: 0 !important;
        margin-bottom: 22px;
    }

    .visitor-registration-page .reg-f form > .d-flex > .w-45 {
        flex: 1 1 calc(50% - 10px);
        width: auto !important;
        min-width: 0;
    }

    .visitor-registration-page .reg-f form > .d-flex > .sm-100 {
        flex-basis: 100%;
        width: 100% !important;
    }

    /* Field labels */

    .visitor-registration-page .form-txt,
    .visitor-registration-page .reg-f label {
        display: block;
        margin: 0 0 9px;
        color: #123965;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.45;
    }

    .visitor-registration-page .form-txt span,
    .visitor-registration-page .reg-f label span {
        display: inline-block;
        margin-left: 3px;
        color: #f37820 !important;
    }

    /* Inputs and selects */

    .visitor-registration-page .reg-f input:not([type="checkbox"]),
    .visitor-registration-page .reg-f select {
        display: block;
        width: 100%;
        height: 54px;
        margin: 0;
        padding: 0 17px;
        border: 1px solid #d5e0ec;
        border-radius: 12px;
        outline: none;
        background-color: #f8fafd;
        color: #102f54;
        font-family: inherit;
        font-size: 15px;
        font-weight: 500;
        box-shadow:
            inset 0 1px 2px rgba(8, 47, 99, 0.025),
            0 5px 15px rgba(8, 47, 99, 0.035);
        transition:
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease,
            transform 0.25s ease;
    }

    .visitor-registration-page .reg-f select {
        padding-right: 45px;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-image:
            linear-gradient(45deg, transparent 50%, #163e6c 50%),
            linear-gradient(135deg, #163e6c 50%, transparent 50%);
        background-position:
            calc(100% - 20px) 23px,
            calc(100% - 14px) 23px;
        background-size: 6px 6px, 6px 6px;
        background-repeat: no-repeat;
    }

    .visitor-registration-page .reg-f input::placeholder {
        color: #8c9aaa;
        font-weight: 400;
        opacity: 1;
    }

    .visitor-registration-page .reg-f input:not([type="checkbox"]):hover,
    .visitor-registration-page .reg-f select:hover {
        border-color: #b4c7db;
        background-color: #ffffff;
    }

    .visitor-registration-page .reg-f input:not([type="checkbox"]):focus,
    .visitor-registration-page .reg-f select:focus {
        border-color: #f37820;
        background-color: #ffffff;
        box-shadow:
            0 0 0 4px rgba(243, 120, 32, 0.11),
            0 10px 22px rgba(8, 47, 99, 0.08);
        transform: translateY(-1px);
    }

    /* Validation messages */

    .visitor-registration-page .reg-f .text-danger,
    .visitor-registration-page .reg-f .help-block {
        display: block;
        width: 100%;
        margin-top: 6px;
        color: #d83838 !important;
        font-size: 13px;
        font-weight: 600;
    }

    /* Visit date section */

    .visitor-registration-page .reg-f form > .d-flex:has(
        .contact_form_inp_2_checkbox
    ) {
        margin-bottom: 10px;
    }

    .visitor-registration-page .reg-f form > .d-flex:has(
        .contact_form_inp_2_checkbox
    ) > .w-45 {
        flex-basis: 100%;
        width: 100% !important;
    }

    .visitor-registration-page .contact_form_inp_2_checkbox {
        display: flex;
        float: none;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-height: 54px;
        margin: 0;
        padding: 14px 16px;
        border: 1px solid #d7e2ed;
        border-radius: 12px;
        background: #f8fafd;
        color: #193d67;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition:
            border-color 0.25s ease,
            background-color 0.25s ease,
            box-shadow 0.25s ease,
            transform 0.25s ease;
    }

    .visitor-registration-page .contact_form_inp_2_checkbox:hover {
        border-color: rgba(243, 120, 32, 0.5);
        background: #ffffff;
        transform: translateY(-1px);
    }

    .visitor-registration-page
    .contact_form_inp_2_checkbox:has(input:checked) {
        border-color: #f37820;
        background: rgba(243, 120, 32, 0.08);
        box-shadow: 0 0 0 4px rgba(243, 120, 32, 0.08);
    }

    .visitor-registration-page
    .contact_form_inp_2_checkbox
    input[type="checkbox"] {
        flex: 0 0 auto;
        width: 20px !important;
        height: 20px;
        margin: 0;
        accent-color: #f37820;
        cursor: pointer;
    }

    /* Captcha section */

    .visitor-registration-page .reg-f > form > .form-group {
        margin-top: 26px;
        padding-top: 25px;
        border-top: 1px solid #e1e8f0;
    }

    .visitor-registration-page .captcha {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 12px;
        border: 1px solid #d7e2ed;
        border-radius: 12px;
        background: #f8fafd;
    }

    .visitor-registration-page .captcha span {
        display: flex;
        flex: 1;
        align-items: center;
        min-width: 170px;
        overflow: hidden;
        border-radius: 8px;
        background: #ffffff;
    }

    .visitor-registration-page .captcha span img {
        display: block;
        width: 100%;
        max-width: 220px;
        height: 50px;
        object-fit: fill;
        border-radius: 8px;
    }

    .visitor-registration-page .captcha #reload {
        display: flex;
        flex: 0 0 50px;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        padding: 0;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #0b376e, #15589f);
        color: #ffffff;
        font-size: 24px;
        line-height: 1;
        cursor: pointer;
        box-shadow: 0 8px 18px rgba(11, 55, 110, 0.2);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .visitor-registration-page .captcha #reload:hover {
        transform: rotate(45deg);
        box-shadow: 0 12px 24px rgba(11, 55, 110, 0.28);
    }

    .visitor-registration-page #captcha {
        margin-top: 14px;
    }

    /* Submit button */

    .visitor-registration-page .sb-btn {
        position: relative;
        min-width: 180px;
        overflow: hidden;
        margin-top: 25px;
        padding: 14px 50px;
        border: none;
        border-radius: 12px;
        outline: none;
        background: linear-gradient(
            135deg,
            #f37820 0%,
            #f89548 100%
        );
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        cursor: pointer;
        box-shadow:
            0 14px 28px rgba(243, 120, 32, 0.30),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .visitor-registration-page .sb-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 75%;
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

    .visitor-registration-page .sb-btn:hover {
        transform: translateY(-3px);
        box-shadow:
            0 19px 36px rgba(243, 120, 32, 0.38),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .visitor-registration-page .sb-btn:hover::before {
        left: 145%;
    }

    .visitor-registration-page .sb-btn:active {
        transform: translateY(-1px);
    }

    /* Bottom lunch-pass message inside form */

    .visitor-registration-page .reg-f > p.text-success {
        position: relative;
        z-index: 1;
        margin: 30px 0 0;
        padding: 14px 18px;
        border: 1px solid rgba(32, 145, 91, 0.18);
        border-radius: 11px;
        background: rgba(32, 145, 91, 0.07);
        color: #168351 !important;
        font-size: 15px !important;
        font-weight: 700;
        width:100%;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .visitor-registration-page .reg-f {
            margin: 22px 0 45px;
            padding: 30px 20px;
            border-radius: 20px;
        }

        .visitor-registration-page .reg-f form > .d-flex {
            display: block !important;
            margin-bottom: 0;
        }

        .visitor-registration-page .reg-f form > .d-flex > .w-45 {
            width: 100% !important;
            margin-bottom: 19px;
        }

        .visitor-registration-page
        .reg-f
        input:not([type="checkbox"]),
        .visitor-registration-page .reg-f select {
            height: 52px;
        }

        .visitor-registration-page .captcha {
            align-items: stretch;
        }

        .visitor-registration-page .captcha span {
            flex-basis: calc(100% - 62px);
            min-width: 0;
        }

        .visitor-registration-page .captcha span img {
            max-width: 100%;
        }

        .visitor-registration-page .sb-btn {
            width: 100%;
            min-width: 0;
            margin-top: 20px;
            padding: 14px 25px;
        }
    }

    @media (max-width: 420px) {
        .visitor-registration-page .reg-f {
            padding: 27px 16px;
        }

        .visitor-registration-page .captcha {
            gap: 8px;
            padding: 9px;
        }

        .visitor-registration-page .captcha #reload {
            flex-basis: 48px;
            width: 48px;
            height: 48px;
        }
    }
    
    /* Visitor form heading */

.visitor-registration-page .visitor-form-heading {
    position: relative;
    margin-bottom: 32px;
    padding-bottom: 17px;
    text-align: center;
}

.visitor-registration-page .visitor-form-heading p {
    margin: 0;
    color: #082f63;
    font-size: 26px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.3px;
}

.visitor-registration-page .visitor-form-heading::after {
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
    .visitor-registration-page .visitor-form-heading {
        margin-bottom: 27px;
    }

    .visitor-registration-page .visitor-form-heading p {
        font-size: 22px;
    }
}

/* ==========================================
   INDIA / OVERSEAS SELECTION
========================================== */

.visitor-registration-page .visitor-country-selector {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 0 25px;
}

.visitor-registration-page .visitor-country-option {
    position: relative;
    flex: 1;
    margin: 0;
    cursor: pointer;
}

.visitor-registration-page .visitor-country-option input {
    position: absolute;
    width: 1px !important;
    height: 1px !important;
    opacity: 0;
    pointer-events: none;
}

.visitor-registration-page .visitor-country-option span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 50px;
    padding: 12px 18px;
    border: 1px solid #d5e0ec;
    border-radius: 12px;
    background: #f8fafd;
    color: #123965;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    transition:
        border-color 0.25s ease,
        background-color 0.25s ease,
        color 0.25s ease,
        box-shadow 0.25s ease,
        transform 0.25s ease;
}

.visitor-registration-page .visitor-country-option span::before {
    content: "";
    width: 16px;
    height: 16px;
    margin-right: 9px;
    border: 2px solid #aebdcd;
    border-radius: 50%;
    background: #ffffff;
    box-shadow: inset 0 0 0 4px #ffffff;
    transition:
        border-color 0.25s ease,
        background-color 0.25s ease;
}

.visitor-registration-page .visitor-country-option:hover span {
    border-color: rgba(243, 120, 32, 0.55);
    background: #ffffff;
    transform: translateY(-1px);
}

.visitor-registration-page
.visitor-country-option
input:checked + span {
    border-color: #f37820;
    background: rgba(243, 120, 32, 0.08);
    color: #0d3768;
    box-shadow: 0 0 0 4px rgba(243, 120, 32, 0.08);
}

.visitor-registration-page
.visitor-country-option
input:checked + span::before {
    border-color: #f37820;
    background: #f37820;
}

/* Conditional location fields */

/* Hide inactive India/Overseas fields */



@media (max-width: 767px) {
    .visitor-registration-page .visitor-country-selector {
        gap: 10px;
        margin-bottom: 22px;
    }

    .visitor-registration-page .visitor-country-option span {
        min-height: 48px;
        padding: 11px 10px;
        font-size: 13px;
    }
}

.visitor-registration-page
.reg-f
form > .visitor-country-fields.is-hidden {
    display: none !important;
}

/* ==================================================
   INDIA / OVERSEAS RADIO DESIGN — FIXED
================================================== */

.visitor-registration-page .visitor-country-selector {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
    width: 100%;
    margin: 0 0 28px;
}

/* Reset old label styles */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option {
    position: relative;
    display: block;
    width: 100%;
    margin: 0;
    padding: 0;
    cursor: pointer;
}

/* Completely hide the original radio input */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
input[type="radio"] {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    margin: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    opacity: 0 !important;
    box-shadow: none !important;
    pointer-events: none;
}

/* Visible option card */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
span {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 11px;
    width: 100%;
    min-height: 54px;
    margin: 0;
    padding: 13px 18px;
    overflow: hidden;
    border: 1px solid #d5e0ec;
    border-radius: 13px;
    background: #f8fafd;
    color: #123965;
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    box-shadow: 0 5px 14px rgba(8, 47, 99, 0.04);
    transition:
        border-color 0.25s ease,
        background-color 0.25s ease,
        color 0.25s ease,
        transform 0.25s ease,
        box-shadow 0.25s ease;
}

/* Proper round radio indicator */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
span::before {
    content: "";
    display: block;
    flex: 0 0 18px;
    width: 18px;
    min-width: 18px;
    height: 18px;
    min-height: 18px;
    border: 2px solid #afbdcd;
    border-radius: 50%;
    background: #ffffff;
    box-sizing: border-box;
    transition:
        border-color 0.25s ease,
        background-color 0.25s ease,
        box-shadow 0.25s ease;
}

/* Subtle decorative glow */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
span::after {
    content: "";
    position: absolute;
    top: -35px;
    right: -35px;
    width: 75px;
    height: 75px;
    border-radius: 50%;
    background: rgba(243, 120, 32, 0.08);
    opacity: 0;
    transition:
        opacity 0.25s ease,
        transform 0.35s ease;
}

/* Hover */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option:hover
span {
    border-color: rgba(243, 120, 32, 0.55);
    background: #ffffff;
    transform: translateY(-2px);
    box-shadow:
        0 10px 22px rgba(8, 47, 99, 0.08),
        0 4px 12px rgba(243, 120, 32, 0.07);
}

/* Selected option */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
input[type="radio"]:checked + span {
    border-color: #f37820;
    background: linear-gradient(
        135deg,
        rgba(243, 120, 32, 0.11),
        rgba(255, 255, 255, 0.96)
    );
    color: #e9650d;
    box-shadow:
        0 0 0 4px rgba(243, 120, 32, 0.09),
        0 10px 24px rgba(243, 120, 32, 0.12);
}

/* Selected round dot */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
input[type="radio"]:checked + span::before {
    border-color: #f37820;
    background: #f37820;
    box-shadow:
        inset 0 0 0 4px #ffffff,
        0 0 0 3px rgba(243, 120, 32, 0.12);
}

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
input[type="radio"]:checked + span::after {
    opacity: 1;
    transform: scale(1.25);
}

/* Keyboard accessibility */

.visitor-registration-page
.reg-f
.visitor-country-selector
.visitor-country-option
input[type="radio"]:focus-visible + span {
    outline: 3px solid rgba(243, 120, 32, 0.22);
    outline-offset: 3px;
}

/* Mobile */

@media (max-width: 767px) {
    .visitor-registration-page .visitor-country-selector {
        gap: 10px;
        margin-bottom: 24px;
    }

    .visitor-registration-page
    .reg-f
    .visitor-country-selector
    .visitor-country-option
    span {
        min-height: 50px;
        padding: 12px 10px;
        font-size: 13px;
    }

    .visitor-registration-page
    .reg-f
    .visitor-country-selector
    .visitor-country-option
    span::before {
        flex-basis: 17px;
        width: 17px;
        min-width: 17px;
        height: 17px;
        min-height: 17px;
    }
}

@media (max-width: 380px) {
    .visitor-registration-page .visitor-country-selector {
        grid-template-columns: 1fr;
    }
}
</style>                

    <section class="visitor-registration-page">
        <div class="head-menu-s">
            <h3 class="fr-head">Visitor registration</h3>
            <!--<p>-->
            <!--    <a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontVisitor_Registration') }}">Register</a>-->
            <!--</p>-->
        </div>
        
        
        {{--  <div style="display: none; z-index: 10060;" id="loading">
            <img id="loading-image" src="<?php echo $web_url; ?>images/loader.gif">
        </div>  --}}
        <marquee width="100%" direction="left" height="30px"
            style="background: red; color: white; font-size: 22px; font-weight: 600; margin-top: 15px;">
            - CHILDREN UNDER 12 YEARS NOT ALLOWED. 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - LUNCH PASS WILL BE ISSUED
            ONLY TO
            REGISTERED VISITORS BEFORE 12:00 PM.
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - लंच पास केवल ऑनलाइन
            रजिस्टर विजिटर को दोपहर 12:00 बजे तक दिए जाएंगे।
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -Entry ONLY FOR OPTICIANS.
        </marquee>
        <div class="container">
            
            <p class="text-success text-center" style="font-size:24px;">
                Collect your lunch pass before 12:00 PM
            </p>
            <div class="row justify-content-center ">
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-6">
                    <div class="reg-f">
                        <!--<h2 style="color:red;" class="text-center">OPTIC EXPO 2025 - RESCHEDULED TO NOVEMBER</h2>-->
                        <!--<div style="color: red;">*Online Registration is closed. Now Registration at Venue.</div>-->
                        <!--<h3 style="color:red;text-align: center;">Online Visitor Registration Is Closed. <br> Now Registered At Venue</h3>-->
                        
                        <form action="{{ route('FrontVisitor_Registration_store') }}"  onsubmit="return formsubmit()"
                            method="POST">
                            @csrf
                            <div class="visitor-form-heading">
                                <p>Register in Just a Minute.</p>
                            </div>
                            <div class="visitor-country-selector">

                                <label class="visitor-country-option">
                                    <input
                                        type="radio"
                                        name="country_type"
                                        id="country_type_india"
                                        value="india"
                                        onchange="toggleVisitorCountry(this.value, true)"
                                        {{ old('country_type', 'india') === 'india' ? 'checked' : '' }}
                                    >
                            
                                    <span>India</span>
                                </label>
                            
                                <label class="visitor-country-option">
                                    <input
                                        type="radio"
                                        name="country_type"
                                        id="country_type_overseas"
                                        value="other"
                                        onchange="toggleVisitorCountry(this.value, true)"
                                        {{ old('country_type') === 'other' ? 'checked' : '' }}
                                    >
                            
                                    <span>Overseas</span>
                                </label>
                            
                            </div>
                            <div class="d-flex mt-4">
                                <div class="w-45">
                                    <p class="form-txt">Name<span style="color:red ;">*</span></p>
                                    <input type="text" class="name" name="name" id="name" required
                                        autocomplete="off" value="{{ old('name') }}" />
                                </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror    
                                    
                                <div class="w-45">
                                    <p class="form-txt">Company Name <span style="color:red ;">*</span></p>
                                    <input type="text" class="companyName" name="companyName" id="companyName" required
                                        autocomplete="off" value="{{ old('companyName') }}" />
                                </div>
                                @error('companyName')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex mt-2">
                                <div class="w-45 ">
                                    <p class="form-txt">Email<span style="color:red ;">*</span></p>
                                    <input type="email" class="email" name="email" id="email" required
                                        autocomplete="off" value="{{ old('email') }}" />
                                </div>
                                @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                                <div class="w-45">
                                    <p class="form-txt">Mobile<span style="color:red ;">*</span></p>
                                    <input
                                        type="text"
                                        class="number"
                                        id="mobile"
                                        name="mobile"
                                        minlength="{{ old('country_type', 'india') === 'other' ? 6 : 10 }}"
                                        maxlength="{{ old('country_type', 'india') === 'other' ? 15 : 10 }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, this.maxLength);"
                                        onblur="chkMobile();"
                                        autocomplete="off"
                                        value="{{ old('mobile') }}"
                                        required
                                    />
                                </div>
                                @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- India location fields --}}
<div
    id="indiaFields"
    class="d-flex mt-2 visitor-country-fields
        {{ old('country_type', 'india') === 'other' ? 'is-hidden' : '' }}"
>
    <div class="w-45">
        <p class="form-txt">
            State<span style="color:red;">*</span>
        </p>

        <select
            name="state"
            id="state"
            onchange="getCityName()"
            required
        >
            <option value="">Select State</option>

            @foreach ($states as $state)
                <option
                    value="{{ $state->stateId }}"
                    {{ old('state') == $state->stateId ? 'selected' : '' }}
                >
                    {{ $state->stateName }}
                </option>
            @endforeach
        </select>

        @error('state')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="w-45">
        <p class="form-txt">
            City<span style="color:red;">*</span>
        </p>

        <select name="city" id="city" required>
            <option value="">Select City</option>
        </select>

        @error('city')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

{{-- Overseas location fields --}}
<div
    id="overseasFields"
    class="d-flex mt-2 visitor-country-fields
        {{ old('country_type', 'india') === 'other' ? '' : 'is-hidden' }}"
>
    <div class="w-45">
        <p class="form-txt">
            Country<span style="color:red;">*</span>
        </p>

        <select name="country" id="country">
            <option value="">Select Country</option>

            {{-- Paste the same country options from your Earthcon form here --}}

           <!-- A -->
        <option value="Afghanistan">Afghanistan</option>
        <option value="Albania">Albania</option>
        <option value="Algeria">Algeria</option>
        <option value="Andorra">Andorra</option>
        <option value="Angola">Angola</option>
        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
        <option value="Argentina">Argentina</option>
        <option value="Armenia">Armenia</option>
        <option value="Australia">Australia</option>
        <option value="Austria">Austria</option>
        <option value="Azerbaijan">Azerbaijan</option>

        <!-- B -->
        <option value="Bahamas">Bahamas</option>
        <option value="Bahrain">Bahrain</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="Barbados">Barbados</option>
        <option value="Belarus">Belarus</option>
        <option value="Belgium">Belgium</option>
        <option value="Belize">Belize</option>
        <option value="Benin">Benin</option>
        <option value="Bhutan">Bhutan</option>
        <option value="Bolivia">Bolivia</option>
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
        <option value="Botswana">Botswana</option>
        <option value="Brazil">Brazil</option>
        <option value="Brunei">Brunei</option>
        <option value="Bulgaria">Bulgaria</option>
        <option value="Burkina Faso">Burkina Faso</option>
        <option value="Burundi">Burundi</option>

        <!-- C -->
        <option value="Cabo Verde">Cabo Verde</option>
        <option value="Cambodia">Cambodia</option>
        <option value="Cameroon">Cameroon</option>
        <option value="Canada">Canada</option>
        <option value="Central African Republic">Central African Republic</option>
        <option value="Chad">Chad</option>
        <option value="Chile">Chile</option>
        <option value="China">China</option>
        <option value="Colombia">Colombia</option>
        <option value="Comoros">Comoros</option>
        <option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
        <option value="Costa Rica">Costa Rica</option>
        <option value="Croatia">Croatia</option>
        <option value="Cuba">Cuba</option>
        <option value="Cyprus">Cyprus</option>
        <option value="Czechia">Czechia</option>

        <!-- D -->
        <option value="Denmark">Denmark</option>
        <option value="Djibouti">Djibouti</option>
        <option value="Dominica">Dominica</option>
        <option value="Dominican Republic">Dominican Republic</option>

        <!-- E -->
        <option value="Ecuador">Ecuador</option>
        <option value="Egypt">Egypt</option>
        <option value="El Salvador">El Salvador</option>
        <option value="Equatorial Guinea">Equatorial Guinea</option>
        <option value="Eritrea">Eritrea</option>
        <option value="Estonia">Estonia</option>
        <option value="Eswatini">Eswatini</option>
        <option value="Ethiopia">Ethiopia</option>

        <!-- F -->
        <option value="Fiji">Fiji</option>
        <option value="Finland">Finland</option>
        <option value="France">France</option>

        <!-- G -->
        <option value="Gabon">Gabon</option>
        <option value="Gambia">Gambia</option>
        <option value="Georgia">Georgia</option>
        <option value="Germany">Germany</option>
        <option value="Ghana">Ghana</option>
        <option value="Greece">Greece</option>
        <option value="Grenada">Grenada</option>
        <option value="Guatemala">Guatemala</option>
        <option value="Guinea">Guinea</option>
        <option value="Guinea-Bissau">Guinea-Bissau</option>
        <option value="Guyana">Guyana</option>

        <!-- H -->
        <option value="Haiti">Haiti</option>
        <option value="Honduras">Honduras</option>
        <option value="Hungary">Hungary</option>

        <!-- I (India removed) -->
        <option value="Iceland">Iceland</option>
        <option value="Indonesia">Indonesia</option>
        <option value="Iran">Iran</option>
        <option value="Iraq">Iraq</option>
        <option value="Ireland">Ireland</option>
        <option value="Israel">Israel</option>
        <option value="Italy">Italy</option>

        <!-- J -->
        <option value="Jamaica">Jamaica</option>
        <option value="Japan">Japan</option>
        <option value="Jordan">Jordan</option>

        <!-- K -->
        <option value="Kazakhstan">Kazakhstan</option>
        <option value="Kenya">Kenya</option>
        <option value="Kiribati">Kiribati</option>
        <option value="Kuwait">Kuwait</option>
        <option value="Kyrgyzstan">Kyrgyzstan</option>

        <!-- L -->
        <option value="Laos">Laos</option>
        <option value="Latvia">Latvia</option>
        <option value="Lebanon">Lebanon</option>
        <option value="Lesotho">Lesotho</option>
        <option value="Liberia">Liberia</option>
        <option value="Libya">Libya</option>
        <option value="Liechtenstein">Liechtenstein</option>
        <option value="Lithuania">Lithuania</option>
        <option value="Luxembourg">Luxembourg</option>

        <!-- M -->
        <option value="Madagascar">Madagascar</option>
        <option value="Malawi">Malawi</option>
        <option value="Malaysia">Malaysia</option>
        <option value="Maldives">Maldives</option>
        <option value="Mali">Mali</option>
        <option value="Malta">Malta</option>
        <option value="Marshall Islands">Marshall Islands</option>
        <option value="Mauritania">Mauritania</option>
        <option value="Mauritius">Mauritius</option>
        <option value="Mexico">Mexico</option>
        <option value="Micronesia">Micronesia</option>
        <option value="Moldova">Moldova</option>
        <option value="Monaco">Monaco</option>
        <option value="Mongolia">Mongolia</option>
        <option value="Montenegro">Montenegro</option>
        <option value="Morocco">Morocco</option>
        <option value="Mozambique">Mozambique</option>
        <option value="Myanmar">Myanmar</option>

        <!-- N -->
        <option value="Namibia">Namibia</option>
        <option value="Nauru">Nauru</option>
        <option value="Nepal">Nepal</option>
        <option value="Netherlands">Netherlands</option>
        <option value="New Zealand">New Zealand</option>
        <option value="Nicaragua">Nicaragua</option>
        <option value="Niger">Niger</option>
        <option value="Nigeria">Nigeria</option>
        <option value="North Korea">North Korea</option>
        <option value="North Macedonia">North Macedonia</option>
        <option value="Norway">Norway</option>

        <!-- O -->
        <option value="Oman">Oman</option>

        <!-- P -->
        <option value="Pakistan">Pakistan</option>
        <option value="Palau">Palau</option>
        <option value="Panama">Panama</option>
        <option value="Papua New Guinea">Papua New Guinea</option>
        <option value="Paraguay">Paraguay</option>
        <option value="Peru">Peru</option>
        <option value="Philippines">Philippines</option>
        <option value="Poland">Poland</option>
        <option value="Portugal">Portugal</option>

        <!-- Q -->
        <option value="Qatar">Qatar</option>

        <!-- R -->
        <option value="Romania">Romania</option>
        <option value="Russia">Russia</option>
        <option value="Rwanda">Rwanda</option>

        <!-- S -->
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
        <option value="Saint Lucia">Saint Lucia</option>
        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
        <option value="Samoa">Samoa</option>
        <option value="San Marino">San Marino</option>
        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <option value="Senegal">Senegal</option>
        <option value="Serbia">Serbia</option>
        <option value="Seychelles">Seychelles</option>
        <option value="Sierra Leone">Sierra Leone</option>
        <option value="Singapore">Singapore</option>
        <option value="Slovakia">Slovakia</option>
        <option value="Slovenia">Slovenia</option>
        <option value="Solomon Islands">Solomon Islands</option>
        <option value="Somalia">Somalia</option>
        <option value="South Africa">South Africa</option>
        <option value="South Korea">South Korea</option>
        <option value="South Sudan">South Sudan</option>
        <option value="Spain">Spain</option>
        <option value="Sri Lanka">Sri Lanka</option>
        <option value="Sudan">Sudan</option>
        <option value="Suriname">Suriname</option>
        <option value="Sweden">Sweden</option>
        <option value="Switzerland">Switzerland</option>
        <option value="Syria">Syria</option>

        <!-- T -->
        <option value="Taiwan">Taiwan</option>
        <option value="Tajikistan">Tajikistan</option>
        <option value="Tanzania">Tanzania</option>
        <option value="Thailand">Thailand</option>
        <option value="Timor-Leste">Timor-Leste</option>
        <option value="Togo">Togo</option>
        <option value="Tonga">Tonga</option>
        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
        <option value="Tunisia">Tunisia</option>
        <option value="Turkey">Turkey</option>
        <option value="Turkmenistan">Turkmenistan</option>
        <option value="Tuvalu">Tuvalu</option>

        <!-- U -->
        <option value="Uganda">Uganda</option>
        <option value="Ukraine">Ukraine</option>
        <option value="United Arab Emirates">United Arab Emirates</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
        <option value="Uruguay">Uruguay</option>
        <option value="Uzbekistan">Uzbekistan</option>

        <!-- V -->
        <option value="Vanuatu">Vanuatu</option>
        <option value="Vatican City">Vatican City</option>
        <option value="Venezuela">Venezuela</option>
        <option value="Vietnam">Vietnam</option>

        <!-- Y -->
        <option value="Yemen">Yemen</option>

        <!-- Z -->
        <option value="Zambia">Zambia</option>
        <option value="Zimbabwe">Zimbabwe</option>
        </select>

        @error('country')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="w-45">
        <p class="form-txt">
            State / Province<span style="color:red;">*</span>
        </p>

        <input
            type="text"
            name="overseas_state"
            id="overseas_state"
            placeholder="State / Province"
            autocomplete="off"
            value="{{ old('overseas_state') }}"
        >

        @error('overseas_state')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
                            <div class="d-flex mt-2">
                                <div class="w-45 ">
                                    <label>Select Visit Date <i style="color: #0075ff;" class="fa fa-check-square"></i>
                                        <span style="color:red;">*</span></label>
                                    <div class="contact_form_inp_2_checkbox">
                                        <input type="checkbox" name="visitDate" style="width: 15% !important;"
                                            id="visitDate1" value="{{ config('app.visitor_date1') }}">{{ config('app.visitor_date1') }}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="w-45 ">
                                    <div class="contact_form_inp_2_checkbox">
                                        <input type="checkbox" name="visitDate" style="width: 15% !important;"
                                            id="visitDate2" value="{{ config('app.visitor_date2') }}">{{ config('app.visitor_date2') }}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-2">
                                <div class="w-45 ">
                                    <div class="contact_form_inp_2_checkbox">
                                        <input type="checkbox" name="visitDate" style="width: 15% !important;"
                                            id="visitDate3" value="{{ config('app.visitor_date3') }}">{{ config('app.visitor_date3') }}
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mt-2">
                                <div class="w-45 sm-100 ">
                                    <p class="form-txt">I am interested in<span style="color:red ;">*</span></p>
                                    <select name="interested" id="interested" required>
                                        <option value="Eyewear Frames">Eyewear Frames</option>
                                        <option value="Sunglasses">Sunglasses</option>
                                        <option value="Contact Lenses">Contact Lenses</option>
                                        <option value="Spectacle lenses">Spectacle lenses</option>
                                        <option value="Eye Testing Equipments">Eye Testing Equipments</option>
                                        <option value="Optical Instruments">Optical Instruments</option>
                                        <option value="Spectacle Cases">Spectacle Cases</option>
                                        <option value="Eyewear Packaging">Eyewear Packaging</option>
                                        <option value="Optical Accessories & Consumables">Optical Accessories & Consumables
                                        </option>
                                        <option value="Cleaning Products">Cleaning Products</option>
                                        <option value="Optical Shop Fitting & Fixtures">Optical Shop Fitting & Fixtures
                                        </option>
                                        <option value="Optical Spare Parts">Optical Spare Parts</option>
                                        <option value="Eyewear Related Softwares & Tech Companies">Eyewear Related
                                            Softwares & Tech Companies</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                                <div class="form-group mt-4 mb-4">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload"
                                            id="reload">
                                            &#x21bb;
                                        </button>
                                    </div>
                                </div>
                                <input id="captcha" type="text" class="form-control"
                                    placeholder="Enter Captcha" name="captcha" required>
                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <!--<div style="color: red;">*Online Registration is close. Now Registration on Vanue</div>-->
                            <div><button type="submit" onclick="return validateData();" class="sb-btn">Submit</button></div>
                        </form>
                        <p class="text-success text-center" style="font-size:18px;">
                            Collect your lunch pass before 12:00 PM
                        </p>

                    </div>
                </div>



            </div>
        </div>
    </section>
    

<script>

function chkMobile(){

    var flag=true;

    $.ajax({
        url:"{{ route('FrontVisitor_Registration_checkmobile') }}",
        type:'GET',
        data:{
            mobile:$('#mobile').val()
        },
        async:false,
        success:function(data){

            if(data==1){
                alert('Mobile already exists');
                $('#mobile').val('');
                $('#mobile').focus();
                flag=false;
            }

        }
    });

    return flag;
}
        // function chkMobile() {
        //     var Flag = true;
        //     var mobile = $('#mobile').val();
        //     var url = "{{ route('FrontVisitor_Registration_checkmobile') }}";
        //     $.ajax({
        //         url: url,
        //         type: 'GET',
        //         data: {
        //             mobile,
        //             mobile
        //         },
        //         success: function(data) {
        //             console.log(data);
        //             var obj = JSON.parse(data);
        //             if (data == 1) {

        //                 alert('Mobile No Already Exist');
        //                 $('#mobile').val('');
        //                 $('#mobile').focus();
        //                 Flag = false;

        //                 return Flag;
        //             } else {
        //                 Flag = true;
        //                 return Flag;
        //             }
        //         }
        //     });
        //     return Flag;
        // }
    </script>    
    
@endsection

@section('scripts')

<script>
function getCityName()
{
    var state = $('#state').val();

    $.ajax({
        url: "{{ route('mappingcity') }}",
        type: "POST",
        data: {
            state: state,
            _token: "{{ csrf_token() }}"
        },
        success: function(result){
            $("#city").html(result);
        }
    });
}
</script>


    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'refresh_captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>


    <script>
        $("#visitDate1").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate2").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            }
        });

        $("#visitDate2").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate3").prop('checked', false);
            }
        });

        $("#visitDate3").on('click', function() {
            if ($(this).is(':checked')) {
                $("#visitDate1").prop('checked', false);
                $("#visitDate2").prop('checked', false);
            }
        });
    </script>

    <script>
        function formsubmit() {
            if ($("#visitDate1").is(':checked') || $("#visitDate2").is(':checked') || $("#visitDate3").is(':checked')) {
                return true;
            } else {
                alert('Select visit date');
                return false;
            }
        }
    </script>

    

    <script>
        $(document).ready(function() {

            window.setTimeout(function() {
                $("#success-alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>

    <script>
        function validateData() {
            var form_submit = formsubmit();
            var chk_Mobile = chkMobile();

            if (form_submit == true && chk_Mobile == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script>
        function otherOption() {

            var city = $("#city").val();

            if (city == "Other") {
                $("#city").hide();
                $("#city").val('');
                $("#city").attr('required', false);
                $("#othercity").show();
                $("#othercity").attr('required', true);
            } else {
                $("#othercity").hide();
                $("#othercity").attr('required', false);
                $("#city").show();
                $("#city").attr('required', true);

            }

        }

        function getCityName() {
            var state = $("#state").val();

            if (state === "Other") {
                $("#state").hide();
                $("#state").attr('required', false);
                $("#city").hide();
                $("#city").attr('required', false);
                $("#otherstate").show();
                $("#otherstate").attr('required', true);
                $("#othercity").show();
                $("#othercity").attr('required', true);
            } else {
                var url = "{{ route('mappingcity', ':state') }}";
                url = url.replace(":state", state);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        state: state,
                    },
                    success: function(data) {
                        $("#city").html('');
                        $("#city").append(data);
                        $("#state").show();
                        $("#state").attr('required', true);
                        $("#city").show();
                        $("#city").attr('required', true);
                        $("#otherstate").hide();
                        $("#otherstate").attr('required', false);
                        $("#othercity").hide();
                        $("#othercity").attr('required', false);
                        otherOption();
                    }
                });
            }
        }

        // Call otherOption() initially to set the input text field visibility based on default city value
        $(document).ready(function() {
            otherOption();
        });

        // Call otherOption() whenever the city dropdown value changes
        $("#city").change(function() {
            otherOption();
        });
    </script>
    
    <script>
function getCityName()
{
    var state = $('#state').val();

    $.ajax({
        url: "{{ route('mappingcity') }}",
        type: "POST",
        data: {
            state: state,
            _token: "{{ csrf_token() }}"
        },
        success: function(result){
            $("#city").html(result);
        }
    });
}
</script>

<script>
    function toggleVisitorCountry(type, resetMobile = false) {
        const isIndia = type === 'india';

        const indiaFields = document.getElementById('indiaFields');
        const overseasFields = document.getElementById('overseasFields');

        const state = document.getElementById('state');
        const city = document.getElementById('city');
        const country = document.getElementById('country');
        const overseasState = document.getElementById('overseas_state');
        const mobile = document.getElementById('mobile');

        indiaFields.classList.toggle('is-hidden', !isIndia);
        overseasFields.classList.toggle('is-hidden', isIndia);

        // India fields
        state.disabled = !isIndia;
        city.disabled = !isIndia;

        state.required = isIndia;
        city.required = isIndia;

        // Overseas fields
        country.disabled = isIndia;
        overseasState.disabled = isIndia;

        country.required = !isIndia;
        overseasState.required = !isIndia;

        // Mobile validation
        mobile.minLength = isIndia ? 10 : 6;
        mobile.maxLength = isIndia ? 10 : 15;

        if (resetMobile) {
            mobile.value = '';
        } else if (mobile.value.length > mobile.maxLength) {
            mobile.value = mobile.value.slice(0, mobile.maxLength);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const selectedCountryType = document.querySelector(
            'input[name="country_type"]:checked'
        );

        toggleVisitorCountry(
            selectedCountryType ? selectedCountryType.value : 'india',
            false
        );
    });
</script>
@endsection
