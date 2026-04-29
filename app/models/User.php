<?php
// ================================================
// MODEL USER
// ================================================

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua user
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // Ambil user berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Ambil user berdasarkan username
    public function getByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    // ================================================
    // LOGIN DENGAN EMAIL + password_hash (AMAN)
    // ================================================
    public function loginByEmail($email, $password) {
        // Ambil user dulu berdasarkan email
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verifikasi password dengan password_verify (aman)
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        // Fallback: coba md5 untuk user lama yang belum dimigrasi
        if ($user && $user['password'] === md5($password)) {
            // Auto-upgrade hash ke bcrypt sekalian
            $this->upgradePassword($user['id'], $password);
            return $user;
        }

        return false;
    }

    // Login dengan username (untuk admin lama, opsional)
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        // Fallback md5
        if ($user && $user['password'] === md5($password)) {
            $this->upgradePassword($user['id'], $password);
            return $user;
        }
        return false;
    }

    // Upgrade hash lama (md5) ke bcrypt otomatis
    private function upgradePassword($id, $plainPassword) {
        $newHash = password_hash($plainPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$newHash, $id]);
    }

    // ================================================
    // REGISTER dengan password_hash (AMAN)
    // ================================================
    public function register($username, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')"
        );
        return $stmt->execute([$username, $email, $hash]);
    }

    // Cek username atau email sudah ada
    public function isExist($username, $email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        return $stmt->fetch() ? true : false;
    }

    // Hitung total user
    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
        return $stmt->fetch()['total'];
    }
}
?>