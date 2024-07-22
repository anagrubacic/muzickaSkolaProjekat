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
        <div class="table-responsive">
            <table class="table table-bordered mt-3 n-table border-danger table-hover">
            <thead>
                <tr class="table-danger border-danger">
                    <th scope="col">ID</td>
                    <th scope="col">Učenik</td>
                    <th scope="col">Datum rezervacije</td>
                    <th scope="col">Status rezervacije</td>
                </tr>
            </thead>
            <?php
                $sql = "SELECT * FROM rezervacija r JOIN ucenik u ON r.ID_ucenik=u.IDucenika WHERE status='Slobodno'";
                $result = $conn-> query($sql);
                while ($row = $result -> fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row['ID_rez']?>
                    </td>
                    <td>
                        <?php echo $row['imeUcenika'] . " " . $row['prezimeUcenika']?>
                    </td>
                    <td>
                        <?php echo $row['datumRezervacije']?>
                    </td>
                    <td>
                        <?php echo $row['status']?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>