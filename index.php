<?php
require 'includes/conn.php';
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
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <div class="container" style="background-color: whitesmoke; padding: 0">
        <div class="jumbotron headerBar">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/logo.png" alt="">
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="main">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <table id="example" class="display" width="100%">
                    <thead>
                    <tr>
                        <th>Nr. crt</th>
                        <th>Titlu</th>
                        <th>Autor</th>             
                    </tr>
                    </thead>
                    <tbody>
                     <?php
                            $query = "SELECT * FROM `books`";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)):
                                $idBookDb = $row['id'];
                                $titleBookDb = $row['name'];
                                $authorBookDb = $row['author'];
                                ?>
                                <tr>
                                    <td><?= $idBookDb ?></td>
                                    <td><?= $titleBookDb ?></td>
                                    <td><?= $authorBookDb ?></td>
                                </tr>
                            <?php endwhile; ?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="footer jumbotron">
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
    <script src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>