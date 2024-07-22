<?php
include '../konekcija.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna strana | ADMIN</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/stil.css" rel="stylesheet">
    <link rel="icon" href="../img/violinski.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="page-header">
            <a href="index_admin.php"><img src="../img/logo.jpg"></a>
            </h1>Muzička škola | Admin</h1>
        </div>
    </header>

    <body>
        <?php
            include "navbars/admin-nav.php";
        ?>
        
        <div class="container">
            <h2>Statistika sistema</h2>
                <ul class="list-group">
                <?php
                    $sql = 'select count(*) as ukupno from rezervacija';
                    $result = $conn-> query($sql);
                    $row = $result -> fetch_assoc();
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Ukupno rezervacija:
                    <span class="badge bg-danger rounded-pill"><?php echo $row['ukupno']?></span>
                </li>
                <?php
                    $casovi = 'select count(*) as ukupnoCasova from cas';
                    $res = $conn-> query($casovi);
                    $red = $res -> fetch_assoc();
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Broj časova:
                    <span class="badge bg-danger rounded-pill"><?php echo $red['ukupnoCasova']?></span>
                </li>
                <?php
                    $ucenik = 'select count(*) as ukupnoUcenika from ucenik';
                    $rezultat = $conn-> query($ucenik);
                    $redovi = $rezultat -> fetch_assoc();
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Broj učenika:
                    <span class="badge bg-danger rounded-pill"><?php echo $redovi['ukupnoUcenika']?></span>
                </li>
                <?php
                    $ucitelj = 'select count(*) as ukupnoUc from ucitelj';
                    $rezul = $conn-> query($ucitelj);
                    $r = $rezul -> fetch_assoc();
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Broj učitelja:
                    <span class="badge bg-danger rounded-pill"><?php echo $r['ukupnoUc']?></span>
                </li>
</ul>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>