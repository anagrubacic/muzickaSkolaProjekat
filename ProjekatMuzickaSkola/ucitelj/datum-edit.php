<?php
include '../konekcija.php';
session_start();

if(isset($_POST['btnSacuvaj'])){
    $idCas = $_GET['editid'];
    $datum= $_POST['datumCasa'];

    $sql = 'UPDATE cas SET dostupniTermin=? WHERE ID_cas='.$idCas;
    $query = $conn->prepare($sql);
    $query -> bind_param("s",$datum);
    $query -> execute();

    if ($sql){
        $poruka= "Uspešno ste izmenili informacije o času.";
        header("location:ucitelj-casovi.php?success=".$poruka);
    }
    else{
        $poruka= 'Greška pri izmeni informacija!';
        header("location:cas-edit.php?error=".$poruka);
    }
}
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
        <form method="post" class="shadow p-3 mt-5 form-w">
            <?php if (isset($_GET['error'])) { ?>
	    		<div class="alert alert-danger" role="alert">
				    <?=$_GET['error']?>
				</div>
			<?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?=$_GET['success']?>
                </div>
            <?php } ?>

            <?php
                $id=$_GET['editid'];
                $sql = 'SELECT dostupniTermin,nazivCasa FROM cas WHERE ID_cas='.$id;
                $result = $conn-> query($sql);
                $row = $result -> fetch_assoc();
            ?>
            <h3>Izmeni dostupni termin za čas : <?=$row['nazivCasa']?></h3><hr>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="labels ">Status:</label><br>
                    <input class="form-control" type="date" name="datumCasa" value="<?=$row['dostupniTermin']?>">
                </div>
            </div>
            <div class="mt-5 text-center">
                <button class="btn btn-danger btnChanges" name="btnSacuvaj" type="submit">Save</button>
                <a class="btn btn-danger btnChanges" href="ucitelj-casovi.php" type="submit">Back</a><br>
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>