/*
*
*	Algoritm de transformare a fiecarui rand din excel in sql (CU TOT CU DIACRITICE < 3)
*
*/

<!-- <?php
require 'includes/conn.php';
require 'Classes/PHPExcel.php';

$tmpfname = 'books.xls';
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);

$worksheet = $excelObj->getActiveSheet();

$lastRow = $worksheet->getHighestRow();
// $row = 2;
// while ($row <= $lastRow) {
//     set_time_limit(999);
//     $idBook = $worksheet->getCell('F'.$row)->getValue();
//     $titleBook = $worksheet->getCell('C'.$row)->getValue();
//     $authorBook = $worksheet->getCell('B'.$row)->getValue();
//     $query = "INSERT INTO `books` (`id`, `name`, `author`) VALUES ('$idBook', '$titleBook', '$authorBook');";
//     mysqli_query($conn, $query);
//     $row++;
// }
?> -->