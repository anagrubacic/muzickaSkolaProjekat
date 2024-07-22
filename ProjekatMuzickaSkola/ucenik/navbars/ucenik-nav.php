<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dobrodošli - <?php echo $_SESSION['ucenik_ime']?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="moji-casovi.php">Moji časovi</a>
                 </li>
                <li class="nav-item dropdown" aria-current="page">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">
                        Časovi </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="casovi-ucenik.php">Časovi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="rezervisi.php">Upiši se na čas</a></li>  
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