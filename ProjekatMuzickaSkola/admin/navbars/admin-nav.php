<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index_admin.php"> Dobrodošao/la - <?php echo $_SESSION['ime_admin']?> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown" aria-current="page">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Rezervacije </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="prikaz_rezervacija.php">Sve rezervacije</a></li>     
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="slobodne_rezervacije.php">Slobodni termini</a></li>
                            
                        </ul>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="prikaz_casova.php">Časovi</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="prikaz_ucenika.php">Učenici</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="prikaz_ucitelja.php">Učitelji</a>
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