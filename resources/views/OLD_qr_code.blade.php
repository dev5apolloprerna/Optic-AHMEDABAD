@extends('layouts.front')
@section('content')
    @php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp

    <style>
        table td {
            border: 1px solid #ff8a00;
            font-size 16px;
            color: black;
            padding-left: 8px;
        }

        .tq-head {
            padding: 15px 0px;
            color: orangered;
            background: orange;
            color: white;
            text-transform: uppercase;
            font-size: 30px;
            margin-bottom: 40px;
            text-align: center;
        }
    </style>

    <section class="section-pad">
        <h1 class="tq-head">Thank You For Spot Registration.</h1>
        <center>
            {{--  {{ $qrCode }}  --}}
            {{--  {{ dd($data['mobile']) }}  --}}
            {!! QrCode::size(200)->generate($data['mobile']) !!}

        </center>

    </section>
@endsection
