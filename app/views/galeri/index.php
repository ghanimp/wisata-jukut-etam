<style>
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

    .hero-galeri {
        background: linear-gradient(rgba(0, 107, 187, 0.85), rgba(10, 37, 64, 0.95)), 
        url('https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
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

    .filter-wrapper {
        background: #ffffff;
        padding: 10px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        display: inline-flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .filter-btn-premium {
        background: transparent;
        color: var(--dark-blue);
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-btn-premium:hover {
        color: var(--primary-blue);
    }

    .filter-btn-premium.active {
        background-color: var(--primary-blue);
        color: #ffffff;
        box-shadow: 0 5px 15px rgba(0, 107, 187, 0.3);
    }

    .galeri-card {
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border-bottom: 4px solid transparent;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .galeri-card img {
        transition: transform 0.6s ease;
    }

    .galeri-card:hover {
        transform: translateY(-8px);
        border-bottom: 4px solid var(--gold);
        box-shadow: 0 15px 35px rgba(0, 107, 187, 0.15);
    }

    .galeri-card:hover img {
        transform: scale(1.08);
    }

    .galeri-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(10, 37, 64, 0.95), transparent);
        padding: 30px 20px 20px;
        color: white;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .galeri-card:hover .galeri-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .user-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        color: var(--dark-blue);
        padding: 8px 15px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        z-index: 2;
        border-left: 3px solid var(--gold);
    }
</style>

<section class="hero-galeri animate-fadeIn">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn" style="color: var(--gold); letter-spacing: 3px; font-size: 0.85rem;">
            Visual & Estetika
        </span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair" style="color: #ffffff; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Galeri Jukut Etam
        </h1>
        <div class="animate-fadeIn" style="width: 80px; height: 4px; background-color: var(--gold); margin: 1.5rem auto; border-radius: 50px;"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto" style="font-weight: 300; max-width: 650px; line-height: 1.8; color: rgba(255,255,255,0.9);">
            Jelajahi keindahan lanskap, kelengkapan fasilitas, dan momen berharga yang terabadikan.
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
        
        <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'user'): ?>
            <div class="row justify-content-center mb-5" style="margin-top: -30px; position: relative; z-index: 10;">
                <div class="col-lg-10">
                    <div class="premium-form-card">
                        <div class="text-center mb-4">
                            <h3 class="playfair fw-bold" style="color: var(--dark-blue);">Bagikan Momen Anda</h3>
                            <p class="text-muted">Unggah foto keseruan Anda saat berkunjung untuk ditampilkan di galeri publik.</p>
                        </div>

                        <?php if(!empty($message)): ?>
                            <div class="alert alert-success border-0 shadow-sm rounded-3"><i class="fas fa-check-circle me-2"></i><?= $message ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>/index.php?c=galeri&m=upload" enctype="multipart/form-data">
                            <div class="row g-4 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Judul Foto</label>
                                    <input type="text" name="judul_foto" class="form-control bg-light p-3" style="border: 1px solid #e0e0e0; border-radius: 12px;" placeholder="Misal: Keseruan Mancing" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Pilih Gambar</label>
                                    <input type="file" name="gambar" class="form-control bg-light p-3" style="border: 1px solid #e0e0e0; border-radius: 12px;" accept="image/*" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark small mb-2">Deskripsi Singkat</label>
                                    <input type="text" name="deskripsi" class="form-control bg-light p-3" style="border: 1px solid #e0e0e0; border-radius: 12px;" placeholder="Opsional...">
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn-gold-solid px-5"><i class="fas fa-cloud-upload-alt me-2"></i> Unggah Foto Ke Galeri</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="text-center mb-5 pt-4">
            <span class="text-uppercase fw-bold" style="color: var(--primary-blue); letter-spacing: 2px; font-size: 0.85rem;">Eksplorasi</span>
            <h2 class="display-6 fw-bold mt-2 mb-4 playfair" style="color: var(--dark-blue);">Album Foto</h2>
            
            <div class="filter-wrapper">
                <button class="filter-btn-premium active" data-filter="all">Semua Foto</button>
                <button class="filter-btn-premium" data-filter="kolam">Kolam Renang</button>
                <button class="filter-btn-premium" data-filter="pemancingan">Pemancingan</button>
                <button class="filter-btn-premium" data-filter="fasilitas">Fasilitas</button>
                <button class="filter-btn-premium" data-filter="suasana">Suasana</button>
            </div>
        </div>
        
        <div class="row g-4" id="galeriGrid">
            <?php foreach($galeri as $foto): ?>
                <div class="col-lg-4 col-md-6 galeri-item-col animate-fadeIn" data-kategori="<?= strtolower($foto['kategori']) ?>">
                    <div class="galeri-card h-100" onclick="openModal('<?= BASE_URL . '/' . $foto['gambar_url'] ?>', '<?= addslashes($foto['judul']) ?>', '<?= addslashes($foto['deskripsi']) ?>')">
                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>" alt="<?= $foto['judul'] ?>" class="w-100 h-100" style="object-fit: cover; min-height: 320px;">
                        
                        <div class="galeri-overlay">
                            <span class="badge mb-2 px-3 py-2 rounded-pill" style="background-color: var(--gold); color: var(--dark-blue); font-weight: 700;"><?= $foto['kategori'] ?></span>
                            <h4 class="playfair fw-bold mb-1"><?= $foto['judul'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php foreach($foto_user as $foto): ?>
                <div class="col-lg-4 col-md-6 galeri-item-col animate-fadeIn" data-kategori="user">
                    <div class="galeri-card h-100" onclick="openModal('<?= BASE_URL . '/' . $foto['gambar_url'] ?>', '<?= addslashes($foto['judul_foto']) ?>', '<?= addslashes($foto['deskripsi']) ?> oleh <?= $foto['nama_user'] ?>')">
                        
                        <div class="user-badge">
                            <i class="fas fa-camera-retro me-1" style="color: var(--primary-blue);"></i> <?= $foto['nama_user'] ?>
                        </div>

                        <img src="<?= BASE_URL . '/' . $foto['gambar_url'] ?>" alt="<?= $foto['judul_foto'] ?>" class="w-100 h-100" style="object-fit: cover; min-height: 320px;">
                        
                        <div class="galeri-overlay">
                            <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Kontribusi Pengunjung</span>
                            <h4 class="playfair fw-bold mb-1"><?= $foto['judul_foto'] ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="galeriModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0 justify-content-end p-0 mb-2">
                <button type="button" class="btn-close btn-close-white fs-4 shadow-none" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1) grayscale(100%) brightness(200%);"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img id="modalImage" src="" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 75vh; object-fit: contain; background: rgba(10, 37, 64, 0.9);">
                <div class="bg-white p-4 rounded-4 shadow-lg mx-auto" style="width: 90%; margin-top: -30px; position: relative; z-index: 10; border-top: 4px solid var(--gold);">
                    <h3 id="modalTitle" class="playfair fw-bold mb-2" style="color: var(--dark-blue);"></h3>
                    <p id="modalDesc" class="text-muted mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script Logika Filter
    const filterButtons = document.querySelectorAll('.filter-btn-premium');
    const galeriItems = document.querySelectorAll('.galeri-item-col');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            const filterValue = button.getAttribute('data-filter');
            
            galeriItems.forEach(item => {
                if(filterValue === 'all' || item.getAttribute('data-kategori') === filterValue) {
                    item.style.display = 'block';
                    item.classList.remove('animate-fadeIn');
                    void item.offsetWidth;
                    item.classList.add('animate-fadeIn');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    function openModal(imgUrl, title, desc) {
        document.getElementById('modalImage').src = imgUrl;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDesc').innerText = desc ? desc : "Tidak ada deskripsi.";
        new bootstrap.Modal(document.getElementById('galeriModal')).show();
    }
</script>