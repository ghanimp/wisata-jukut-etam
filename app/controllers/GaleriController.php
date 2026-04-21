<?php
// ================================================
// GALERICONTROLLER - Halaman Galeri Publik + Upload User
// ================================================

require_once __DIR__ . '/../models/Galeri.php';
require_once __DIR__ . '/../models/FotoUser.php';

class GaleriController extends Controller {
    
    // Halaman Galeri
    public function index() {
        $galeriModel  = new Galeri($this->conn);
        $fotoUserModel = new FotoUser($this->conn);
        
        $kategori      = $_GET['kategori'] ?? 'semua';
        $kategoriValid = ['Kolam', 'Pemancingan', 'Fasilitas', 'Suasana'];
        
        if ($kategori !== 'semua' && in_array($kategori, $kategoriValid)) {
            $galeri = $galeriModel->getByKategori($kategori);
        } else {
            $galeri   = $galeriModel->getAll();
            $kategori = 'semua';
        }
        
        $foto_user = $fotoUserModel->getApproved();
        $flash     = $this->getFlash();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/galeri/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    
    // ================================================
    // PROSES UPLOAD FOTO (USER)
    // ================================================
    public function upload() {
        $this->requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // --------------------------------------------------
        // FIX 1: Ambil nama user dari session dengan fallback
        // Cek semua kemungkinan key session yang dipakai
        // --------------------------------------------------
        $nama_user = $_SESSION['username']
                  ?? $_SESSION['nama']
                  ?? $_SESSION['name']
                  ?? 'Pengunjung';

        $judul     = $this->sanitize($_POST['judul_foto'] ?? $_POST['judul'] ?? '');
        $deskripsi = $this->sanitize($_POST['deskripsi'] ?? '');
        
        // --------------------------------------------------
        // FIX 2: Tulis log debug ke file (tidak merusak halaman)
        // Hapus blok ini setelah upload berhasil
        // --------------------------------------------------
        $logFile = __DIR__ . '/../debug_upload.txt';
        $logData = date('Y-m-d H:i:s') . "\n"
                 . "SESSION  : " . print_r($_SESSION, true)
                 . "POST     : " . print_r($_POST, true)
                 . "FILES    : " . print_r($_FILES, true)
                 . "nama_user: " . $nama_user . "\n"
                 . "judul    : " . $judul . "\n"
                 . str_repeat('-', 60) . "\n";
        file_put_contents($logFile, $logData, FILE_APPEND);
        // --------------------------------------------------

        if (empty($judul)) {
            $this->setFlash('danger', 'Judul foto tidak boleh kosong!');
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }
        
        // --------------------------------------------------
        // FIX 3: Cek nama field file — form pakai name="gambar"
        // Kalau masih gagal ganti 'gambar' sesuai name di form HTML
        // --------------------------------------------------
        $fileKey = isset($_FILES['gambar']) ? 'gambar' : (isset($_FILES['foto']) ? 'foto' : null);

        if (!$fileKey) {
            $this->setFlash('danger', 'Tidak ada file yang dikirim. Pastikan kamu memilih foto.');
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        $upload = $this->uploadGambar($_FILES[$fileKey], 'user');

        // Tulis hasil upload ke log juga
        file_put_contents($logFile,
            "UPLOAD RESULT: " . print_r($upload, true) . "\n" . str_repeat('=', 60) . "\n",
            FILE_APPEND
        );
        
        if (!$upload['success']) {
            $this->setFlash('danger', 'Upload gagal: ' . $upload['message']);
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }
        
        // --------------------------------------------------
        // FIX 4: Pastikan semua key array cocok dengan FotoUser::create()
        // --------------------------------------------------
        $data = [
            'user_id'    => $_SESSION['user_id'],
            'nama_user'  => $nama_user,
            'judul'      => $judul,       // FotoUser::create() pakai $data['judul']
            'gambar_url' => $upload['filename'],
            'deskripsi'  => $deskripsi
        ];
        
        $fotoUserModel = new FotoUser($this->conn);
        
        if ($fotoUserModel->create($data)) {
            $this->setFlash('success', 'Foto berhasil dikirim! Menunggu persetujuan admin. 📸');
        } else {
            // --------------------------------------------------
            // FIX 5: Tangkap error PDO supaya kelihatan pesannya
            // --------------------------------------------------
            $this->setFlash('danger', 'Foto terupload tapi gagal disimpan ke database. Cek debug_upload.txt');
        }
        
        $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
    }
}
?>