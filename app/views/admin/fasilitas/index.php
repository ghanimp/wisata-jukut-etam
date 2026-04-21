<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<style>
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .table-custom th { background-color: #006BBB; color: white; border: none; padding: 15px; }
    .table-custom td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f0f0f0; }
    .table-custom tbody tr { transition: all 0.3s ease; }
    .table-custom tbody tr:hover { background-color: #f8f9fa; transform: scale(1.01); }
    
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-vue { animation: slideUp 0.6s ease-out forwards; }
    
    /* Badge styling */
    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .bg-secondary { background-color: #6c757d; color: white; }
    
    /* Button styling */
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.75rem;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        margin: 0 3px;
    }
    .btn-outline-primary {
        background: transparent;
        border: 1px solid #006BBB;
        color: #006BBB;
    }
    .btn-outline-primary:hover {
        background: #006BBB;
        color: white;
    }
    .btn-outline-danger {
        background: transparent;
        border: 1px solid #dc3545;
        color: #dc3545;
    }
    .btn-outline-danger:hover {
        background: #dc3545;
        color: white;
    }
    .rounded-circle { border-radius: 50% !important; }
    
    /* Alert styling */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-close {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
    }
    
    /* Button Gold */
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
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(216,165,72,0.3);
        color: #0A2540;
    }
</style>

<div id="vue-fasilitas-app" class="container-fluid pt-3 pb-5 px-md-4 animate-vue">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1" style="color: #0A2540;"><i class="fas fa-chair me-2" style="color: #FFC973;"></i> Kelola Fasilitas</h3>
            <p class="text-muted mb-0">Daftar semua fasilitas yang tersedia di Jukut Etam.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitasTambah" class="btn-gold">
            <i class="fas fa-plus me-1"></i> Tambah Fasilitas
        </a>
    </div>
    
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <?php if($_GET['success'] == 'tambah'): ?>
                <i class="fas fa-check-circle me-2"></i> Fasilitas berhasil ditambahkan!
            <?php elseif($_GET['success'] == 'edit'): ?>
                <i class="fas fa-check-circle me-2"></i> Fasilitas berhasil diupdate!
            <?php elseif($_GET['success'] == 'hapus'): ?>
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
                        <?php if(empty($fasilitas)): ?>
                            <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data fasilitas.</td></tr>
                        <?php else: ?>
                            <?php $no=1; foreach($fasilitas as $row): ?>
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
                                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitasEdit&id=<?= $row['id'] ?>" class="btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitasHapus&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Yakin hapus fasilitas ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
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

<style>
    /* ========== ADMIN CARD ========== */
    .admin-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .admin-card-body {
        padding: 0;
    }
    
    /* ========== ADMIN TABLE ========== */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }
    .admin-table thead th {
        background: #f8f9fa;
        color: #0A2540;
        font-weight: 600;
        padding: 12px 16px;
        border-bottom: 2px solid #e9ecef;
        text-align: left;
    }
    .admin-table thead th.text-center {
        text-align: center;
    }
    .admin-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }
    .admin-table tbody tr:hover {
        background: #f8f9fa;
    }
    
    /* ========== ICON WRAPPER ========== */
    .icon-wrapper {
        width: 45px;
        height: 45px;
        background-color: rgba(0, 107, 187, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    .icon-wrapper i {
        font-size: 1.2rem;
        color: #006BBB;
    }
    
    /* ========== BADGE CUSTOM ========== */
    .badge-custom {
        background-color: #6c757d;
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    
    /* ========== ACTION BUTTONS ========== */
    .btn-edit {
        background: #fff3cd;
        color: #856404;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.3s;
        margin: 0 3px;
    }
    .btn-edit:hover {
        background: #e0a800;
        color: white;
    }
    .btn-delete {
        background: #f8d7da;
        color: #721c24;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.3s;
        margin: 0 3px;
    }
    .btn-delete:hover {
        background: #c82333;
        color: white;
    }
    
    /* ========== UTILITY ========== */
    .border-bottom {
        border-bottom: 1px solid #e9ecef !important;
    }
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .pb-3 {
        padding-bottom: 1rem !important;
    }
    .pt-3 {
        padding-top: 1rem !important;
    }
    .fw-bold {
        font-weight: 600 !important;
    }
    .fw-semibold {
        font-weight: 500 !important;
    }
    .text-muted {
        color: #6c757d !important;
    }
    .text-center {
        text-align: center !important;
    }
</style>

<script>
    const { createApp } = Vue;
    createApp({}).mount('#vue-fasilitas-app');
</script>