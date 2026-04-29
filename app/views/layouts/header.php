<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jukut Etam - Kolam Renang & Pemancingan Samarinda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>/index.php?c=home&m=index">
                <div class="nav-logo">
                    <img src="<?= BASE_URL ?>/assets/img/logojukut.png" alt="Jukut Etam">
                </div>
                <strong>Jukut Etam</strong>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php
                    $current_c = $_GET['c'] ?? 'home';
                    $current_m = $_GET['m'] ?? 'index';
                    $isProfilPage = ($current_c == 'user' && $current_m == 'profile');
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_c == 'home' && $current_m == 'index') ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php?c=home&m=index">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_c == 'home' && $current_m == 'tentang') ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php?c=home&m=tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_c == 'home' && $current_m == 'info') ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php?c=home&m=info">Fasilitas & Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_c == 'galeri') ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php?c=galeri&m=index">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_c == 'home' && $current_m == 'ulasan') ? 'active' : '' ?>"
                            href="<?= BASE_URL ?>/index.php?c=home&m=ulasan">Ulasan</a>
                    </li>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link <?= $isProfilPage ? 'active' : '' ?>"
                                href="<?= $_SESSION['role'] == 'admin' ? BASE_URL . '/index.php?c=admin&m=dashboard' : BASE_URL . '/index.php?c=user&m=profile' ?>">
                                <i class="far fa-user-circle me-1"></i>
                                <?= $_SESSION['role'] == 'admin' ? 'Dashboard' : 'Profil' ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-custom px-4 py-2" href="<?= BASE_URL ?>/index.php?c=auth&m=login">
                                LOGIN
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($this)): ?>
        <?php $flash = $this->getFlash(); ?>
        <?php if ($flash): ?>
            <div id="notifGlobal" class="notif-ulasan-success <?= $flash['type'] == 'error' ? 'notif-error' : '' ?>"
                style="position:fixed; top:80px; right:24px; z-index:9999; min-width:320px; max-width:420px;">
                <div class="notif-ulasan-icon">
                    <i class="fas fa-<?= $flash['type'] == 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i>
                </div>
                <div class="notif-ulasan-content">
                    <h5><?= $flash['type'] == 'success' ? 'Berhasil! 🎉' : 'Gagal!' ?></h5>
                    <p><?= $flash['message'] ?></p>
                </div>
                <button class="notif-ulasan-close" onclick="this.parentElement.remove()">×</button>
            </div>
            <script>
                setTimeout(function () {
                    const notif = document.getElementById('notifGlobal');
                    if (notif) {
                        notif.style.opacity = '0';
                        notif.style.transition = 'opacity 0.5s';
                        setTimeout(() => notif.remove(), 500);
                    }
                }, 5000);
            </script>
        <?php endif; ?>
    <?php endif; ?>