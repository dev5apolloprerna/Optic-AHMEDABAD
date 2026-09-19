@extends('layouts.front')
@section('content')
    <style>
        .boxs {
            /* border: 1px solid #e5e5e5e5; */
            border-radius: 6px;
            padding: 20px;
            margin: 15px 0px;
            background: #6cdaff38;
            background: orange;
        }



        .box-img {
            height: 215px;
            /*width: 215px;*/
            overflow: hidden;

        }

        .box-img img {
            transition: all ease 1s;
            object-fit: cover;
            cursor: pointer;
            height: 100%;
            width: 100%;
            border: 5px solid var(--bs-white);
            border-radius: 6px;
        }


        .box-img:hover img {
            scale: 1.2;
        }


        .box-head {
            text-align: center;
            margin-top: 15px;
            color: black;
            font-size: 20px;
        }

        @media screen and (max-width: 1025px) {
            .box-img {
                height: 215px;
                width: 100%;
                overflow: hidden;

            }
        }

        @media screen and (max-width: 789px) {
            .box-img {
                height: 215px;
                width: 100%;
                overflow: hidden;

            }
        }

        @media screen and (max-width: 450px) {
            .box-img {
                height: 100%;
                width: 100%;
                overflow: hidden;

            }

        }
    </style>

    <section>
        <div class="head-menu-s">
            <h3 class="fr-head">VISITOR PROFILE</h3>
            <!--<p style="color: #0d6efd;">-->
            <!--    <a href="{{ route('FrontIndex') }}">Home</a> / <a href="{{ route('visitors_profile') }}">Vistor Profile</a>-->
            <!--</p>-->
        </div>
        <div class="container">

        </div>
    </section>

    <section class="mt-3 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/optic-frame.webp') }}" alt="">
                        </div>
                        <div class="box-head">
                            Optical Frame
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/leanse.webp') }}" alt="">
                        </div>
                        <div class="box-head">
                            Contact Lenses
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/one-size-ss22-hssg1075-haute-sauce-original-imagf8u8pgenkztn.webp') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Sunglasses
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/optic-frame.webp') }}" alt="">
                        </div>
                        <div class="box-head">
                            Software
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/0651377001547655778.jpg') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Low Vison
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/Transition-Lenses-2.png') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Spectacle Lens
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/de183cc5-043d-4d75-b916-d1afcf01b16c_900_900') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            optical instrumental
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/HartschalenBrillenetuiSunset07_600x.webp') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Optical Packing
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/how-to-take-care-of-your-glasses-8.jpg') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Cleaning Products
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/Category_Websize_Capitol_Hill_Vision_Shot_1_1000X562.jpg') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            fixture and fittings
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid"
                                src="{{ asset('assets/front/optic/f81fc03ca5707a12598fa828928cab53.jpg') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Store designer
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/Spare_parts.jpg') }}" alt="">
                        </div>
                        <div class="box-head">
                            Spare parts
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
