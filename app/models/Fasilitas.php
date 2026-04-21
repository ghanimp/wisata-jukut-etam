<?php
// ================================================
// MODEL FASILITAS
// ================================================

class Fasilitas {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua fasilitas (urut berdasarkan urutan)
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM fasilitas ORDER BY urutan ASC");
        return $stmt->fetchAll();
    }
    
    // Ambil fasilitas berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM fasilitas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // Tambah fasilitas baru
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO fasilitas (nama_fasilitas, icon, keterangan, urutan) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['icon'], $data['keterangan'], $data['urutan']]);
    }
    
    // Update fasilitas
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE fasilitas SET nama_fasilitas=?, icon=?, keterangan=?, urutan=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['icon'], $data['keterangan'], $data['urutan'], $id]);
    }
    
    // Hapus fasilitas
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM fasilitas WHERE id=?");
        return $stmt->execute([$id]);
    }
    
    // Hitung total fasilitas
    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM fasilitas");
        return $stmt->fetch()['total'];
    }
}
?>