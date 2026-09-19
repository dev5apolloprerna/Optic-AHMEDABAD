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
            <h3 class="fr-head">EXHIBITOR'S PROFILE</h3>
            <!--<p style="color: #0d6efd;"><a href="{{ route('FrontIndex') }}">Home</a> / <a-->
            <!--        href="{{ route('FrontExhibitor_Profile') }}">Exhibitor's profile</a>-->
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
                            <img class="img-fluid" src="{{ asset('assets/front/optic/optic-new1.jpeg') }}" alt="">
                        </div>
                        <div class="box-head">
                            Optical Frame
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/sunglass2.jpeg') }}" alt="">
                        </div>
                        <div class="box-head">
                            Sunglasses
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/contact-lense2.jpg') }}"
                                alt="">
                        </div>
                        <div class="box-head">
                            Contact Lenses
                        </div>
                    </div>
                </div>


                

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/software.png') }}" alt="">
                        </div>
                        <div class="box-head">
                            Software
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/low2.jpg') }}" alt="">
                        </div>
                        <div class="box-head">
                            Low Vison
                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/spectacle-lense2.jpg') }}"
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
                                src="{{ asset('assets/front/optic/opticalinstruments.jpg') }}"
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
                            <img class="img-fluid" src="{{ asset('assets/front/optic/optical2.jpeg') }}" alt="">
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
                            <img class="img-fluid" src="{{ asset('assets/front/optic/store2.jpg') }}" alt="">
                        </div>
                        <div class="box-head">
                            Store designer
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-lg-3">
                    <div class="boxs">
                        <div class="box-img">
                            <img class="img-fluid" src="{{ asset('assets/front/optic/Spare_parts2.jpg') }}" alt="">
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
