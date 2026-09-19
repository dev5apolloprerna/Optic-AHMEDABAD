<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$file = file_get_contents($root . '/Ahmedabad/mailers/book_my_stall.html', 'r');

$file = str_replace('#name', $data['name'], $file);
$file = str_replace('#companyname', $data['companyName'], $file);
$file = str_replace('#email', $data['email'], $file);
$file = str_replace('#mobile', $data['mobile'], $file);
$file = str_replace('#city', $data['city'], $file);
$file = str_replace('#stall_size', $data['stall_size'], $file);
$file = str_replace('#message', $data['message'], $file);
$file = str_replace('#strEntryDate', date('d-m-Y'), $file);

echo $file;

?>
