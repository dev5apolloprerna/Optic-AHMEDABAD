@extends('layouts.front')
@section('content')
    @include('common.front.frontalert')


<style>
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
       BOOK MY STALL FORM DESIGN
    ================================================== */

    .book-stall-page .reg-f {
        position: relative;
        overflow: hidden;
        margin: 25px 0 60px;
        padding: 42px;
        border: 1px solid rgba(12, 50, 95, 0.12) !important;
        border-radius: 26px;
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(247, 109, 47, 0.11),
                transparent 30%
            ),
            linear-gradient(
                145deg,
                #ffffff 0%,
                #f7faff 58%,
                #fff9f5 100%
            ) !important;
        box-shadow:
            0 30px 70px rgba(8, 39, 79, 0.14),
            0 8px 24px rgba(8, 39, 79, 0.06);
    }

    .book-stall-page .reg-f::before {
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

    .book-stall-page .reg-f::after {
        content: "";
        position: absolute;
        right: -80px;
        bottom: -90px;
        width: 200px;
        height: 200px;
        border: 36px solid rgba(243, 120, 32, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .book-stall-page .reg-f form {
        position: relative;
        z-index: 1;
    }

    /* Form grid */

    .book-stall-page .reg-f .row {
        margin-right: -10px;
        margin-left: -10px;
    }

    .book-stall-page .reg-f .row > div {
        margin-bottom: 22px;
        padding-right: 10px;
        padding-left: 10px;
    }

    /* Labels */

    .book-stall-page .form-txt {
        display: block;
        margin: 0 0 9px;
        color: #123965;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.45;
    }

    .book-stall-page .form-txt span {
        display: inline-block;
        margin-left: 3px;
        color: #f37820 !important;
    }

    /* Inputs and textarea */

    .book-stall-page .reg-f input,
    .book-stall-page .reg-f textarea {
        display: block;
        width: 100%;
        margin: 0;
        border: 1px solid #d6e1ec;
        border-radius: 12px;
        outline: none;
        background: #f8fafd;
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

    .book-stall-page .reg-f input {
        height: 54px;
        padding: 0 17px;
    }

    .book-stall-page .reg-f textarea {
        min-height: 125px;
        padding: 15px 17px;
        line-height: 1.6;
        resize: vertical;
    }

    .book-stall-page .reg-f input::placeholder,
    .book-stall-page .reg-f textarea::placeholder {
        color: #8c9aaa;
        font-weight: 400;
        opacity: 1;
    }

    .book-stall-page .reg-f input:hover,
    .book-stall-page .reg-f textarea:hover {
        border-color: #b5c8db;
        background: #ffffff;
    }

    .book-stall-page .reg-f input:focus,
    .book-stall-page .reg-f textarea:focus {
        border-color: #f37820;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(243, 120, 32, 0.11),
            0 10px 22px rgba(8, 47, 99, 0.08);
        transform: translateY(-1px);
    }

    /* Message field */

    .book-stall-page .reg-f form > .col-lg-12 {
        padding: 0;
        margin-top: 2px;
    }

    /* Submit area */

    .book-stall-page .reg-f .mt-3 {
        margin-top: 25px !important;
        text-align: center;
    }

    .book-stall-page .sb-btn {
        position: relative;
        min-width: 180px;
        overflow: hidden;
        margin-top: 0;
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

    .book-stall-page .sb-btn::before {
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

    .book-stall-page .sb-btn:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow:
            0 19px 36px rgba(243, 120, 32, 0.38),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .book-stall-page .sb-btn:hover::before {
        left: 145%;
    }

    .book-stall-page .sb-btn:active {
        transform: translateY(-1px);
    }

    .contact_form_inp_2_checkbox {
        width: 100%;
        float: left;
        padding: 15px 0 0;
    }

    /* Responsive */

    @media (max-width: 991px) {
        .book-stall-page .reg-f {
            padding: 36px 28px;
        }
    }

    @media (max-width: 767px) {
        .book-stall-page .reg-f {
            margin: 22px 0 45px;
            padding: 30px 20px;
            border-radius: 20px;
        }

        .book-stall-page .reg-f .row > div {
            margin-bottom: 18px;
        }

        .book-stall-page .reg-f input {
            height: 52px;
        }

        .book-stall-page .reg-f textarea {
            min-height: 115px;
        }

        .book-stall-page .reg-f .mt-3 {
            margin-top: 20px !important;
        }

        .book-stall-page .sb-btn {
            width: 100%;
            min-width: 0;
            padding: 14px 25px;
        }
    }

    @media (max-width: 420px) {
        .book-stall-page .reg-f {
            padding: 27px 16px;
        }
    }
    
      /* Visitor form heading */

.book-stall-page .visitor-form-heading {
    position: relative;
    margin-bottom: 32px;
    padding-bottom: 17px;
    text-align: center;
}

.book-stall-page .visitor-form-heading p {
    margin: 0;
    color: #082f63;
    font-size: 26px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.3px;
}

.book-stall-page .visitor-form-heading::after {
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
    .book-stall-page .visitor-form-heading {
        margin-bottom: 27px;
    }

    .book-stall-page .visitor-form-heading p {
        font-size: 22px;
    }
}
</style>

    <section class="contact padding-top padding-bottom book-stall-page">
    <div class="head-menu-s">
            <h3 class="fr-head">Book My Stall</h3>
            <!--<p>-->
            <!--    <a href="{{ route('FrontIndex') }}">Home </a> / Book My Stall-->
            <!--</p>-->
        </div>
        <!--<h3 style="color:red;text-align: center;">Online Visitor Registration Is Closed. <br> Now Registered At Venue</h3>-->
        <div class="container">
            
            <div class="row justify-content-center mt-40">
                <div class="col-lg-6">
                    <div class="reg-f" style="border: 1px solid #f37820;background: #E6EDF5;">
                        <form action="{{ route('book_my_stall_store') }}" method="post" >
                            @csrf
                            <div class="visitor-form-heading">
        <p>Complete the Form to Reserve Your Stall</p>
    </div>
                            <div class="row mt-4">
                                <div class="col-lg-6">
                                <p class="form-txt">Name<span style="color:red ;">*</span></p>
                                    <input name="name" type="text" placeholder="Your Name*" value="{{ old('name') }}"
                                        required="" autocomplete="off" maxlength="25">
                                </div>
                                <div class="col-lg-6">
                                 <p class="form-txt">Company Name<span style="color:red ;">*</span></p>
                                    <input name="companyName" type="text" placeholder="Your Company Name*"
                                        value="{{ old('companyName') }}" required="" autocomplete="off" maxlength="50">
                                </div>
                                <div class="col-lg-6">
                                  <p class="form-txt">Phone<span style="color:red ;">*</span></p>
                                    <input name="mobile" type="text" maxlength="10" minlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        placeholder="Your Phone*" value="{{ old('mobile') }}" required="" autocomplete="off">
                                </div>
                                <div class="col-lg-6">
                                <p class="form-txt">Email<span style="color:red ;">*</span></p>
                                    <input name="email" type="email" placeholder="Your Email*" value="{{ old('email') }}"
                                        required="" autocomplete="off" maxlength="50">
                                </div>
                                <div class="col-lg-6">
                                <p class="form-txt">City<span style="color:red ;">*</span></p>
                                    <input name="city" type="text" placeholder="City*" value="{{ old('city') }}"
                                        required="" autocomplete="off" maxlength="50">
                                </div>
                                <div class="col-lg-6">
                                <p class="form-txt">Stall Size (sqm)<span style="color:red ;">*</span></p>
                                    <input name="stall_size" type="text" placeholder="Stall Size (sqm)*" value="{{ old('stall_size') }}"
                                        required="" autocomplete="off" maxlength="50">
                                </div>


                            </div>

                            <div class="col-lg-12">
                            <p class="form-txt">Messages<span style="color:red ;">*</span></p>
                                <textarea placeholder="Messages*" name="message" id="" cols="30" rows="3" required=""
                                    autocomplete="off" maxlength="250" class="w-100">{{ old('message') }}</textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit"  class="sb-btn">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            window.setTimeout(function() {
                $("#success-alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endsection
