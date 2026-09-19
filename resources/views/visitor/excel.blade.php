<?php
ob_start();
$filename = 'Visitor_' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo 'No' . "\t" . 'Visit Id' . "\t" . 'Name' . "\t" . 'Company' . "\t" . 'Email' . "\t" . 'Mobile' . "\t" . 'City' . "\t" . 'Visit Date' . "\t" . 'Interested' . "\n";

$i = 1;
foreach ($Visiter as $row) {
    echo $i . "\t" . $row->earthconId . "\t" . $row->name . "\t" . $row->companyName . "\t" . $row->email . "\t" . $row->mobile . "\t" . $row->city . "\t" . $row->visitDate . "\t" . $row->interested . "\n";
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
