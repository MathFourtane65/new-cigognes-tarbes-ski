<!-- /src/view/components/navbar.php -->



<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container-fluid navbar-container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>Menu
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="/actualites" class="nav-link">Actualités</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Le Club
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/bureau">Le Bureau</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/moniteurs">Les Moniteurs</a></li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <!-- <li><a class="dropdown-item" href="/partenaires">Les Partenaires</a></li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/calendrier" class="nav-link">Calendrier</a>
                </li>
                <li class="nav-item">
                    <a href="/phototeque" class="nav-link">Phototèque</a>
                </li>
                <li class="nav-item">
                    <a href="/dossier-inscription" class="nav-link">Dossier d'inscription</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact</a>
                </li>




                <!-- <li class="nav-item nav-item-connexion">
                    <a href="/connexion-licencie" class="nav-link">Connexion</a>
                </li> -->
                <li class="nav-item nav-item-connexion">
                    <?php if (isset($_SESSION['licencie_logged_in']) && $_SESSION['licencie_logged_in'] === true) : ?>
                        <a href="/licencie" class="nav-link">Espace Licencié</a>
                    <?php elseif (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) : ?>
                        <a href="/admin" class="nav-link">Espace Admin</a>
                    <?php else : ?>
                        <a href="/connexion-licencie" class="nav-link">Connexion</a>
                    <?php endif; ?>
                </li>



            </ul>
        </div>
    </div>
</nav>