<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Admin Panel' ?> - Jukut Etam</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <img src="<?= BASE_URL ?>/assets/img/logojukut.png" alt="Jukut Etam">
            </div>
            <div>
                <h4>JUKUT ETAM</h4>
                <small>Admin Panel</small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="sidebar-section-title">MENU UTAMA</div>

            <a href="<?= BASE_URL ?>/index.php?c=admin&m=dashboard"
                class="sidebar-link <?= ($active_menu ?? '') == 'dashboard' ? 'active-menu' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri"
                class="sidebar-link <?= ($active_menu ?? '') == 'galeri' ? 'active-menu' : '' ?>">
                <i class="fas fa-images"></i> <span>Kelola Galeri</span>
            </a>
            <a href="<?= BASE_URL ?>/index.php?c=admin&m=ulasan"
                class="sidebar-link <?= ($active_menu ?? '') == 'ulasan' ? 'active-menu' : '' ?>">
                <i class="fas fa-comments"></i> <span>Kelola Ulasan</span>
            </a>
            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitas"
                class="sidebar-link <?= ($active_menu ?? '') == 'fasilitas' ? 'active-menu' : '' ?>">
                <i class="fas fa-chair"></i> <span>Kelola Fasilitas</span>
            </a>
            <a href="<?= BASE_URL ?>/index.php?c=admin&m=harga"
                class="sidebar-link <?= ($active_menu ?? '') == 'harga' ? 'active-menu' : '' ?>">
                <i class="fas fa-tags"></i> <span>Kelola Harga</span>
            </a>

            <div class="sidebar-section-title">PENGATURAN</div>

            <a href="#"
                onclick="event.preventDefault(); confirmAction('Yakin ingin logout?', '<?= BASE_URL ?>/index.php?c=auth&m=logout')"
                class="sidebar-link sidebar-logout">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- CONTENT -->
    <div class="content">
        <div class="navbar-top">
            <div class="navbar-top-left">
                <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="datetime">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="tanggal"></span>
                </div>
            </div>

            <div class="admin-badge">
                <div class="admin-icon-box">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="admin-info">
                    <div class="admin-role">Admin</div>
                </div>
            </div>
        </div>

        <!-- NOTIFIKASI -->
        <?php if (isset($_SESSION['flash']) && !empty($_SESSION['flash'])): ?>
            <div class="notif-alert notif-<?= $_SESSION['flash']['type'] ?>">
                <div class="notif-icon">
                    <?php if ($_SESSION['flash']['type'] == 'success'): ?><i class="fas fa-check-circle"></i>
                    <?php elseif ($_SESSION['flash']['type'] == 'error'): ?><i class="fas fa-times-circle"></i>
                    <?php elseif ($_SESSION['flash']['type'] == 'warning'): ?><i
                            class="fas fa-exclamation-triangle"></i><?php endif; ?>
                </div>
                <div class="notif-content">
                    <div class="notif-title">
                        <?= $_SESSION['flash']['type'] == 'success' ? 'Berhasil!' : ($_SESSION['flash']['type'] == 'error' ? 'Gagal!' : 'Perhatian!') ?>
                    </div>
                    <div class="notif-message"><?= $_SESSION['flash']['message'] ?></div>
                </div>
                <button class="notif-close" onclick="this.parentElement.remove()">×</button>
            </div>
            <?php unset($_SESSION['flash']); endif; ?>

        <!-- MODAL KONFIRMASI -->
        <div id="confirmModal" class="modal-confirm-overlay">
            <div class="modal-confirm-box">
                <div class="modal-confirm-icon"><i class="fas fa-question-circle"></i></div>
                <h4 id="confirmTitle">Konfirmasi</h4>
                <p id="confirmMessage">Apakah Anda yakin?</p>
                <div class="modal-confirm-buttons">
                    <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
                    <a id="confirmLink" href="#" class="btn-danger-confirm">Ya, Lanjutkan</a>
                </div>
            </div>
        </div>

        <script>
            function updateDateTime() {
                const now = new Date();
                const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                document.getElementById('tanggal').innerHTML = hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();
            }
            updateDateTime();

            function confirmAction(message, url) {
                document.getElementById('confirmMessage').innerText = message;
                document.getElementById('confirmLink').href = url;
                document.getElementById('confirmModal').style.display = 'flex';
            }
            function closeConfirm() { document.getElementById('confirmModal').style.display = 'none'; }
            document.getElementById('confirmModal').addEventListener('click', function (e) { if (e.target === this) closeConfirm(); });

            setTimeout(function () {
                const notif = document.querySelector('.notif-alert');
                if (notif) { notif.style.animation = 'slideOut 0.5s ease forwards'; setTimeout(() => notif.remove(), 500); }
            }, 4000);

            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('show');
                document.querySelector('.sidebar-overlay').classList.toggle('show');
            }
        </script>