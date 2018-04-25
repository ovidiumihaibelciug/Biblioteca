<?php
require '../includes/conn.php';
session_start();
$success = 0;
$_SESSION['xls'] = false;
$_SESSION['news'] = "";
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == 0) {
        header('Location: index.php');
    }

    if (isset($_POST['submitDb'])) {
        $target_dir = '../';
        $target_file = $target_dir . "books.xls";
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if(file_exists('./assets/export/file_name.xls')) {
            unlink('./assets/export/file_name.xls');
        }

        move_uploaded_file($_FILES["filepath"]["tmp_name"], $target_file);
        $_SESSION['xls'] = true;
    }

    if (isset($_POST['submitNews'])) {
        $target_dir = "../upload/news/";
        $target_dir = $target_dir . basename( $_FILES['file']['name']);

        $file_type = $_FILES['file']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpeg" || $file_type=="image/jpg" || $file_type=="image/png") {

            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_dir)) {
                $_SESSION['news'] = "Ati adaugat o noutate cu succes";
            } else {
                $_SESSION['news'] = "A aparut o problema. Incercati mai tarziu.";             
            }
        } else {
            $_SESSION['news'] = "Format invalid. Puteti adauga doar pdf,gif,jpeg,jpg sau png.";                         
        }
    }
   

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proiect</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../styles/index.css">
</head>
<body>
    <div class="page-content">
        <div style="background-color: whitesmoke; padding: 0;">
            <div class="jumbotron headerBar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="../img/logo.png" alt="">
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>

            
            
            <div class="container main-section">
                <?php if ($_SESSION['xls'] == true): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Ati schimbat baza de date cu succes!
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-3 box change-db">
                        Adauga un eveniment
                    </div>
                    <div class="col-md-3 box change-db" data-toggle="modal" data-target="#changeDb">
                        Schimba baza de date
                    </div>
                    <div class="col-md-3 box change-db" data-toggle="modal" data-target="#news">
                        Adauga o noutate
                    </div>
                </div>
            </div>
    
    
            <div class="modal fade" id="changeDb" tabindex="-1" role="dialog" aria-labelledby="changeDb">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Schimba Baza de date</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="main.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="filepath" id="filepath"/>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success form-control" name="submitDb"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="events" tabindex="-1" role="dialog" aria-labelledby="events">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Adauga un eveniment</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="news" tabindex="-1" role="dialog" aria-labelledby="news">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Adauga o noutate</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="main.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" id="file" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success form-control" name="submitNews" />
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
        </div> 
    </div>
    <div class="footer jumbotron">
        <div class="container">
            <div class="pull-right year">

            </div>
            <div class="pull-left">
                <a href="admin">Toate drepturile rezervate CNGI</a>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.8.3/jquery.csv.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>
</body>
</html>