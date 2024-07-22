<?php
include '../konekcija.php';
session_start();
$id = $_GET['teacher_id'];
$sql = 'DELETE FROM ucitelj WHERE IDucitelja='.$id;
$conn-> query($sql);
    if ($sql){
        $poruka="Uspešno ste obrisali odabranog učitelja.";
        header("location:prikaz_ucitelja.php?success=".$poruka);
    }
    else{
        echo 'Greška pri brisanju učitelja!';
        header("location:prikaz_ucitelja.php?error=".$poruka);
    }
?>