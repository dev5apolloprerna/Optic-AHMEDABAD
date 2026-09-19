<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            border-collapse: collapse;

        }

        table tr th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;

        }
    </style>
</head>

<body>

    <table>
        <div style="text-align: center;">
            <img style="text-align: center; height: 100px;" src="https://earthconexpo.com/assets/images/newlogo.png"
                alt="">
        </div>
        <tr>
            <th style="border: none;text-align: left;">{{ $Exhibitor->strCompany }}</th>
            <th style="border: none;text-align: right;">{{ $Exhibitor->strStallNo }}</th>
        </tr>
        <tr>
            <th style="border: none;text-align: left;">{{ $Exhibitor->strContactPerson }}</th>
            <th style="border: none;text-align: right;">{{ $Exhibitor->Mobile }}</th>
        </tr>

    </table>
    <div>
        <h3 style="text-align: center;">
            Additional Furniture Requirment
        </h3>
    </div>
    <table>
        <?php
        $ExhibitorBatch = App\Models\AdditionalFurniture::orderBy('iAdditionalFurnitureId', 'desc')
            ->where(['additionalfurniture.iStatus' => 1, 'additionalfurniture.isDelete' => 0, 'additionalfurniture.iCompayId' => $Exhibitor->id])
            ->join('furnituremaster', 'additionalfurniture.iFurnitureId', '=', 'furnituremaster.iFurnitureId')
            ->get();
        ?>
        <tr>
            <th>Furniture</th>
            <th>QTY</th>
            <th>Rate</th>
            <th>Amount</th>
        </tr>
        <tbody>
            <?php $TotalAmount = 0; ?>
            @foreach ($ExhibitorBatch as $data)
                <tr>
                    <td>{{ $data->strFurnitureName }}</td>
                    <td>{{ $data->iQty }}</td>
                    <td>{{ $data->iRate }}</td>
                    <td>{{ $data->iAmount }}</td>
                </tr>
            @endforeach
        </tbody>
        <?php
        $TotalAmount += $data->iAmount;
        ?>
        <tr>
            <th colspan="3">Total Amount</th>
            <th>{{ $TotalAmount }}</th>
        </tr>
    </table>
</body>

</html>
