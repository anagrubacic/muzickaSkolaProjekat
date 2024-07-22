<?php
include '../konekcija.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna strana | UČENIK</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="../css/ucenik.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="../img/violinski.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="page-header">
            <a href="index_ucenik.php"><img src="../img/logo.jpg"></a>
            </h1>Muzička škola | Učenik</h1>
        </div>
    </header>

    <?php
    include('navbars/ucenik-nav.php');
    ?>
    <?php
    $id=$_SESSION['ucenik_ID'];
    $sql = 'SELECT * FROM cas c 
    JOIN rezervacija r ON c.ID_cas=r.ID_cas
    LEFT JOIN ucenik u ON u.IDucenika=r.ID_ucenik 
    WHERE IDucenika='.$id;
    $result = $conn-> query($sql);
    $row = $result -> fetch_assoc();
    ?>

<div class="container mt-5">
    <div class="card" style="width: 22rem;">
    <img src="../img/student.jpg" class="card-img-top" alt="...">
        <?php if($row): ?>
            <div class="card-body">
                <h5 class="card-title text-center"><i class="bi bi-backpack"></i><?php echo $row['imeUcenika'] . " " . $row['prezimeUcenika']?></h5>
            </div>
            <ul class="list-group list-group-flush">        
                <li class="list-group-item">Ime: <?=$row['imeUcenika']?></li>
                <li class="list-group-item">Prezime: <?=$row['prezimeUcenika']?></li>
                <li class="list-group-item">Email: <?=$row['email']?></li>
                <li class="list-group-item">Predmeti koje pohađate:
                    <?php 
                        $idU=$_SESSION['ucenik_ID'];
                        $sql = 'SELECT * FROM cas c
                        JOIN rezervacija r ON c.ID_cas=r.ID_cas  
                        JOIN ucenik u ON r.ID_ucenik=u.IDucenika
                        WHERE IDucenika='.$idU;
                        $result = $conn-> query($sql);
                        while($red = $result -> fetch_assoc()){
                    ?>
                        <?=$red['nazivCasa'] . " | "?>
                    <?php } ?>
                </li>
                <li class="list-group-item">Profesori koji Vam predaju:
                    <?php 
                        $idU=$_SESSION['ucenik_ID'];
                        $sql = 'SELECT * FROM rezervacija r 
                        JOIN cas c ON r.ID_cas=c.ID_cas
                        LEFT JOIN ucitelj uc ON c.uciteljID=uc.IDucitelja
                        WHERE ID_ucenik='.$idU;
                        $result = $conn-> query($sql);
                        while($red = $result -> fetch_assoc()){
                    ?>
                        <?=$red['ime'] ." ". $red['prezime'] ." | "?>
                    <?php } ?>
                </li>
            </ul>
        <?php else: ?>
            <div class="card-body">
                <h5 class="card-title text-center">Morate se upisati na čas da bi Vam se napravio profil.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>