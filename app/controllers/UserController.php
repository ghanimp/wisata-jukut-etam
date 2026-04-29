<?php
// ================================================
// USERCONTROLLER - Profil & Riwayat User
// ================================================

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/FotoUser.php';
require_once __DIR__ . '/../models/Ulasan.php';

class UserController extends Controller
{

    // Halaman Profil User
    public function profile()
    {
        $this->requireLogin();

        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Ulasan.php';
        require_once __DIR__ . '/../models/FotoUser.php';
        require_once __DIR__ . '/../models/Pemesanan.php';

        $userModel = new User($this->conn);
        $ulasanModel = new Ulasan($this->conn);
        $fotoUserModel = new FotoUser($this->conn);
        $pemesananModel = new Pemesanan($this->conn);

        $user = $userModel->getById($_SESSION['user_id']);
        $ulasan_saya = $ulasanModel->getByUserId($_SESSION['user_id']);
        $foto_saya = $fotoUserModel->getByUserId($_SESSION['user_id']);
        $riwayat_pemesanan = $pemesananModel->getByUserId($_SESSION['user_id']);

        $jml_ulasan = count($ulasan_saya ?? []);
        $jml_foto = count($foto_saya ?? []);
        $jml_pesan = count($riwayat_pemesanan ?? []);
        $inisial = strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)); // 🔥 TAMBAHIN INI

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/profile.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
?>