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
    <div id="loader"></div>
    <div id="layout" class="not-active">
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
                        <?php
                            $query = "SELECT * FROM `events`";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <div class="container-card">
                                <div class='large'>
                                    <div class='card-image'>
                                        <img src="<?= $row['image'] ?>">
                                    </div>
                                        <div class='card-text'>
                                            <p><?= $row['title'] ?></p>
                                            <p><?= $row['description'] ?></p>
                                            <p>
                                                <?php if ($row['file']):?>
                                                    <a href="<?= $row['file']; ?>" target="_blank">PDF</a>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                </div>              
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
         </div>
         <footer class="footer jumbotron">
            <div class="container">
                <div class="pull-left year"></div>
                <br />
                <div class="pull-left">
                    <a href="admin">Toate drepturile rezervate CNGI</a>
                </div>
                <div class="pull-right">
                    <div class="row">
                        <div class="col-md-12 made-by">
                            <span>Proiect realizat de: &nbsp</span>
                            <a href="https://www.facebook.com/ovidiumihai.belciug" target="_blank">Ovidiu-Mihai Belciug</a>, &nbsp;<a href="https://www.facebook.com/alexcambose" target="_blank">Alexandru Cambose</a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </footer>
    </div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.8.3/jquery.csv.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>