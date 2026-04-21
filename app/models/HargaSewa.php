<?php
// ================================================
// MODEL HARGA SEWA FASILITAS
// ================================================

class HargaSewa {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua data harga sewa
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM harga_sewa ORDER BY id");
        return $stmt->fetchAll();
    }
    
    // Update harga
    public function update($id, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_sewa SET harga = ? WHERE id = ?");
        return $stmt->execute([$harga, $id]);
    }
    
    // Update nama & harga
    public function updateFull($id, $nama, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_sewa SET nama_fasilitas = ?, harga = ? WHERE id = ?");
        return $stmt->execute([$nama, $harga, $id]);
    }
}
?>