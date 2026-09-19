@extends('layouts.front')
@section('content')
    <style>
        /*.reg-f {*/
        /*    background: #fff;*/
        /*    padding: 20px;*/
        /*    margin: 20px 0px;*/
        /*    border: 1px solid #f37820;*/
        /*    background: #E6EDF5;*/
        /*}*/

        /*.contact_form_inp_2_checkbox {*/
        /*    width: 100%;*/
        /*    float: left;*/
        /*    padding: 15px 0 0 0;*/
        /*}*/
    </style>
    
    <style>
        /* ==========================================
           EXHIBITOR LOGIN FORM DESIGN
        ========================================== */

        .reg-f {
            position: relative;
            overflow: hidden;
            margin: 35px 0;
            padding: 0;
            border: 1px solid rgba(7, 42, 86, 0.10);
            border-radius: 26px;
            background: #ffffff;
            box-shadow:
                0 30px 70px rgba(7, 42, 86, 0.14),
                0 8px 24px rgba(7, 42, 86, 0.07);
        }

        .reg-f::before {
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

        .reg-f::after {
            content: "";
            position: absolute;
            right: -75px;
            bottom: -85px;
            width: 190px;
            height: 190px;
            border: 35px solid rgba(243, 120, 32, 0.055);
            border-radius: 50%;
            pointer-events: none;
        }

        .reg-f form {
            position: relative;
            z-index: 1;
        }

        .reg-f .main {
            width: 100%;
        }

        .reg-f .contact_left {
            position: relative;
            width: 100%;
            padding: 44px 42px 40px;
            background:
                radial-gradient(
                    circle at 100% 0%,
                    rgba(243, 120, 32, 0.10),
                    transparent 34%
                ),
                linear-gradient(
                    145deg,
                    #ffffff 0%,
                    #f8fbff 58%,
                    #fff9f5 100%
                );
        }

        .reg-f .login-heading {
    position: relative;
    margin-bottom: 32px;
    padding-bottom: 17px;
    text-align: center;
}

.reg-f .login-heading h2 {
    margin: 0 0 7px;
    padding: 0;
    color: #082f63;
    font-size: 28px;
    font-weight: 800;
    line-height: 1.3;
    letter-spacing: -0.4px;
}

.reg-f .login-heading p {
    margin: 0;
    color: #78899c;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.5;
    letter-spacing: 0.15px;
}

.reg-f .login-heading::after {
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

        .reg-f .contact_form_full {
            width: 100%;
            margin-bottom: 22px;
        }

        .reg-f .contact_form_inp_2 {
            position: relative;
            width: 100%;
        }

        .reg-f .contact_form_inp_2 label {
            display: block;
            margin: 0 0 9px;
            color: #163b67;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;
        }

        .reg-f .contact_form_inp_2 label span {
            display: inline-block;
            margin-left: 3px;
            color: #f37820;
        }

        .reg-f .contact_form_inp_2 input {
            width: 100%;
            height: 55px;
            padding: 0 17px;
            border: 1px solid #d7e1ec;
            border-radius: 12px;
            outline: none;
            background: #f7fafd;
            color: #102f54;
            font-size: 15px;
            font-weight: 500;
            box-shadow:
                inset 0 1px 2px rgba(7, 42, 86, 0.025),
                0 5px 15px rgba(7, 42, 86, 0.035);
            transition:
                border-color 0.25s ease,
                background-color 0.25s ease,
                box-shadow 0.25s ease,
                transform 0.25s ease;
        }

        .reg-f .contact_form_inp_2 input::placeholder {
            color: #8c9aaa;
            font-weight: 400;
            opacity: 1;
        }

        .reg-f .contact_form_inp_2 input:hover {
            border-color: #b7c8da;
            background: #ffffff;
        }

        .reg-f .contact_form_inp_2 input:focus {
            border-color: #f37820;
            background: #ffffff;
            box-shadow:
                0 0 0 4px rgba(243, 120, 32, 0.11),
                0 10px 22px rgba(7, 42, 86, 0.08);
            transform: translateY(-1px);
        }

        .reg-f .contact_form_full:last-child {
            margin-top: 7px;
            margin-bottom: 0;
            text-align: center;
        }

        .reg-f .rn-btn {
            display: inline-block;
            text-decoration: none;
        }

        .reg-f .rn-btn button {
            position: relative;
            min-width: 175px;
            overflow: hidden;
            padding: 14px 48px;
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

        .reg-f .rn-btn button::before {
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

        .reg-f .rn-btn button:hover {
            transform: translateY(-3px);
            box-shadow:
                0 18px 35px rgba(243, 120, 32, 0.38),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        .reg-f .rn-btn button:hover::before {
            left: 145%;
        }

        .reg-f .rn-btn button:active {
            transform: translateY(-1px);
        }

        .contact_form_inp_2_checkbox {
            width: 100%;
            float: left;
            padding: 15px 0 0;
        }

        @media (max-width: 767px) {
            .reg-f {
                margin: 25px 0;
                border-radius: 20px;
            }

            .reg-f .contact_left {
                padding: 34px 22px 30px;
            }

            .reg-f .contact_left h2 {
                margin-bottom: 27px;
                font-size: 24px;
            }

            .reg-f .contact_form_full {
                margin-bottom: 19px;
            }

            .reg-f .contact_form_inp_2 input {
                height: 52px;
            }

            .reg-f .rn-btn {
                width: 100%;
            }

            .reg-f .rn-btn button {
                width: 100%;
                min-width: 0;
                padding: 14px 25px;
            }
            
            .reg-f .login-heading {
        margin-bottom: 27px;
    }

    .reg-f .login-heading h2 {
        font-size: 24px;
    }

    .reg-f .login-heading p {
        font-size: 13px;
    }
        }
    </style>

    <section>
        <div class="head-menu-s">
            <h3 class="fr-head">Exhibitor Login</h3>

            <!--<p>-->
            <!--    <a href="{{ route('FrontIndex') }}">Home</a> /-->
            <!--    <a href="{{ route('FrontExhibitor_Login') }}">Exhibitor Login</a>-->
            <!--</p>-->
        </div>

        <div class="container">
            <div class="row justify-content-center mt-40">
                <div class="col-lg-6">

                    @if (session('error'))
                        <span class="text-danger d-flex justify-content-center">
                            {{ session('error') }}
                        </span>
                    @endif

                    <div class="reg-f" data-aos="zoom-in">
                        <form action="{{ route('exhibitorloginsubmit') }}" method="post">
                            @csrf

                            <div class="main">
                                <div class="contact_left f_floor_form">
                                    <div class="login-heading">
    <h2>Exhibitor Login</h2>
    <p>Access Your Dashboard.</p>
</div>

                                    <div class="contact_form_full">
                                        <div class="contact_form_inp_2">
                                            <label>
                                                Mobile <span>*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="Mobile"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                minlength="10"
                                                maxlength="10"
                                                value="{{ old('Mobile') }}"
                                                autocomplete="off"
                                                placeholder="Mobile Number"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <div class="contact_form_full">
                                        <div class="contact_form_inp_2">
                                            <label>
                                                Password <span>*</span>
                                            </label>

                                            <input
                                                type="password"
                                                required=""
                                                name="strPassword"
                                                placeholder="Password"
                                            >
                                        </div>
                                    </div>

                                    <div class="contact_form_full">
                                        <a href="#" class="rn-btn">
                                            <button type="submit" name="btnsubmit">
                                                Submit
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--<section>-->
    <!--    <div class="head-menu-s">-->
    <!--        <h3 class="fr-head">Exhibitor Login</h3>-->
    <!--        <p><a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontExhibitor_Login') }}">Exhibitor Login</a>-->
    <!--        </p>-->
    <!--    </div>-->
    <!--    {{--  <div style="display: none; z-index: 10060;" id="loading">-->
    <!--        <img id="loading-image" src="<?php echo $web_url; ?>images/loader.gif">-->
    <!--    </div>  --}}-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center mt-40">-->
    <!--            <div class="col-lg-6">-->
    <!--                @if (session('error'))-->
    <!--                    <span class="text-danger d-flex justify-content-center"> {{ session('error') }}</span>-->
    <!--                @endif-->
    <!--                <div class="reg-f" data-aos="zoom-in">-->
    <!--                    <form action="{{ route('exhibitorloginsubmit') }}" method="post">-->
    <!--                        @csrf-->
    <!--                        <div class="main">-->
    <!--                            <div class="contact_left f_floor_form">-->
    <!--                                <h2>Exhibitor Login</h2>-->
    <!--                                <div class="contact_form_full">-->
    <!--                                    <div class="contact_form_inp_2">-->
    <!--                                        <label>Mobile <span>*</span></label>-->
    <!--                                        <input type="text" name="Mobile"-->
    <!--                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"-->
    <!--                                            minlength="10" maxlength="10" value="{{ old('Mobile') }}" autocomplete="off"-->
    <!--                                            placeholder="Mobile Number" required>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="contact_form_full">-->
    <!--                                    <div class="contact_form_inp_2">-->
    <!--                                        <label>Password <span>*</span></label>-->

    <!--                                        <input type="password" required="" name="strPassword" placeholder="Password">-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                                <div class="contact_form_full">-->
    <!--                                    <a href="#" class="rn-btn"><button type="submit"-->
    <!--                                            name="btnsubmit">Submit</button></a>-->
    <!--                                </div>-->
    <!--                            </div>-->

    <!--                        </div>-->
    <!--                    </form>-->

    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
@endsection
