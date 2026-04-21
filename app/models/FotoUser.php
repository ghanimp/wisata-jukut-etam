<?php
// ================================================
// MODEL FOTO USER (UPLOAD DARI PENGUNJUNG)
// ================================================

class FotoUser {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Ambil semua foto user
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM foto_user ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    // Ambil foto yang menunggu persetujuan
    public function getPending() {
        $stmt = $this->conn->query("SELECT * FROM foto_user WHERE status = 'menunggu' ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Ambil foto yang sudah disetujui
    public function getApproved() {
        $stmt = $this->conn->query("SELECT * FROM foto_user WHERE status = 'disetujui' ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Ambil foto berdasarkan user_id
    public function getByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM foto_user WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    
    // ================================================
    // TAMBAH FOTO USER — dengan error logging
    // ================================================
    public function create($data) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO foto_user (user_id, nama_user, judul_foto, gambar_url, deskripsi, status)
                 VALUES (?, ?, ?, ?, ?, 'menunggu')"
            );

            $result = $stmt->execute([
                $data['user_id'],
                $data['nama_user'],
                $data['judul'],      // key dari controller tetap 'judul'
                $data['gambar_url'],
                $data['deskripsi']
            ]);

            // Tulis ke log kalau insert gagal
            if (!$result) {
                $logFile = __DIR__ . '/../../debug_upload.txt';
                file_put_contents($logFile,
                    date('Y-m-d H:i:s') . " PDO ERROR: " . print_r($stmt->errorInfo(), true) . "\n",
                    FILE_APPEND
                );
            }

            return $result;

        } catch (PDOException $e) {
            // Tulis error PDO ke log
            $logFile = __DIR__ . '/../../debug_upload.txt';
            file_put_contents($logFile,
                date('Y-m-d H:i:s') . " EXCEPTION: " . $e->getMessage() . "\n"
                . "DATA: " . print_r($data, true) . "\n",
                FILE_APPEND
            );
            return false;
        }
    }
    
    // Approve foto
    public function approve($id) {
        $stmt = $this->conn->prepare("UPDATE foto_user SET status = 'disetujui' WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Reject foto (hapus file sekaligus)
    public function reject($id) {
        $stmt = $this->conn->prepare("SELECT gambar_url FROM foto_user WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            $file = __DIR__ . '/../../public/' . $data['gambar_url'];
            if (file_exists($file)) unlink($file);
        }
        
        $stmt = $this->conn->prepare("UPDATE foto_user SET status = 'ditolak' WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Hapus foto permanen
    public function delete($id) {
        $stmt = $this->conn->prepare("SELECT gambar_url FROM foto_user WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        
        if ($data) {
            $file = __DIR__ . '/../../public/' . $data['gambar_url'];
            if (file_exists($file)) unlink($file);
        }
        
        $stmt = $this->conn->prepare("DELETE FROM foto_user WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // Hitung total foto pending (untuk notif dashboard)
    public function countPending() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM foto_user WHERE status = 'menunggu'");
        return $stmt->fetch()['total'];
    }
}
?>