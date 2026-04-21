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
        <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>/index.php?c=home&m=index">
            <i class="fas fa-fish me-2"></i>
            <strong>Jukut Etam</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <?php 
                $current_c = $_GET['c'] ?? 'home';
                $current_m = $_GET['m'] ?? 'index';
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
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3 dropdown">
                        <a class="nav-link dropdown-toggle btn btn-outline-light px-3 py-1 rounded-pill" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="far fa-user-circle me-1"></i> <?= $_SESSION['username'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?c=admin&m=dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= BASE_URL ?>/index.php?c=user&m=profile"><i class="fas fa-user me-2"></i>Profil Saya</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>/index.php?c=auth&m=logout"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                        </ul>
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