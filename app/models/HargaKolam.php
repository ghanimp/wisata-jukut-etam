<?php
// ================================================
// MODEL HARGA KOLAM RENANG
// ================================================

class HargaKolam {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua data harga kolam
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM harga_kolam ORDER BY id");
        return $stmt->fetchAll();
    }
    
    // Update harga
    public function update($id, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_kolam SET harga = ? WHERE id = ?");
        return $stmt->execute([$harga, $id]);
    }
    
    // Update hari & harga
    public function updateFull($id, $hari, $harga) {
        $stmt = $this->conn->prepare("UPDATE harga_kolam SET hari = ?, harga = ? WHERE id = ?");
        return $stmt->execute([$hari, $harga, $id]);
    }
}
?>