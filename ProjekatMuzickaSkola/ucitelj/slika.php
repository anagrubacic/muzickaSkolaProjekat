<?php
include '../konekcija.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna strana | UČITELJ</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/stil.css" rel="stylesheet">
    <link href="../css/galerija.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="../img/violinski.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="page-header">
            <a href="index_ucitelj.php"><img src="../img/logo.jpg"></a>
            </h1>Muzička škola | Učitelj</h1>
        </div>
    </header>
    <?php
        include "navbars/ucitelj-nav.php";
    ?>
    
<div class="container mt-5">
    <h2>Galerija slika</h2>
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?=$_GET['success']?>
        </div>
    <?php } ?>

    <div class="row">
        <?php
        $dir = "../img/testovi/";
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if($file != "." && $file != ".."){
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4 shadow-sm">';
                        echo '<img src="'.$dir.$file.'" class="card-img-top" alt="Slika">';
                        echo '<div class="card-body">';
                        echo '<a class="btn btn-outline-danger" href="'.$dir.$file.'">Pogledaj</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                closedir($dh);
            }
        }
        ?>
        </div>
    </div>
    <div class="container mt-5 shadow p-3">
    <h2>Ubacite test</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Odaberite sliku za upload:</label><br>
        <input type="file" id="file" name="file" accept="image/*"><br><br>
        <input class="btn btn-outline-danger" type="submit" value="Upload slike" name="submit">
    </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>