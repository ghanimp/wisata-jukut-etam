<div class="page-header text-center" style="background: linear-gradient(135deg, #0A2540 0%, #006BBB 100%); padding: 80px 0; margin-top: 66px;">
    <div class="container">
        <h1 style="color: #FFC973; font-family: 'Playfair Display', serif;"><i class="fas fa-user-circle me-2"></i> Profil Saya</h1>
        <p class="lead" style="color: white;">Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Informasi Akun -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header" style="background: linear-gradient(135deg, #0A2540, #006BBB); color: white; border: none; padding: 15px 20px;">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2" style="color: #FFC973;"></i> Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-user me-2"></i>Username:</strong> <?= $user['username'] ?></p>
                    <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong> <?= $user['email'] ?></p>
                    <p><strong><i class="fas fa-calendar-alt me-2"></i>Bergabung sejak:</strong> <?= date('d M Y', strtotime($user['created_at'])) ?></p>
                    <p><strong><i class="fas fa-tag me-2"></i>Role:</strong> <span class="badge" style="background: #FFC973; color: #0A2540;">User</span></p>
                </div>
            </div>
        </div>
        
        <!-- Riwayat Ulasan -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header" style="background: linear-gradient(135deg, #0A2540, #006BBB); color: white; border: none; padding: 15px 20px;">
                    <h5 class="mb-0"><i class="fas fa-history me-2" style="color: #FFC973;"></i> Riwayat Ulasan Saya</h5>
                </div>
                <div class="card-body">
                    <?php if(count($ulasan_saya) > 0): ?>
                        <?php foreach($ulasan_saya as $ulas): ?>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="rating mb-2">
                                    <?php for($i=1;$i<=5;$i++): ?>
                                        <i class="fas fa-star <?= $i <= $ulas['rating'] ? 'text-warning' : 'text-muted' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="mb-1">"<?= htmlspecialchars($ulas['ulasan']) ?>"</p>
                                <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($ulas['tanggal'])) ?></small>
                                <span class="badge ms-2" style="background: <?= $ulas['status'] == 'menunggu' ? '#ffc107' : ($ulas['status'] == 'disetujui' ? '#28a745' : '#dc3545'); ?>; color: <?= $ulas['status'] == 'menunggu' ? '#856404' : 'white' ?>;">
                                    <?= $ulas['status'] == 'menunggu' ? 'Menunggu' : ($ulas['status'] == 'disetujui' ? 'Disetujui' : 'Ditolak') ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Anda belum pernah memberikan ulasan.</p>
                            <a href="<?= BASE_URL ?>/index.php?c=home&m=ulasan" class="btn" style="background: #FFC973; color: #0A2540; border-radius: 8px; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-pen me-2"></i> Beri Ulasan Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Riwayat Foto -->
            <div class="card mt-4 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header" style="background: linear-gradient(135deg, #0A2540, #006BBB); color: white; border: none; padding: 15px 20px;">
                    <h5 class="mb-0"><i class="fas fa-camera me-2" style="color: #FFC973;"></i> Riwayat Foto Saya</h5>
                </div>
                <div class="card-body">
                    <?php if(count($foto_saya) > 0): ?>
                        <div class="row g-3">
                            <?php foreach($foto_saya as $foto): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2 text-center">
                                            <p class="small mb-1 fw-semibold"><?= htmlspecialchars($foto['judul_foto']) ?></p>
                                            <span class="badge" style="background: <?= $foto['status'] == 'menunggu' ? '#ffc107' : ($foto['status'] == 'disetujui' ? '#28a745' : '#dc3545'); ?>; color: <?= $foto['status'] == 'menunggu' ? '#856404' : 'white' ?>;">
                                                <?= $foto['status'] == 'menunggu' ? 'Menunggu' : ($foto['status'] == 'disetujui' ? 'Disetujui' : 'Ditolak') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Anda belum pernah mengunggah foto.</p>
                            <a href="<?= BASE_URL ?>/index.php?c=galeri&m=index" class="btn" style="background: #FFC973; color: #0A2540; border-radius: 8px; padding: 8px 20px; text-decoration: none;">
                                <i class="fas fa-upload me-2"></i> Upload Foto Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page-header {
        background: linear-gradient(135deg, #0A2540 0%, #006BBB 100%);
        padding: 80px 0;
        margin-top: 66px;
    }
    .page-header h1 {
        color: #FFC973;
        font-family: 'Playfair Display', serif;
    }
    .page-header .lead {
        color: white;
    }
    .card-header {
        background: linear-gradient(135deg, #0A2540, #006BBB);
    }
    .btn-gold {
        background: #FFC973;
        color: #0A2540;
        border-radius: 8px;
        padding: 8px 20px;
        text-decoration: none;
    }
    .btn-gold:hover {
        background: #d8a548;
        color: white;
    }
</style>