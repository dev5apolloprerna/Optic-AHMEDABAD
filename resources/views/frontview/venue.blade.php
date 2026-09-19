@extends('layouts.front')
@section('content')
    <section class="mb-40">
        <div class="head-menu-s" style="background: #efefef !important;">
            <h3 class="fr-head">Venue</h3>
            <!--<p>-->
            <!--    <a href="{{ route('FrontIndex') }}">Home</a> /<a href="{{ route('FrontVenue') }}">Venue</a>-->
            <!--</p>-->
        </div>
        <div class="container">
            <div class="row mt-40">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="border-o" data-aos="fade-right">
                        <img src="{{ asset('assets/front/img/drone-image-2.jpeg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 onea-txt col-md-6 col-sm-12">
                    <div class="onea-txt" data-aos="fade-left">
                        <p class="venm-head">Location</p>
                        <p class="venm-head2">EKA CLUB Kankaria, Ahmedabad
                        </p>
                        <p class="venm-head">EXHIBITION DATE</p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 3rd October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 4th October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>
                        <p class="venm-head2"><i class="fas fa-angle-double-right"></i> 5th October 2026<span class="mx-3"><i
                                    class="fas fa-clock"></i> 10:30am - 6:00pm</span></p>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
