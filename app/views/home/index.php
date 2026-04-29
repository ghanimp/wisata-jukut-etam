<section class="hero position-relative d-flex align-items-center justify-content-center">
    <div class="container text-center text-white position-relative z-1">
        <h1 class="display-3 fw-bold animate-fadeIn mb-0 playfair text-gold">JUKUT ETAM</h1>
        <h2 class="h3 fw-light animate-fadeIn mb-4 hero-subtitle">SAMARINDA</h2>

        <p class="lead mb-5 animate-fadeIn mx-auto hero-desc">
            Destinasi rekreasi keluarga di mana ketenangan air kolam bertemu dengan sensasi memancing yang tak
            terlupakan.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5 animate-fadeIn">
            <span class="badge px-4 py-3 hero-badge">
                <i class="fas fa-swimmer me-2 hero-badge-icon"></i> Kolam Renang
            </span>
            <span class="badge px-4 py-3 hero-badge">
                <i class="fas fa-fish me-2 hero-badge-icon"></i> Pemancingan
            </span>
            <span class="badge px-4 py-3 hero-badge">
                <i class="fas fa-utensils me-2 hero-badge-icon"></i> Kantin & Gazebo
            </span>
        </div>

        <div class="animate-fadeIn">
            <a href="<?= BASE_URL ?>/index.php?c=home&m=info" class="btn btn-lg px-5 py-3 fw-bold shadow-lg btn-hero">
                Eksplor Fasilitas <i class="fas fa-chevron-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<div id="vue-features-app">
    <section class="container my-5 py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="section-title mb-4">
                    <span class="text-uppercase fw-bold section-label">Mengenal Lebih Dekat</span>
                    <h2 class="display-6 fw-bold mt-2 playfair section-heading">Kenapa Memilih Kami?</h2>
                </div>

                <ul class="list-unstyled">
                    <li v-for="(feature, index) in features" :key="index" @click="activeTab = index"
                        :class="['p-3 mb-3 rounded-3 cursor-pointer', activeTab === index ? 'feature-active' : 'feature-inactive']">
                        <h5 :class="['fw-bold mb-1', activeTab === index ? 'feature-title-active' : 'feature-title']">
                            <i :class="feature.icon + ' me-2'"></i> {{ feature.title }}
                        </h5>
                        <transition name="slide-fade">
                            <p v-if="activeTab === index" class="mb-0 mt-2 small feature-desc">
                                {{ feature.desc }}
                            </p>
                        </transition>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 position-relative">
                <div class="feature-accent-border"></div>
                <div class="feature-image-wrapper">
                    <transition name="fade" mode="out-in">
                        <img :src="features[activeTab].image" :key="activeTab" alt="Fasilitas"
                            class="w-100 h-100 feature-image">
                    </transition>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="gallery-section">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold section-label">Galeri Pilihan</span>
            <h2 class="fw-bold mt-2 playfair section-heading">Sekilas Jukut Etam</h2>
            <div class="section-divider"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="gallery-card" style="height: 300px;">
                    <img src="<?= BASE_URL ?>/assets/img/suasanapagi.jpeg" alt="Kolam Renang" class="w-100 h-100">
                </div>
            </div>
            <div class="col-md-4">
                <div class="gallery-card" style="height: 300px;">
                    <img src="<?= BASE_URL ?>/assets/img/bagusjukut.jpeg" alt="Suasana" class="w-100 h-100">
                </div>
            </div>
            <div class="col-md-4">
                <div class="gallery-card" style="height: 300px;">
                    <img src="<?= BASE_URL ?>/assets/img/suasanajukut.jpeg" alt="Suasana Jukut Etam"
                        class="w-100 h-100">
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?= BASE_URL ?>/index.php?c=galeri&m=index" class="btn-outline-custom">
                Lihat Semua Foto <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
    const { createApp, ref } = Vue;

    createApp({
        setup() {
            const activeTab = ref(0);
            const features = ref([
                {
                    icon: 'fas fa-leaf',
                    title: 'Suasana Alam Asri',
                    desc: 'Terletak jauh dari kebisingan kota, memberikan ketenangan maksimal untuk relaksasi Anda.',
                    image: '<?= BASE_URL ?>/assets/img/suasanapagi.jpeg'
                },
                {
                    icon: 'fas fa-shield-alt',
                    title: 'Keamanan & Kebersihan',
                    desc: 'Air kolam yang selalu difilter secara berkala dan area yang dipantau demi kenyamanan bersama.',
                    image: '<?= BASE_URL ?>/assets/img/bagusjukut.jpeg'
                },
                {
                    icon: 'fas fa-utensils',
                    title: 'Kuliner Lokal Khas',
                    desc: 'Nikmati ikan bakar segar hasil pancingan Anda sendiri dengan bumbu rahasia dapur kami.',
                    image: '<?= BASE_URL ?>/assets/img/suasanajukut.jpeg'
                }
            ]);
            return { activeTab, features };
        }
    }).mount('#vue-features-app');
</script>