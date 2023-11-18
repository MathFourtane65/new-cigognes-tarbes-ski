<?php require_once('components/header.php'); ?>
<?php require_once('components/navbar.php'); ?>

<head>
    <!-- Méta-tag viewport essentiel pour le responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <title>Espace Administrateur</title> -->
    <link rel="stylesheet" href="/css/view/phototequePage.css">


</head>

<h1>PHOTOTEQUE</h1>


<body>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque1">
                <img src="/images/phototeque/photo1.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque1"/>
            </a>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque2">
                <img src="/images/phototeque/photo2.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque2"/>
            </a>
        </div>


        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque3">
                <img src="/images/phototeque/photo3.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque3"/>
            </a>
        </div>


        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque4">
                <img src="/images/phototeque/photo4.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque4"/>
            </a>
        </div>


        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque5">
                <img src="/images/phototeque/photo5.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque5"/>
            </a>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque6">
                <img src="/images/phototeque/photo6.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque6"/>
            </a>
        </div>


        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <a href="" class="thumbnail" data-bs-toggle="modal" data-bs-target="#phototeque7">
                <img src="/images/phototeque/photo7.jpg" class="img-fluid img-gallery-thumbnail" alt="phototeque7"/>
            </a>
        </div>


        <!-- Modal for image preview -->
        <div class="modal fade" id="phototeque1" tabindex="-1" aria-labelledby="phototequeLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo1.jpg" class="img-fluid img-modal-full" alt="Photo 1 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque2" tabindex="-1" aria-labelledby="phototequeLabel2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo2.jpg" class="img-fluid img-modal-full" alt="Photo 2 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque3" tabindex="-1" aria-labelledby="phototequeLabel3" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo3.jpg" class="img-fluid img-modal-full" alt="Photo 3 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque4" tabindex="-1" aria-labelledby="phototequeLabel4" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo4.jpg" class="img-fluid img-modal-full" alt="Photo 4 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque5" tabindex="-1" aria-labelledby="phototequeLabel5" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo5.jpg" class="img-fluid img-modal-full" alt="Photo 5 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque6" tabindex="-1" aria-labelledby="phototequeLabel6" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo6.jpg" class="img-fluid img-modal-full" alt="Photo 6 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="phototeque7" tabindex="-1" aria-labelledby="phototequeLabel7" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="/images/phototeque/photo7.jpg" class="img-fluid img-modal-full" alt="Photo 7 de la Phototèque"/>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
</body>


<?php require_once('components/footer.php'); ?>