<?php
require 'includes/conn.php';
require 'includes/conn.php';
require 'Classes/PHPExcel.php';
$schedule = ['Luni' => ' 08:00 - 16:00', 'Marti' => '08:00 - 16:00', 'Miercuri' => '08:00 - 16:00', 'Joi' => '08:00 - 16:00', 'Vineri' => '08:00 - 16:00', 'Sambata' => 'Închis', 'Duminica' => 'Închis'];
$tmpfname = 'books.xls';
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);

$worksheet = $excelObj->getActiveSheet();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proiect</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php require './includes/navbar.php'; ?>
    <?php require './includes/carousel.php'; ?>
    <div class="container" id="main" style="background-color: whitesmoke; padding: 0;">
        <div class="container">
            <div class="main" style="margin-top: 100px">
                <div class="row">
                <div class="col-md-9">
                    <table id="example" class="display" width="100%">
                    <thead>
                    <tr>
                        <th>Domeniu (C.Z.U)</th>
                        <th>Autor</th>
                        <th>Titlu</th>             
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lastRow = $worksheet->getHighestRow();
                    $row = 2; // primul index e 1 si e titlul 
                    while ($row <= $lastRow):
                        set_time_limit(999);
                        // $idBook = $worksheet->getCell('F'.$row)->getValue();
                        $fieldBook = $worksheet->getCell('A'.$row)->getValue();
                        $titleBook = $worksheet->getCell('C'.$row)->getValue();
                        $authorBook = $worksheet->getCell('D'.$row)->getValue();
                        ?>
                                <tr>
                                    <td><?= $fieldBook ?></td>
                                    <td><?= $authorBook ?></td>  
                                    <td><?= $titleBook ?></td>
                                </tr>
                                
                    <?php 
                        $row++;
                    endwhile; ?>
                    </tbody>
                </table>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default schedule">
                        <div class="panel-heading" style="background-color: white; text-align: center; font-family: Verdana; text-transform: uppercase;">
                            <h4 class="title">
                                Program
                            </h4>
                        </div>
                        <div class="panel-body" style="text-align: center; align-items: center;">
                            <div class="row" style="text-align: center">
                                <?php foreach ($schedule as $day => $day_schedule) {?>
                                <div class="col-xs-5 text-right">
                                    <?php echo $day . ':'; ?>
                                </div>
                                <div class="col-xs-7 text-left strong" style="text-align: center">
                                    <?php echo $day_schedule ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
     </div>
    <footer class="footer jumbotron">
        <div class="container">
            <div class="pull-right year">

            </div>
            <div class="pull-left">
                <a href="admin">Toate drepturile rezervate CNGI</a>
            </div>
        </div>
    </footer>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.8.3/jquery.csv.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>