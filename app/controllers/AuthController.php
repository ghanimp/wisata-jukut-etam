<?php
// ================================================
// AUTHCONTROLLER - Login, Register, Logout
// ================================================

require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {
    
    // Halaman Login + Proses Login
public function login() {
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['role'] === 'admin') {
            $this->redirect($this->baseUrl . '/index.php?c=admin&m=dashboard');
        } else {
            $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
        }
    }
    
    $userModel = new User($this->conn);
    $flash = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        if (empty($username) || empty($password)) {
            $flash = ['type' => 'danger', 'message' => 'Username dan password tidak boleh kosong!'];
        } else {
            $user = $userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                $this->setFlash('success', 'Selamat datang, ' . $user['username'] . '! 👋');
                
                if ($user['role'] === 'admin') {
                    $this->redirect($this->baseUrl . '/index.php?c=admin&m=dashboard');
                } else {
                    $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
                }
            } else {
                $flash = ['type' => 'danger', 'message' => 'Username atau password salah!'];
            }
        }
    }
    
    $activeTab = 'login';
    require_once __DIR__ . '/../views/auth/login.php';
}
    
    // Halaman Register + Proses Register
public function register() {
    if (isset($_SESSION['user_id'])) {
        $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
    }
    
    $userModel = new User($this->conn);
    $flash_register = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $konfirmasi = trim($_POST['konfirmasi_password'] ?? '');
        
        if (empty($username) || empty($email) || empty($password)) {
            $flash_register = ['type' => 'danger', 'message' => 'Semua field wajib diisi!'];
        } elseif ($password !== $konfirmasi) {
            $flash_register = ['type' => 'danger', 'message' => 'Password dan konfirmasi tidak cocok!'];
        } elseif (strlen($password) < 6) {
            $flash_register = ['type' => 'danger', 'message' => 'Password minimal 6 karakter!'];
        } elseif ($userModel->isExist($username, $email)) {
            $flash_register = ['type' => 'danger', 'message' => 'Username atau email sudah terdaftar!'];
        } else {
            if ($userModel->register($username, $email, $password)) {
                $this->setFlash('success', 'Akun berhasil dibuat! Silakan login. ✅');
                $this->redirect($this->baseUrl . '/index.php?c=auth&m=login');
            } else {
                $flash_register = ['type' => 'danger', 'message' => 'Gagal membuat akun, coba lagi.'];
            }
        }
    }
    
    $activeTab = 'register';
    require_once __DIR__ . '/../views/auth/login.php';
}
    
    // Logout
    public function logout() {
        session_destroy();
        header('Location: ' . $this->baseUrl . '/index.php?c=home&m=index');
        exit;
    }
}
?>