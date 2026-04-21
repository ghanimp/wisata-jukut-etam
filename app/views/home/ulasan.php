<style>
    /* Palet Warna Premium */
    :root {
        --primary-blue: #006BBB;
        --dark-blue: #0A2540;
        --gold: #FFC973;
        --dark-gold: #d8a548;
        --light-bg: #fdfaf5; 
    }
    
    .playfair {
        font-family: 'Playfair Display', serif;
    }

    .hero-ulasan {
        background: linear-gradient(rgba(0, 107, 187, 0.85), rgba(10, 37, 64, 0.95)), 
        url('https://images.unsplash.com/photo-1528605248644-14dd04022da1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        min-height: 66vh; 
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 66px; 
        position: relative;
    }

    .premium-form-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-top: 5px solid var(--gold);
        position: relative;
    }

    .star-rating-container {
        display: flex;
        gap: 8px;
        font-size: 2rem;
    }
    .star-rating {
        color: #e0e0e0;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .star-rating:hover {
        transform: scale(1.2);
    }
    .star-rating.active {
        color: var(--dark-gold);
        text-shadow: 0 0 10px rgba(216, 165, 72, 0.4);
    }

    .premium-review-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        height: 100%;
        overflow: hidden;
        border-bottom: 4px solid transparent;
    }

    .premium-review-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 107, 187, 0.1);
        border-bottom: 4px solid var(--gold);
    }

    .quote-mark {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 5rem;
        color: rgba(0, 107, 187, 0.05);
        font-family: serif;
        line-height: 1;
        z-index: 0;
    }

    .review-content {
        position: relative;
        z-index: 1;
    }

    .btn-gold-solid {
        background-color: var(--gold);
        color: var(--dark-blue);
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gold-solid:hover {
        background-color: var(--dark-gold);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(216, 165, 72, 0.3);
    }
    
    .badge-pending {
        background-color: #ffc107;
        color: #856404;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        margin-left: 10px;
    }
    
    .alert-pending {
        background-color: #fff3cd;
        border-left: 4px solid #ffc107;
        border-radius: 10px;
    }
</style>

<section class="hero-ulasan animate-fadeIn">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn" style="color: var(--gold); letter-spacing: 3px; font-size: 0.85rem;">
            Testimonial
        </span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair" style="color: #ffffff; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Suara Pengunjung
        </h1>
        <div class="animate-fadeIn" style="width: 80px; height: 4px; background-color: var(--gold); margin: 1.5rem auto; border-radius: 50px;"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto" style="font-weight: 300; max-width: 650px; line-height: 1.8; color: rgba(255,255,255,0.9);">
            Pengalaman nyata dari mereka yang telah menghabiskan momen berharga bersama Jukut Etam.
        </p>
    </div>
    
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 40px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #fdfaf5;"></path>
        </svg>
    </div>
</section>

<div style="background-color: var(--light-bg); padding-bottom: 5rem;">
    <div class="container animate-fadeIn">
        
        <!-- FORM ULASAN (HANYA UNTUK USER YANG LOGIN) -->
        <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
            <div class="row justify-content-center mb-5" style="margin-top: -30px; position: relative; z-index: 10;">
                <div class="col-lg-8">
                    <div class="premium-form-card">
                        <div class="text-center mb-4">
                            <h3 class="playfair text-primary fw-bold" style="color: var(--dark-blue) !important;">Bagikan Pengalaman Anda</h3>
                            <p class="text-muted">Masukan Anda sangat berarti untuk meningkatkan kualitas layanan kami.<br>
                            <small class="text-warning"><i class="fas fa-info-circle"></i> Ulasan akan ditampilkan setelah disetujui admin.</small></p>
                        </div>
                        
                        <?php if(!empty($message)): ?>
                            <div class="alert alert-<?= $messageType ?> border-0 shadow-sm rounded-3">
                                <i class="fas fa-<?= $messageType == 'success' ? 'check-circle' : 'exclamation-circle' ?> me-2"></i> 
                                <?= $message ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($pending_message)): ?>
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
                                <textarea name="ulasan" class="form-control bg-light p-3" rows="4" style="border: 1px solid #e0e0e0; border-radius: 12px; resize: none;" placeholder="Tuliskan pengalaman seru Anda atau masukan untuk kami di sini..." required></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="submit_ulasan" class="btn-gold-solid px-5">Kirim Ulasan <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        <?php elseif(!isset($_SESSION['user_id'])): ?>
            <!-- Guest: Tampilkan pesan login -->
            <div class="row justify-content-center mb-5" style="margin-top: -30px; position: relative; z-index: 10;">
                <div class="col-lg-8">
                    <div class="premium-form-card text-center">
                        <i class="fas fa-lock fa-3x" style="color: var(--gold); margin-bottom: 15px;"></i>
                        <h4 class="playfair fw-bold" style="color: var(--dark-blue);">Login untuk Memberikan Ulasan</h4>
                        <p class="text-muted">Silakan login atau daftar terlebih dahulu untuk membagikan pengalaman Anda.</p>
                        <div class="mt-3">
                            <a href="<?= BASE_URL ?>/index.php?c=auth&m=login" class="btn-gold-solid me-2">Login</a>
                            <a href="<?= BASE_URL ?>/index.php?c=auth&m=register" class="btn btn-outline-secondary">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif($_SESSION['role'] == 'admin'): ?>
            <div class="row justify-content-center mb-5" style="margin-top: -30px; position: relative; z-index: 10;">
                <div class="col-lg-8">
                    <div class="premium-form-card text-center">
                        <i class="fas fa-shield-alt fa-3x" style="color: var(--primary-blue); margin-bottom: 15px;"></i>
                        <h4 class="playfair fw-bold" style="color: var(--dark-blue);">Admin tidak dapat memberikan ulasan</h4>
                        <p class="text-muted">Silakan login sebagai pengunjung biasa untuk memberikan ulasan.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="text-center mb-5 pt-4">
            <span class="text-uppercase fw-bold" style="color: var(--primary-blue); letter-spacing: 2px; font-size: 0.85rem;">Kata Mereka</span>
            <h2 class="display-6 fw-bold mt-2 playfair" style="color: var(--dark-blue);">Ulasan Terbaru</h2>
            <div style="width: 60px; height: 3px; background-color: var(--gold); margin: 15px auto 0;"></div>
        </div>

        <?php if(!empty($ulasanList)): ?>
            <div class="row g-4 justify-content-center">
                <?php foreach($ulasanList as $ulasan): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="premium-review-card">
                            <i class="fas fa-quote-right quote-mark"></i>
                            <div class="review-content">
                                <div class="text-gold mb-3 fs-5" style="color: var(--dark-gold);">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?= ($i <= $ulasan['rating']) ? 'fas' : 'far' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                
                                <p class="text-muted mb-4" style="line-height: 1.7; font-style: italic;">
                                    "<?= htmlspecialchars($ulasan['ulasan']) ?>"
                                </p>
                                
                                <div class="d-flex align-items-center mt-auto border-top pt-3">
                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-3" style="width: 45px; height: 45px; color: var(--primary-blue);">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="playfair fw-bold mb-0" style="color: var(--dark-blue);"><?= htmlspecialchars($ulasan['nama']) ?></h6>
                                        <small class="text-muted" style="font-size: 0.8rem;"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($ulasan['tanggal'])) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-4" style="width: 100px; height: 100px; background-color: rgba(0, 107, 187, 0.05);">
                    <i class="fas fa-comment-slash fa-3x" style="color: var(--primary-blue);"></i>
                </div>
                <h4 class="playfair fw-bold" style="color: var(--dark-blue);">Belum Ada Ulasan</h4>
                <p class="text-muted">Jadilah orang pertama yang membagikan pengalaman liburan Anda!</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll('.star-rating');
    const ratingInput = document.getElementById('ratingValue');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            let rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            
            stars.forEach(s => s.classList.remove('active'));
            for(let i=0; i<rating; i++) {
                stars[i].classList.add('active');
            }
        });
    });
});
</script>