<?php
include '../konekcija.php';
session_start();
if(isset($_POST['btnSacuvaj'])){
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email= $_POST['email'];
    $password= $_POST['sifra'];
    $pol= $_POST['pol'];

    if($ime!=null && $prezime!=null && $email!=null && $password!=null){
        $provera_email = "SELECT email FROM ucitelj WHERE email = ?";
        $stmt_provera = $conn->prepare($provera_email);
        $stmt_provera->bind_param("s", $email);
        $stmt_provera->execute();
        $stmt_provera->store_result();

        if ($stmt_provera->num_rows == 0){
            // Hashovanje lozinke pre nego što je sačuvate u bazi (obavezno za sigurnost)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = 'INSERT INTO ucitelj (ime,prezime,email,sifra,gender) values (?,?,?,?,?)';
            $query = $conn->prepare($sql);
            $query -> bind_param("sssss",$ime,$prezime,$email,$hashed_password,$pol);
            $query -> execute();

            if ($sql) {
                $poruka= "Uspešno ste dodali novog učitelja u bazu podataka.";
                header("location:prikaz_ucitelja.php?success=".$poruka);
            } else {
                $poruka= 'Greška pri dodavanju novog učitelja u bazu!';
                header("location:ucitelj-add.php?error=".$poruka);
            }
        } else {
            $poruka= "Korisnik sa ovakvim emailom već postoji.";
            header("Location: ucitelj-add.php?error=".$poruka);
        }
    } else {
        $poruka= "Niste uneli potrebne podatke za dodavanje novog casa";
        header("location:ucitelj-add.php?error=".$poruka);
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
        <h3>Dodaj novog učitelja</h3><hr>
        
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
                <label class="form-label">Ime:</label>
                <input class="form-control" type="text" name="ime">
             </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Prezime:</label>
                <input class="form-control" type="text" name="prezime">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label class="form-label">Email:</label>
                <input class="form-control" type="email" name="email">
            </div>
        </div>
        <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Password:</label>
                    <input class="form-control" type="password" name="sifra">
                </div>
        </div>
        <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Pol:</label>
                    <select class="form-select" name="pol" id="pol">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
        </div>
        <div class="mt-5 text-center">
                <button class="btn btn-outline-danger" name="btnSacuvaj" type="submit">Save</button>
                <a href="prikaz_ucitelja.php" class="btn btn-outline-danger">Back</a>
        </div>
        </form>
    </div>
<script src="../js/main.js"></script>
</body>
</html>