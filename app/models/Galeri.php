<?php
// ================================================
// MODEL GALERI (FOTO DARI ADMIN)
// ================================================

class Galeri {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua foto
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM galeri ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    // Ambil berdasarkan kategori
    public function getByKategori($kategori) {
        $stmt = $this->conn->prepare("SELECT * FROM galeri WHERE kategori = ? ORDER BY created_at DESC");
        $stmt->execute([$kategori]);
        return $stmt->fetchAll();
    }
    
    // Ambil foto terbaru (limit)
    public function getLatest($limit = 4) {
        $stmt = $this->conn->query("SELECT * FROM galeri ORDER BY created_at DESC LIMIT $limit");
        return $stmt->fetchAll();
    }
    
    // Ambil berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM galeri WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // Tambah foto
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO galeri (judul, kategori, gambar_url, deskripsi) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['judul'], $data['kategori'], $data['gambar_url'], $data['deskripsi']]);
    }
    
    // Update foto
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE galeri SET judul=?, kategori=?, gambar_url=?, deskripsi=? WHERE id=?");
        return $stmt->execute([$data['judul'], $data['kategori'], $data['gambar_url'], $data['deskripsi'], $id]);
    }
    
    // Hapus foto
    public function delete($id) {
        // Ambil gambar_url dulu untuk hapus file
        $stmt = $this->conn->prepare("SELECT gambar_url FROM galeri WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            $file = __DIR__ . '/../public/' . $data['gambar_url'];
            if (file_exists($file)) unlink($file);
        }
        
        $stmt = $this->conn->prepare("DELETE FROM galeri WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Hitung total foto
    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM galeri");
        return $stmt->fetch()['total'];
    }
}
?>