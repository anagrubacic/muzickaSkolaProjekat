<?php
include '../konekcija.php';
session_start();

if(isset($_POST['btnSacuvaj'])){
    $ucenik = $_GET['editid'];
    $id_cas = $_POST['cas'];
    $datum = date("Y-m-d"); echo $datum;
    $status = 'Rezervisano';


    $sql = 'INSERT INTO rezervacija (ID_cas,ID_ucenik,status,datumRezervacije) values (?,?,?,?)';
    $query = $conn->prepare($sql);
    $query -> bind_param("iiss",$id_cas,$ucenik,$status,$datum);
    $query -> execute();

    if ($sql){
        header("location:index_ucenik.php?>");
    }
    else{
        echo 'Greska pri dodavanju novog korisnika!';
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
    <link href="css/index_admin.css" rel="stylesheet">
    <link rel="icon" href="../img/violinski.png" type="image/x-icon">
</head>

<body>
    <header>
        <div class="page-header">
            <a href="index_admin.php"><img src="../img/logo.jpg"></a>
            </h1>Muzička škola | Admin</h1>
        </div>
    </header>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-danger navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dobrodošli -
                    <?php echo $_SESSION['ucenik_ime']  ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="info_ucenici.php">Informacije o napretku</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../welcome.html">
                            <i class="bi bi-arrow-down-right-circle"></i>Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <form method="post">
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="casovi">Izaberi cas koji zelis da prijavis:</label>
                                    <select name="cas" id="cas">
                                    <?php
                                        $cas = "SELECT DISTINCT * from rezervacija r join cas c on r.ID_cas=c.ID_cas";
                                        $res = $conn->query($cas);
                                        while ($red = $res->fetch_assoc()) {
                                            echo "<option value='" . $red['ID_cas'] . "'>" . $red['nazivCasa'] . "</option>";
                                            }?>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-danger btnChanges" name="btnSacuvaj" type="submit">Save</button>
                            </div>
                        </form>
    </div>
<script src="../js/main.js"></script>
</body>
</html>

