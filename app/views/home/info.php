<!-- ===== HERO ===== -->
<section class="hero-info position-relative">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn hero-label">Informasi Tarif Jukut Etam</span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair hero-page-title">Fasilitas & Harga</h1>
        <div class="animate-fadeIn hero-divider"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto hero-page-desc">Transparansi harga untuk pengalaman liburan Anda yang
            tak terlupakan.</p>
    </div>
    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none"
            style="display:block;width:calc(100% + 1.3px);height:40px;">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                fill="#FDFAF5"></path>
        </svg>
    </div>
</section>

<!-- ===== INFO HARGA ===== -->
<div class="fasilitas-wrapper" id="vue-info-app">
    <div class="container">

        <!-- Section Title -->
        <div class="section-divider-info mb-4">
            <h2>Daftar Harga</h2>
            <div class="section-divider-line"></div>
        </div>

        <div class="row g-4 mb-5">
            <!-- Kolam Renang -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-swimmer me-2"></i> Kolam Renang
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataKolam" :key="'kolam-'+index">
                            <span class="fw-500">{{ row.hari }}</span>
                            <span class="price-text">Rp{{ formatRupiah(row.harga) }} <small
                                    class="text-muted fw-normal">/org</small></span>
                        </li>
                        <li class="list-group-item bg-light">
                            <span><i class="far fa-clock me-2 clock-icon"></i> Jam Operasional</span>
                            <span class="fw-bold jam-text">08:00 – 17:30 WITA</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Pemancingan -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-fish me-2"></i> Tarif Pemancingan
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataPemancingan" :key="'pancing-'+index">
                            <span class="fw-500">{{ row.nama }}</span>
                            <span class="price-text">{{ row.harga }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sewa Fasilitas -->
            <div class="col-12">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-umbrella-beach me-2"></i> Sewa Alat & Fasilitas
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataSewa" :key="'sewa-'+index">
                            <span class="fw-500"><i class="fas fa-check-circle me-2 check-icon"></i>{{
                                row.nama_fasilitas }}</span>
                            <span class="price-text">{{ row.harga }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="info-box-premium info-box-blue">
                    <h5 class="playfair mb-3 info-box-title-blue">
                        <i class="fas fa-credit-card me-2 info-box-icon"></i> Metode Pembayaran
                    </h5>
                    <p class="mb-0 text-muted info-box-desc">
                        Menerima <strong class="text-dark">Uang Tunai</strong> dan <strong class="text-dark">QRIS /
                            Transfer Bank</strong>.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box-premium info-box-green">
                    <h5 class="playfair mb-3 info-box-title-green">
                        <i class="fas fa-fish me-2 info-box-icon"></i> Sewa Alat Pancing
                    </h5>
                    <p class="mb-0 text-muted info-box-desc">
                        Tersedia sewa joran pancing lengkap termasuk kail, umpan racikan, dan ember.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section Title Pemesanan -->
        <div class="section-divider-info mb-4">
            <h2>Pesan Tiket</h2>
            <div class="section-divider-line"></div>
        </div>

        <!-- ===== FORM PEMESANAN ===== -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="pemesanan-card">
                    <div class="row g-0">
                        <!-- Kiri Info -->
                        <div class="col-md-5 pemesanan-left">
                            <div class="pemesanan-left-content">
                                <span class="badge bg-gold text-dark mb-4 px-3 py-2 rounded-pill tiket-badge">
                                    <i class="fas fa-tag me-1"></i> Tiket Masuk Resmi
                                </span>
                                <h3 class="playfair fw-bold mb-3 pemesanan-title">Siap Liburan<br>di Jukut Etam?</h3>
                                <p class="mb-4 pemesanan-desc">Pesan tiket sekarang, dapatkan QR code digital, dan
                                    langsung masuk tanpa antri panjang!</p>

                                <div class="pemesanan-highlights">
                                    <div class="text-center">
                                        <div class="highlight-value">Rp15-20K</div>
                                        <small class="highlight-label">/orang</small>
                                    </div>
                                    <div class="text-center">
                                        <div class="highlight-value">08:00</div>
                                        <small class="highlight-label">s/d 17:30</small>
                                    </div>
                                    <div class="text-center">
                                        <div class="highlight-value">QR</div>
                                        <small class="highlight-label">Tiket Digital</small>
                                    </div>
                                </div>

                                <hr class="pemesanan-divider">

                                <div class="pemesanan-features">
                                    <div class="pemesanan-feature-item"><i
                                            class="fas fa-check-circle me-2 feature-check"></i> Tiket digital via QR
                                        code</div>
                                    <div class="pemesanan-feature-item"><i
                                            class="fas fa-check-circle me-2 feature-check"></i> Weekday 15K | Weekend
                                        20K</div>
                                    <div class="pemesanan-feature-item"><i
                                            class="fas fa-check-circle me-2 feature-check"></i> Tutup setiap hari Senin
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan Form -->
                        <div class="col-md-7 bg-white">
                            <div class="pesan-form-wrap">
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
                                    <div class="pesan-section-title">
                                        <i class="fas fa-ticket-alt"></i> Form Pemesanan Tiket
                                    </div>

                                    <form method="POST" action="<?= BASE_URL ?>/index.php?c=home&m=pesanTiket"
                                        id="formPesan">
                                        <div class="form-group-custom">
                                            <label class="form-label-custom">Tanggal Kunjungan</label>
                                            <input type="date" name="tanggal" id="tanggalPesan" class="form-input-custom"
                                                min="<?= date('Y-m-d') ?>" required onchange="updateTotal()">
                                            <small id="warningTutup" class="text-danger mt-1" style="display:none;">
                                                <i class="fas fa-exclamation-circle me-1"></i> Jukut Etam tutup setiap hari
                                                Senin. Pilih tanggal lain.
                                            </small>
                                        </div>

                                        <div class="form-group-custom">
                                            <label class="form-label-custom">Jumlah Tiket (maks. 10)</label>
                                            <div class="tiket-counter">
                                                <button type="button" class="counter-btn" onclick="kurangTiket()"><i
                                                        class="fas fa-minus"></i></button>
                                                <input type="number" name="jumlah" id="jumlahTiket" class="counter-input"
                                                    value="1" min="1" max="10" readonly required>
                                                <button type="button" class="counter-btn" onclick="tambahTiket()"><i
                                                        class="fas fa-plus"></i></button>
                                            </div>
                                        </div>

                                        <div class="total-box">
                                            <div>
                                                <div class="total-label">Total Harga</div>
                                                <small class="total-detail">
                                                    <span id="hargaPerTiket">Rp 15.000</span> × <span
                                                        id="jumlahLabel">1</span> tiket
                                                </small>
                                                <small class="text-muted d-block mt-1" style="font-size:0.7rem;">
                                                    <i class="fas fa-info-circle me-1"></i> Weekday 15K | Weekend 20K |
                                                    Senin Tutup
                                                </small>
                                            </div>
                                            <div class="total-value" id="totalHarga">Rp 15.000</div>
                                        </div>

                                        <button type="submit" class="btn-pesan" id="btnPesan">
                                            <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                                        </button>
                                    </form>

                                <?php elseif (!isset($_SESSION['user_id'])): ?>
                                    <div class="login-required">
                                        <i class="fas fa-lock"></i>
                                        <h5>Login untuk Memesan</h5>
                                        <p>Silakan login terlebih dahulu untuk melakukan pemesanan tiket masuk Jukut Etam.
                                        </p>
                                        <a href="<?= BASE_URL ?>/index.php?c=auth&m=login" class="btn-login-required">
                                            <i class="fas fa-sign-in-alt"></i> Login Sekarang
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="login-required">
                                        <i class="fas fa-user-shield"></i>
                                        <h5>Mode Admin</h5>
                                        <p>Admin tidak dapat melakukan pemesanan tiket.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 🔥 NOTIFIKASI PEMESANAN -->
<?php $flash = $this->getFlash(); ?>
<?php if ($flash && $flash['type'] == 'success'): ?>
    <div id="notifPesan" class="notif-ulasan-success">
        <div class="notif-ulasan-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="notif-ulasan-content">
            <h5>Pemesanan Berhasil! 🎫</h5>
            <p><?= $flash['message'] ?></p>
            <small>Cek riwayat pemesanan untuk melihat QR Code.</small>
        </div>
        <button class="notif-ulasan-close" onclick="this.parentElement.remove()">×</button>
    </div>
<?php endif; ?>

<script>
    const HARGA_WEEKDAY = 15000;
    const HARGA_WEEKEND = 20000;

    function getHargaByTanggal(tanggal) {
        if (!tanggal) return HARGA_WEEKDAY;
        const date = new Date(tanggal + 'T00:00:00');
        const day = date.getDay();
        return (day === 0 || day === 6) ? HARGA_WEEKEND : HARGA_WEEKDAY;
    }

    function isSenin(tanggal) {
        if (!tanggal) return false;
        const date = new Date(tanggal + 'T00:00:00');
        return date.getDay() === 1;
    }

    function tambahTiket() {
        let input = document.getElementById('jumlahTiket');
        let val = parseInt(input.value);
        if (val < 10) { input.value = val + 1; updateTotal(); }
    }

    function kurangTiket() {
        let input = document.getElementById('jumlahTiket');
        let val = parseInt(input.value);
        if (val > 1) { input.value = val - 1; updateTotal(); }
    }

    function updateTotal() {
        const tanggal = document.getElementById('tanggalPesan').value;
        const warning = document.getElementById('warningTutup');
        const btnPesan = document.getElementById('btnPesan');

        // Cek hari Senin
        if (isSenin(tanggal)) {
            warning.style.display = 'block';
            btnPesan.disabled = true;
            btnPesan.style.opacity = '0.5';
            document.getElementById('totalHarga').innerText = '-';
            document.getElementById('hargaPerTiket').innerText = '-';
            return;
        } else {
            warning.style.display = 'none';
            btnPesan.disabled = false;
            btnPesan.style.opacity = '1';
        }

        let hargaPerTiket = getHargaByTanggal(tanggal);
        let jumlah = parseInt(document.getElementById('jumlahTiket').value);
        let total = jumlah * hargaPerTiket;

        document.getElementById('jumlahLabel').innerText = jumlah;
        document.getElementById('hargaPerTiket').innerText = 'Rp ' + hargaPerTiket.toLocaleString('id-ID');
        document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    // Validasi saat submit
    document.getElementById('formPesan')?.addEventListener('submit', function (e) {
        const tanggal = document.getElementById('tanggalPesan').value;
        if (isSenin(tanggal)) {
            e.preventDefault();
            alert('⚠️ Jukut Etam tutup setiap hari Senin. Silakan pilih tanggal lain.');
        }
    });

    updateTotal();
</script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const phpDataKolam = <?= json_encode($harga_kolam ?? []) ?>;
    const phpDataPemancingan = <?= json_encode($harga_pemancingan ?? []) ?>;
    const phpDataSewa = <?= json_encode($harga_sewa ?? []) ?>;

    const { createApp } = Vue;
    createApp({
        data() {
            return {
                dataKolam: phpDataKolam,
                dataPemancingan: phpDataPemancingan,
                dataSewa: phpDataSewa
            }
        },
        methods: {
            formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(Number(angka));
            }
        }
    }).mount('#vue-info-app');
</script>