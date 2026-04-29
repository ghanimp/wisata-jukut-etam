<?php

require_once __DIR__ . '/../models/HargaKolam.php';
require_once __DIR__ . '/../models/HargaPemancingan.php';
require_once __DIR__ . '/../models/HargaSewa.php';
require_once __DIR__ . '/../models/Galeri.php';
require_once __DIR__ . '/../models/Fasilitas.php';
require_once __DIR__ . '/../models/Ulasan.php';
require_once __DIR__ . '/../models/Pemesanan.php';

class HomeController extends Controller
{

    public function index()
    {
        $galeriModel = new Galeri($this->conn);
        $fasilitasModel = new Fasilitas($this->conn);
        $ulasanModel = new Ulasan($this->conn);

        $galeri_preview = $galeriModel->getLatest(4);
        $fasilitas = $fasilitasModel->getAll();
        $ulasan = $ulasanModel->getApproved();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function tentang()
    {
        $fasilitasModel = new Fasilitas($this->conn);
        $fasilitas = $fasilitasModel->getAll();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/tentang.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function info()
    {
        $hargaKolamModel = new HargaKolam($this->conn);
        $hargaPemancinganModel = new HargaPemancingan($this->conn);
        $hargaSewaModel = new HargaSewa($this->conn);

        $harga_kolam = $hargaKolamModel->getAll();
        $harga_pemancingan = $hargaPemancinganModel->getAll();
        $harga_sewa = $hargaSewaModel->getAll();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/info.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function ulasan()
    {
        $ulasanModel = new Ulasan($this->conn);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            $rating = (int) ($_POST['rating'] ?? 0);
            $ulasan_text = trim($_POST['ulasan'] ?? '');

            if ($rating >= 1 && $rating <= 5 && !empty($ulasan_text)) {
                $data = [
                    'user_id' => $_SESSION['user_id'],
                    'nama' => $_SESSION['username'],
                    'rating' => $rating,
                    'ulasan' => $ulasan_text,
                    'tanggal' => date('Y-m-d')
                ];

                if ($ulasanModel->create($data)) {
                    $this->setFlash('success', 'Terima kasih! Ulasan kamu sudah dikirim.');
                } else {
                    $this->setFlash('error', 'Gagal menambahkan ulasan.');
                }
                $this->redirect(BASE_URL . '/index.php?c=home&m=ulasan');
            }
        }

        $ulasanList = $ulasanModel->getApproved();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/home/ulasan.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function pesanTiket()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->setFlash('error', 'Silakan login terlebih dahulu!');
            $this->redirect(BASE_URL . '/index.php?c=auth&m=login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'] ?? '';
            $jumlah = (int) ($_POST['jumlah'] ?? 1);

            // Validasi tanggal kosong
            if (empty($tanggal)) {
                $this->setFlash('error', 'Tanggal kunjungan harus diisi!');
                $this->redirect(BASE_URL . '/index.php?c=home&m=info');
            }

            // 🔥 HARGA BERDASARKAN HARI
            $day = date('w', strtotime($tanggal)); // 0=Minggu, 6=Sabtu, 1=Senin
            $harga_per_tiket = ($day == 0 || $day == 6) ? 20000 : 15000;

            // ✅ VALIDASI SENIN TUTUP
            if ($day == 1) {
                $this->setFlash('error', 'Maaf, Jukut Etam tutup setiap hari Senin. Silakan pilih hari lain.');
                $this->redirect(BASE_URL . '/index.php?c=home&m=info');
            }

            $total = $jumlah * $harga_per_tiket;
            $kode = 'JKT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

            require_once __DIR__ . '/../models/Pemesanan.php';
            $pemesananModel = new Pemesanan($this->conn);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'kode_pemesanan' => $kode,
                'tanggal' => $tanggal,
                'jumlah' => $jumlah,
                'total' => $total
            ];

            if ($pemesananModel->create($data)) {
                $this->setFlash('success', '🎉 Pemesanan berhasil! Kode: <strong>' . $kode . '</strong> | Total: <strong>Rp' . number_format($total) . '</strong>');
            } else {
                $this->setFlash('error', 'Gagal melakukan pemesanan!');
            }
            $this->redirect(BASE_URL . '/index.php?c=home&m=info');
        }
    }
}
?>