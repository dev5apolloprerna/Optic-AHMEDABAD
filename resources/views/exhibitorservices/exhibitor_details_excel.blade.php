<?php
ob_start();
$filename = 'FasciaDetails' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo 'No' . "\t" . 'Company Name' . "\t" . 'Contact Person' . "\t" . 'Mobile' . "\t" . 'Email' . "\t" . 'City' . "\t" . 'Stall No' . "\t" . 'Name Facia On Stall' . "\t" . 'Name On Participant Certificate' . "\t" . 'My GST No.' . "\t" . 'Invitation Card Require.' . "\n";

$i = 1;
foreach ($Exhibitor as $row) {
    echo $i . "\t" . $row->strCompany . "\t" . $row->strContactPerson . "\t" . $row->Mobile . "\t" . $row->strEmail . "\t" . $row->strCity . "\t" . $row->strStallNo . "\t" . $row->strFasciaName . "\t" . $row->strParticipantCertificateName . "\t" . $row->txtGSTIN . "\t" . $row->iInviteesRequired . "\n";
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
