<?php
include '../konekcija.php';
session_start();
$id = $_GET['casID'];
$sql = 'DELETE FROM cas WHERE ID_cas='.$id;
$conn-> query($sql);
    if ($sql){
        $poruka="Uspešno ste obrisali odabrani čas.";
        header("location:prikaz_casova.php?success=".$poruka);
    }
    else{
        echo 'Greška pri brisanju časa!';
        header("location:prikaz_casova.php?error=".$poruka);
    }
?>