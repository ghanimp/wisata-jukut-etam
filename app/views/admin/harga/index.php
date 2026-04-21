<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-harga-app" class="container-fluid pt-3 pb-5 px-md-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1" style="color: #0A2540;"><i class="fas fa-tags me-2" style="color: #FFC973;"></i> Kelola Harga</h3>
            <p class="text-muted mb-0">Atur harga tiket masuk kolam renang dan biaya sewa fasilitas.</p>
        </div>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'update'): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> Data harga berhasil diperbarui!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex mb-4 border-bottom flex-wrap gap-2">
        <button @click="activeTab = 'kolam'" :class="['tab-btn', { active: activeTab === 'kolam' }]">
            <i class="fas fa-swimmer me-2"></i> Harga Kolam Renang
        </button>
        <button @click="activeTab = 'sewa'" :class="['tab-btn', { active: activeTab === 'sewa' }]">
            <i class="fas fa-chair me-2"></i> Harga Sewa Fasilitas
        </button>
    </div>

    <transition name="fade" mode="out-in">
        
        <!-- TAB HARGA KOLAM -->
        <div v-if="activeTab === 'kolam'" key="kolam">
            <div class="admin-card">
                <div class="admin-card-body p-0">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Kategori / Hari</th>
                                    <th>Nominal Harga (Rp)</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($harga_kolam as $row): ?>
                                <form method="POST" action="<?= BASE_URL ?>/index.php?c=admin&m=hargaUpdate">
                                    <input type="hidden" name="table" value="harga_kolam">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <tr>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['hari']) ?></td>
                                        <td>
                                            <div class="input-group" style="max-width: 250px;">
                                                <span class="input-group-text bg-light">Rp</span>
                                                <input type="number" name="harga" value="<?= $row['harga'] ?>" class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn-gold btn-sm">Update</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB HARGA SEWA -->
        <div v-else-if="activeTab === 'sewa'" key="sewa">
            <div class="admin-card">
                <div class="admin-card-body p-0">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Nama Fasilitas</th>
                                    <th>Keterangan Harga</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($harga_sewa as $row): ?>
                                <form method="POST" action="<?= BASE_URL ?>/index.php?c=admin&m=hargaUpdate">
                                    <input type="hidden" name="table" value="harga_sewa">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <tr>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                                        <td>
                                            <div class="input-group" style="max-width: 300px;">
                                                <span class="input-group-text bg-light"><i class="fas fa-tag"></i></span>
                                                <input type="text" name="harga" value="<?= htmlspecialchars($row['harga']) ?>" class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn-gold btn-sm">Update</button>
                                        </td>
                                    </tr>
                                </form>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </transition>
</div>

<style>
    .tab-btn {
        background: transparent;
        border: none;
        padding: 8px 20px;
        font-weight: 500;
        color: #6c757d;
        border-bottom: 3px solid transparent;
        transition: 0.3s;
    }
    
    .tab-btn.active {
        color: #0A2540;
        border-bottom-color: #FFC973;
    }
    
    .tab-btn:hover {
        color: #0A2540;
    }
    
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.3s ease;
    }
    
    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
    
    .btn-gold {
        background: linear-gradient(135deg, #FFC973, #d8a548);
        color: #0A2540;
        font-weight: 600;
        border: none;
        padding: 6px 16px;
        border-radius: 6px;
        transition: 0.3s;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }
    
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(216,165,72,0.3);
    }
    
    .btn-gold.btn-sm {
        padding: 5px 12px;
        font-size: 0.8rem;
    }
    
    .admin-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .admin-card-body {
        padding: 0;
    }
    
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
    }
    
    .admin-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }
    
    .admin-table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .input-group {
        display: flex;
        align-items: center;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        padding: 8px 12px;
        border-radius: 6px 0 0 6px;
    }
    
    .form-control {
        border: 1px solid #e9ecef;
        padding: 8px 12px;
        border-radius: 0 6px 6px 0;
        width: 100%;
    }
    
    .form-control:focus {
        border-color: #006BBB;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,107,187,0.1);
    }
    
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
        color: #155724;
    }
    
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
    
    .text-muted {
        color: #6c757d !important;
    }
</style>

<script>
    const { createApp, ref } = Vue;

    createApp({
        setup() {
            const activeTab = ref('kolam');
            return { activeTab };
        }
    }).mount('#vue-harga-app');
</script>