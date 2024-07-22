<?php
include '../konekcija.php';
session_start();

if(isset($_POST['btnSacuvaj'])){
    $idCas = $_GET['casID'];
    $id_ucitelj = $_POST['ucitelj'];
    $nazivCasa= $_POST['nazivCasa'];
    $cena= $_POST['cenaCasa'];
    $datum= $_POST['datumCasa'];

    if($nazivCasa!=null && $cena!=null && $datum!=null){
    $sql = 'UPDATE cas SET uciteljID=?,nazivCasa=?,cena=?,dostupniTermin=? WHERE ID_cas='.$idCas;
    $query = $conn->prepare($sql);
    $query -> bind_param("isss",$id_ucitelj,$nazivCasa,$cena,$datum);
    $query -> execute();

    if ($sql){
        $poruka= "Uspešno ste izmenili informacije o času.";
        header("location:prikaz_casova.php?success=".$poruka);
    }
    else{
        $poruka= 'Greška pri izmene informacija!';
        header("location:cas-edit.php?error=".$poruka."&casID=".$idCas);
    }}
    else{
        $poruka= "Niste uneli potrebne podatke za dodavanje novog casa";
        header("location:cas-edit.php?error=".$poruka."&casID=".$idCas);
    }
}
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
        <form method="post" class="shadow p-3 mt-5 form-w">
        <h3>Izmeni čas</h3><hr>
        
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
            $id=$_GET['casID'];
            $sql = 'SELECT * FROM cas c
            JOIN ucitelj u ON c.uciteljID=u.IDucitelja
            WHERE ID_cas='.$id;
            $result = $conn-> query($sql);
            $row = $result -> fetch_assoc();
        ?>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Izaberi učitelja:</label>
                <select class="form-select" name="ucitelj" id="ucitelj">
                    <option value="<?=$row['IDucitelja']?>"> <?php echo $row['ime'] . " " . $row['prezime'];?> </option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Naziv časa:</label>
                <input class="form-control" type="text" name="nazivCasa" value="<?=$row['nazivCasa']?>">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Cena:</label>
                <input class="form-control" type="text" name="cenaCasa" value="<?=$row['cena']?>">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Datum:</label>
                <input class="form-control" type="date" name="datumCasa" value="<?=$row['dostupniTermin']?>">
            </div>
        </div>
        <div class="mt-5 text-center">
            <button class="btn btn-outline-danger" name="btnSacuvaj" type="submit">Save</button>
            <a href="prikaz_casova.php" class="btn btn-outline-danger">Back</a>
        </div>
    </form>
</div>
<script src="../js/main.js"></script>
</body>
</html>

