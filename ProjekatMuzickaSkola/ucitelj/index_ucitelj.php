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
    <link href="../css/slika.css" rel="stylesheet">
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
        $id=$_SESSION['ucitelj_ID'];
        $sql = 'SELECT * FROM cas c 
        JOIN ucitelj u ON c.uciteljID=u.IDucitelja 
        WHERE IDucitelja='.$id;
        $result = $conn-> query($sql);
        $row = $result -> fetch_assoc();
    ?>
<div class="row">
    <div class="col">
        <div class="container mt-5">
            <div class="card" style="width: 22rem;">
                <img src="../img/teacher-<?=$row['gender']?>.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center"><i class="bi bi-person"></i> <?php echo $row['ime'] . " " . $row['prezime']?></h5>
                </div>
                <ul class="list-group list-group-flush">        
                    <li class="list-group-item">Ime: <?=$row['ime']?></li>
                    <li class="list-group-item">Prezime: <?=$row['prezime']?></li>
                    <li class="list-group-item">Email: <?=$row['email']?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="container mt-5">
            <div class="card" style="width: 22rem;">
                <img src="../img/testovi/test1.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Testovi</h5>
                <p class="card-text">Testovi iz teorije ili solfedja.</p>
                <a class="btn btn-outline-danger" href="slika.php">Pogledaj galeriju</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>