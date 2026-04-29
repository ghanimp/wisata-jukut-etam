<?php
$inisial = strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1));
$jml_ulasan = count($ulasan_saya ?? []);
$jml_foto = count($foto_saya ?? []);
$jml_pemesanan = count($riwayat_pemesanan ?? []);
?>

<!-- HERO -->
<section class="prof-hero">
    <div class="prof-avatar"><?= $inisial ?></div>
    <div class="prof-name"><?= htmlspecialchars($user['username']) ?></div>
    <div class="prof-email"><?= htmlspecialchars($user['email'] ?? '') ?></div>
</section>

<!-- BODY -->
<div class="prof-wrap">
    <div class="prof-container">
        <div class="prof-grid">

            <!-- SIDEBAR -->
            <div class="prof-sidebar-sticky">

                <!-- Info Akun -->
                <div class="pcard">
                    <div class="pcard-head pcard-head-click" onclick="toggleAkun()">
                        <div class="pcard-head-icon"><i class="fas fa-user"></i></div>
                        <span class="pcard-head-title">Informasi Akun</span>
                        <i class="fas fa-chevron-down ms-auto akun-chevron"></i>
                    </div>
                    <div id="akun-body" class="pcard-body" style="display:none;">
                        <div class="info-list">
                            <div class="info-row">
                                <div class="info-label">Username</div>
                                <div class="info-val"><?= htmlspecialchars($user['username']) ?></div>
                            </div>
                            <hr class="info-divider">
                            <div class="info-row">
                                <div class="info-label">Email</div>
                                <div class="info-val email-val"><?= htmlspecialchars($user['email'] ?? '') ?></div>
                            </div>
                            <hr class="info-divider">
                            <div class="info-row">
                                <div class="info-label">Bergabung Sejak</div>
                                <div class="info-val"><?= date('d M Y', strtotime($user['created_at'])) ?></div>
                            </div>
                            <hr class="info-divider">
                            <div class="info-row">
                                <div class="info-label">Role</div>
                                <div class="info-val">
                                    <span class="role-badge">User</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nav Tabs -->
                <div class="pcard">
                    <div class="pcard-head">
                        <div class="pcard-head-icon"><i class="fas fa-layer-group"></i></div>
                        <span class="pcard-head-title">Riwayat Saya</span>
                    </div>
                    <div class="nav-tabs-wrap">
                        <button class="nav-tab-btn active" onclick="switchTab('ulasan', this)">
                            <i class="fas fa-star"></i> Ulasan
                            <span class="tab-count"><?= $jml_ulasan ?></span>
                        </button>
                        <button class="nav-tab-btn" onclick="switchTab('foto', this)">
                            <i class="fas fa-camera"></i> Foto
                            <span class="tab-count"><?= $jml_foto ?></span>
                        </button>
                        <button class="nav-tab-btn" onclick="switchTab('pemesanan', this)">
                            <i class="fas fa-ticket-alt"></i> Pemesanan
                            <span class="tab-count"><?= $jml_pemesanan ?></span>
                        </button>
                    </div>
                    <div class="logout-wrap">
                        <a href="#"
                            onclick="event.preventDefault(); confirmAction('Yakin ingin logout?', '<?= BASE_URL ?>/index.php?c=auth&m=logout')"
                            class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </div>

            </div>

            <!-- MAIN CONTENT -->
            <!-- MAIN CONTENT -->
            <div class="prof-main-area">

                <!-- TAB: Ulasan -->
                <div id="tab-ulasan" class="tab-panel active pcard">
                    <div class="pcard-head">
                        <div class="pcard-head-icon"><i class="fas fa-star"></i></div>
                        <span class="pcard-head-title">Riwayat Ulasan</span>
                    </div>
                    <div class="pcard-body">
                        <?php if ($jml_ulasan > 0): ?>
                            <?php foreach ($ulasan_saya as $ulas): ?>
                                <div class="ulasan-item">
                                    <div class="ulasan-stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $ulas['rating'] ? 'star-on' : 'star-off' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="ulasan-text">"<?= htmlspecialchars($ulas['ulasan']) ?>"</p>
                                    <div class="ulasan-meta">
                                        <i class="far fa-calendar-alt"></i>
                                        <?= date('d M Y', strtotime($ulas['tanggal'] ?? $ulas['created_at'])) ?>
                                        <span class="sbadge sbadge-<?= $ulas['status'] ?>">
                                            <?= $ulas['status'] == 'menunggu' ? 'Menunggu' : ($ulas['status'] == 'disetujui' ? 'Disetujui' : 'Ditolak') ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-comment-slash"></i>
                                <p>Belum ada ulasan yang diberikan.</p>
                                <a href="<?= BASE_URL ?>/index.php?c=home&m=ulasan" class="btn-gold-sm">
                                    <i class="fas fa-pen"></i> Beri Ulasan
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- TAB: Foto -->
                <div id="tab-foto" class="tab-panel pcard">
                    <div class="pcard-head">
                        <div class="pcard-head-icon"><i class="fas fa-camera"></i></div>
                        <span class="pcard-head-title">Riwayat Foto</span>
                    </div>
                    <div class="pcard-body">
                        <?php if ($jml_foto > 0): ?>
                            <div class="foto-grid">
                                <?php foreach ($foto_saya as $foto): ?>
                                    <div class="foto-item">
                                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>"
                                            alt="<?= htmlspecialchars($foto['judul_foto']) ?>">
                                        <div class="foto-overlay">
                                            <div class="foto-judul"><?= htmlspecialchars($foto['judul_foto']) ?></div>
                                            <span class="sbadge sbadge-<?= $foto['status'] ?>">
                                                <?= $foto['status'] == 'menunggu' ? 'Menunggu' : ($foto['status'] == 'disetujui' ? 'Disetujui' : 'Ditolak') ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-image"></i>
                                <p>Belum ada foto yang diunggah.</p>
                                <a href="<?= BASE_URL ?>/index.php?c=galeri&m=index" class="btn-gold-sm">
                                    <i class="fas fa-upload"></i> Upload Foto
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- TAB: Pemesanan -->
                <div id="tab-pemesanan" class="tab-panel pcard">
                    <div class="pcard-head">
                        <div class="pcard-head-icon"><i class="fas fa-ticket-alt"></i></div>
                        <span class="pcard-head-title">Riwayat Pemesanan</span>
                    </div>
                    <div class="pcard-body-table">
                        <?php if (!empty($riwayat_pemesanan) && $jml_pemesanan > 0): ?>
                            <table class="pesan-table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tgl Kunjungan</th>
                                        <th>Tiket</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>QR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($riwayat_pemesanan as $pesan): ?>
                                        <tr>
                                            <td data-label="Kode"><span
                                                    class="kode-pesan"><?= htmlspecialchars($pesan['kode_pemesanan']) ?></span>
                                            </td>
                                            <td data-label="Tgl Kunjungan">
                                                <?= date('d M Y', strtotime($pesan['tanggal_kunjungan'])) ?>
                                            </td>
                                            <td data-label="Tiket"><?= $pesan['jumlah_tiket'] ?> orang</td>
                                            <td data-label="Total"><span class="pesan-total">Rp
                                                    <?= number_format($pesan['total_harga'], 0, ',', '.') ?></span></td>
                                            <td data-label="Status">
                                                <?php
                                                $statusMap = [
                                                    'pending' => ['label' => '⏳ Pending', 'class' => 'sbadge-pending'],
                                                    'confirmed' => ['label' => '✅ Confirmed', 'class' => 'sbadge-lunas'],
                                                    'used' => ['label' => '🎉 Used', 'class' => 'sbadge-lunas'],
                                                    'cancelled' => ['label' => '❌ Cancelled', 'class' => 'sbadge-batal'],
                                                ];
                                                $s = $statusMap[$pesan['status']] ?? ['label' => $pesan['status'], 'class' => 'sbadge-pending'];
                                                ?>
                                                <span class="sbadge <?= $s['class'] ?>"><?= $s['label'] ?></span>
                                            </td>
                                            <td data-label="QR">
                                                <img class="qr-thumb"
                                                    src="https://api.qrserver.com/v1/create-qr-code/?size=60x60&data=<?= urlencode($pesan['kode_pemesanan']) ?>"
                                                    onclick="bukaQR('<?= $pesan['kode_pemesanan'] ?>', '<?= date('d M Y', strtotime($pesan['tanggal_kunjungan'])) ?>', <?= $pesan['jumlah_tiket'] ?>)"
                                                    alt="QR" title="Klik untuk perbesar">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-ticket-alt"></i>
                                <p>Belum ada riwayat pemesanan tiket.</p>
                                <a href="<?= BASE_URL ?>/index.php?c=home&m=info" class="btn-gold-sm">
                                    <i class="fas fa-shopping-cart"></i> Pesan Tiket
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <!-- END MAIN -->

        </div>
    </div>
