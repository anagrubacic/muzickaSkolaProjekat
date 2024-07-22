<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dobrodošli profesore/ka - <?php echo $_SESSION['ime_ucitelja']?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown" aria-current="page">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">
                        Časovi </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="casovi.php">Svi časovi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="ucitelj-casovi.php">Moji časovi</a></li>  
                    </ul>
                </li>
                <li class="nav-item dropdown" aria-current="page">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">
                    Učenici </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ucenici.php">Učenici</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="ocene.php">Oceni</a></li>  
                    </ul>
                </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.html">
                    <i class="bi bi-arrow-down-right-circle"></i> Sign out
                </a>
            </li>
        </ul>
</div>
</nav>