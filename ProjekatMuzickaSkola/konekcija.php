<?php
$conn = new mysqli("localhost","root","","muzicka_baza");

if ($conn -> connect_errno){
    echo 'Došlo je do greške prilikom povezivanja sa bazom!';
}
?>