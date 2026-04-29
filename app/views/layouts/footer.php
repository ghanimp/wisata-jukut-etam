<!-- MODAL KONFIRMASI -->
<div id="confirmModal" class="modal-confirm-overlay">
    <div class="modal-confirm-box">
        <div class="modal-confirm-icon">
            <i class="fas fa-question-circle"></i>
        </div>
        <h4 id="confirmTitle">Konfirmasi</h4>
        <p id="confirmMessage">Apakah Anda yakin?</p>
        <div class="modal-confirm-buttons">
            <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
            <a id="confirmLink" href="#" class="btn-danger-confirm">Ya, Lanjutkan</a>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container pb-4">
        <div class="row g-5">
            <!-- Brand -->
            <div class="col-lg-5 text-center text-lg-start">
                <h4 class="footer-brand mb-4">
                    <span><i class="fas fa-fish me-2"></i>JUKUT ETAM</span>
                </h4>
                <p class="footer-desc mb-4">
                    Tempat berkumpul keluarga yang memadukan fasilitas kolam renang menyegarkan dan area pemancingan
                    yang asri.
                </p>
                <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-3">
                    <a href="https://facebook.com/jukutetam" target="_blank" class="social-btn">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://instagram.com/jukutetam" target="_blank" class="social-btn">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6285252898772" target="_blank" class="social-btn">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Tautan -->
            <div class="col-lg-3 col-md-6 text-center text-md-start">
                <h5 class="mb-4 text-white footer-heading">Tautan Cepat</h5>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                    <li><a href="<?= BASE_URL ?>/index.php?c=home&m=index" class="footer-link"><i
                                class="fas fa-angle-right me-2 small"></i>Beranda</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?c=home&m=tentang" class="footer-link"><i
                                class="fas fa-angle-right me-2 small"></i>Tentang</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?c=home&m=info" class="footer-link"><i
                                class="fas fa-angle-right me-2 small"></i>Fasilitas & Harga</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?c=galeri&m=index" class="footer-link"><i
                                class="fas fa-angle-right me-2 small"></i>Galeri Foto</a></li>
                    <li><a href="<?= BASE_URL ?>/index.php?c=home&m=ulasan" class="footer-link"><i
                                class="fas fa-angle-right me-2 small"></i>Ulasan Pengunjung</a></li>
                </ul>
            </div>

            <!-- Kunjungi Kami -->
            <div class="col-lg-4 col-md-6 text-center text-md-start">
                <h5 class="mb-4 text-white footer-heading">Kunjungi Kami</h5>
                <p class="small mb-3 footer-desc-text">
                    Dapatkan momen berharga bersama keluarga setiap akhir pekan di Jukut Etam. Lihat rute tercepat
                    melalui Google Maps.
                </p>
                <a href="https://maps.app.goo.gl/e4y2y8deHCUYZ5Nc7" target="_blank" class="btn-maps px-4 py-2 fw-bold">
                    <i class="fas fa-map-marker-alt me-2"></i> BUKA PETA LOKASI
                </a>
            </div>
        </div>

        <!-- 🔥 HR DI LUAR ROW -->
        <hr class="mt-5 mb-4 footer-divider">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small mb-0 footer-copy">
                    &copy; <?= date('Y') ?> <span class="fw-bold footer-copy-brand">Jukut Etam Samarinda</span>. Hak
                    Cipta Dilindungi.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <p class="small mb-0 footer-made">
                    Dibuat dengan <i class="fas fa-heart text-danger mx-1"></i> di Kalimantan Timur
                </p>
            </div>
        </div>
    </div>
</footer>

<script>
    function confirmAction(message, url) {
        document.getElementById('confirmMessage').innerText = message;
        document.getElementById('confirmLink').href = url;
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function closeConfirm() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    document.getElementById('confirmModal').addEventListener('click', function (e) {
        if (e.target === this) closeConfirm();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>