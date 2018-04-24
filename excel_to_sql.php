<?php
/*
*
*	Algoritm de transformare a fiecarui rand din excel in sql (CU TOT CU DIACRITICE < 3)
*   useless, (can't change free hosting server configuration :( )
*/

require 'includes/conn.php';
require 'Classes/PHPExcel.php';

$tmpfname = 'books.xls';
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);

$worksheet = $excelObj->getActiveSheet();

$lastRow = $worksheet->getHighestRow();
$row = 2; // primul index e 1 si e titlul 
while ($row <= $lastRow) {
    set_time_limit(999);
    $idBook = $worksheet->getCell('F'.$row)->getValue();
    $fieldBook = $worksheet->getCell('A'.$row)->getValue();
    $titleBook = $worksheet->getCell('C'.$row)->getValue();
    $authorBook = $worksheet->getCell('B'.$row)->getValue();
    
    $query = "INSERT INTO `books` (`id`, `name`, `author`, `field`) VALUES ('$idBook', '$titleBook', '$authorBook', '$fieldBook')";
    mysqli_query($conn, $query);

    $row++;
}
?> 