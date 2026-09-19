@extends('layouts.app')
@section('title', 'Thank You')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <style>
                table td {
                    border: 1px solid #4a2d02;
                    font-size 16px;
                    color: black;
                    padding-left: 8px;
                }

                .tq-head {
                    padding: 15px 0px;
                    color: orangered;
                    background: #1b4e9b;
                    color: white;
                    text-transform: uppercase;
                    font-size: 30px;
                    margin-bottom: 40px;
                    text-align: center;
                }
            </style>

            {{-- Alert Messages --}}
            @include('common.alert')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body table-responsive">
                            <section class="section-pad">
                                <h1 class="tq-head text-center">Thank You For Registration.</h1>
                                <center>
                                    <table style="width:45%;">
                                        <tr>
                                            <td style="text-align:center;padding:6px 0px;">
                                                <img style="margin-bottom:10px;" width="200"
                                                    src="{{ asset('assets/front/img/optic-2024.png') }}" alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="
                                                font-weight: 700;
                                                text-align: center;
                                                background: #1b4e9b;
                                                padding: 3px 5px;
                                                border-radius: 4px;
                                                color: white;
                                                text-transform: uppercase;
                                                font-size: 17px;">
                                                visitor Registration
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="width:45%;padding-top:10px;">
                                        <tr>
                                            <td style="width:30%;">Name:</td>
                                            <td style="width:70%;">{{ $data['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Company Name:</td>
                                            <td style="width:70%;">{{ $data['companyName'] }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Email:</td>
                                            <td style="width:70%;">{{ $data['email'] }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Mobile:</td>
                                            <td style="width:70%;">{{ $data['mobile'] }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width:30%;">State:</td>
                                            <td style="width:70%;">{{ $data['state'] }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width:30%;">City:</td>
                                            <td style="width:70%;">{{ $data['city'] }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Visit Date:</td>
                                            <td style="width:70%;">{{ $data['visitDate'] }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">Intersted:</td>
                                            <td style="width:70%;">{{ $data['interested'] }}</td>
                                        </tr>
                                        @if($qrFile)
                       <tr>
                    <td colspan="2" style="text-align:center;padding:20px;border:1px solid #ff8a00;">
                        
                            <div style="font-size:16px;font-weight:bold;margin-bottom:15px;">
                            Scan this QR Code at Registration Counter
                        </div>
                        
                            <img src="{{ url('qrcodes/'.$qrFile) }}" width="220">
                        
                            <br><br>
                        
                            <a href="{{ url('qrcodes/'.$qrFile) }}"
                               download
                               style="display:inline-block;background:#1b4e9b;color:#fff;padding:10px 18px;text-decoration:none;border-radius:5px;">
                                Download QR Code
                            </a>
                        
                         </td>
                    </tr>
                    @endif
                                    </table>
                                    
                                    <p style="text-align: center; margin-top: 20px;">
                                        <a style="background: #ff8a00;border: none;" href="{{ route('employees_module.create') }}" class="btn btn-primary">
                                            Return to Visitor Registration
                                        </a>
                                    </p>
                                </center>

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection