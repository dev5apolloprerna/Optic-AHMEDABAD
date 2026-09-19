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
    $ExhibitorBatch = App\Models\StallDesign::orderBy('iExhibitStallDesginId', 'desc')
        ->where(['iStatus' => 1, 'isDelete' => 0, 'iCompanyId' => $Exhibitor->id])
        ->first();
    //dd($ExhibitorBatch);
    $strVendorName = explode(',', $ExhibitorBatch->strVendorName);
    
    $html = '';
    for ($i = 0; $i < count($strVendorName); $i++) {
        $html .= '<tr><td style="border-bottom: 1px solid black;">';
        if ($i == 0) {
            $html .= 'Name:(' . $i + 1 . ')';
        } else {
            $html .= '(' . $i + 1 . ')';
        }
        $html .= $strVendorName[$i] . '</td></tr>';
    }
    
    ?>

    <table cellspacing="0" cellpadding="5" style="width: 100%; height: 25%; padding: 15px;border: 1px solid black;">
        <tr>
            <td style="border-bottom: 2px solid black;text-align: center;font-size: 35px;background-color: #AFB0B2;">
                <strong>VENDOR REGISTRAION FORM</strong>
            </td>
        </tr>

        <tr>
            <th style="text-align: start !important;"><strong>To,</strong></th>
        </tr>
        <tr>
            <td><strong>Aries Events Pvt. Ltd.</strong></td>
        </tr>
        <tr>
            <td style="font-size: 15px;">A,812-813, Dev Arnum Anandnagar Cross Road</td>
        </tr>
        <tr>
            <td>Prahlad Nagar Road,Ahmedbad-380015</td>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid black;">Ph:079-40193925. Email: dirapm.aakar@gmail.com</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;"><strong>Vendor Company Name : </strong>
                {{ $ExhibitorBatch->strVendorCompanyName }} </td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid black;"><strong>Contact Person:Mr. /Ms. : </strong>
                {{ $ExhibitorBatch->strVendorContactPersonName }} </td>
        </tr>
        <tr>
            <td><strong>Address For Vendors : </strong> {{ $ExhibitorBatch->strVendorAddress }} </td>
        </tr>
        <table cellpadding="4" style="width: 100%;border: 1px solid black;">
            <tr>
                <td style="border-bottom: 1px solid black;">City: {{ $ExhibitorBatch->strVendorCity }}</td>
                <td style="border-bottom: 1px solid black;">State: {{ $ExhibitorBatch->strVendorState }}</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid black;">Telephone: {{ $ExhibitorBatch->iVendorTelephone }}</td>
                <td style="border-bottom: 1px solid black;">Mobile: {{ $ExhibitorBatch->iVendorMobile }}</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid black;">Email:{{ $ExhibitorBatch->strVendorEmail }} </td>
                <td style="border-bottom: 1px solid black;">Website:{{ $ExhibitorBatch->strVendorWebsite }} </td>
            </tr>
        </table>
        <table cellpadding="4" style="width: 100%;border: 1px solid black;">
            <tr>
                <td style="border-bottom: 1px solid black">Designer Company Stall Name: {{ $Exhibitor->strCompany }}
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid black">Size Of Stall: {{ $Exhibitor->strStallNo }} </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid black">Size No: {{ $Exhibitor->strStallSize }} </td>
            </tr>
        </table>
        <table cellpadding="4" style="width: 100%;border: 1px solid black;">
            {!! $html !!}
        </table>

    </table>

</body>

</html>
