<?php
include '../konekcija.php';
session_start();

if(isset($_POST['btnSacuvaj'])){
    $id_ucitelj = $_POST['ucitelj'];
    $nazivCasa= $_POST['nazivCasa'];
    $cena= $_POST['cenaCasa'];
    $datum= $_POST['datumCasa'];

    if( $nazivCasa!=null && $cena!=null && $datum!=null){
    $sql = 'INSERT INTO cas (uciteljID,nazivCasa,cena,dostupniTermin) values (?,?,?,?)';
    $query = $conn->prepare($sql);
    $query -> bind_param("isss",$id_ucitelj,$nazivCasa,$cena,$datum);
    $query -> execute();

    if ($sql){
        $poruka= "Uspešno ste dodali novi čas u bazu podataka.";
        header("location:prikaz_casova.php?success=".$poruka);
    }
    else{
        $poruka= 'Greška pri dodavanju novog časa u bazu!';
        header("location:add_cas.php?error=".$poruka);
    }}
    else{
        $poruka= "Niste uneli potrebne podatke za dodavanje novog casa";
        header("location:add_cas.php?error=".$poruka);
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
        <h3>Dodaj novi čas</h3><hr>
        
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

            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Izaberi učitelja:</label>
                    <select class="form-select" name="ucitelj" id="ucitelj">
                    <?php
                        $ucitelj = "SELECT * FROM ucitelj ";
                        $res = $conn->query($ucitelj);
                        while ($red = $res->fetch_assoc()) {?>
                        <option value="<?php echo $red['IDucitelja'];?>"> <?php echo $red['ime'] . " " . $red['prezime'];?> </option>";
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Naziv časa:</label>
                    <input class="form-control" type="text" name="nazivCasa">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Cena:</label>
                    <input class="form-control" type="text" name="cenaCasa">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Datum:</label>
                    <input class="form-control" type="date" name="datumCasa">
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

