@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="thank row">

            <div class="thank-img col-lg-5 align-items-center">
                <img
                    class="img-fluid"
                    src="{{ asset('assets/front/img/thankyouimg.png') }}"
                    alt="Thank You"
                >
            </div>

            <div class="thank-info col-lg-7 align-items-center pt-5">

                <h3 style="margin-bottom: 20px; padding-top: 5%;">
                    Your request has been received successfully.
                </h3>

                <h3>
                    Our team will share the latest floor plan and available stall options with you shortly.
                </h3>

            </div>

        </div>
    </div>
@endsection