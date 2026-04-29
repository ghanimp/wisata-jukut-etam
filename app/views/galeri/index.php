<section class="hero-galeri animate-fadeIn">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn hero-label">Visual & Estetika</span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair hero-title">Galeri Jukut Etam</h1>
        <div class="animate-fadeIn hero-divider"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto hero-desc">
            Jelajahi keindahan lanskap, kelengkapan fasilitas, dan momen berharga yang terabadikan.
        </p>
    </div>

    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="wave-svg">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                fill="#fdfaf5"></path>
        </svg>
    </div>
</section>

<div class="galeri-bg">
    <div class="container animate-fadeIn">

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
            <div class="row justify-content-center mb-5 upload-section">
                <div class="col-lg-10">
                    <div class="premium-form-card">
                        <div class="text-center mb-4">
                            <h3 class="playfair fw-bold form-title">Bagikan Momen Anda</h3>
                            <p class="text-muted">Unggah foto keseruan Anda saat berkunjung untuk ditampilkan di galeri
                                publik.<br>
                                <small class="text-warning"><i class="fas fa-info-circle"></i> Foto akan ditampilkan setelah
                                    disetujui admin.</small>
                            </p>
                        </div>

                        <form method="POST" action="<?= BASE_URL ?>/index.php?c=galeri&m=upload"
                            enctype="multipart/form-data">
                            <div class="row g-4 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Judul Foto</label>
                                    <input type="text" name="judul_foto" class="form-control bg-light p-3 form-input"
                                        placeholder="Misal: Keseruan Mancing" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Pilih Gambar</label>
                                    <input type="file" name="gambar" class="form-control bg-light p-3 form-input"
                                        accept=".jpg,.jpeg,.png" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Deskripsi Singkat</label>
                                    <input type="text" name="deskripsi" class="form-control bg-light p-3 form-input"
                                        placeholder="Opsional...">
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn-gold-solid px-5">
                                        <i class="fas fa-cloud-upload-alt me-2"></i> Unggah Foto Ke Galeri
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- NOTIFIKASI SUKSES UPLOAD -->
            <?php $flash = $this->getFlash(); ?>
            <?php if ($flash && $flash['type'] == 'success'): ?>
                <div id="notifGaleri" class="notif-galeri-success">
                    <div class="notif-galeri-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notif-galeri-content">
                        <h5>Foto Berhasil Diunggah! 📸</h5>
                        <p><?= $flash['message'] ?></p>
                        <small>Foto kamu akan ditampilkan setelah disetujui admin.</small>
                    </div>
                    <button class="notif-galeri-close" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="text-center mb-5 pt-4">
            <span class="text-uppercase fw-bold section-label">Eksplorasi</span>
            <h2 class="display-6 fw-bold mt-2 mb-4 playfair section-heading">Album Foto</h2>

            <div class="filter-wrapper">
                <button class="filter-btn-premium active" data-filter="all">Semua Foto</button>
                <button class="filter-btn-premium" data-filter="kolam">Kolam Renang</button>
                <button class="filter-btn-premium" data-filter="pemancingan">Pemancingan</button>
                <button class="filter-btn-premium" data-filter="fasilitas">Fasilitas</button>
                <button class="filter-btn-premium" data-filter="suasana">Suasana</button>
            </div>
        </div>

        <div class="galeri-masonry" id="galeriGrid">
            <?php foreach ($galeri as $foto): ?>
                <div class="galeri-item-col animate-fadeIn" data-kategori="<?= strtolower($foto['kategori']) ?>">
                    <div class="galeri-card"
                        onclick="openModal('<?= BASE_URL . '/' . $foto['gambar_url'] ?>', '<?= addslashes($foto['judul']) ?>', '<?= addslashes($foto['deskripsi']) ?>')">
                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>" alt="<?= $foto['judul'] ?>"
                            class="galeri-img">
                        <div class="galeri-overlay">
                            <span class="badge mb-2 px-3 py-2 rounded-pill galeri-badge"><?= $foto['kategori'] ?></span>
                            <h4 class="playfair fw-bold mb-1"><?= $foto['judul'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php foreach ($foto_user as $foto): ?>
                <div class="galeri-item-col animate-fadeIn" data-kategori="user">
                    <div class="galeri-card"
                        onclick="openModal('<?= BASE_URL . '/' . $foto['gambar_url'] ?>', '<?= addslashes($foto['judul_foto']) ?>', '<?= addslashes($foto['deskripsi']) ?> oleh <?= $foto['nama_user'] ?>')">
                        <div class="user-badge">
                            <i class="fas fa-camera-retro me-1 user-badge-icon"></i> <?= $foto['nama_user'] ?>
                        </div>
                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>" alt="<?= $foto['judul_foto'] ?>"
                            class="galeri-img">
                        <div class="galeri-overlay">
                            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Kontribusi Pengunjung</span>
                            <h4 class="playfair fw-bold mb-1"><?= $foto['judul_foto'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>

<!-- MODAL GALERI -->
<div class="modal fade" id="galeriModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0 justify-content-end p-0 mb-2">
                <button type="button" class="btn-close btn-close-white fs-4 shadow-none modal-close-btn"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img id="modalImage" src="" class="img-fluid rounded-4 shadow-lg w-100 modal-img">
                <div class="modal-info bg-white p-4 rounded-4 shadow-lg mx-auto">
                    <h3 id="modalTitle" class="playfair fw-bold mb-2 modal-title"></h3>
                    <p id="modalDesc" class="text-muted mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const filterButtons = document.querySelectorAll('.filter-btn-premium');
    const galeriItems = document.querySelectorAll('.galeri-item-col');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            const filterValue = button.getAttribute('data-filter');
            galeriItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-kategori') === filterValue) {
                    item.style.display = 'block';
                    item.classList.remove('animate-fadeIn');
                    void item.offsetWidth;
                    item.classList.add('animate-fadeIn');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    function openModal(imgUrl, title, desc) {
        document.getElementById('modalImage').src = imgUrl;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDesc').innerText = desc ? desc : "Tidak ada deskripsi.";
        new bootstrap.Modal(document.getElementById('galeriModal')).show();
    }

    setTimeout(function () {
        const notif = document.getElementById('notifGaleri');
        if (notif) {
            notif.style.animation = 'slideOutNotif 0.5s ease forwards';
            setTimeout(() => notif.remove(), 500);
        }
    }, 5000);
</script>