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
    
    // Cek login
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->execute([$username, md5($password)]);
        return $stmt->fetch();
    }
    
    // Registrasi user baru
    public function register($username, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
        return $stmt->execute([$username, $email, md5($password)]);
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