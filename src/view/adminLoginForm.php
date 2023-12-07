<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/view/adminLoginForm.css">
    <title>Connexion Administrateur</title>

</head>


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card mt-5">
                <div class="card-footer text-center">
                    <a href="/">Retour à l'accueil</a>
                </div>

                <div class="card-header text-center">
                    <img src="/images/icon-admin.png" class="img-fluid logo-form-conn-admin" alt="Club Logo" />

                    <h3 class="titre">Connexion Administrateur</h3>

                    <p><a href="/fichiers/XXXXXXXX.pdf" class="btn btn-primary btn-lg disabled" download>Guide d'utilisation ADMIN (pdf) <br>BIENTOT DISPONIBLE</a></p>

                </div>

                <?php if (isset($_GET['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        if ($_GET['error'] == 'missing_fields') echo "Tous les champs sont obligatoires.";
                        if ($_GET['error'] == 'invalid_credentials') echo "Identifiant ou mot de passe incorrect.";
                        ?>
                    </div><?php endif; ?>


                <div class="card-body">
                    <form action="/login-admin-process" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Identifiant:</label>
                            <input type="text" class="form-control" name="username" >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe:</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="/connexion-licencie">Connexion Licencié</a>
                </div>

            </div>
        </div>
    </div>
</div>