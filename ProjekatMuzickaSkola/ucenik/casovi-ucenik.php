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
    <link href="../css/stil.css" rel="stylesheet">
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
    
    <div class="container mt-5">
    <h2>INFORMACIJE O ČASOVIMA</h2>
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
                    <th scope="col">Učitelj</th>
                    <th scope="col">Dostupan termin</th>
                </tr>
            </thead>
                <?php
                    $sql = 'SELECT * FROM cas c JOIN ucitelj u ON c.uciteljID=u.IDucitelja';
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
                    <td>
                        <?php echo $row['dostupniTermin']?>
                    </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>