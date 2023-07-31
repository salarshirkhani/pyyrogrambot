<?php 

 
// Include PHPSpreadsheet classes 
require 'vendor/autoload.php'; 
 
use PhpOffice\PhpSpreadsheet\IOFactory; 
 
// Read the Excel file into a PHP array 
$reader = IOFactory::createReader('Xlsx'); 
$reader->setReadDataOnly(true); 
$spreadsheet = $reader->load('output.xlsx'); 
$worksheet = $spreadsheet->getActiveSheet(); 
$data = $worksheet->toArray(null, true, true, true); 
 
// Remove the header row from the data 
$header = array_shift($data); 
 
// Create an array of dictionaries using the header row as keys 
$result = array(); 
foreach ($data as $row) { 
    // Convert each cell value to UTF-8 
    foreach ($row as &$cell) { 
        $cell = iconv('WINDOWS-1256', 'WINDOWS-1256', $cell); 
    } 
     
    $result[] = array_combine($header, $row); 
} 
 

?>