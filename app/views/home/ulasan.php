<section class="hero-ulasan animate-fadeIn">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn label">Testimonial</span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair">Suara Pengunjung</h1>
        <div class="animate-fadeIn divider"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto desc">
            Pengalaman nyata dari mereka yang telah menghabiskan momen berharga bersama Jukut Etam.
        </p>
    </div>

    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none"
            style="position: relative; display: block; width: calc(100% + 1.3px); height: 40px;">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                fill="#fdfaf5"></path>
        </svg>
    </div>
</section>

<div class="ulasan-bg">
    <div class="container animate-fadeIn">

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
            <div class="row justify-content-center mb-5 form-section">
                <div class="col-lg-8">
                    <div class="premium-form-card">
                        <div class="text-center mb-4">
                            <h3 class="playfair fw-bold form-title">Bagikan Pengalaman Anda</h3>
                            <p class="text-muted">Masukan Anda sangat berarti untuk meningkatkan kualitas layanan kami.<br>
                                <small class="text-warning"><i class="fas fa-info-circle"></i> Ulasan akan ditampilkan
                                    setelah disetujui admin.</small>
                            </p>
                        </div>

                        <?php if (!empty($message)): ?>
                            <div class="alert alert-<?= $messageType ?> border-0 shadow-sm rounded-3">
                                <i
                                    class="fas fa-<?= $messageType == 'success' ? 'check-circle' : 'exclamation-circle' ?> me-2"></i>
                                <?= $message ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($pending_message)): ?>
                            <div class="alert alert-pending border-0 shadow-sm rounded-3">
                                <i class="fas fa-clock me-2"></i> <?= $pending_message ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>/index.php?c=home&m=ulasan">
                            <div class="mb-4 text-center">
                                <label class="form-label fw-bold text-dark d-block mb-3">Seberapa puas Anda?</label>
                                <div class="star-rating-container justify-content-center">
                                    <i class="fas fa-star star-rating" data-rating="1"></i>
                                    <i class="fas fa-star star-rating" data-rating="2"></i>
                                    <i class="fas fa-star star-rating" data-rating="3"></i>
                                    <i class="fas fa-star star-rating" data-rating="4"></i>
                                    <i class="fas fa-star star-rating" data-rating="5"></i>
                                </div>
                                <input type="hidden" name="rating" id="ratingValue" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark">Cerita Anda</label>
                                <textarea name="ulasan" class="form-control bg-light p-3 form-textarea" rows="4"
                                    placeholder="Tuliskan pengalaman seru Anda atau masukan untuk kami di sini..."
                                    required></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="submit_ulasan" class="btn-gold-solid px-5">Kirim Ulasan <i
                                        class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 🔥 NOTIFIKASI SUKSES SETELAH ULASAN -->
            <?php $flash = $this->getFlash(); ?>
            <?php if ($flash && $flash['type'] == 'success'): ?>
                <div id="notifUlasan" class="notif-ulasan-success">
                    <div class="notif-ulasan-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notif-ulasan-content">
                        <h5>Ulasan Terkirim! 🎉</h5>
                        <p><?= $flash['message'] ?></p>
                        <small>Ulasan kamu akan ditampilkan setelah disetujui admin.</small>
                    </div>
                    <button class="notif-ulasan-close" onclick="this.parentElement.remove()">×</button>
                </div>
            <?php endif; ?>

        <?php elseif (!isset($_SESSION['user_id'])): ?>
            <div class="row justify-content-center mb-5 form-section">
                <div class="col-lg-8">
                    <div class="premium-form-card text-center">
                        <i class="fas fa-lock fa-3x form-icon-lock"></i>
                        <h4 class="playfair fw-bold form-title">Login untuk Memberikan Ulasan</h4>
                        <p class="text-muted">Silakan login atau daftar terlebih dahulu untuk membagikan pengalaman Anda.
                        </p>
                        <div class="mt-3">
                            <a href="<?= BASE_URL ?>/index.php?c=auth&m=login" class="btn-gold-solid me-2">Login</a>
                            <a href="<?= BASE_URL ?>/index.php?c=auth&m=register"
                                class="btn btn-outline-secondary">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['role'] == 'admin'): ?>
            <div class="row justify-content-center mb-5 form-section">
                <div class="col-lg-8">
                    <div class="premium-form-card text-center">
                        <i class="fas fa-shield-alt fa-3x form-icon-admin"></i>
                        <h4 class="playfair fw-bold form-title">Admin tidak dapat memberikan ulasan</h4>
                        <p class="text-muted">Silakan login sebagai pengunjung biasa untuk memberikan ulasan.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="text-center mb-5 pt-4">
            <span class="text-uppercase fw-bold section-label">Kata Mereka</span>
            <h2 class="display-6 fw-bold mt-2 playfair section-heading">Ulasan Terbaru</h2>
            <div class="section-divider" style="margin: 15px auto 0;"></div>
        </div>

        <?php if (!empty($ulasanList)): ?>
            <div class="row g-4 justify-content-center">
                <?php foreach ($ulasanList as $ulasan): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="premium-review-card">
                            <i class="fas fa-quote-right quote-mark"></i>
                            <div class="review-content">
                                <div class="review-stars mb-3 fs-5">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?= ($i <= $ulasan['rating']) ? 'fas' : 'far' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>

                                <p class="review-text mb-4">
                                    "<?= htmlspecialchars($ulasan['ulasan']) ?>"
                                </p>

                                <div class="d-flex align-items-center mt-auto border-top pt-3">
                                    <div
                                        class="review-user-icon rounded-circle bg-light d-flex justify-content-center align-items-center me-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="playfair fw-bold mb-0 review-name"><?= htmlspecialchars($ulasan['nama']) ?>
                                        </h6>
                                        <small class="text-muted review-date"><i class="far fa-calendar-alt me-1"></i>
                                            <?= date('d M Y', strtotime($ulasan['tanggal'])) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="fas fa-comment-slash fa-3x empty-icon-inner"></i>
                </div>
                <h4 class="playfair fw-bold section-heading">Belum Ada Ulasan</h4>
                <p class="text-muted">Jadilah orang pertama yang membagikan pengalaman liburan Anda!</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    // Star Rating
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll('.star-rating');
        const ratingInput = document.getElementById('ratingValue');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                let rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                stars.forEach(s => s.classList.remove('active'));
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('active');
                }
            });
        });
    });

    // Auto hide notif setelah 5 detik
    setTimeout(function () {
        const notif = document.getElementById('notifFlash');
        if (notif) {
            notif.style.animation = 'slideDownNotif 0.5s ease forwards';
            setTimeout(() => notif.remove(), 500);
        }
    }, 5000);
</script>