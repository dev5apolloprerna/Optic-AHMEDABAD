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
        
        .thank-you-message {
    width: min(700px, calc(100% - 30px));
    margin: -15px auto 35px;
    padding: 18px 24px;
    border-left: 5px solid #f37820;
    border-radius: 10px;
    background: #f4f8fd;
    box-shadow: 0 8px 22px rgba(27, 78, 155, 0.1);
    text-align: center;
}

.thank-you-message p {
    margin: 0;
    color: #203854;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.7;
}

@media (max-width: 767px) {
    .thank-you-message {
        margin-top: -20px;
        margin-bottom: 28px;
        padding: 15px 18px;
    }

    .thank-you-message p {
        font-size: 14px;
    }
}
    </style>

    <section class="section-pad">
        <h1 class="tq-head">Thank You For Registration.</h1>
        <div class="thank-you-message">
            <p>
                Your stall enquiry has been received successfully.<br>
                Our exhibition team will contact you shortly with stall availability,
                floor plan, pricing, and booking assistance.
            </p>
        </div>
        <center class="mb-5">
            <table style="width:30%;">
                <tr>
                    <td style="text-align:center;"><img style="margin-bottom:10px;" width="200"
                            src="https://opticexhibition.com/assets/front/img/optic-2024.png" alt=""></td>
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
                        Book My Stall
                    </td>
                </tr>
            </table>
            <table style="width:30%;padding-top:10px;">
                <tr>
                    <td style="width:30%;">Name:</td>
                    <td style="width:70%;">{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <td style="width:35%;">Company Name:</td>
                    <td style="width:70%;">{{ $data['companyName'] }}</td>
                </tr>
                <tr>
                    <td style="width:30%;">Email:</td>
                    <td style="width:70%;">{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td style="width:30%;">Mobile Number</td>
                    <td style="width:70%;">{{ $data['mobile'] }}</td>
                </tr>
                <tr>
                    <td style="width:30%;">City</td>
                    <td style="width:70%;">{{ $data['city'] }}</td>
                </tr>
                <tr>
                    <td style="width:30%;">Stall Size (sqm)</td>
                    <td style="width:70%;">{{ $data['stall_size'] }}</td>
                </tr>
                <tr>
                    <td style="width:30%;">Message</td>
                    <td style="width:70%;">{{ $data['message'] }}</td>
                </tr>
            </table>
        </center>

    </section>
@endsection
