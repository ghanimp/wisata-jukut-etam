<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-dashboard-app" class="container-fluid pt-3 pb-5 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom animate-card delay-1">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0A2540; font-family: 'Playfair Display', serif;">Dashboard Admin</h2>
            <p class="text-muted mb-0">Selamat datang di panel kontrol manajemen Jukut Etam.</p>
        </div>
        <div class="d-none d-md-block">
            <a href="<?= BASE_URL ?>/index.php?c=home&m=index" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm dashboard-card" target="_blank">
                <i class="fas fa-globe me-2"></i> Lihat Website
            </a>
        </div>
    </div>

    <div class="row g-3 mb-5">
        <!-- Card Total Galeri -->
        <div class="col-md-6 col-lg-3 animate-card delay-2">
            <div class="card border-0 shadow-sm h-100 dashboard-card" style="background-color: #0A2540; color: #fff; border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-semibold mb-1" style="letter-spacing: 1px; color: #FFC973; font-size: 0.85rem;">Total Galeri</h6>
                            <h2 class="mb-0 fw-bold" style="font-size: 2.2rem;">{{ animGaleri }}</h2>
                        </div>
                        <i class="fas fa-images fa-3x" style="color: rgba(255, 201, 115, 0.2);"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Ulasan Pending -->
        <div class="col-md-6 col-lg-3 animate-card delay-3">
            <div class="card border-0 shadow-sm h-100 dashboard-card" style="background-color: #FFC973; color: #0A2540; border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-bold mb-1" style="letter-spacing: 1px; color: rgba(10, 37, 64, 0.7); font-size: 0.85rem;">Ulasan Pending</h6>
                            <h2 class="mb-0 fw-bold" style="font-size: 2.2rem;">{{ animPending }}</h2>
                        </div>
                        <i class="fas fa-clock fa-3x" style="color: rgba(10, 37, 64, 0.15);"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Ulasan Aktif -->
        <div class="col-md-6 col-lg-3 animate-card delay-4">
            <div class="card border-0 shadow-sm h-100 dashboard-card" style="background-color: #00b4d8; color: #fff; border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-semibold mb-1" style="letter-spacing: 1px; color: rgba(255, 255, 255, 0.9); font-size: 0.85rem;">Ulasan Aktif</h6>
                            <h2 class="mb-0 fw-bold" style="font-size: 2.2rem;">{{ animAktif }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-3x" style="color: rgba(255, 255, 255, 0.2);"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card Total User -->
        <div class="col-md-6 col-lg-3 animate-card delay-5">
            <div class="card border-0 shadow-sm h-100 dashboard-card" style="background-color: #ffffff; color: #0A2540; border-radius: 12px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-uppercase fw-semibold mb-1" style="letter-spacing: 1px; color: #6c757d; font-size: 0.85rem;">Total User</h6>
                            <h2 class="mb-0 fw-bold" style="font-size: 2.2rem;">{{ animUser }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x" style="color: rgba(10, 37, 64, 0.1);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-3">
        <!-- Menu Kelola Galeri -->
        <div class="col-md-6 animate-card delay-6">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-header border-0 py-3" style="background-color: #0A2540; color: #fff;">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-images me-2" style="color: #FFC973;"></i> Menu Kelola Galeri</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <p class="text-muted mb-4">Kelola foto-foto fasilitas dan kegiatan Jukut Etam. Anda dapat menambah foto baru, mengedit informasi, atau menghapus foto yang sudah tidak relevan.</p>
                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri" class="btn fw-bold mt-auto align-self-start shadow-sm" style="background-color: #FFC973; color: #0A2540; padding: 10px 25px; border-radius: 8px;">
                        Buka Kelola Galeri <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Menu Kelola Ulasan -->
        <div class="col-md-6 animate-card delay-6">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="card-header border-0 py-3" style="background-color: #0A2540; color: #fff;">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-comments me-2" style="color: #FFC973;"></i> Menu Kelola Ulasan</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <p class="text-muted mb-4">Pantau semua testimoni dan ulasan masuk dari pengunjung. Anda memiliki kendali penuh untuk menyetujui atau menolak ulasan.</p>
                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=ulasan" class="btn fw-bold mt-auto align-self-start shadow-sm" style="background-color: #FFC973; color: #0A2540; padding: 10px 25px; border-radius: 8px;">
                        Buka Kelola Ulasan <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const { createApp, ref, onMounted } = Vue;

    createApp({
        setup() {
            // Ambil data dari controller PHP
            const targetGaleri = <?= $total_galeri ?? 0 ?>;
            const targetPending = <?= $total_ulasan_pending ?? 0 ?>;
            const targetAktif = <?= $total_ulasan_aktif ?? 0 ?>;
            const targetUser = <?= $total_user ?? 0 ?>;

            const animGaleri = ref(0);
            const animPending = ref(0);
            const animAktif = ref(0);
            const animUser = ref(0);

            const animateValue = (target, refVar, duration) => {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    refVar.value = Math.floor(progress * target);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        refVar.value = target;
                    }
                };
                window.requestAnimationFrame(step);
            };

            onMounted(() => {
                animateValue(targetGaleri, animGaleri, 1500);
                animateValue(targetPending, animPending, 1500);
                animateValue(targetAktif, animAktif, 1500);
                animateValue(targetUser, animUser, 1500);
            });

            return {
                animGaleri,
                animPending,
                animAktif,
                animUser
            }
        }
    }).mount('#vue-dashboard-app');
</script>