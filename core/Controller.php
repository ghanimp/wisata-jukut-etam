<?php
// ================================================
// BASE CONTROLLER (PARENT CLASS UNTUK SEMUA CONTROLLER)
// ================================================

require_once __DIR__ . '/Database.php';

class Controller {
    protected $conn;
    protected $baseUrl;
    
    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
        $this->baseUrl = BASE_URL;
    }
    
    // ── Cek apakah user sudah login ──
    protected function requireLogin() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->baseUrl . '/index.php?c=auth&m=login');
            exit;
        }
    }
    
    // ── Cek apakah user adalah admin ──
    protected function requireAdmin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . $this->baseUrl . '/index.php?c=auth&m=login');
            exit;
        }
    }
    
    // ── Set flash message (pesan setelah redirect) ──
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }
    
    // ── Ambil dan hapus flash message ──
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
    
    // ── Sanitasi input dari user ──
    protected function sanitize($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    // ── Redirect ke URL ──
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    
    // ── Upload gambar — validasi ketat ──
    protected function uploadGambar($file, $folder = 'galeri') {
        $uploadDir = __DIR__ . '/../public/uploads/' . $folder . '/';
        
        // Buat folder jika belum ada
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Validasi: file harus ada dan tidak error
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File tidak valid atau terjadi error upload.'];
        }
        
        // Validasi ukuran (max 2MB)
        if ($file['size'] > 2 * 1024 * 1024) {
            return ['success' => false, 'message' => 'Ukuran file maksimal 2MB.'];
        }
        
        // Validasi tipe MIME asli
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mime, $allowedMime)) {
            return ['success' => false, 'message' => 'Format file harus JPG, PNG, atau WebP.'];
        }
        
        // Generate nama file unik
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
        $dest     = $uploadDir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            return ['success' => true, 'filename' => 'uploads/' . $folder . '/' . $filename];
        }
        
        return ['success' => false, 'message' => 'Gagal menyimpan file. Cek permission folder.'];
    }
    
    // ── Load view dengan data ──
    protected function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View {$view} tidak ditemukan");
        }
    }
}
?>