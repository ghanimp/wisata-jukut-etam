<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-dashboard-app" class="container-fluid pt-3 pb-5 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom animate-card delay-1">
        <div>
            <h2 class="dashboard-title">Dashboard Admin</h2>
            <p class="text-muted mb-0">Selamat datang di panel kontrol manajemen Jukut Etam.</p>
        </div>
        <div class="d-none d-md-block">
            <a href="<?= BASE_URL ?>/index.php?c=home&m=index"
                class="btn btn-outline-secondary rounded-pill px-4 shadow-sm dashboard-card" target="_blank">
                <i class="fas fa-globe me-2"></i> Lihat Website
            </a>
        </div>
    </div>

    <div class="row g-3 mb-5 align-items-stretch">
        <div class="col-md-6 col-lg-3 animate-card delay-2">
            <div class="dashboard-stat-card dashboard-stat-dark">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="dashboard-stat-label">Total Galeri</h6>
                            <h2 class="dashboard-stat-value">{{ animGaleri }}</h2>
                        </div>
                        <i class="fas fa-images dashboard-stat-icon dashboard-stat-icon-gold"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 animate-card delay-3">
            <div class="dashboard-stat-card dashboard-stat-gold">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="dashboard-stat-label">Ulasan Pending</h6>
                            <h2 class="dashboard-stat-value">{{ animPending }}</h2>
                        </div>
                        <i class="fas fa-clock dashboard-stat-icon dashboard-stat-icon-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 animate-card delay-4">
            <div class="dashboard-stat-card dashboard-stat-blue">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="dashboard-stat-label">Ulasan Aktif</h6>
                            <h2 class="dashboard-stat-value">{{ animAktif }}</h2>
                        </div>
                        <i class="fas fa-check-circle dashboard-stat-icon dashboard-stat-icon-light"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 animate-card delay-5">
            <div class="dashboard-stat-card dashboard-stat-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="dashboard-stat-label">Total User</h6>
                            <h2 class="dashboard-stat-value">{{ animUser }}</h2>
                        </div>
                        <i class="fas fa-users dashboard-stat-icon dashboard-stat-icon-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6 animate-card delay-6">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="dashboard-menu-header">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-images me-2 dashboard-menu-header-icon"></i> Menu
                        Kelola Galeri</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <p class="text-muted mb-4">Kelola foto-foto fasilitas dan kegiatan Jukut Etam.</p>
                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=galeri"
                        class="btn fw-bold mt-auto align-self-start shadow-sm btn-gold-link">
                        Buka Kelola Galeri <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 animate-card delay-6">
            <div class="card border-0 shadow-sm h-100 dashboard-card">
                <div class="dashboard-menu-header">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-comments me-2 dashboard-menu-header-icon"></i> Menu
                        Kelola Ulasan</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <p class="text-muted mb-4">Pantau semua testimoni dan ulasan masuk dari pengunjung.</p>
                    <a href="<?= BASE_URL ?>/index.php?c=admin&m=ulasan"
                        class="btn fw-bold mt-auto align-self-start shadow-sm btn-gold-link">
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

            return { animGaleri, animPending, animAktif, animUser }
        }
    }).mount('#vue-dashboard-app');
</script>