<?php
include '../konekcija.php';
session_start();
$id = $_GET['editid'];
$sql = "Select * from rezervacija where ID_rez=?";
$upit = $conn->prepare($sql);
$upit->bind_param("i",$id);
$upit->execute();
$result = $upit->get_result();
$rez = $result->fetch_assoc();

if(isset($_POST['btnSacuvaj'])){
    $status = $_POST['statusRezervacije'];
    
    if($status === "Slobodno" ||  $status === "Rezervisano"){

        $sql = 'Update rezervacija set status=? where ID_rez='.$id;
        $query = $conn->prepare($sql);
        $query -> bind_param("s",$status);
        $query -> execute();

        if ($sql){
            $poruka= "Uspešno ste izmenili status rezervacije.";
            header("location:edit_status.php?editid=".$id."&success=".$poruka);
        }
        else{
            $poruka= 'Greška pri izmeni statusa rezervacije!';
            header("location:edit_status.php?editid=".$id."&error=".$poruka);
        }
    }
    else{
        $poruka= "Niste uneli validne podatke";
        header("location:edit_status.php?editid=".$id."&error=".$poruka);
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
            <h3>Izmeni status</h3><hr>

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
                        <label class="labels ">Status:</label><br>
                        <input class="form-control" type="text" name="statusRezervacije">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-danger btnChanges" name="btnSacuvaj" type="submit">Save</button>
                    <a class="btn btn-danger btnChanges" href="prikaz_rezervacija.php" type="submit">Back</a><br>
                 </div>
            </form>
        </div>
    </div>
<script src="../js/main.js"></script>
</body>
</html>

