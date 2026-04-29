<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-galeri-app" class="container-fluid pt-3 pb-5 px-md-4">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1 admin-heading"><i class="fas fa-images me-2 admin-heading-icon"></i> Kelola Galeri
            </h3>
            <p class="text-muted mb-0">Manajemen foto fasilitas dan dokumentasi pengunjung.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriTambah" class="btn-gold">
            <i class="fas fa-plus me-1"></i> Tambah Foto
        </a>
    </div>

    <div class="d-flex mb-4 border-bottom flex-wrap gap-2 align-items-center">
        <button @click="activeTab = 'admin'" :class="['tab-btn', { active: activeTab === 'admin' }]">
            <i class="fas fa-user-shield me-2"></i> Foto dari Admin
            <span class="tab-badge tab-badge-blue"><?= count($galeri) ?></span>
        </button>
        <button @click="activeTab = 'menunggu'" :class="['tab-btn', { active: activeTab === 'menunggu' }]">
            <i class="fas fa-clock me-2"></i> Menunggu Persetujuan
            <?php if (count($foto_user_menunggu) > 0): ?>
                <span class="tab-badge tab-badge-warning"><?= count($foto_user_menunggu) ?></span>
            <?php endif; ?>
        </button>
        <button @click="activeTab = 'disetujui'" :class="['tab-btn', { active: activeTab === 'disetujui' }]">
            <i class="fas fa-check-circle me-2"></i> Sudah Disetujui
            <span class="tab-badge tab-badge-green"><?= count($foto_user_disetujui) ?></span>
        </button>
    </div>

    <transition name="fade" mode="out-in">

        <!-- TAB ADMIN -->
        <div v-if="activeTab === 'admin'" key="admin">
            <?php if (empty($galeri)): ?>
                <div class="empty-state">
                    <i class="fas fa-image fa-3x mb-3 empty-state-icon"></i>
                    <p class="text-muted">Belum ada foto dari admin.</p>
                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriTambah" class="btn-gold mt-2">
                        <i class="fas fa-plus me-1"></i> Tambah Foto
                    </a>
                </div>
            <?php else: ?>
                <div class="admin-card">
                    <div class="admin-card-body p-0">
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th width="40">ID</th>
                                        <th width="90">Foto</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($galeri as $row): ?>
                                        <tr>
                                            <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                            <td><img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>" class="foto-thumb"></td>
                                            <td class="fw-semibold"><?= htmlspecialchars($row['judul']) ?></td>
                                            <td><span class="badge-custom"><?= htmlspecialchars($row['kategori']) ?></span></td>
                                            <td>
                                                <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriEdit&id=<?= $row['id'] ?>"
                                                    class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn-action btn-delete"
                                                    onclick="event.preventDefault(); confirmAction('Yakin hapus foto ini?', '<?= BASE_URL ?>/index.php?c=admin&m=galeriHapus&id=<?= $row['id'] ?>')"
                                                    title="Hapus"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- TAB MENUNGGU -->
        <div v-else-if="activeTab === 'menunggu'" key="menunggu">
            <?php if (empty($foto_user_menunggu)): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox fa-3x mb-3 empty-state-icon"></i>
                    <p class="text-muted mb-0">Tidak ada foto yang menunggu persetujuan.</p>
                </div>
            <?php else: ?>
                <div class="alert-info-custom mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Ada <strong><?= count($foto_user_menunggu) ?> foto</strong> dari pengunjung yang menunggu persetujuan
                    admin.
                </div>
                <div class="admin-card">
                    <div class="admin-card-body p-0">
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th width="40">ID</th>
                                        <th width="90">Foto</th>
                                        <th>Pengunggah</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th width="160">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($foto_user_menunggu as $row): ?>
                                        <tr>
                                            <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                            <td>
                                                <img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>"
                                                    class="foto-thumb foto-preview-trigger"
                                                    onclick="bukaPreview('<?= BASE_URL . '/' . $row['gambar_url'] ?>', '<?= addslashes($row['judul_foto']) ?>', '<?= addslashes($row['nama_user']) ?>')"
                                                    title="Klik untuk preview">
                                            </td>
                                            <td>
                                                <div class="fw-semibold pengunggah-name">
                                                    <?= htmlspecialchars($row['nama_user']) ?></div>
                                            </td>
                                            <td><?= htmlspecialchars($row['judul_foto']) ?></td>
                                            <td class="text-muted small"><?= htmlspecialchars($row['deskripsi'] ?: '-') ?></td>
                                            <td class="text-muted small">
                                                <?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                                            <td>
                                                <a href="#" class="btn-action btn-approve"
                                                    onclick="event.preventDefault(); confirmAction('Setujui foto dari <?= addslashes($row['nama_user']) ?>?', '<?= BASE_URL ?>/index.php?c=admin&m=fotoUserApprove&id=<?= $row['id'] ?>')"
                                                    title="Setujui"><i class="fas fa-check me-1"></i> Setujui</a>
                                                <a href="#" class="btn-action btn-reject mt-1"
                                                    onclick="event.preventDefault(); confirmAction('Tolak dan hapus foto ini?', '<?= BASE_URL ?>/index.php?c=admin&m=fotoUserReject&id=<?= $row['id'] ?>')"
                                                    title="Tolak"><i class="fas fa-times me-1"></i> Tolak</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- TAB DISETUJUI -->
        <div v-else-if="activeTab === 'disetujui'" key="disetujui">
            <?php if (empty($foto_user_disetujui)): ?>
                <div class="empty-state">
                    <i class="fas fa-images fa-3x mb-3 empty-state-icon"></i>
                    <p class="text-muted mb-0">Belum ada foto pengunjung yang disetujui.</p>
                </div>
            <?php else: ?>
                <div class="admin-card">
                    <div class="admin-card-body p-0">
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th width="40">ID</th>
                                        <th width="90">Foto</th>
                                        <th>Pengunggah</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($foto_user_disetujui as $row): ?>
                                        <tr>
                                            <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                            <td><img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>" class="foto-thumb"></td>
                                            <td class="fw-semibold pengunggah-name"><?= htmlspecialchars($row['nama_user']) ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['judul_foto']) ?></td>
                                            <td class="text-muted small"><?= date('d M Y', strtotime($row['created_at'])) ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn-action btn-delete"
                                                    onclick="event.preventDefault(); confirmAction('Yakin hapus foto ini dari galeri publik?', '<?= BASE_URL ?>/index.php?c=admin&m=fotoUserHapus&id=<?= $row['id'] ?>')"
                                                    title="Hapus"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </transition>
