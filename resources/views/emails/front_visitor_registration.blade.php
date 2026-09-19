<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;

$qrText =
    $data['companyName'] . '~' .
    $data['name'] . '~' .
    $data['mobile'] . '~' .
    $data['city'] . '~' .
    date('d-m-Y', strtotime($data['strEntryDate'])) . '~' .
    date('d-m-Y', strtotime($data['visitDate']));

$qrUrl = "https://opticexhibition.com/Ahmedabad/qrcodes/visitor_" . $GetId . ".png";

$root = $_SERVER['DOCUMENT_ROOT'];
$filePath = $root . '/Ahmedabad/mailers/front_visitor_registration.html';

$file = file_get_contents($filePath);

$file = str_replace('#name', $data['name'], $file);
$file = str_replace('#companyname', $data['companyName'], $file);
$file = str_replace('#email', $data['email'], $file);
$file = str_replace('#mobile', $data['mobile'], $file);
$file = str_replace('#state', $data['state'], $file);
$file = str_replace('#city', $data['city'], $file);
$file = str_replace('#visitdate', $data['visitDate'], $file);
$file = str_replace('#intersterd', $data['interested'], $file);
$file = str_replace('#strEntryDate', date('d-m-Y'), $file);

$file = str_replace('#qrcode', $qrUrl, $file);

echo $file;

?>