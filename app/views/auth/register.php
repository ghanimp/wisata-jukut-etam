<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Jukut Etam</title>
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
                <div class="left-tagline">Bergabung dan nikmati <span>pengalaman wisata</span> terbaik</div>
                <div class="left-desc">Daftar sekarang dan dapatkan akses penuh — unggah foto, tulis ulasan, dan jadilah
                    bagian dari komunitas Jukut Etam.</div>
            </div>
            <div class="left-steps">
                <div class="steps-label">Cara daftar</div>
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">Isi username, email, dan password</div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">Klik tombol Buat Akun</div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">Login dan nikmati semua fitur!</div>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-tab-row">
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=login" class="auth-tab">Masuk</a>
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=register" class="auth-tab active">Daftar</a>
            </div>

            <div class="auth-form-title">Buat akun baru</div>
            <div class="auth-form-sub">Gratis, mudah, langsung bisa dipakai!</div>

            <?php if (!empty($flash)): ?>
                <div class="flash-<?= $flash['type'] === 'danger' ? 'danger' : 'success' ?>">
                    <i class="bi bi-<?= $flash['type'] === 'danger' ? 'exclamation-circle' : 'check-circle' ?>"></i>
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/index.php?c=auth&m=register">
                <div class="input-wrap">
                    <i class="bi bi-person"></i>
                    <input type="text" name="username" class="auth-input" placeholder="Username" required
                        autocomplete="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>
                <div class="input-wrap">
                    <i class="bi bi-envelope"></i>
                    <input type="email" name="email" class="auth-input" placeholder="Email" required
                        autocomplete="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="password" class="auth-input" placeholder="Password (min. 6 karakter)"
                        required autocomplete="new-password">
                </div>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="konfirmasi_password" class="auth-input"
                        placeholder="Konfirmasi password" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn-auth">
                    <i class="bi bi-person-plus"></i> Buat Akun
                </button>
            </form>

            <div class="switch-link">
                Sudah punya akun?
                <a href="<?= BASE_URL ?>/index.php?c=auth&m=login">Masuk sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>