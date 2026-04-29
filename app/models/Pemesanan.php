<?php
// ================================================
// MODEL PEMESANAN
// ================================================

class Pemesanan
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create pemesanan baru
    public function create($data)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO pemesanan (user_id, kode_pemesanan, tanggal_kunjungan, jumlah_tiket, total_harga) 
            VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $data['user_id'],
            $data['kode_pemesanan'],
            $data['tanggal'],
            $data['jumlah'],
            $data['total']
        ]);
    }

    // Get by user ID (buat riwayat)
    public function getByUserId($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM pemesanan WHERE user_id = ? ORDER BY created_at DESC"
        );
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    // Count by user
    public function countByUser($user_id)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) as total FROM pemesanan WHERE user_id = ?"
        );
        $stmt->execute([$user_id]);
        return $stmt->fetch()['total'];
    }
}
?>