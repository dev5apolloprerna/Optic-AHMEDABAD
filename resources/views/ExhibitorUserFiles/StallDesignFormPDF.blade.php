
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Registration PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            font-family: 'DejaVu Sans', sans-serif;
        }

        .normal {
            font-size: 14px;
            margin-bottom: 0;
        }

        .page-break {
            page-break-before: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .bordered-table td,
        .bordered-table th {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .text-danger {
            color: red;
        }

        .text-success {
            color: green;
        }

        .text-info {
            color: #0dcaf0;
        }

        .text-primary {
            color: #0d6efd;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .container-box {
            border: 2px solid #000;
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 0; /* add this line */
        }
    </style>
</head>

<body>
    <!-- First Page -->
    <table>
        <tr>
            <td style="width: 50%; padding-left: 10px;" class="bold">OPTIC EXPO <?php echo date('Y') ?>
            </td>
            <td style="width: 50%; text-align: right; padding-right: 30px;" class="bold">DATE :- {{ config('app.front_header_date') }} </td>
        </tr>
    </table>

    <table style="border: 1px solid black; margin-top: 10px;" cellpadding="5">
        <tr>
            <td colspan="2" class="center bold" style="background-color: #AFB0B2; border-bottom: 2px solid black;">
                VENDOR REGISTRATION FORM
            </td>
        </tr>
        <tr>
            <th colspan="2" style="text-align: left;">To,</th>
        </tr>
        <tr>
            <td colspan="2"><strong>Aries Events Pvt. Ltd. (Ahmedabad)</strong></td>
        </tr>
        <tr>
            <td colspan="2">Ph:079-40193925. Email: dirapm.aakar@gmail.com</td>
        </tr>
        <tr>
            <td colspan="2" class="center text-danger bold" style="font-size: 14px;">
                Approval of stall design compulsory. Send in 3D Format with Dimension.
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 2px solid black;"></td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;"><strong>Vendor Company Name's:</strong></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;">Main Person:</td>
            <td style="border-bottom: 1px solid black;">Supervisor:</td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid black;">Address:</td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%;">
                    <tr>
                        <td style="border-bottom: 1px solid black; width: 50%">City:</td>
                        <td style="border-bottom: 1px solid black;">State:</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">Telephone (with code):</td>
                        <td style="border-bottom: 1px solid black;">Mobile(1):</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">Email:</td>
                        <td style="border-bottom: 1px solid black;">Mobile(2):</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%;">
                    <tr>
                        <td class="bold" style="border-bottom: 1px solid black;">Participant Company:</td>
                        <td style="border-bottom: 1px solid black;"></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;  width: 50%">Person Name:</td>
                        <td style="border-bottom: 1px solid black;">Mobile:</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">Size:</td>
                        <td style="border-bottom: 1px solid black;">Design Cost:</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%;">
                    <tr>
                        <td style="border-bottom: 1px solid black;  width: 50%">Labour Name:(1)</td>
                        <td style="border-bottom: 1px solid black;">(2)</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">(3)</td>
                        <td style="border-bottom: 1px solid black;">(4)</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">(5)</td>
                        <td style="border-bottom: 1px solid black;">(6)</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

            <td class="bold" style="padding-top:50px !important">Vendor Signature with seal</td>
            <td class="bold" style="text-align: right;padding-top:50px !important">Participant Signature with seal</td>
        </tr>
        <tr>
            <td>(I hereby agree to all the<br>terms & conditions as mentioned below)</td>
            <td style="text-align: right;">(I hereby agree to all the<br>terms & conditions as mentioned below)</td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Terms & Conditions:</strong>
                <ol>
                    <li>Vendor will use all standard ISI-marked electrical wires and other accessories.</li>
                    <li>Vendor will use all safety measures for their labour working at their stall.</li>
                    <li>If any accident occurs while working on their stalls, vendor will be responsible.</li>
                </ol>
                <p>Fill Vendor Registration Form and Submit in Dashboard with Sign & Stamp.</p>
                <p class="text-danger bold center" style="font-size:14px; ">No work will be allowed beyond 10:00 pm on
                    2<sup>nd</sup> October 2026. </br>
                    Inform Registration counter if your Design/Fabrication work is over by 10:00 PM
                </p>
                
            </td>
        </tr>
    </table>

    <table style="border: 1px solid black; margin-top: 10px;" cellpadding="5">
        <tr>
            <td colspan="3" style="text-align: center;">
                <p class="text-danger bold" style="font-size: 14px;">
                    We have completed work on time by 10:00 PM on 2<sup>nd</sup> October 2026
                </p>
            </td>
        </tr>
        <tr>
            <td class="bold" style="text-align: left; padding-top: 30px;">Vendor Signature</td>
            <td></td>
            <td class="bold" style="text-align: right; padding-top: 30px;">Organizer Signature</td>
        </tr>
    </table>


    <!-- Page Break for second section -->
    <div class="page-break"></div>

    <!-- Second Page Content -->
<div class="container-box bg-light" style="page-break-inside: avoid; padding-bottom: 10px;">
    <p style="font-size:12px;"><strong>Payment of Rs. ₹5000 / ₹7000 /  ₹10000 as deposit. Rs. ______ + 18% GST as charges for
            stall designing.</strong></p>

    <h4 class="text-success">Charges for Designer Stalls</h4>
    <table class="bordered-table" style="margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Stall Size</th>
                <th>Charges (INR)</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Up to 20 sqm</td><td>5000/-</td></tr>
            <tr><td>21 to 30 sqm</td><td>7000/-</td></tr>
            <tr><td>31 sqm to above</td><td>10000/-</td></tr>
            <!--<tr><td>51 to 64 sqm</td><td>11000/-</td></tr>
            <tr><td>65 sqm & above</td><td>15000/-</td></tr>-->
        </tbody>
    </table>
    <p style="margin-bottom: 10px;">*GST as applicable</p>

    <h4 class="text-primary">Stall Setup Duration</h4>
    <p><strong>Octonorm Stall Possession:</strong> 2<sup>nd</sup> October 2026 @ 11:00 am</p>
    <p><strong>Designer Stall Possession:</strong> 1<sup>st</sup> October 2026 @ 11:00 am</p>
    <p>Stall setup allowed only till <strong>2<sup>nd</sup> October 2026 @ 10:00 pm</strong></p>
    <p><strong>Designer Stall Height:</strong> Maximum 14’ ft</p>
    <p class="text-danger bold" style="font-size:14px">No work will be allowed beyond 10:00 pm on 2<sup>nd</sup> October 2026</p>

    <h4 class="text-info">Stall Design Deposit Policy</h4>
    <ul style="margin-bottom: 10px;">
        <li>Up to 20 sqm : ₹5,000</li>
        <li>21 to 30 sqm : ₹7,000</li>
        <li>31 sqm to above: ₹10,000</li>
        <li>Deposit to be paid by Stall Design Vendor</li>
        <li>Refund after 1 week of exhibition: 12<sup>th</sup> October 2026</li>
        <!--<li style="font-size:14px" class="text-danger">If stall work is not over by 10:00 pm on 12<sup>th</sup> November 2025, deposit won’t be refunded</li>-->
        <li style="font-size:14px" class="text-danger">If stall work is not over by 10:00 pm on 2<sup>nd</sup> October 2026, = <span class="bold" style="font-width:900;"> NO REFUND </span> </li>
        <li style="font-size:14px" class="text-danger">Any damages to venue property = <span class="bold" style="font-width:900;"> NO REFUND </span></li>
    </ul>

    <table style="width: 100%;">
        <tbody>
            <tr>
                <td class="bold" style="padding-top:30px;">Vendor Signature with seal</td>
                <td class="bold" style="text-align: right;padding-top:30px;">Participant Signature with seal</td>
            </tr>
            <tr>
                <td>(I hereby agree to all the<br>terms & conditions as mentioned below)</td>
                <td style="text-align: right;">(I hereby agree to all the<br>terms & conditions as mentioned below)</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 15px;">Fill Vendor Registration Form and Submit in Dashboard with Sign & Stamp.</p>
    
    <p class="text-danger bold center" style="font-size:17px; margin-top: 10px;font-width:600;">
        No work will be allowed beyond 10:00 pm on 2<sup>nd</sup> October 2026.<br>
        If stall work is not over by 10:00 pm, deposit won’t be refunded.
    </p>
</div>

</body>

</html>
