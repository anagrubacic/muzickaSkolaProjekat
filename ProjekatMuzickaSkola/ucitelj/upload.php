<?php
if(isset($_POST["submit"])) {
    $target_dir = "../img/testovi/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
   
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "Datoteka je slika - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Datoteka nije slika.";
        $uploadOk = 0;
    }

    
    if (file_exists($target_file)) {
        $poruka= "Fajl već postoji.";
        header("location:slika.php?error=".$poruka);
        $uploadOk = 0;
    }


    if ($_FILES["file"]["size"] > 500000) {
        $poruka= "Vaš fajl je prevelik.";
        header("location:slika.php?error=".$poruka);
        $uploadOk = 0;
    }


    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowed_formats)) {
        $poruka= "Vaš fajl nije dozvoljenog formata.";
        header("location:slika.php?error=".$poruka);
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        $poruka= "Greška prilikom upoload-a.";
        header("location:slika.php?error=".$poruka);

    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $poruka= "Fajl ". htmlspecialchars( basename( $_FILES["file"]["name"])). " je uspesno dodat.";
            header("location:slika.php?success=".$poruka);
        } else {
            $poruka= "Greška prilikom upoload-a.";
            header("location:slika.php?error=".$poruka);
        }
    }
}
?>
