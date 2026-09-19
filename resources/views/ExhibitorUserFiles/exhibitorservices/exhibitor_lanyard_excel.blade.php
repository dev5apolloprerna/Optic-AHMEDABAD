<?php
ob_start();
$filename = 'ExhibitorLanyard' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo 'No' . "\t" . 'Company Name' . "\t" . 'Member Name' . "\t" . 'Member Mobile' . "\t" . 'City' . "\n";

$i = 1;
foreach ($Exhibitor as $row) {
    //dd($row);
    echo $i . "\t" . $row->strCompany . "\n";

    $ExhibitorBatch = App\Models\ExhibitBatch::orderBy('iExhibitBatchId', 'desc')
        ->where(['iStatus' => 1, 'isDelete' => 0, 'iCompayId' => $row->id])
        ->get();

    foreach ($ExhibitorBatch as $data) {
        echo '' . "\t" . '' . "\t" . $data->strMemberName . "\t" . $data->iMemberMobile . "\t" . $data->strCity . "\n";
    }
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
