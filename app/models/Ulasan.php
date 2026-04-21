<?php
// ================================================
// MODEL ULASAN
// ================================================

class Ulasan {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua ulasan
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM ulasan ORDER BY tanggal DESC");
        return $stmt->fetchAll();
    }
    
    // Ambil ulasan yang sudah disetujui
    public function getApproved() {
        $stmt = $this->conn->query("SELECT * FROM ulasan WHERE status = 'disetujui' ORDER BY tanggal DESC");
        return $stmt->fetchAll();
    }
    
    // Ambil ulasan yang masih menunggu
    public function getPending() {
        $stmt = $this->conn->query("SELECT * FROM ulasan WHERE status = 'menunggu' ORDER BY tanggal DESC");
        return $stmt->fetchAll();
    }
    
    // Ambil ulasan berdasarkan user_id
    public function getByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM ulasan WHERE user_id = ? ORDER BY tanggal DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    
    // Ambil rating rata-rata
    public function getAverageRating() {
        $stmt = $this->conn->query("SELECT AVG(rating) as avg FROM ulasan WHERE status = 'disetujui'");
        $result = $stmt->fetch();
        return round($result['avg'] ?? 0, 1);
    }
    
    // Tambah ulasan
    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO ulasan (user_id, nama, rating, ulasan, tanggal, status) VALUES (?, ?, ?, ?, ?, 'menunggu')");
        return $stmt->execute([$data['user_id'], $data['nama'], $data['rating'], $data['ulasan'], $data['tanggal']]);
    }
    
    // Approve ulasan
    public function approve($id) {
        $stmt = $this->conn->prepare("UPDATE ulasan SET status = 'disetujui' WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Reject ulasan
    public function reject($id) {
        $stmt = $this->conn->prepare("UPDATE ulasan SET status = 'ditolak' WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Hapus ulasan
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM ulasan WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Hitung total ulasan pending
    public function countPending() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM ulasan WHERE status = 'menunggu'");
        return $stmt->fetch()['total'];
    }
    
    // Hitung total ulasan aktif
    public function countActive() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM ulasan WHERE status = 'disetujui'");
        return $stmt->fetch()['total'];
    }
}
?>