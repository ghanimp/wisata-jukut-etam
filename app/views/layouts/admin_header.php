<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Admin Panel' ?> - Jukut Etam</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Admin External -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fas fa-fish"></i>
        </div>
        <div>
            <h4>JUKUT ETAM</h4>
            <small>Admin Panel</small>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <div class="sidebar-section-title">MENU UTAMA</div>
        
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=dashboard" class="<?= ($active_menu ?? '') == 'dashboard' ? 'active-menu' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri" class="<?= ($active_menu ?? '') == 'galeri' ? 'active-menu' : '' ?>">
            <i class="fas fa-images"></i> <span>Kelola Galeri</span>
        </a>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=ulasan" class="<?= ($active_menu ?? '') == 'ulasan' ? 'active-menu' : '' ?>">
            <i class="fas fa-comments"></i> <span>Kelola Ulasan</span>
        </a>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitas" class="<?= ($active_menu ?? '') == 'fasilitas' ? 'active-menu' : '' ?>">
            <i class="fas fa-chair"></i> <span>Kelola Fasilitas</span>
        </a>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=harga" class="<?= ($active_menu ?? '') == 'harga' ? 'active-menu' : '' ?>">
            <i class="fas fa-tags"></i> <span>Kelola Harga</span>
        </a>
        
        <div class="sidebar-section-title">PENGATURAN</div>
        
        <a href="<?= BASE_URL ?>/index.php?c=auth&m=logout" class="text-danger">
            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
        </a>
    </div>
</div>

<div class="content">
    <div class="navbar-top">
        <div class="datetime">
            <i class="fas fa-calendar-alt me-1"></i>
            <span id="tanggal"></span> 
            <span class="mx-2 text-muted">|</span> 
            <i class="fas fa-clock me-1"></i> 
            <span id="jam"></span>
        </div>
        
        <div class="admin-badge">
            <div class="icon-box">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="d-none d-md-block ms-1">
                <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1;">Administrator</div>
                <div class="text-muted" style="font-size: 0.7rem;"><?= $_SESSION['username'] ?? 'Admin Jukut Etam' ?></div>
            </div>
        </div>
    </div>