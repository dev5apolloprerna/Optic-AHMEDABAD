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
    $Date = date('d-m-Y');
    $dynamicdate = DB::table('dates')->where('id', 1)->first();
    ?>
    <table style="width: 100%">
        <tr>
            <td><img src="https://opticexhibition.com/assets/images/tabkle1.png" style="width: 100%;" alt="">
            </td>
        </tr>
        <table style="text-align: start !important;">
            <tr>
                <th style="text-align: start">Date : {{ $Date }} </th>
            </tr>
            <tr>
                <th style="text-align: start">Shri. {{ $ParticipationLetter->strContactPerson }}</th>
            </tr>
            <tr>
                <th style="text-align: start"><strong>{{ $ParticipationLetter->strCompany }}</strong></th>
            </tr>
            <tr>
                <td style="text-align: start !important;">{{ $ParticipationLetter->strCity }} </td>
            </tr>
        </table>


        <tr>
            <td style="text-align: center; text-decoration: underline">
                <strong>SUB : PARTICIPATION AT OPTIC <?php echo date('Y') ?></strong>
            </td>
        </tr>

        <tr>
            <td style="text-align: start">Dear Participant,</td>
        </tr>
        <br />

        <tr>
            <td style="text-align: start">
                This is reference to your booking form received by us duly signed and
                authorized by you on behalf of your company regarding participation at
                <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition being held at {{ $dynamicdate->letter_location }}
                from <strong> {{ $dynamicdate->letter_dates }} <strong> .
            </td>
        </tr>
        <br />

        <tr>
            <td style="text-align: start">
                We are happy to inform that we are receiving great response in terms
                of visiting registration and are awaiting huge pool of targeted
                visitors at Expo.
            </td>
        </tr>
        <tr>
            <td style="text-align: start">
                We are writing to you in regards to all requirement you need at the
                Expo, please find below helpline and details of Expo.
                <strong> OPTIC HELP LINE :- +91 63563 50100 </strong>
            </td>
        </tr>
        <br />

        <tr>
            <td style="text-align: start">
                You will also get information on our Vendors from our website, you can
                also download Transport Letter, Stall Possession Letter / No Due
                Letter from our website. Rates for Extra furniture are also placed on
                our website.
            </td>
        </tr>
        <br />

        <tr>
            <td style="text-align: start">
                <strong>
                    We hereby confirm your participation details of which are as under;
                </strong>
            </td>
        </tr>
        <tr>
            <td style="text-align: start">
                <table style="width: 100%">
                    <tr>
                        <td>Stall No</td>
                        <td>{{ $ParticipationLetter->strStallNo }}</td>
                    </tr>
                    <tr>
                        <td>Size (dimension)</td>
                        <td>{{ $ParticipationLetter->strStallSize }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">
                It is understood as per Booking Contract form Signed by you that all
                stall & payment details are mutually finalized by you and our team
                member.
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">
                As per agreed and as per our system our account department will follow
                up for your remaining payment as per schedule mutually decided and our
                Back office will also follow up with you from time to time for
                Catalogue Entry / Facia / will also inform about Vendors / Official
                Agency for <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition.<br />
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">
                <strong>Applicable TDS is 2% under section 194C</strong><br />
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">
                Please contact our Support Staff on 6356350100 in case you would like
                to have any requirements in regards to
                <strong>OPTIC EXPO <?php echo date('Y') ?></strong> Exhibition.
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">
                Happy Participation, Looking ahead to see you at Exhibition.
            </td>
        </tr>
        <br />
        <tr>
            <td style="text-align: start">Thanking You</td>
        </tr>
        <tr>
            <td style="text-align: start"><strong>OPTIC EXPO Team.</strong></td>
        </tr>
    </table>

    <table style="width: 100%" style="position: absolute; bottom: 100px">
        <tr>
            <td>
                <br /><br /><br />
                <img src="https://opticexhibition.com/assets/images/footer.png" style="width: 100%" alt="" />
            </td>
        </tr>
    </table>
</body>

</html>
