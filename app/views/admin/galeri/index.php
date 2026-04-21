<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-galeri-app" class="container-fluid pt-3 pb-5 px-md-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1" style="color: #0A2540;">
                <i class="fas fa-images me-2" style="color: #FFC973;"></i> Kelola Galeri
            </h3>
            <p class="text-muted mb-0">Manajemen foto fasilitas dan dokumentasi pengunjung.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriTambah" class="btn-gold">
            <i class="fas fa-plus me-1"></i> Tambah Foto
        </a>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> Aksi berhasil dilakukan!
            <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
        </div>
    <?php endif; ?>

    <!-- ===== TAB NAVIGATION ===== -->
    <div class="d-flex mb-4 border-bottom flex-wrap gap-2 align-items-center">
        <button @click="activeTab = 'admin'" :class="['tab-btn', { active: activeTab === 'admin' }]">
            <i class="fas fa-user-shield me-2"></i> Foto dari Admin
            <span class="tab-badge tab-badge-blue"><?= count($galeri) ?></span>
        </button>

        <button @click="activeTab = 'menunggu'" :class="['tab-btn', { active: activeTab === 'menunggu' }]">
            <i class="fas fa-clock me-2"></i> Menunggu Persetujuan
            <?php if(count($foto_user_menunggu) > 0): ?>
                <span class="tab-badge tab-badge-warning"><?= count($foto_user_menunggu) ?></span>
            <?php endif; ?>
        </button>

        <button @click="activeTab = 'disetujui'" :class="['tab-btn', { active: activeTab === 'disetujui' }]">
            <i class="fas fa-check-circle me-2"></i> Sudah Disetujui
            <span class="tab-badge tab-badge-green"><?= count($foto_user_disetujui) ?></span>
        </button>
    </div>

    <transition name="fade" mode="out-in">

        <!-- ===== TAB 1: FOTO DARI ADMIN ===== -->
        <div v-if="activeTab === 'admin'" key="admin">
            <?php if(empty($galeri)): ?>
                <div class="empty-state">
                    <i class="fas fa-image fa-3x mb-3" style="color:#dee2e6;"></i>
                    <p class="text-muted">Belum ada foto dari admin. Tambah foto sekarang!</p>
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
                                    <?php foreach($galeri as $row): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                        <td>
                                            <img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>" class="foto-thumb">
                                        </td>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['judul']) ?></td>
                                        <td><span class="badge-custom"><?= htmlspecialchars($row['kategori']) ?></span></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriEdit&id=<?= $row['id'] ?>" class="btn-action btn-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeriHapus&id=<?= $row['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Yakin hapus foto ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
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

        <!-- ===== TAB 2: MENUNGGU PERSETUJUAN ===== -->
        <div v-else-if="activeTab === 'menunggu'" key="menunggu">
            <?php if(empty($foto_user_menunggu)): ?>
                <div class="empty-state">
                    <i class="fas fa-inbox fa-3x mb-3" style="color:#dee2e6;"></i>
                    <p class="text-muted mb-0">Tidak ada foto yang menunggu persetujuan.</p>
                </div>
            <?php else: ?>
                <div class="alert-info-custom mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Ada <strong><?= count($foto_user_menunggu) ?> foto</strong> dari pengunjung yang menunggu persetujuan admin.
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
                                    <?php foreach($foto_user_menunggu as $row): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                        <td>
                                            <!-- Klik untuk preview besar -->
                                            <img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>"
                                                 class="foto-thumb foto-preview-trigger"
                                                 onclick="bukaPreview('<?= BASE_URL . '/' . $row['gambar_url'] ?>', '<?= addslashes($row['judul_foto']) ?>', '<?= addslashes($row['nama_user']) ?>')"
                                                 title="Klik untuk preview">
                                        </td>
                                        <td>
                                            <div class="fw-semibold" style="color:#006BBB;"><?= htmlspecialchars($row['nama_user']) ?></div>
                                        </td>
                                        <td><?= htmlspecialchars($row['judul_foto']) ?></td>
                                        <td class="text-muted small"><?= htmlspecialchars($row['deskripsi'] ?: '-') ?></td>
                                        <td class="text-muted small"><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <!-- TOMBOL APPROVE -->
                                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fotoUserApprove&id=<?= $row['id'] ?>"
                                               class="btn-action btn-approve"
                                               onclick="return confirm('Setujui foto dari <?= addslashes($row['nama_user']) ?>?')"
                                               title="Setujui">
                                                <i class="fas fa-check me-1"></i> Setujui
                                            </a>
                                            <!-- TOMBOL REJECT -->
                                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fotoUserReject&id=<?= $row['id'] ?>"
                                               class="btn-action btn-reject mt-1"
                                               onclick="return confirm('Tolak dan hapus foto ini?')"
                                               title="Tolak">
                                                <i class="fas fa-times me-1"></i> Tolak
                                            </a>
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

        <!-- ===== TAB 3: SUDAH DISETUJUI ===== -->
        <div v-else-if="activeTab === 'disetujui'" key="disetujui">
            <?php if(empty($foto_user_disetujui)): ?>
                <div class="empty-state">
                    <i class="fas fa-images fa-3x mb-3" style="color:#dee2e6;"></i>
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
                                    <?php foreach($foto_user_disetujui as $row): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?= $row['id'] ?></td>
                                        <td>
                                            <img src="<?= BASE_URL . '/' . $row['gambar_url'] ?>" class="foto-thumb">
                                        </td>
                                        <td class="fw-semibold" style="color:#006BBB;"><?= htmlspecialchars($row['nama_user']) ?></td>
                                        <td><?= htmlspecialchars($row['judul_foto']) ?></td>
                                        <td class="text-muted small"><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fotoUserHapus&id=<?= $row['id'] ?>"
                                               class="btn-action btn-delete"
                                               onclick="return confirm('Yakin hapus foto ini dari galeri publik?')"
                                               title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
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

<!-- ===== MODAL PREVIEW FOTO ===== -->
<div id="modalPreview" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:20px;max-width:600px;width:90%;position:relative;">
        <button onclick="tutupPreview()" style="position:absolute;top:12px;right:12px;background:#f1f1f1;border:none;border-radius:50%;width:32px;height:32px;font-size:1rem;cursor:pointer;">✕</button>
        <img id="previewFotoImg" src="" style="width:100%;border-radius:10px;max-height:400px;object-fit:contain;">
        <div style="margin-top:12px;">
            <div id="previewFotoJudul" style="font-weight:600;color:#0A2540;font-size:1rem;"></div>
            <div id="previewFotoUser" style="font-size:0.85rem;color:#006BBB;margin-top:4px;"></div>
        </div>
    </div>
</div>

<style>
    /* TAB */
    .tab-btn {
        background: transparent;
        border: none;
        padding: 8px 20px;
        font-weight: 500;
        color: #6c757d;
        border-bottom: 3px solid transparent;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .tab-btn.active { color: #0A2540; border-bottom-color: #FFC973; }
    .tab-btn:hover { color: #0A2540; }

    /* BADGE COUNTER di tab */
    .tab-badge {
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 20px;
        margin-left: 4px;
    }
    .tab-badge-blue    { background: #e7f1fb; color: #006BBB; }
    .tab-badge-warning { background: #fff3cd; color: #856404; animation: pulse 1.5s infinite; }
    .tab-badge-green   { background: #d4edda; color: #155724; }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    /* CARD & TABLE */
    .admin-card { background: white; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; }
    .admin-table { width: 100%; border-collapse: collapse; }
    .admin-table thead th { background: #f8f9fa; color: #0A2540; font-weight: 600; padding: 12px 16px; border-bottom: 2px solid #e9ecef; text-align: left; font-size: 0.85rem; }
    .admin-table tbody td { padding: 12px 16px; border-bottom: 1px solid #e9ecef; vertical-align: middle; }
    .admin-table tbody tr:last-child td { border-bottom: none; }
    .admin-table tbody tr:hover { background: #fafafa; }

    /* FOTO */
    .foto-thumb { width: 70px; height: 55px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .foto-preview-trigger { cursor: zoom-in; transition: transform 0.2s; }
    .foto-preview-trigger:hover { transform: scale(1.05); }

    /* BADGE KATEGORI */
    .badge-custom { background: #6c757d; color: white; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }

    /* ACTION BUTTONS */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 5px 10px;
        margin: 2px;
        white-space: nowrap;
    }
    .btn-edit    { background: #fff3cd; color: #856404; }
    .btn-edit:hover { background: #e0a800; color: white; }
    .btn-delete  { background: #f8d7da; color: #721c24; }
    .btn-delete:hover { background: #c82333; color: white; }

    /* TOMBOL APPROVE & REJECT */
    .btn-approve { background: #d4edda; color: #155724; display: flex !important; }
    .btn-approve:hover { background: #28a745; color: white; }
    .btn-reject  { background: #f8d7da; color: #721c24; display: flex !important; }
    .btn-reject:hover { background: #dc3545; color: white; }

    /* GOLD BUTTON */
    .btn-gold {
        background: linear-gradient(135deg, #FFC973, #d8a548);
        color: #0A2540;
        font-weight: 600;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }
    .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(216,165,72,0.3); color: #0A2540; }

    /* EMPTY STATE */
    .empty-state { text-align: center; padding: 4rem 2rem; background: #f8f9fa; border-radius: 16px; }

    /* ALERT INFO */
    .alert-info-custom { background: #d1ecf1; color: #0c5460; padding: 12px 20px; border-radius: 8px; font-size: 0.875rem; }

    /* FADE TRANSITION */
    .fade-enter-active, .fade-leave-active { transition: opacity 0.25s ease; }
    .fade-enter-from, .fade-leave-to { opacity: 0; }

    /* UTILITY */
    .border-bottom { border-bottom: 1px solid #e9ecef !important; }
</style>

<script>
    const { createApp, ref } = Vue;

    // Cek URL: jika ada ?tab=menunggu, langsung buka tab itu
    const urlParams = new URLSearchParams(window.location.search);
    const defaultTab = urlParams.get('tab') || 'admin';

    createApp({
        setup() {
            const activeTab = ref(defaultTab);
            return { activeTab };
        }
    }).mount('#vue-galeri-app');

    // Preview foto di modal
    function bukaPreview(imgUrl, judul, namaUser) {
        document.getElementById('previewFotoImg').src = imgUrl;
        document.getElementById('previewFotoJudul').innerText = judul;
        document.getElementById('previewFotoUser').innerText = 'Dikirim oleh: ' + namaUser;
        document.getElementById('modalPreview').style.display = 'flex';
    }

    function tutupPreview() {
        document.getElementById('modalPreview').style.display = 'none';
    }

    // Klik di luar modal = tutup
    document.getElementById('modalPreview').addEventListener('click', function(e) {
        if (e.target === this) tutupPreview();
    });
</script>