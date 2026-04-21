<?php
// ================================================
// HOMECONTROLLER - Halaman Publik
// ================================================

// Panggil semua model yang dibutuhkan
require_once __DIR__ . '/../models/HargaKolam.php';
require_once __DIR__ . '/../models/HargaPemancingan.php';
require_once __DIR__ . '/../models/HargaSewa.php';
require_once __DIR__ . '/../models/Galeri.php';
require_once __DIR__ . '/../models/Fasilitas.php';
require_once __DIR__ . '/../models/Ulasan.php';

class HomeController extends Controller {
    
    // Halaman Beranda
    public function index() {
        require_once __DIR__ . '/../models/HargaKolam.php';
        require_once __DIR__ . '/../models/HargaPemancingan.php';
        require_once __DIR__ . '/../models/HargaSewa.php';
        require_once __DIR__ . '/../models/Galeri.php';
        require_once __DIR__ . '/../models/Fasilitas.php';
        require_once __DIR__ . '/../models/Ulasan.php';
        
        $hargaKolamModel = new HargaKolam($this->conn);
        $hargaPemancinganModel = new HargaPemancingan($this->conn);
        $hargaSewaModel = new HargaSewa($this->conn);
        $galeriModel = new Galeri($this->conn);
        $fasilitasModel = new Fasilitas($this->conn);
        $ulasanModel = new Ulasan($this->conn);
        
        // Buat variabel yang akan dikirim ke view
        $harga_kolam = $hargaKolamModel->getAll();
        $harga_pemancingan = $hargaPemancinganModel->getAll();
        $harga_sewa = $hargaSewaModel->getAll();
        $galeri_preview = $galeriModel->getLatest(4);
        $fasilitas = $fasilitasModel->getAll();
        $ulasan = $ulasanModel->getApproved();
        $avg_rating = $ulasanModel->getAverageRating();
        
        $flash = $this->getFlash();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    
    // Halaman Tentang
    public function tentang() {
        require_once __DIR__ . '/../models/Fasilitas.php';
        $fasilitasModel = new Fasilitas($this->conn);
        $fasilitas = $fasilitasModel->getAll();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/tentang.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    
    // Halaman Info & Harga
    public function info() {
        require_once __DIR__ . '/../models/HargaKolam.php';
        require_once __DIR__ . '/../models/HargaPemancingan.php';
        require_once __DIR__ . '/../models/HargaSewa.php';
        
        $hargaKolamModel = new HargaKolam($this->conn);
        $hargaPemancinganModel = new HargaPemancingan($this->conn);
        $hargaSewaModel = new HargaSewa($this->conn);
        
        // Buat variabel terpisah (bukan dalam array)
        $harga_kolam = $hargaKolamModel->getAll();
        $harga_pemancingan = $hargaPemancinganModel->getAll();
        $harga_sewa = $hargaSewaModel->getAll();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/info.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    
    // Halaman Ulasan (GET + POST)
    public function ulasan() {
        require_once __DIR__ . '/../models/Ulasan.php';
        $ulasanModel = new Ulasan($this->conn);
        
        // Proses POST: Tambah ulasan
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            $rating = (int)($_POST['rating'] ?? 0);
            $ulasan_text = trim($_POST['ulasan'] ?? '');
            
            if ($rating >= 1 && $rating <= 5 && !empty($ulasan_text)) {
                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'nama' => $_SESSION['username'],
                    'rating' => $rating,
                    'ulasan' => $ulasan_text,
                    'tanggal' => date('Y-m-d')
                ];
                
                if ($ulasanModel->create($data)) {
                    $this->setFlash('success', 'Terima kasih! Ulasan kamu sudah dikirim dan menunggu persetujuan admin. 🎉');
                } else {
                    $this->setFlash('danger', 'Gagal menambahkan ulasan. Silakan coba lagi.');
                }
                $this->redirect(BASE_URL . '/index.php?c=home&m=ulasan');
            } else {
                $this->setFlash('warning', 'Mohon isi rating dan ulasan dengan benar.');
                $this->redirect(BASE_URL . '/index.php?c=home&m=ulasan');
            }
        }
        
        $ulasanList = $ulasanModel->getApproved();
        $avg_rating = $ulasanModel->getAverageRating();
        $flash = $this->getFlash();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/ulasan.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
?>