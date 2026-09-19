<?php
ob_start();
$filename = 'StallDesign' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo 'No' . "\t" . 'Company Name' . "\t" . 'Vendor Company Name' . "\t" . 'Vendor Contact Person' . "\t" . 'Vendor Address' . "\t" . 'Vendor City' . "\t" . 'Vendor State' . "\t" . 'Vendor Country' . "\t" . 'Vendor Names' . "\n";

$i = 1;
foreach ($Exhibitor as $row) {
    echo $i . "\t" . $row->strCompany . "\n";

    $StallDesign = App\Models\StallDesign::orderBy('iExhibitStallDesginId', 'desc')
        ->where(['iStatus' => 1, 'isDelete' => 0, 'iCompanyId' => $row->id])
        ->get();

    foreach ($StallDesign as $data) {
        echo '' . "\t" . '' . "\t" . $data->strVendorCompanyName . "\t" . $data->strVendorContactPersonName . "\t" . trim($data->strVendorAddress, ' ') . "\t" . $data->strVendorCity . "\t" . $data->strVendorState . "\t" . $data->strVendorCountry . "\t" . $data->strVendorName . "\n";
    }
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