</div>

<!-- MODAL PREVIEW FOTO -->
<div id="modalPreview"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:20px;max-width:600px;width:90%;position:relative;">
        <button onclick="tutupPreview()"
            style="position:absolute;top:12px;right:12px;background:#f1f1f1;border:none;border-radius:50%;width:32px;height:32px;font-size:1rem;cursor:pointer;">✕</button>
        <img id="previewFotoImg" src="" style="width:100%;border-radius:10px;max-height:400px;object-fit:contain;">
        <div style="margin-top:12px;">
            <div id="previewFotoJudul" style="font-weight:600;color:#0A2540;font-size:1rem;"></div>
            <div id="previewFotoUser" style="font-size:0.85rem;color:#006BBB;margin-top:4px;"></div>
        </div>
    </div>
</div>

<script>
    const { createApp, ref } = Vue;
    const urlParams = new URLSearchParams(window.location.search);
    const defaultTab = urlParams.get('tab') || 'admin';

    createApp({
        setup() { const activeTab = ref(defaultTab); return { activeTab }; }
    }).mount('#vue-galeri-app');

    function bukaPreview(imgUrl, judul, namaUser) {
        document.getElementById('previewFotoImg').src = imgUrl;
        document.getElementById('previewFotoJudul').innerText = judul;
        document.getElementById('previewFotoUser').innerText = 'Dikirim oleh: ' + namaUser;
        document.getElementById('modalPreview').style.display = 'flex';
    }
    function tutupPreview() { document.getElementById('modalPreview').style.display = 'none'; }
    document.getElementById('modalPreview').addEventListener('click', function (e) { if (e.target === this) tutupPreview(); });
</script>