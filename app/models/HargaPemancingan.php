<?php
// ================================================
// MODEL HARGA PEMANCINGAN
// ================================================

class HargaPemancingan {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua data harga pemancingan
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM harga_pemancingan ORDER BY id");
        return $stmt->fetchAll();
    }
    
    // Update harga
    public function update($id, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_pemancingan SET harga = ? WHERE id = ?");
        return $stmt->execute([$harga, $id]);
    }
    
    // Update nama & harga
    public function updateFull($id, $nama, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_pemancingan SET nama = ?, harga = ? WHERE id = ?");
        return $stmt->execute([$nama, $harga, $id]);
    }
}
?>