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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    
    <?php
        include "navbars/admin-nav.php";
    ?>
    
    <div class="container mt-5">
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
        <?php } ?>

        <div class="table-responsive">
        <h3>Časovi koje pohađa učenik</h3>
            <table class="table table-bordered mt-3 n-table border-danger table-hover">
            <thead>
                <tr class="table-danger border-danger">
                    <th scope="col">Naziv predmeta</th>
                    <th scope="col">Učitelj</th>
                    <th scope="col">Ocena</th>
                </tr>
            </thead>
            <?php
                $id=$_GET['student_id'];
                $sql = "SELECT c.nazivCasa, uct.ime, uct.prezime, o.ocena
                        FROM ucenik uc
                        LEFT JOIN rezervacija r ON uc.IDucenika = r.ID_ucenik
                        LEFT JOIN cas c ON r.ID_cas = c.ID_cas
                        LEFT JOIN ucitelj uct ON c.uciteljID = uct.IDucitelja
                        LEFT JOIN ocene o ON uc.IDucenika = o.IDucenik AND c.ID_cas = o.IDCas
                        WHERE uc.IDucenika =".$id;
                        
                        $result = $conn-> query($sql);
                        while ($row = $result -> fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['nazivCasa']?>
                            </td>
                            <td>
                                <?php echo $row['ime'] . " " . $row['prezime']?>
                            </td>
                            <?php
                                $ocena = $row['ocena'];
                                if ($ocena >= 5 && $ocena <= 10) { ?>
                                <?php if ($ocena>=6 && $ocena <= 10) {?>
                            <td style="font-weight: bold; color: #39ff14;">
                                <?php echo $row['ocena']?>
                            </td>
                            <?php }else {?>
                            <td style="font-weight: bold; color: red;">
                                <?php echo $row['ocena']?>
                            </td><?php } ?>
                            <?php }else {?>
                            <td>
                                NEOCENJEN
                            </td><?php } ?>
                        </tr>
                <?php } ?>
            </table>
            <a href="prikaz_ucenika.php" class="btn btn-outline-danger">Go Back</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>