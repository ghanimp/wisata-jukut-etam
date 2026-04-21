<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - Jukut Etam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>
<body>
<div class="auth-wrap">

    <!-- Panel Kiri (Branding) -->
    <div class="auth-left">
        <div class="left-brand">
            <div class="left-logo">🏊</div>
            <div class="left-title">Jukut Etam</div>
            <div class="left-sub">Samarinda · Kalimantan Timur</div>
        </div>
        <div class="left-mid">
            <div class="left-tagline">Selamat datang di <span>surga kolam renang</span> Samarinda</div>
            <div class="left-desc">
                Masuk untuk menikmati fitur lengkap — unggah foto, tulis ulasan,
                dan simpan momen berharga kamu di Jukut Etam.
            </div>
        </div>
        <div class="left-chips">
            <div class="info-chip">
                <div class="info-chip-icon">🎟️</div>
                <div class="info-chip-text"><strong>Rp 20.000</strong>Tiket masuk per orang</div>
            </div>
            <div class="info-chip">
                <div class="info-chip-icon">🕐</div>
                <div class="info-chip-text"><strong>09.00 – 17.30 WITA</strong>Buka setiap hari</div>
            </div>
            <div class="info-chip">
                <div class="info-chip-icon">📍</div>
                <div class="info-chip-text"><strong>Samarinda, Kaltim</strong>Jl. Pahlawan No.45</div>
            </div>
        </div>
    </div>

    <!-- Panel Kanan (Form) -->
    <div class="auth-right">
        <a href="<?= BASE_URL ?>/index.php?c=home&m=index" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke beranda
        </a>

        <!-- Tab Login / Daftar -->
        <div class="auth-tab-row">
            <button class="auth-tab <?= ($activeTab ?? 'login') === 'login' ? 'active' : '' ?>"
                    onclick="switchTab('login')" id="tab-login">Masuk</button>
            <button class="auth-tab <?= ($activeTab ?? 'login') === 'register' ? 'active' : '' ?>"
                    onclick="switchTab('register')" id="tab-register">Daftar</button>
        </div>

        <!-- Tempat form login & register akan dimasukkan -->