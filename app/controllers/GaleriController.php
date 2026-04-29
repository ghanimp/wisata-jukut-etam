<?php
// GALERICONTROLLER - Halaman Galeri Publik + Upload User

require_once __DIR__ . '/../models/Galeri.php';
require_once __DIR__ . '/../models/FotoUser.php';

class GaleriController extends Controller
{

    // Halaman Galeri
    public function index()
    {
        $galeriModel = new Galeri($this->conn);
        $fotoUserModel = new FotoUser($this->conn);

        $kategori = $_GET['kategori'] ?? 'semua';
        $kategoriValid = ['Kolam', 'Pemancingan', 'Fasilitas', 'Suasana'];

        if ($kategori !== 'semua' && in_array($kategori, $kategoriValid)) {
            $galeri = $galeriModel->getByKategori($kategori);
        } else {
            $galeri = $galeriModel->getAll();
            $kategori = 'semua';
        }

        $foto_user = $fotoUserModel->getApproved();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/galeri/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // PROSES UPLOAD FOTO (USER)
    public function upload()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // Ambil nama user dari session dengan fallback
        $nama_user = $_SESSION['username']
            ?? $_SESSION['nama']
            ?? $_SESSION['name']
            ?? 'Pengunjung';

        $judul = $this->sanitize($_POST['judul_foto'] ?? $_POST['judul'] ?? '');
        $deskripsi = $this->sanitize($_POST['deskripsi'] ?? '');

        if (empty($judul)) {
            $this->setFlash('danger', 'Judul foto tidak boleh kosong!');
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // Cek nama field file
        $fileKey = isset($_FILES['gambar']) ? 'gambar' : (isset($_FILES['foto']) ? 'foto' : null);

        if (!$fileKey) {
            $this->setFlash('danger', 'Tidak ada file yang dikirim. Pastikan kamu memilih foto.');
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // Validasi format file
        $allowedMime = ['image/jpeg', 'image/png'];
        $allowedExt = ['jpg', 'jpeg', 'png'];

        $fileTmp = $_FILES[$fileKey]['tmp_name'];
        $fileName = $_FILES[$fileKey]['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileTmp);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMime) || !in_array($fileExt, $allowedExt)) {
            $this->setFlash('danger', 'Format file tidak valid! Hanya JPEG dan PNG yang diperbolehkan.');
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // Upload gambar
        $upload = $this->uploadGambar($_FILES[$fileKey], 'user');

        if (!$upload['success']) {
            $this->setFlash('danger', 'Upload gagal: ' . $upload['message']);
            $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
        }

        // Simpan ke database
        $data = [
            'user_id' => $_SESSION['user_id'],
            'nama_user' => $nama_user,
            'judul' => $judul,
            'gambar_url' => $upload['filename'],
            'deskripsi' => $deskripsi
        ];

        $fotoUserModel = new FotoUser($this->conn);

        if ($fotoUserModel->create($data)) {
            $this->setFlash('success', 'Foto berhasil dikirim! Menunggu persetujuan admin. 📸');
        } else {
            $this->setFlash('danger', 'Gagal menyimpan foto ke database.');
        }

        $this->redirect($this->baseUrl . '/index.php?c=galeri&m=index');
    }
}
?>