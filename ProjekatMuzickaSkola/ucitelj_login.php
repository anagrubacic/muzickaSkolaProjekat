<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'konekcija.php';

    // Provera konekcije
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Dobijanje informacija o korisniku iz forme
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL upit za pronalaženje korisnika sa datim emailom
    $sql = "SELECT * FROM ucitelj WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $rez = $result->fetch_assoc();

        if ($rez) {
            // Provera lozinke
            $new_password = $rez['sifra'];
            if ($new_password==$password) {
                // Lozinka je tačna, korisnik je uspešno prijavljen
                $_SESSION['ucitelj_ID'] = $rez['IDucitelja'];
                $_SESSION['ime_ucitelja'] = $rez['ime'];
                $_SESSION['email'] = $rez['email'];
                header("Location: ucitelj/index_ucitelj.php"); // Preusmeravanje na željenu stranicu nakon prijave
                exit();
            } else {
                $poruka= "Pogrešna lozinka!";
                header("Location: ucitelj_login.php?error=".$poruka);
            }
        } else {
            $poruka= "Korisnik sa datim emailom ne postoji!";
            header("Location: ucitelj_login.php?error=".$poruka);
        }
    } else {
        $poruka= "Greška pri izvršavanju upita: " . $conn->error;
        header("Location: ucitelj_login.php?error=".$poruka);
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
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/violinski.png" type="image/x-icon">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-danger">
                        Login
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
	    		        <div class="alert alert-danger" role="alert">
				            <?=$_GET['error']?>
				        </div>
				    <?php } ?>

                    <div class="card-body">
                        <form method="POST" action="ucitelj_login.php">
                            <div class="mb-3 text-danger">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 text-danger">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Login</button><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>