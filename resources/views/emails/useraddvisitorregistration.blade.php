<?php
// dd('hello');
$root = $_SERVER['DOCUMENT_ROOT'];
$file = file_get_contents($root . '/Ahmedabad/mailers/useraddvisitorregistration.html', 'r');

$file = str_replace('#obticid', 'EARI-' . $GetId, $file);
$file = str_replace('#name', $data['name'], $file);
$file = str_replace('#companyname', $data['companyName'], $file);
$file = str_replace('#email', $data['email'], $file);
$file = str_replace('#mobile', $data['mobile'], $file);
$file = str_replace('#state', $data['state'], $file);
$file = str_replace('#city', $data['city'], $file);
$file = str_replace('#visitdate', $data['visitDate'], $file);
$file = str_replace('#intersterd', $data['interested'], $file);
$file = str_replace('#strEntryDate', date('d-m-Y'), $file);

echo $file;

?>
