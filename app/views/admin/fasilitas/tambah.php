<div class="card">
    <div class="card-header">
        <h4>Tambah Fasilitas</h4>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label>Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Icon (Font Awesome)</label>
                <input type="text" name="icon" class="form-control" value="fas fa-circle">
                <small class="text-muted">Contoh: fas fa-swimmer, fas fa-fish, dll</small>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Urutan</label>
                <input type="number" name="urutan" class="form-control" value="0">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL ?>/index.php?c=admin&m=fasilitas" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>