<?php
// ================================================
// AUTHCONTROLLER - Login, Register, Logout
// ================================================

require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {

    // ================================================
    // HALAMAN LOGIN + PROSES LOGIN
    // ================================================
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
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $flash = ['type' => 'danger', 'message' => 'Email dan password tidak boleh kosong!'];
            } else {
                $user = $userModel->loginByEmail($email, $password);

                if ($user) {
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role']     = $user['role'];

                    $this->setFlash('success', 'Selamat datang, ' . $user['username'] . '! 👋');

                    if ($user['role'] === 'admin') {
                        $this->redirect($this->baseUrl . '/index.php?c=admin&m=dashboard');
                    } else {
                        $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
                    }
                } else {
                    $flash = ['type' => 'danger', 'message' => 'Email atau password salah!'];
                }
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    // ================================================
    // HALAMAN REGISTER + PROSES REGISTER
    // ================================================
    public function register() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
        }

        $userModel = new User($this->conn);
        $flash = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username   = trim($_POST['username'] ?? '');
            $email      = trim($_POST['email'] ?? '');
            $password   = trim($_POST['password'] ?? '');
            $konfirmasi = trim($_POST['konfirmasi_password'] ?? '');

            if (empty($username) || empty($email) || empty($password)) {
                $flash = ['type' => 'danger', 'message' => 'Semua field wajib diisi!'];
            } elseif ($password !== $konfirmasi) {
                $flash = ['type' => 'danger', 'message' => 'Password dan konfirmasi tidak cocok!'];
            } elseif (strlen($password) < 6) {
                $flash = ['type' => 'danger', 'message' => 'Password minimal 6 karakter!'];
            } elseif ($userModel->isExist($username, $email)) {
                $flash = ['type' => 'danger', 'message' => 'Username atau email sudah terdaftar!'];
            } else {
                if ($userModel->register($username, $email, $password)) {
                    $this->setFlash('success', 'Akun berhasil dibuat! Silakan login. ✅');
                    $this->redirect($this->baseUrl . '/index.php?c=auth&m=login');
                } else {
                    $flash = ['type' => 'danger', 'message' => 'Gagal membuat akun, coba lagi.'];
                }
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    // ================================================
    // LOGOUT
    // ================================================
    public function logout() {
        session_destroy();
        $this->redirect($this->baseUrl . '/index.php?c=home&m=index');
    }
}
?>