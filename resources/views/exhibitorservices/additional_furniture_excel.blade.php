<?php
ob_start();
$filename = 'AdditionalFurniture' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo 'No' . "\t" . 'Company Name' . "\t" . 'Furniture Name' . "\t" . 'Qty' . "\t" . 'Rate' . "\t" . 'Amount' . "\n";

$i = 1;
foreach ($Exhibitor as $row) {
    echo $i . "\t" . $row->strCompany . "\n";

    $AdditionalFurniture = App\Models\AdditionalFurniture::orderBy('iAdditionalFurnitureId', 'desc')
        ->where(['additionalfurniture.iStatus' => 1, 'additionalfurniture.isDelete' => 0, 'additionalfurniture.iCompayId' => $row->id])
        ->join('furnituremaster', 'additionalfurniture.iFurnitureId', '=', 'furnituremaster.iFurnitureId')
        ->get();
    $TotalAmount = 0;
    foreach ($AdditionalFurniture as $data) {
        $TotalAmount += $data->iAmount;
        echo '' . "\t" . '' . "\t" . $data->strFurnitureName . "\t" . $data->iQty . "\t" . trim($data->iRate, ' ') . "\t" . $data->iAmount . "\n";
    }
    echo '' . "\t" . '' . "\t" . 'Total Amount' . "\t" . '' . "\t" . '' . "\t" . $TotalAmount . "\n";
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
