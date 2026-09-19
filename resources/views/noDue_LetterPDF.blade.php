<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <?php
    $date = date('d-m-Y');
    $dynamicdate = DB::table('dates')->where('id', 1)->first();
    ?>
    <table style="width: 100%">
        <tr>
            <th style="text-align: start">Date : {{ $date }} <br /><br /></th>
        </tr>
        <tr>
            <th style="text-align: start">Shri. {{ $Data->strContactPerson }}</th>
        </tr>
        <tr>
            <th style="text-align: start"><strong>{{ $Data->strCompany }}</strong></th>
        </tr>
        <tr>
            <td style="text-align: start">{{ $Data->strCity }} <br /><br /></td>
        </tr>
        <tr>
            <td style="text-align: center;text-decoration: underline;">
                <strong>SUB : STALL POSESSION CUM NO DUE LETTER FOR OPTIC EXPO <?php echo date('Y') ?></strong><br />
            </td>
        </tr>
        <tr>
            <td style="text-align: start">Dear Participant,<br /><br /></td>
        </tr>
        <tr>
            <td style="text-align: start">We hereby confirm receiving your 100% payment against your stall at
                OPTIC EXPO <?php echo date('Y') ?> Exhibition being held at {{ $dynamicdate->letter_location }} from
                {{ $dynamicdate->letter_dates }}, details of your
                payments
                are as under.<br />
            </td>
        </tr>
        <tr>
            <td style="text-align: start"><strong>Applicable TDS is 2% under section 194C</strong><br /></td>
        </tr>
        <tr>
            <td style="text-align: start">We will allot you stall 1 day prior at 12.00 noon, you will be allowed
                to work till 11 pm on {{ $dynamicdate->no_due_letter_date }}. We will in no case allow any
                stall design work beyond 11 pm on {{ $dynamicdate->no_due_letter_date }}.<br />
            </td>
        </tr>

        <tr>
            <td style="text-align: start"><strong>STALL POSSESSION TIME – 12.00 noon
                    {{ $dynamicdate->no_due_letter_date }}</strong><br />
            </td>
        </tr>
        <tr>
            <td style="text-align: start">Kindly send us details of your Facia (name to be displayed on stall) / Name
                for Participants Badges, different form for which are made available on our website.<br />
            </td>
        </tr>
        <tr>
            <td style="text-align: start">Please contact our Support Staff on 079 40193925 in case you would like to
                have any requirements in regards to
                <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition.<br />
            </td>
        </tr>
        <tr>
            <td style="text-align: start">Happy Participation, Looking ahead to see you at Exhibition.<br /></td>
        </tr>
        <tr>
            <td style="text-align: start">Thanking You<br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td style="text-align: start"><strong>OPTIC EXPO Team.</strong></td>
        </tr>
    </table>
</body>

</html>
