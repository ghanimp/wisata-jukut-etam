<?php
// ================================================
// USERCONTROLLER - Profil & Riwayat User
// ================================================

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/FotoUser.php';
require_once __DIR__ . '/../models/Ulasan.php';

class UserController extends Controller {
    
    // Halaman Profil User
    public function profile() {
        $this->requireLogin();
        
        $user_id = $_SESSION['user_id'];
        
        $userModel = new User($this->conn);
        $fotoUserModel = new FotoUser($this->conn);
        $ulasanModel = new Ulasan($this->conn);
        
        $user = $userModel->getById($user_id);
        $foto_saya = $fotoUserModel->getByUserId($user_id);
        $ulasan_saya = $ulasanModel->getByUserId($user_id);
        
        $flash = $this->getFlash();
        
        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/profile.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
?>