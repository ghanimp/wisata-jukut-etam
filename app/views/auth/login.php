<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Jukut Etam</title>
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

        <!-- Tab Login / Register -->
        <div class="auth-tab-row">
            <button class="auth-tab <?= ($activeTab ?? 'login') === 'login' ? 'active' : '' ?>" onclick="showLogin()" id="btn-login">Masuk</button>
            <button class="auth-tab <?= ($activeTab ?? 'login') === 'register' ? 'active' : '' ?>" onclick="showRegister()" id="btn-register">Daftar</button>
        </div>

        <!-- ========== FORM LOGIN ========== -->
        <div id="form-login" style="<?= ($activeTab ?? 'login') === 'login' ? 'display: block;' : 'display: none;' ?>">
            <div class="auth-form-title">Selamat datang!</div>
            <div class="auth-form-sub">Masuk ke akun kamu untuk melanjutkan</div>

            <?php if(isset($flash) && $flash): ?>
                <div class="<?= $flash['type'] == 'danger' ? 'flash-danger' : 'flash-success' ?>">
                    <i class="bi bi-<?= $flash['type'] == 'danger' ? 'exclamation-circle' : 'check-circle' ?>"></i>
                    <?= $flash['message'] ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/index.php?c=auth&m=login">
                <div class="input-wrap">
                    <i class="bi bi-person"></i>
                    <input type="text" name="username" class="auth-input" placeholder="Username" required>
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="auth-input" placeholder="Password" required>
                </div>
                <div class="forgot-link">
                    <a href="#">Lupa password?</a>
                </div>
                <button type="submit" class="btn-auth">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
                </button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-text">atau</div>
                <div class="divider-line"></div>
            </div>

            <a href="<?= BASE_URL ?>/index.php?c=home&m=index">
                <button type="button" class="btn-tamu">
                    <i class="bi bi-eye me-1"></i> Lanjut sebagai Tamu
                </button>
            </a>
        </div>

        <!-- ========== FORM REGISTER ========== -->
        <div id="form-register" style="<?= ($activeTab ?? 'login') === 'register' ? 'display: block;' : 'display: none;' ?>">
            <div class="auth-form-title">Buat akun baru</div>
            <div class="auth-form-sub">Gratis, mudah, langsung bisa dipakai!</div>

            <?php if(isset($flash_register) && $flash_register): ?>
                <div class="<?= $flash_register['type'] == 'danger' ? 'flash-danger' : 'flash-success' ?>">
                    <i class="bi bi-<?= $flash_register['type'] == 'danger' ? 'exclamation-circle' : 'check-circle' ?>"></i>
                    <?= $flash_register['message'] ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/index.php?c=auth&m=register">
                <div class="input-wrap">
                    <i class="bi bi-person"></i>
                    <input type="text" name="username" class="auth-input" placeholder="Username" required>
                </div>
                <div class="input-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" class="auth-input" placeholder="Email" required>
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="auth-input" placeholder="Password (min. 6 karakter)" required>
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="konfirmasi_password" class="auth-input" placeholder="Konfirmasi password" required>
                </div>
                <button type="submit" class="btn-auth">
                    <i class="bi bi-person-plus"></i> Buat Akun
                </button>
            </form>

            <div class="switch-link">
                Sudah punya akun?
                <a href="#" onclick="showLogin(); return false;">Masuk sekarang</a>
            </div>
        </div>
    </div>
</div>

<script>
    function showLogin() {
        document.getElementById('form-login').style.display = 'block';
        document.getElementById('form-register').style.display = 'none';
        document.getElementById('btn-login').classList.add('active');
        document.getElementById('btn-register').classList.remove('active');
    }
    
    function showRegister() {
        document.getElementById('form-login').style.display = 'none';
        document.getElementById('form-register').style.display = 'block';
        document.getElementById('btn-login').classList.remove('active');
        document.getElementById('btn-register').classList.add('active');
    }
</script>
</body>
</html>