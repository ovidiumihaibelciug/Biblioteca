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
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="sec-events">
                        <?php require_once './includes/secondaryNav.php'; ?>
                    </div>
                    <div class="container-card">
                        <div class='large'>
                            <div class='card-image'>
                                <img src='https://images.pexels.com/photos/595747/pexels-photo-595747.jpeg?auto=compress&amp;cs=tinysrgb&amp;h=750&amp;w=1260'>
                            </div>
                                <div class='card-text'>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <p>Integer nec odio. Praesent libero.</p>
                                </div>
                        </div>              
                    </div>
                    <div class="container-card">
                        <div class='large'>
                            <div class='card-image'>
                                <img src='https://images.pexels.com/photos/595747/pexels-photo-595747.jpeg?auto=compress&amp;cs=tinysrgb&amp;h=750&amp;w=1260'>
                                </div>
                                <div class='card-text'>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <p>Integer nec odio. Praesent libero.</p>
                                </div>
                            </div>              
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
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