<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-harga-app" class="container-fluid pt-3 pb-5 px-md-4">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold mb-1 admin-heading">
                <i class="fas fa-tags me-2 admin-heading-icon"></i> Kelola Harga
            </h3>
            <p class="text-muted mb-0">Atur harga tiket masuk kolam renang, pemancingan, dan biaya sewa fasilitas.</p>
        </div>
    </div>

    <div class="d-flex mb-4 border-bottom flex-wrap gap-2">
        <button @click="activeTab = 'kolam'" :class="['tab-btn', { active: activeTab === 'kolam' }]">
            <i class="fas fa-swimmer me-2"></i> Harga Kolam Renang
        </button>
        <button @click="activeTab = 'pancing'" :class="['tab-btn', { active: activeTab === 'pancing' }]">
            <i class="fas fa-fish me-2"></i> Harga Pemancingan
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
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($harga_kolam as $row): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['hari']) ?></td>
                                        <td>
                                            <div class="input-group input-group-harga">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="harga_<?= $row['id'] ?>"
                                                    id="harga_kolam_<?= $row['id'] ?>" value="<?= $row['harga'] ?>"
                                                    class="form-control" required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-gold btn-sm"
                                                onclick="updateHarga('harga_kolam', <?= $row['id'] ?>)">
                                                <i class="fas fa-save me-1"></i> Update
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB HARGA PEMANCINGAN -->
        <div v-else-if="activeTab === 'pancing'" key="pancing">
            <div class="admin-card">
                <div class="admin-card-body p-0">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Keterangan Harga</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($harga_pemancingan as $row): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['nama']) ?></td>
                                        <td>
                                            <div class="input-group input-group-harga">
                                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                <input type="text" name="harga_<?= $row['id'] ?>"
                                                    id="harga_pemancingan_<?= $row['id'] ?>"
                                                    value="<?= htmlspecialchars($row['harga']) ?>" class="form-control"
                                                    required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-gold btn-sm"
                                                onclick="updateHarga('harga_pemancingan', <?= $row['id'] ?>)">
                                                <i class="fas fa-save me-1"></i> Update
                                            </button>
                                        </td>
                                    </tr>
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
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($harga_sewa as $row): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['nama_fasilitas']) ?></td>
                                        <td>
                                            <div class="input-group input-group-harga">
                                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                                <input type="text" name="harga_<?= $row['id'] ?>"
                                                    id="harga_sewa_<?= $row['id'] ?>"
                                                    value="<?= htmlspecialchars($row['harga']) ?>" class="form-control"
                                                    required>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn-gold btn-sm"
                                                onclick="updateHarga('harga_sewa', <?= $row['id'] ?>)">
                                                <i class="fas fa-save me-1"></i> Update
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </transition>
</div>

<script>
    const { createApp, ref } = Vue;

    createApp({
        setup() {
            const activeTab = ref('kolam');
            return { activeTab };
        }
    }).mount('#vue-harga-app');

    // Fungsi update harga pakai MODAL KONFIRMASI
    function updateHarga(table, id) {
        const inputEl = document.getElementById(table + '_' + id);
        const hargaBaru = inputEl.value;

        if (!hargaBaru || hargaBaru.trim() === '') {
            alert('Harga tidak boleh kosong!');
            return;
        }

        // Buka modal konfirmasi
        confirmAction(
            'Update harga menjadi Rp' + hargaBaru + '?',
            'javascript:void(0)'
        );

        // Override tombol konfirmasi buat fetch
        document.getElementById('confirmLink').onclick = function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('table', table);
            formData.append('id', id);
            formData.append('harga', hargaBaru);

            fetch('<?= BASE_URL ?>/index.php?c=admin&m=hargaUpdate', {
                method: 'POST',
                body: formData
            })
                .then(() => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal update: ' + error.message);
                });

            closeConfirm();
        };
    }
</script>