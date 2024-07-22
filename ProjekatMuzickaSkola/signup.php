<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'konekcija.php';

    // Provera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Dobijanje informacija o korisniku iz forme
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Provera da li email već postoji
    $provera_email = "SELECT email FROM ucenik WHERE email = ?";
    $stmt_provera = $conn->prepare($provera_email);
    $stmt_provera->bind_param("s", $email);
    $stmt_provera->execute();
    $stmt_provera->store_result();

    // Hashovanje lozinke pre nego što je sačuvate u bazi (obavezno za sigurnost)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL upit za dodavanje novog korisnika u bazu, bez eksplicitnog unošenja ID-a
    $sql = "INSERT INTO ucenik (imeUcenika,prezimeUcenika, email, sifra) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name,$lastname, $email, $hashed_password);

    if ($stmt_provera->num_rows == 0) {
        if ($stmt->execute()) {
            $_SESSION['registration_success'] = true;
            header("Location: ucenik_login.php"); // Preusmeravanje na stranicu za prijavu nakon uspešne registracije
            exit();
        } else {
            $poruka= "Greška pri izvršavanju upita: " . $conn->error;
            header("Location: signup.php?error=".$poruka);
        }
    }
    else{
        $poruka= "Korisnik sa ovakvim emailom već postoji.";
        header("Location: signup.php?error=".$poruka);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/violinski.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-danger">
                        Sign Up
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
	    		        <div class="alert alert-danger" role="alert">
				            <?=$_GET['error']?>
				        </div>
				    <?php } ?>

                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3 text-danger">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 text-danger">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3 text-danger">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 text-danger">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Sign Up</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>