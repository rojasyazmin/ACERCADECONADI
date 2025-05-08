<?php
/** @var \CodeIgniter\View\View $this */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RED CONADI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">
</head>

<body>

    <?php if (!session()->get('isLoggedIn')): ?>
        <!-- Navbar principal -->

        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f; z-index: 1030;">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url('/') ?>">RED CONADI</a>

                <!-- Botón hamburguesa -->
                <!-- Botón hamburguesa personalizado -->
                <button class="btn btn-outline-primary d-md-none m-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                <!-- Menú colapsable alineado a la derecha -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav text-end">
                        <li class="nav-item me-lg-3">
                            <a class="nav-link" href="<?= base_url('/') ?>">Inicio</a>
                        </li>
                        <li class="nav-item me-lg-3">
                            <a class="nav-link" href="<?= base_url('/acerca-de') ?>">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="<?= base_url('/login') ?>">Ingresar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


    <?php endif; ?>

    <!-- Contenido principal -->
    <div class="container" style="padding-top: 70px;">
        <?= $this->renderSection('content'); ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>