<?php
// ================================================
// KONFIGURASI DATABASE & BASE URL
// ================================================

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_jukut_etam');
// Base URL (sesuaikan dengan nama folder project)
define('BASE_URL', 'http://localhost/jukut_etam/public');

// Timezone
date_default_timezone_set('Asia/Makassar');

// Error reporting (nonaktifkan saat production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>