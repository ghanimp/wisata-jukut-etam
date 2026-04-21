<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-galeri-tambah" class="container-fluid pt-3 pb-5 px-md-4">
    <div class="mb-4">
        <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri
        </a>
        <h3 class="fw-bold mb-1" style="color: #0A2540;">
            <i class="fas fa-plus-circle me-2" style="color: #FFC973;"></i> Tambah Foto Baru
        </h3>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-body p-4 p-md-5">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Judul Foto</label>
                            <input type="text" name="judul" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select form-select-lg" required>
                                <option value="Kolam">Kolam</option>
                                <option value="Pemancingan">Pemancingan</option>
                                <option value="Fasilitas">Fasilitas</option>
                                <option value="Suasana">Suasana</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih Gambar</label>
                            <input type="file" name="gambar" @change="previewImage" class="form-control form-control-lg" accept="image/jpeg,image/jpg,image/png" required>
                            <small class="text-muted mt-2 d-block">Format: JPG, JPEG, PNG. Max: 2MB</small>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-gold btn-lg">
                                <i class="fas fa-save me-2"></i> Simpan Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="preview-card">
                <div class="preview-card-body text-center">
                    <h6 class="preview-title">Live Preview Image</h6>
                    
                    <div v-if="imageUrl" class="w-100">
                        <img :src="imageUrl" class="preview-img">
                        <p class="preview-success"><i class="fas fa-check-circle me-1"></i> Gambar siap diunggah</p>
                    </div>
                    
                    <div v-else class="preview-placeholder">
                        <i class="fas fa-image fa-3x mb-3"></i>
                        <p class="mb-0">Pilih file gambar di form sebelah kiri untuk melihat preview.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .back-link {
        text-decoration: none;
        color: #6c757d;
        margin-bottom: 10px;
        display: inline-block;
        transition: 0.3s;
    }
    
    .back-link:hover {
        color: #0A2540;
    }
    
    .admin-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .admin-card-body {
        padding: 25px;
    }
    
    .form-control, .form-select {
        border: 1px solid #e9ecef;
        padding: 12px 16px;
        border-radius: 8px;
        transition: 0.3s;
        background-color: #f8f9fa;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #006BBB;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,107,187,0.1);
        background-color: white;
    }
    
    .btn-gold {
        background: linear-gradient(135deg, #FFC973, #d8a548);
        color: #0A2540;
        font-weight: 600;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        transition: 0.3s;
    }
    
    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(216,165,72,0.3);
        color: #0A2540;
    }
    
    .btn-gold.btn-lg {
        padding: 14px 28px;
        font-size: 1rem;
    }
    
    .preview-card {
        background: #fdf6eb;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        height: 100%;
        overflow: hidden;
    }
    
    .preview-card-body {
        padding: 25px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }
    
    .preview-title {
        color: #6c757d;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }
    
    .preview-img {
        width: 100%;
        max-height: 280px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 3px solid white;
    }
    
    .preview-success {
        margin-top: 15px;
        color: #28a745;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .preview-placeholder {
        padding: 40px 20px;
        border: 2px dashed #dcdde1;
        border-radius: 12px;
        width: 100%;
        background: white;
        text-align: center;
    }
    
    .preview-placeholder i {
        color: #adb5bd;
        margin-bottom: 15px;
    }
    
    .preview-placeholder p {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: 0;
    }
</style>

<script>
    const { createApp, ref } = Vue;
    createApp({
        setup() {
            const imageUrl = ref(null);
            
            const previewImage = (event) => {
                const file = event.target.files[0];
                if (file) {
                    imageUrl.value = URL.createObjectURL(file);
                } else {
                    imageUrl.value = null;
                }
            };
            
            return { imageUrl, previewImage };
        }
    }).mount('#vue-galeri-tambah');
</script>