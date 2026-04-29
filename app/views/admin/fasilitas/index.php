<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-fasilitas-app" class="container-fluid pt-3 pb-5 px-md-4 animate-vue">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1 admin-heading"><i class="fas fa-chair me-2 admin-heading-icon"></i> Kelola Fasilitas
            </h3>
            <p class="text-muted mb-0">Daftar semua fasilitas yang tersedia di Jukut Etam.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitasTambah" class="btn-gold">
            <i class="fas fa-plus me-1"></i> Tambah Fasilitas
        </a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <?php if ($_GET['success'] == 'tambah'): ?>
                <i class="fas fa-check-circle me-2"></i> Fasilitas berhasil ditambahkan!
            <?php elseif ($_GET['success'] == 'edit'): ?>
                <i class="fas fa-check-circle me-2"></i> Fasilitas berhasil diupdate!
            <?php elseif ($_GET['success'] == 'hapus'): ?>
                <i class="fas fa-check-circle me-2"></i> Fasilitas berhasil dihapus!
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
        </div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="10%" class="text-center">Icon</th>
                            <th width="25%">Nama Fasilitas</th>
                            <th width="35%">Keterangan</th>
                            <th width="10%" class="text-center">Urutan</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($fasilitas)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data fasilitas.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($fasilitas as $row): ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                                    <td class="text-center">
                                        <div class="icon-wrapper">
                                            <i class="<?= $row['icon'] ?> fa-lg"></i>
                                        </div>
                                    </td>
                                    <td class="fw-semibold"><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                                    <td class="text-muted"><?= htmlspecialchars($row['keterangan']) ?></td>
                                    <td class="text-center"><span class="badge-custom"><?= $row['urutan'] ?></span></td>
                                    <td class="text-center">
                                        <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitasEdit&id=<?= $row['id'] ?>"
                                            class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn-delete"
                                            onclick="event.preventDefault(); confirmAction('Yakin hapus fasilitas ini?', '<?= BASE_URL ?>/index.php?c=admin&m=fasilitasHapus&id=<?= $row['id'] ?>')"
                                            title="Hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const { createApp } = Vue;
    createApp({}).mount('#vue-fasilitas-app');
</script>