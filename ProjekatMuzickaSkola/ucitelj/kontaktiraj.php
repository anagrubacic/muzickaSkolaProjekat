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
    <a class="btn btn-outline-danger" href="ucenici.php" type="submit">Back</a><br>
        <form method="post" class="shadow p-3 mt-5 form-w">
        <h3>Kontaktiraj učenika</h3><hr>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="labels ">Izaberi učenika:</label><br>
                    <select class="form-select" name="ucenik" id="ucenik">
                    <?php
                        $sql = "SELECT * from ucenik ";
                        $res = $conn->query($sql);
                        while ($red = $res->fetch_assoc()) { ?>
                        <option value="<?=$red['email']?>"><?php echo $red['imeUcenika'] . "  " . $red['prezimeUcenika']?></option>;<?php } ?>
                    </select> 
                </div>
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-danger btnChanges" type="submit" id="kontaktirajLink">Kontaktiraj</a><br>
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/email.js"></script>
</body>

</html>