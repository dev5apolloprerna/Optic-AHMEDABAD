@extends('layouts.front')
@section('content')
    <style>
        table td {
            border: 1px solid #1b4e9b;
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
        @media screen and  (max-width: 768px) {
        .tq-wrap table{width:85%!important;}
        }
    </style>

    <section class="section-pad tq-wrap">
        <h1 class="tq-head">Thank You For Registration.</h1>
        <center class="mb-5">
            <table style="width:35%;">
                <tr>
                    <td style="text-align:center;padding:6px 0px;">
                        <img style="margin-bottom:10px;" width="200" src="{{ asset('assets/front/img/optic-2024.png') }}"
                            alt="">
                    </td>
                </tr>
                <tr>
                    <td
                        style="
                font-weight: 700;
                text-align: center;
                background: #1b4e9b;
                padding: 3px 5px;
                border-radius: 4px;
                color: white;
                text-transform: uppercase;
                font-size: 17px;">
                        Visitor Information 
                    </td>
                </tr>
            </table>
            <table style="width:35%;padding-top:10px;">
                <tr>
                    <td style="width:35%;">Name:</td>
                    <td style="width:65%;">{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">Company Name:</td>
                    <td style="width:65%;">{{ $data['companyName'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">E-mail:</td>
                    <td style="width:65%;">{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">Contact Number:</td>
                    <td style="width:65%;">{{ $data['mobile'] }}</td>
                </tr>

                <tr>
                    <td style="width:35%;">State:</td>
                    <td style="width:65%;">{{ $data['state'] }}</td>
                </tr>

                <tr>
                    <td style="width:35%;">City:</td>
                    <td style="width:65%;">{{ $data['city'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">Visit Date:</td>
                    <td style="width:65%;">{{ $data['visitDate'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">Intersted:</td>
                    <td style="width:65%;">{{ $data['interested'] }}</td>
                </tr>
                @if($qrFile)
                       <tr>
                    <td colspan="2" style="text-align:center;padding:20px;border:1px solid #1b4e9b;">
                        
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
        </center>

    </section>
@endsection
