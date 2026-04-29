<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-fasilitas-edit" class="container-fluid pt-3 pb-5 px-md-4">
    <div class="mb-4">
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitas" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Fasilitas
        </a>
        <h3 class="fw-bold mb-1 admin-heading">
            <i class="fas fa-edit me-2 admin-heading-icon"></i> Edit Fasilitas
        </h3>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-body p-4 p-md-5">
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" class="form-control form-control-lg"
                                value="<?= htmlspecialchars($data['nama_fasilitas']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Icon (Font Awesome)</label>
                            <input type="text" name="icon" class="form-control form-control-lg"
                                value="<?= $data['icon'] ?>">
                            <small class="text-muted mt-2 d-block">
                                Contoh: fas fa-swimmer, fas fa-fish, fas fa-umbrella-beach
                            </small>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Keterangan</label>
                            <input type="text" name="keterangan" class="form-control form-control-lg"
                                value="<?= htmlspecialchars($data['keterangan']) ?>">
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" class="form-control form-control-lg"
                                value="<?= $data['urutan'] ?>">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-gold btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Update Fasilitas
                            </button>
                            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitas"
                                class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="preview-card">
                <div class="preview-card-body text-center">
                    <h6 class="preview-title">Preview Icon</h6>
                    <div class="icon-preview-large">
                        <i class="<?= $data['icon'] ?> fa-4x icon-preview-icon"></i>
                    </div>
                    <p class="preview-info mt-3">
                        <i class="fas fa-info-circle me-1"></i>
                        Icon akan ditampilkan di halaman fasilitas
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const { createApp } = Vue;
    createApp({}).mount('#vue-fasilitas-edit');
</script>