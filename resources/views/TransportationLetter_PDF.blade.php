<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $dynamicdate = DB::table('dates')->where('id', 1)->first();
    ?>
    <table style="width: 100%;">
        <tr>
            <td><img src="https://opticexhibition.com/assets/images/tabkle1.png" style="width: 100%;" alt="">
                <br />
                <br />
            </td>
        </tr>

        <tr>
            <th
                style="text-align: center;text-decoration: underline; font-family:helvetica,arial,sans-serif;font-size:12px">
                <strong>TO WHOM SO EVER IT MAY CONCERN </strong>
                <br />
                <br />
            </th>
        </tr>

        <tr>
            <td style="font-size: 16px;">This is to certify and confirm that
                <strong>{{ $TransportationLetter->strCompany }}</strong> located
                at <strong>{{ $TransportationLetter->strCity }}</strong>. has participated in
                <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition
                being held at <strong>{{ $dynamicdate->letter_full_location }}</strong>
                from
                <strong>{{ $dynamicdate->letter_dates }}</strong>.
            </td>
        </tr>
        <tr>
            <td style="font-size: 16px;"><br />
                <br />
                <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition is only for Display and Not for Selling.
            </td>
        </tr>
        <tr>
            <td style="font-size: 16px;"><br />
                
                <br />Thank you.
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td><br />
                <br /><img style="width: 80px;" src="https://opticexhibition.com/assets/images/sign.png" alt="">
            </td>
        </tr>
        <tr>
            <td style="font-size: 16px;"><strong> Authorized Signatory</strong></td>
        </tr>
        <tr>
            <td style="font-size: 16px;"><strong> For ARIES EVENTS PVT. LTD.</strong></td>
        </tr>
    </table>
    <table style="width: 100%" style="position: absolute; bottom: 100px">
        <tr>
            <td>
                <br /><br />
                <img src="https://opticexhibition.com/assets/images/footer.png" style="width: 100%" alt="" />
            </td>
        </tr>
    </table>
</body>

</html>
