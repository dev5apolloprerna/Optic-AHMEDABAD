<?php
ob_start();
$filename = 'user_list_' . date('d-m-Y H:i:s') . '.xls';

ob_end_clean();

echo "No\tCompany Name\tContact Person\tMobile\tEmail\tCity\tStall No\tStall Size\tStatus\n";

$i = 1;
foreach ($datas as $row) {
    
    if($row->iStatus == 0){
        $Status = "Inactive";
    }else{
        $Status = "Active";
    }
    
   
    
    echo $i . "\t" . $row->strCompany . "\t" . $row->strContactPerson . "\t" . $row->Mobile . "\t" . $row->strEmail . "\t" . $row->strCity . "\t" . $row->strStallNo .  "\t" . $row->strStallSize .  "\t" . $Status .  "\n";
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
exit();
