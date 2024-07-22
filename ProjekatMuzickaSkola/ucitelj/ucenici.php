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
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../css/stil.css" rel="stylesheet">
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

    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger mt-3 n-table" role="alert">
            <?=$_GET['error']?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
        </div>
    <?php } ?>
        <div class="table-responsive">
            <table class="table table-bordered mt-3 n-table border-danger table-hover">
            <thead>
                <tr class="table-danger border-danger">
                    <th scope="col">Contact</td>
                    <th scope="col">Učenik</td>
                    <th scope="col">Predmet</td>
                    <th scope="col">Instrument</td>
                    <th scope="col">Ocena</td>
                </tr>
            </thead>
            <?php
                $id=$_SESSION['ucitelj_ID'];
                $sql = "SELECT * FROM ocene o
                        JOIN ucenik u ON o.IDucenik=u.IDucenika
                        JOIN ucitelj uc ON o.IDucitelj=uc.IDucitelja
                        JOIN cas c ON o.IDCas=c.ID_cas
                        WHERE IDucitelj=".$id;
                $result = $conn-> query($sql);
                while ($row = $result -> fetch_assoc()) { ?>
                <tr>
                    <td>
                    <a href="kontaktiraj.php" class="btn btn-danger"><i class="bi bi-person"></i></a>
                    </td>
                    <td>
                        <?php echo $row['imeUcenika'] . " " . $row['prezimeUcenika']?>
                    </td>
                    <td>
                        <?php echo $row['nazivCasa']?>
                    </td>
                    <td>
                        <?php echo $row['nazivInstrumenta'] ?>
                    </td>
                    <?php
                        $ocena = $row['ocena'];
                        if($ocena>5){
                    ?>
                    <td style="font-weight: bold; color: #39ff14;">
                        <?php echo $row['ocena']?>
                    </td>
                    <?php } else { ?>
                    <td style="font-weight: bold; color: red;">
                        <?php echo $row['ocena']?>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                <!--/list -->
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>