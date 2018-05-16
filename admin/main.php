<?php
require '../includes/conn.php';
session_start();
$success = 0;
$_SESSION['xls'] = false;
$_SESSION['news'] = "";
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == 0) {
        header('Location: index.php');
    }

    if (isset($_POST['submitEvent'])) {
        $title = mysqli_real_escape_string($conn, htmlentities($_POST['title']));
        $description = mysqli_real_escape_string($conn, htmlentities($_POST['description']));
        
        $target_dir = "../upload/events/";
        $target_dir = $target_dir . time() . basename( $_FILES['image']['name']);
        $ok = 1;

        $file_type = $_FILES['image']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpeg" || $file_type=="image/jpg" || $file_type=="image/png") {

            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir)) {
                $image = substr($target_dir, 1);                
            } else {
                $ok = 0;            
            }
        } else {
            $ok = 0;                        
        }

        $target_dir = "../upload/events/";
        $target_dir = $target_dir . time() . basename( $_FILES['file']['name']);

        $file_type = $_FILES['file']['type'];

        if ($file_type=="application/pdf") {

            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_dir)) {
                $file = substr($target_dir, 1);                
            } else {
                $ok = 0;          
            }
        } else {
            $ok = 0;                  
        }
        if (!$ok) {
            $_SESSION['news'] = "A aparut o problema. Incercati mai tarziu.";
        } else {
            $query = "INSERT INTO `events` VALUES('', '$title', '$description', '$image', '$file')";
            mysqli_query($conn, $query);
        }
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
        $target_dir = $target_dir . time() . basename( $_FILES['file']['name']);

        $file_type = $_FILES['file']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpeg" || $file_type=="image/jpg" || $file_type=="image/png") {

            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_dir)) {
                $_SESSION['news'] = "Ati adaugat o noutate cu succes";
                $title = mysqli_real_escape_string($conn, htmlentities($_POST['title']));
                $file = $_FILES['file']['tmp_name'];
                $dbFile = substr($target_dir, 1);
                $query = "INSERT INTO `news` VALUES('', '$title', '$dbFile')";
                mysqli_query($conn, $query);
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
    <div id="loader"></div>
    <div id="layout" class="not-active">
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


                <a href="/" class="back-button btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i>
                </a>
                <div class="container main-section">
                    <?php if ($_SESSION['xls'] == true): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Ati schimbat baza de date cu succes!
                        </div>
                    <?php endif; ?>
                    <div class="row main-btns">
                        <div class="col-md-3 box change-db" data-toggle="modal" data-target="#events">
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
                                <form action="main.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Titlul</label>
                                        <input type="text" name="title" id="title" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descriere</label>
                                        <textarea name="description" id="description" class="form-control" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Imagine</label>
                                        <input type="file" name="image" id="image" class="form-control" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Pdf(optional)</label>
                                        <input type="file" name="file" id="file" class="form-control" />
                                    </div>
                                    <input type="submit" name="submitEvent" id="submitEvent" class="btn btn-success form-control" >
                                </form>
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
                                        <label for="title">Titlu:</label>
                                        <input type="text" class="form-control" name="title" id="title" />
                                    </div>
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
            <div class="footer jumbotron admin-footer">
                <div class="container">
                    <div class="pull-left year"></div>
                    <br />
                    <div class="pull-right">
                        <div class="row">
                            <div class="col-md-12 made-by">
                                ovidiumihaibelciug@gmail.com
                            </div>
                        </div>
                    
                    </div>
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