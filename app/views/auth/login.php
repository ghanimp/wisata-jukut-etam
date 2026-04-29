<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – Jukut Etam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>

<body>

    <div class="auth-wrap">
        <div class="auth-left">
            <div class="left-brand">
                <div class="left-logo">
                    <img src="<?= BASE_URL ?>/assets/img/logojukut.png" alt="Jukut Etam">
                </div>
                <div class="left-title">Jukut Etam</div>
                <div class="left-sub">Samarinda · Kalimantan Timur</div>
            </div>
            <div class="left-mid">
                <div class="left-tagline">Selamat datang di <span>surga kolam renang</span> Samarinda</div>
                <div class="left-desc">Masuk untuk menikmati fitur lengkap — unggah foto, tulis ulasan, dan simpan momen
                    berharga kamu di Jukut Etam.</div>
            </div>
            <div class="left-chips">
                <div class="info-chip">
                    <div class="info-chip-text"><strong>🕐 08.00 – 17.30 WITA</strong>Selasa – Minggu (Senin tutup)
                    </div>
                </div>
                <div class="info-chip">
                    <div class="info-chip-text"><strong>📍 Mugirejo, Sungai Pinang</strong>Samarinda, Kaltim 75241</div>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-tab-row">
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=login" class="auth-tab active">Masuk</a>
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=register" class="auth-tab">Daftar</a>
            </div>

            <div class="auth-form-title">Selamat datang!</div>
            <div class="auth-form-sub">Masuk ke akun kamu untuk melanjutkan</div>

            <?php if (!empty($flash)): ?>
                <div class="flash-<?= $flash['type'] === 'danger' ? 'danger' : 'success' ?>">
                    <i class="bi bi-<?= $flash['type'] === 'danger' ? 'exclamation-circle' : 'check-circle' ?>"></i>
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/index.php?c=auth&m=login">
                <div class="input-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" class="auth-input" placeholder="Email" required
                        autocomplete="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="auth-input" placeholder="Password" required
                        autocomplete="current-password">
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

            <a href="<?= BASE_URL ?>/index.php?c=home&m=index" class="btn-tamu">
                <i class="bi bi-eye me-1"></i> Masuk Beranda Sebagai Tamu
            </a>

            <div class="switch-link">
                Belum punya akun?
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=register">Daftar sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>