</div>

<!-- QR MODAL -->
<div class="qr-modal" id="qrModal" onclick="tutupQR()">
    <div class="qr-modal-inner" onclick="event.stopPropagation()">
        <img id="qrModalImg" class="qr-modal-img" src="" alt="QR Code">
        <div class="qr-modal-kode" id="qrModalKode"></div>
        <div class="qr-modal-info" id="qrModalInfo"></div>
        <button class="qr-modal-close" onclick="tutupQR()">
            <i class="fas fa-times me-1"></i> Tutup
        </button>
    </div>
</div>

<script>
    function switchTab(tabName, btn) {
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.nav-tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + tabName).classList.add('active');
        btn.classList.add('active');
    }

    function toggleAkun() {
        const body = document.getElementById('akun-body');
        const chevron = document.querySelector('.akun-chevron');
        const isOpen = body.style.display !== 'none';
        body.style.display = isOpen ? 'none' : 'block';
        chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    function bukaQR(kode, tanggal, jumlah) {
        document.getElementById('qrModalImg').src =
            'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=' + encodeURIComponent(kode);
        document.getElementById('qrModalKode').innerText = kode;
        document.getElementById('qrModalInfo').innerText = tanggal + ' · ' + jumlah + ' tiket';
        document.getElementById('qrModal').style.display = 'flex';
    }

    function tutupQR() {
        document.getElementById('qrModal').style.display = 'none';
    }
</script>