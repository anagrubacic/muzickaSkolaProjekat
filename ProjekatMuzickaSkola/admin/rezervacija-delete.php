<?php
include '../konekcija.php';
session_start();
$id = $_GET['teacher_id'];
$sql = 'DELETE FROM rezervacija WHERE ID_rez='.$id;
$conn-> query($sql);
    if ($sql){
        $poruka="Uspešno ste obrisali rezervaciju.";
        header("location:prikaz_rezervacija.php?success=".$poruka);
    }
    else{
        echo 'Greška pri brisanju rezervacije!';
        header("location:prikaz_rezervacija.php?error=".$poruka);
    }
?>