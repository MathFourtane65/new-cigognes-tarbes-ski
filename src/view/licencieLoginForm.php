<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/view/licencieLoginForm.css">
    <title>Connexion Licencié</title>

</head>


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">



            <div class="card mt-5">

                <div class="card-footer text-center">
                    <a href="/">Retour à l'accueil</a>
                </div>

                <div class="card-header text-center">
                    <img src="/images/logo.png" class="img-fluid logo-form-conn-licencie" alt="Club Logo" />

                    <h3 class="titre">Connexion Licencié</h3>
                </div>

                <?php if (isset($_GET['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        if ($_GET['error'] == 'missing_fields') echo "Tous les champs sont obligatoires.";
                        if ($_GET['error'] == 'invalid_credentials') echo "Identifiant ou mot de passe incorrect.";
                        ?>
                    </div><?php endif; ?>

                <div class="card-body">
                    <form action="/login-licencie-process" method="post">
                        <div class="mb-3">
                            <label for="identifiant" class="form-label">Identifiant:</label>
                            <input type="text" class="form-control" name="identifiant" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="/connexion-admin">Connexion Administrateur</a>
                </div>

            </div>
        </div>
    </div>
</div>