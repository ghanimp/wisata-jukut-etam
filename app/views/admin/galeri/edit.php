<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-galeri-edit" class="container-fluid pt-3 pb-5 px-md-4">
    <div class="mb-4">
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri
        </a>
        <h3 class="fw-bold mb-1 admin-heading">
            <i class="fas fa-edit me-2 admin-heading-icon"></i> Edit Foto Galeri
        </h3>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-body p-4 p-md-5">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Judul Foto</label>
                            <input type="text" name="judul" class="form-control form-control-lg"
                                value="<?= htmlspecialchars($data['judul']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select form-select-lg" required>
                                <option value="Kolam" <?= $data['kategori'] == 'Kolam' ? 'selected' : '' ?>>Kolam</option>
                                <option value="Pemancingan" <?= $data['kategori'] == 'Pemancingan' ? 'selected' : '' ?>>
                                    Pemancingan</option>
                                <option value="Fasilitas" <?= $data['kategori'] == 'Fasilitas' ? 'selected' : '' ?>>
                                    Fasilitas</option>
                                <option value="Suasana" <?= $data['kategori'] == 'Suasana' ? 'selected' : '' ?>>Suasana
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
                            <input type="file" name="gambar" @change="previewImage" class="form-control form-control-lg"
                                accept="image/jpeg,image/jpg,image/png">
                            <small class="text-muted mt-2 d-block">Biarkan kosong jika tidak ingin mengganti foto saat
                                ini.</small>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control"
                                rows="3"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-gold btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Update Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="preview-card">
                <div class="preview-card-body text-center">
                    <h6 class="preview-title">Preview Gambar</h6>

                    <div class="w-100">
                        <img :src="imageUrl" class="preview-img">
                        <p class="preview-info"><i class="fas fa-eye me-1"></i> Gambar yang akan ditampilkan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const { createApp, ref } = Vue;
    createApp({
        setup() {
            const imageUrl = ref('<?= BASE_URL . '/' . $data['gambar_url'] ?>');

            const previewImage = (event) => {
                const file = event.target.files[0];
                if (file) {
                    imageUrl.value = URL.createObjectURL(file);
                }
            };

            return { imageUrl, previewImage };
        }
    }).mount('#vue-galeri-edit');
</script>