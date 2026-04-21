<?php
// ================================================
// ADMINCONTROLLER - Panel Admin (CRUD semua data)
// ================================================

require_once __DIR__ . '/../models/Galeri.php';
require_once __DIR__ . '/../models/FotoUser.php';
require_once __DIR__ . '/../models/Ulasan.php';
require_once __DIR__ . '/../models/Fasilitas.php';
require_once __DIR__ . '/../models/HargaKolam.php';
require_once __DIR__ . '/../models/HargaPemancingan.php';
require_once __DIR__ . '/../models/HargaSewa.php';
require_once __DIR__ . '/../models/User.php';

class AdminController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->requireAdmin();
    }
    
    // ========== DASHBOARD ==========
    public function dashboard() {
        require_once __DIR__ . '/../models/Galeri.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Ulasan.php';
        require_once __DIR__ . '/../models/FotoUser.php';
        
        $galeriModel = new Galeri($this->conn);
        $userModel = new User($this->conn);
        $ulasanModel = new Ulasan($this->conn);
        $fotoUserModel = new FotoUser($this->conn);
        
        $total_galeri = $galeriModel->count();
        $total_user = $userModel->count();
        $total_ulasan_pending = $ulasanModel->countPending();
        $total_ulasan_aktif = $ulasanModel->countActive();
        $total_foto_pending = $fotoUserModel->countPending();
        
        $flash = $this->getFlash();
        $active_menu = 'dashboard'; 
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/dashboard.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    // ========== KELOLA GALERI ==========
    public function galeri() {
        require_once __DIR__ . '/../models/Galeri.php';
        require_once __DIR__ . '/../models/FotoUser.php';
        
        $galeriModel = new Galeri($this->conn);
        $fotoUserModel = new FotoUser($this->conn);
        
        $galeri = $galeriModel->getAll();
        $foto_user_menunggu = $fotoUserModel->getPending();   // status 'menunggu'
        $foto_user_disetujui = $fotoUserModel->getApproved(); // status 'disetujui'
        
        $page_title = 'Kelola Galeri';
        $page_icon = 'fas fa-images';
        $active_menu = 'galeri';
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/galeri/index.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    public function galeriTambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $this->sanitize($_POST['judul'] ?? '');
            $kategori = $_POST['kategori'] ?? 'Suasana';
            $deskripsi = $this->sanitize($_POST['deskripsi'] ?? '');
            
            // Validasi upload gambar
            $upload = $this->uploadGambar($_FILES['gambar'] ?? [], 'galeri');
            
            if (!$upload['success']) {
                $this->setFlash('danger', $upload['message']);
                $this->redirect(BASE_URL . '/index.php?c=admin&m=galeriTambah');
            }
            
            // Simpan ke database
            $galeriModel = new Galeri($this->conn);
            $data = [
                'judul' => $judul,
                'kategori' => $kategori,
                'gambar_url' => $upload['filename'],
                'deskripsi' => $deskripsi
            ];
            
            if ($galeriModel->create($data)) {
                $this->setFlash('success', 'Foto berhasil ditambahkan! ✅');
            } else {
                $this->setFlash('danger', 'Gagal menambahkan foto.');
            }
            $this->redirect(BASE_URL . '/index.php?c=admin&m=galeri');
        }
        
        // Tampilkan form tambah
        $page_title = 'Tambah Foto Galeri';
        $page_icon = 'fas fa-plus';
        $active_menu = 'galeri';
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/galeri/tambah.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function galeriEdit() {
        $id = (int)($_GET['id'] ?? 0);
        $galeriModel = new Galeri($this->conn);
        $data = $galeriModel->getById($id);
        
        if (!$data) {
            $this->setFlash('danger', 'Data tidak ditemukan.');
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=galeri');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = [
                'judul' => $this->sanitize($_POST['judul'] ?? ''),
                'kategori' => $_POST['kategori'] ?? $data['kategori'],
                'gambar_url' => $data['gambar_url'],
                'deskripsi' => $this->sanitize($_POST['deskripsi'] ?? '')
            ];
            
            // Jika ada upload gambar baru
            if (!empty($_FILES['gambar']['name'])) {
                $upload = $this->uploadGambar($_FILES['gambar'], 'galeri');
                if ($upload['success']) {
                    // Hapus gambar lama
                    $oldFile = __DIR__ . '/../public/' . $data['gambar_url'];
                    if (file_exists($oldFile)) unlink($oldFile);
                    $updateData['gambar_url'] = $upload['filename'];
                } else {
                    $this->setFlash('danger', $upload['message']);
                    $this->redirect($this->baseUrl . '/index.php?c=admin&m=galeriEdit&id=' . $id);
                }
            }
            
            if ($galeriModel->update($id, $updateData)) {
                $this->setFlash('success', 'Foto berhasil diupdate! ✅');
            } else {
                $this->setFlash('danger', 'Gagal mengupdate foto.');
            }
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=galeri');
        }
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/galeri/edit.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function galeriHapus() {
        $id = (int)($_GET['id'] ?? 0);
        $galeriModel = new Galeri($this->conn);
        
        if ($galeriModel->delete($id)) {
            $this->setFlash('success', 'Foto berhasil dihapus!');
        } else {
            $this->setFlash('danger', 'Data tidak ditemukan.');
        }
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=galeri');
    }
    
    // ========== KELOLA FOTO USER ==========
    public function fotoUserApprove() {
        $id = (int)($_GET['id'] ?? 0);
        $fotoUserModel = new FotoUser($this->conn);
        
        if ($fotoUserModel->approve($id)) {
            $this->setFlash('success', 'Foto berhasil disetujui!');
        } else {
            $this->setFlash('danger', 'Gagal menyetujui foto.');
        }
        $this->redirect(BASE_URL . '/index.php?c=admin&m=galeri');
    }
    
    public function fotoUserReject() {
        $id = (int)($_GET['id'] ?? 0);
        $fotoUserModel = new FotoUser($this->conn);
        
        if ($fotoUserModel->reject($id)) {
            $this->setFlash('success', 'Foto berhasil ditolak.');
        } else {
            $this->setFlash('danger', 'Gagal menolak foto.');
        }
        $this->redirect(BASE_URL . '/index.php?c=admin&m=galeri');
    }
    
    public function fotoUserHapus() {
        $id = (int)($_GET['id'] ?? 0);
        $fotoUserModel = new FotoUser($this->conn);
        
        if ($fotoUserModel->delete($id)) {
            $this->setFlash('success', 'Foto berhasil dihapus!');
        } else {
            $this->setFlash('danger', 'Gagal menghapus foto.');
        }
        $this->redirect(BASE_URL . '/index.php?c=admin&m=galeri');
    }
    
    // ========== KELOLA ULASAN ==========
    public function ulasan() {
        require_once __DIR__ . '/../models/Ulasan.php';
        $ulasanModel = new Ulasan($this->conn);
        $ulasan = $ulasanModel->getAll();
        
        $flash = $this->getFlash();
        $active_menu = 'ulasan'; 
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/ulasan/index.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function ulasanApprove() {
        $id = (int)($_GET['id'] ?? 0);
        $ulasanModel = new Ulasan($this->conn);
        
        if ($ulasanModel->approve($id)) {
            $this->setFlash('success', 'Ulasan berhasil disetujui!');
        } else {
            $this->setFlash('danger', 'Gagal menyetujui ulasan.');
        }
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=ulasan');
    }
    
    public function ulasanReject() {
        $id = (int)($_GET['id'] ?? 0);
        $ulasanModel = new Ulasan($this->conn);
        
        if ($ulasanModel->reject($id)) {
            $this->setFlash('success', 'Ulasan berhasil ditolak.');
        } else {
            $this->setFlash('danger', 'Gagal menolak ulasan.');
        }
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=ulasan');
    }
    
    public function ulasanHapus() {
        $id = (int)($_GET['id'] ?? 0);
        $ulasanModel = new Ulasan($this->conn);
        
        if ($ulasanModel->delete($id)) {
            $this->setFlash('success', 'Ulasan berhasil dihapus!');
        } else {
            $this->setFlash('danger', 'Gagal menghapus ulasan.');
        }
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=ulasan');
    }
    
    // ========== KELOLA FASILITAS ==========
    public function fasilitas() {
        require_once __DIR__ . '/../models/Fasilitas.php';
        $fasilitasModel = new Fasilitas($this->conn);
        $fasilitas = $fasilitasModel->getAll();
        
        $flash = $this->getFlash();
        $active_menu = 'fasilitas'; 
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/fasilitas/index.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function fasilitasTambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama' => $this->sanitize($_POST['nama_fasilitas'] ?? ''),
                'icon' => $this->sanitize($_POST['icon'] ?? 'fas fa-circle'),
                'keterangan' => $this->sanitize($_POST['keterangan'] ?? ''),
                'urutan' => (int)($_POST['urutan'] ?? 0)
            ];
            
            $fasilitasModel = new Fasilitas($this->conn);
            
            if ($fasilitasModel->create($data)) {
                $this->setFlash('success', 'Fasilitas berhasil ditambahkan! ✅');
            } else {
                $this->setFlash('danger', 'Gagal menambahkan fasilitas.');
            }
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=fasilitas');
        }
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/fasilitas/tambah.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function fasilitasEdit() {
        $id = (int)($_GET['id'] ?? 0);
        $fasilitasModel = new Fasilitas($this->conn);
        $data = $fasilitasModel->getById($id);
        
        if (!$data) {
            $this->setFlash('danger', 'Data tidak ditemukan.');
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=fasilitas');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = [
                'nama' => $this->sanitize($_POST['nama_fasilitas'] ?? ''),
                'icon' => $this->sanitize($_POST['icon'] ?? ''),
                'keterangan' => $this->sanitize($_POST['keterangan'] ?? ''),
                'urutan' => (int)($_POST['urutan'] ?? 0)
            ];
            
            if ($fasilitasModel->update($id, $updateData)) {
                $this->setFlash('success', 'Fasilitas berhasil diupdate! ✅');
            } else {
                $this->setFlash('danger', 'Gagal mengupdate fasilitas.');
            }
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=fasilitas');
        }
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/fasilitas/edit.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function fasilitasHapus() {
        $id = (int)($_GET['id'] ?? 0);
        $fasilitasModel = new Fasilitas($this->conn);
        
        if ($fasilitasModel->delete($id)) {
            $this->setFlash('success', 'Fasilitas berhasil dihapus!');
        } else {
            $this->setFlash('danger', 'Gagal menghapus fasilitas.');
        }
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=fasilitas');
    }
    
    // ========== KELOLA HARGA ==========
    public function harga() {
        require_once __DIR__ . '/../models/HargaKolam.php';
        require_once __DIR__ . '/../models/HargaPemancingan.php';
        require_once __DIR__ . '/../models/HargaSewa.php';
        
        $hargaKolamModel = new HargaKolam($this->conn);
        $hargaPemancinganModel = new HargaPemancingan($this->conn);
        $hargaSewaModel = new HargaSewa($this->conn);
        
        $harga_kolam = $hargaKolamModel->getAll();
        $harga_pemancingan = $hargaPemancinganModel->getAll();
        $harga_sewa = $hargaSewaModel->getAll();
        
        $flash = $this->getFlash();
        $active_menu = 'harga'; 
        
        require_once __DIR__ . '/../views/layouts/admin_header.php';
        require_once __DIR__ . '/../views/admin/harga/index.php';
        require_once __DIR__ . '/../views/layouts/admin_footer.php';
    }
    
    public function hargaUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=harga');
        }
        
        $hargaKolamModel = new HargaKolam($this->conn);
        $hargaPemancinganModel = new HargaPemancingan($this->conn);
        $hargaSewaModel = new HargaSewa($this->conn);
        
        // Update harga kolam
        if (isset($_POST['harga_kolam'])) {
            foreach ($_POST['harga_kolam'] as $id => $harga) {
                $hargaKolamModel->update($id, (int)$harga);
            }
        }
        
        // Update harga pemancingan
        if (isset($_POST['harga_pemancingan'])) {
            foreach ($_POST['harga_pemancingan'] as $id => $harga) {
                $hargaPemancinganModel->update($id, $harga);
            }
        }
        
        // Update harga sewa
        if (isset($_POST['harga_sewa'])) {
            foreach ($_POST['harga_sewa'] as $id => $harga) {
                $hargaSewaModel->update($id, $harga);
            }
        }
        
        $this->setFlash('success', 'Harga berhasil diupdate! ✅');
        $this->redirect($this->baseUrl . '/index.php?c=admin&m=harga');
    }
}
?>