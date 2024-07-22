<?php
include '../konekcija.php';
session_start();

if(isset($_POST['btnSacuvaj'])){
    $id_ucenik = $_GET['editid'];
    $id_cas = $_GET['id'];
    $naziv = $_POST['nazivCasa'];
    $status= 'Rezervisano';
    $cena= $_POST['cena'];
    $datum = date("Y-m-d");

    $upit = "SELECT * FROM rezervacija WHERE ID_cas = ? AND ID_ucenik = ?";
    $stmt = $conn->prepare($upit);
    $stmt -> bind_param("ii",$id_cas,$id_ucenik);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $sql = 'INSERT INTO rezervacija (ID_cas,ID_ucenik,status,datumRezervacije) values (?,?,?,?)';
        $query = $conn->prepare($sql);
        $query -> bind_param("iiss",$id_cas,$id_ucenik,$status,$datum);
        $query -> execute();

        $poruka= "Upisali ste se na čas: " . $naziv . "<br> Datum: " . $datum . "<br> Cena časa iznosi: " . $cena . "<br>";
        header("location:moji-casovi.php?success=".$poruka);

    }
    else{
        $poruka= "Već ste upisani na čas " . $naziv . ".";
        header("location:moji-casovi.php?error=".$poruka);
    }
}
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
        <form method="post" class="shadow p-3 mt-5 form-w">
        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                    <a class="text" href="rezervisi.php" type="submit"><i class="bi bi-x-lg"></i></a><br>
                    <?=$_GET['success']?>
            </div>
        <?php } ?>
    <?php
        $id=$_GET['id'];
        $sql = 'SELECT * FROM cas c
                JOIN ucitelj uc ON c.uciteljID=uc.IDucitelja
                WHERE ID_cas='.$id;
                $result = $conn-> query($sql);
                while($row = $result -> fetch_assoc()){
    ?>
    <h3>Da li ste sigurni da želite da se upišete na čas <?=$row['nazivCasa']?> ?</h3><hr>
    <div class="row mt-2">
            <div class="col-md-6">
                    <label class="labels ">Naziv:</label><br>
                    <input class="form-control" type="text" name="nazivCasa" value="<?=$row['nazivCasa']?>" readonly>
            </div>
            <div class="col-md-6">
                    <label class="labels ">Profesor:</label><br>
                    <input class="form-control" type="text" value="<?=$row['ime'] . " " . $row['prezime']?>" readonly>
            </div>
            <div class="col-md-6">
                    <label class="labels ">Cena:</label><br>
                    <input class="form-control" type="text" name="cena" value="<?=$row['cena']?>" readonly>
            </div>
            </div>
            <div class="mt-5 text-center">
                <button class="btn btn-danger btnChanges" name="btnSacuvaj" type="submit">YES</button>
                <a class="btn btn-danger btnChanges" href="rezervisi.php" type="submit">NO</a><br>
            </div>
    </div><?php } ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>