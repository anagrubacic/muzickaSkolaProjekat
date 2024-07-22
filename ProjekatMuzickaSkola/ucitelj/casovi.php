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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="../css/stil.css" rel="stylesheet">
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
                    <th scope="col">Naziv časa</th>
                    <th scope="col">Učenici</th>
                    <th scope="col">Cena časa</th>
                    <th scope="col">Dostupni termin</th>
                </tr>
            </thead>
        <?php
            $sql = "SELECT c.nazivCasa, GROUP_CONCAT(CONCAT(u.imeUcenika, ' ', u.prezimeUcenika)) AS imenaUcenika, c.cena, c.dostupniTermin
                    FROM rezervacija r 
                    JOIN cas c ON r.ID_cas = c.ID_cas
                    JOIN ucenik u ON r.ID_ucenik = u.IDucenika
                    LEFT JOIN ucitelj uc ON c.uciteljID = uc.IDucitelja
                    GROUP BY c.nazivCasa";

            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['nazivCasa'] ?></td>
                <td>
                    <ul>
                        <?php
                        // Razdvajamo imena učenika po zarezima i pravimo listu
                        $imenaUcenika = explode(",", $row['imenaUcenika']);
                        foreach ($imenaUcenika as $imeUcenika) {
                            echo "<li>" . $imeUcenika . "</li>";
                        }
                        ?>
                    </ul>
                </td>
                <td><?php echo $row['cena'] ?></td>
                <td><?php echo $row['dostupniTermin'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>