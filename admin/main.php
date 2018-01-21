<?php
require '../includes/conn.php';
session_start();
$success = 0;
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == 0) {
        header('Location: index.php');
    }
    if (isset($_POST['addBook'])) {
        $title = mysqli_real_escape_string($conn, htmlentities($_POST['title']));
        $author = mysqli_real_escape_string($conn, htmlentities($_POST['author']));
        $field = mysqli_real_escape_string($conn, htmlentities($_POST['field']));
        $queryInsert = "INSERT INTO `books` VALUES('', '$title', '$author', '$field')";
        mysqli_query($conn, $queryInsert);
    }
    if (isset($_POST['save'])) {
        $idEdit = mysqli_real_escape_string($conn, htmlentities($_POST['idEdit']));
        $titleEdit = mysqli_real_escape_string($conn, htmlentities($_POST['titleEdit']));
        $fieldEdit = mysqli_real_escape_string($conn, htmlentities($_POST['fieldEdit']));
        $authorEdit = mysqli_real_escape_string($conn, htmlentities($_POST['authorEdit']));
        $queryEdit = "UPDATE `books` SET `id` = '$idEdit', `name` = '$titleEdit', `author` = '$authorEdit', `field` = '$fieldEdit' WHERE `id` = '$idEdit'";
        mysqli_query($conn, $queryEdit);
        header('Location: main.php');
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
<div class="container" style="background-color: whitesmoke; padding: 0">
    <div class="jumbotron headerBar">
        <div class="row">
            <div class="col-md-6">
                <img src="../img/logo.png" alt="">
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
    <div class="main container" style="margin-top: 20px;">
        <div class="container">
            <!-- Large modal -->
            <div class="modals">
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content" style="padding: 10px">
                            <h3 class="titleAddBook" style="text-align: center">Adauga o carte</h3>
                            <form action="main.php" method="POST">
                                <div class="form-group">
                                    <label for="title">Titlu</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="author">Autor</label>
                                    <input type="text" class="form-control" id="author" name="author">
                                </div>
                                <div class="form-group">
                                    <label for="field">Domeniu</label>
                                    <input type="text" class="form-control" id="field" name="field">
                                </div>
                                <input type="submit" name="addBook" class="btn btn-primary btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-btn" style="margin-bottom: 10px">
            <a href="/Biblioteca-master" class="btn btn-default"><i class=" glyphicon glyphicon-chevron-left"></i></a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="glyphicon glyphicon-plus"></i></button>
                <?php if (isset($success) && $success == 1):?>
                    <div class="alert alert-success" id="successAlert" style="margin: 10px">
                        Ai adaugat o carte cu succes.
                    </div>
                <?php endif; ?>

            </div>


            <table id="example" class="display" width="100%">
                <thead>
                <tr>
                    <th>Nr. crt</th>
                    <th>Domeniu</th>
                    <th>Titlu</th>
                    <th>Autor</th>
                    <th>Edit</th>
                    <th>Sterge</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                        $queryAll = "SELECT * FROM `books`";
                        $result = mysqli_query($conn, $queryAll);
                        while ($row = mysqli_fetch_assoc($result)):               
                            $idBook     = $row['id'];
                            $fieldBook  = $row['field'];
                            $titleBook  = $row['name']; 
                            $authorBook = $row['author'];             
                            
                            $delete = 'delete';
                            $delete .= $idBook;
                            $edit = 'edit';
                            $edit .= $idBook;
                            ?>
                            <tr>
                                <?php 
                                    if (!isset($_POST[$edit])):?>
                                        <td><?= $idBook ?></td>
                                        <td><?= $fieldBook ?></td>
                                        <td style="word-wrap: break-word; word-break: break-all;"><?= $titleBook ?></td>
                                        <td><?= $authorBook ?></td>
                                    <?php elseif(!isset($_POST['save'])): ?>
                                        <form action="main.php" method="POST">
                                            <td><input type="text" name="idEdit" class="form-control" value="<?php echo $idBook; ?>"></td>
                                            <td><input type="text" name="fieldEdit" class="form-control" value="<?php echo $fieldBook; ?>"></td>
                                            <td><input type="text" name="titleEdit" class="form-control" value="<?php echo $titleBook; ?>"></td>
                                            <td><input type="text" name="authorEdit" class="form-control" value="<?php echo $authorBook; ?>"></td>
                                            <td><button class="btn btn-success" name="save"><i class="glyphicon glyphicon-ok"></i></button></td>
                                        </form>
                                    <?php endif;
                                    if (!isset($_POST[$edit])): ?>
                                        <form action="main.php" method="POST">
                                            <td><button type="submit" class="btn btn-warning" name="<?php echo $edit; ?>"><i class="glyphicon glyphicon-edit"></i></button></td>
                                        </form>
                                    <?php endif; ?>
                                
                                <form action="delete.php?delete=<?php echo $idBook ?>" method="POST">
                                    <td><button type="submit" class="btn btn-danger" name="<?php echo $delete; ?>"><i class="glyphicon glyphicon-trash"></i></button></td>
                                </form>
                            </tr>
                        <?php 
                        $row++;
                        endwhile; ?>
                </tbody>
            </table>
           
        </div>
    </div>
    <div class="footer jumbotron">
        <div class="pull-right year">

        </div>
        <div class="pull-left">
            Toate drepturile rezervate CNGI
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