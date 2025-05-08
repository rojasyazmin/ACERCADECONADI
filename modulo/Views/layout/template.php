<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONADI</title>

    <!-- Bootstrap & Iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('css/style.css'); ?>" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
</head>

<body>

    <?php if (session()->has( 'user_id')): ?>
        <div class="sidebar-overlay m-5" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        <?= view('layout/sidebar') ?>

        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001f3f; z-index: 1030;">
            <div class="container-fluid d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-center">
                <!-- Logo y botón hamburguesa -->
                <div class="d-flex flex-column align-items-start">
                    <a class="navbar-brand" href="<?= base_url('home') ?>">RED CONADI</a>
                    <button class="btn btn-outline-primary d-md-none m-2" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>

                </div>

                <!-- Usuario y logout a la derecha siempre -->
                <div class="d-flex align-items-center ms-auto mt-2 mt-lg-0">
                    <span class="me-3 fw-bold text-white">
                        <i class="bi bi-person-circle"></i> <?= session('user_name'); ?>
                    </span>
                    <?php if (session('is_admin')): ?>
                        <span class="badge bg-secondary me-3">Admin</span>
                    <?php else: ?>
                        <span class="badge bg-info text-dark me-3">Investigador</span>
                    <?php endif; ?>
                    <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                    </a>
                </div>
            </div>
        </nav>

    <?php endif; ?>


    <?php
    $currentUri = service('uri')->getSegment(1);
    $isAuthPage = in_array($currentUri, ['login', 'register', 'password-request']);
    ?>

    <div class="<?= $isAuthPage ? 'd-flex justify-content-center align-items-center' : 'content-wrapper p-4'; ?>"
        style="<?= $isAuthPage ? 'min-height: 100vh;' : ''; ?>">
        <?= $this->renderSection('content'); ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
            <div class="toast fade align-items-center text-bg-primary border-0" role="alert" data-bs-autohide="true"
                data-bs-delay="3000">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ponentes').select2({
                placeholder: "Selecciona ponentes",
                allowClear: true
            });
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-wrapper');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }


        const toastEl = document.querySelector('.toast');
        if (toastEl) {
            const bsToast = new bootstrap.Toast(toastEl);
            bsToast.show();
        }

    </script>

</body>

</html>