<?php
include '../konekcija.php';
session_start();
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

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
        <?php } ?>

        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-bordered mt-3 n-table border-danger table-hover">
                    <thead>
                        <tr class="table-danger border-danger">
                            <th scope="col">ID</th>
                            <th scope="col">Učenik</th>
                            <th scope="col">Datum rezervacije</th>
                            <th scope="col">Status rezervacije</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = 'SELECT * FROM rezervacija r JOIN ucenik u ON r.ID_ucenik=u.IDucenika';
                        $result = $conn-> query($sql);
                        while ($row = $result -> fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <?php echo $row['ID_rez']?>
                            </td>
                            <td>
                                <?php echo $row['imeUcenika'] . " " . $row['prezimeUcenika']?>
                            </td>
                            <td>
                                <?php echo $row['datumRezervacije']?>
                            </td>
                            <td>
                                <span class="col-4 col-lg-2 info">
                                    <i class="bi bi-pen"></i>
                                    <a class="text-danger" href="edit_status.php?editid=<?php echo $row['ID_rez'] ?>"><?php echo $row['status']?></a>
                                </span>
                            </td>
                            <td>
                                <a href="rezervacija-delete.php?teacher_id=<?=$row['ID_rez']?>"
                                class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>