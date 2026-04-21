<section class="hero position-relative d-flex align-items-center justify-content-center" style="min-height: 80vh; background: linear-gradient(rgba(0, 107, 187, 0.8), rgba(10, 37, 64, 0.9)), url('https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover; margin-top: 56px;">
    <div class="container text-center text-white position-relative z-1">
        <h1 class="display-3 fw-bold animate-fadeIn mb-0" style="font-family: 'Playfair Display', serif; color: #FFC973; letter-spacing: 2px;">JUKUT ETAM</h1>
        <h2 class="h3 fw-light animate-fadeIn mb-4" style="letter-spacing: 5px;">SAMARINDA</h2>
        
        <p class="lead mb-5 animate-fadeIn mx-auto" style="font-weight: 300; max-width: 700px; line-height: 1.8;">
            Destinasi rekreasi keluarga di mana ketenangan air kolam bertemu dengan sensasi memancing yang tak terlupakan.
        </p>
        
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5 animate-fadeIn">
            <span class="badge px-4 py-3" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 201, 115, 0.5); font-size: 0.9rem; border-radius: 50px;">
                <i class="fas fa-swimmer me-2" style="color: #FFC973;"></i> Kolam Renang
            </span>
            <span class="badge px-4 py-3" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 201, 115, 0.5); font-size: 0.9rem; border-radius: 50px;">
                <i class="fas fa-fish me-2" style="color: #FFC973;"></i> Pemancingan
            </span>
            <span class="badge px-4 py-3" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 201, 115, 0.5); font-size: 0.9rem; border-radius: 50px;">
                <i class="fas fa-utensils me-2" style="color: #FFC973;"></i> Kantin & Gazebo
            </span>
        </div>

        <div class="animate-fadeIn">
            <a href="<?= BASE_URL ?>/index.php?c=home&m=info" class="btn btn-lg px-5 py-3 fw-bold shadow-lg" style="background-color: #FFC973; color: #006BBB; border-radius: 10px; transition: 0.3s;">
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
                    <span class="text-uppercase fw-bold" style="color: #006BBB; letter-spacing: 2px; font-size: 0.85rem;">Mengenal Lebih Dekat</span>
                    <h2 class="display-6 fw-bold mt-2" style="font-family: 'Playfair Display', serif; color: #0A2540;">Kenapa Memilih Kami?</h2>
                </div>
                
                <ul class="list-unstyled">
                    <li v-for="(feature, index) in features" :key="index" 
                        @click="activeTab = index"
                        :class="['p-3 mb-3 rounded-3 cursor-pointer', activeTab === index ? 'shadow-sm' : '']"
                        :style="activeTab === index ? 'background-color: #006BBB; color: white; transition: 0.3s;' : 'background-color: #f8f9fa; color: #333; transition: 0.3s; cursor: pointer;'">
                        <h5 class="fw-bold mb-1" :style="activeTab === index ? 'color: #FFC973;' : 'color: #0A2540;'">
                            <i :class="feature.icon + ' me-2'"></i> {{ feature.title }}
                        </h5>
                        <transition name="slide-fade">
                            <p v-if="activeTab === index" class="mb-0 mt-2 small" style="line-height: 1.6; opacity: 0.9;">
                                {{ feature.desc }}
                            </p>
                        </transition>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 position-relative">
                <div class="position-absolute" style="top: -20px; left: -20px; width: 100px; height: 100px; border-top: 5px solid #FFC973; border-left: 5px solid #FFC973; z-index: 0;"></div>
                
                <div class="position-relative z-1" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); height: 450px;">
                    <transition name="fade" mode="out-in">
                        <img :src="features[activeTab].image" :key="activeTab" alt="Fasilitas" class="w-100 h-100" style="object-fit: cover;">
                    </transition>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold" style="color: #006BBB; letter-spacing: 2px; font-size: 0.85rem;">Galeri Pilihan</span>
            <h2 class="fw-bold mt-2" style="font-family: 'Playfair Display', serif; color: #0A2540;">Sekilas Jukut Etam</h2>
            <div style="width: 60px; height: 3px; background-color: #FFC973; margin: 15px auto 0;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="gallery-card position-relative overflow-hidden rounded-4 shadow-sm" style="height: 300px;">
                    <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kolam Renang" class="w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-md-4">
                <div class="gallery-card position-relative overflow-hidden rounded-4 shadow-sm" style="height: 300px;">
                    <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Suasana" class="w-100 h-100" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-md-4">
                <div class="gallery-card position-relative overflow-hidden rounded-4 shadow-sm" style="height: 300px;">
                    <img src="https://placehold.co/800x600/FFC973/0A2540?text=Kuliner+Jukut+Etam" alt="Kuliner" class="w-100 h-100" style="object-fit: cover;">
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

<style>
    /* Animasi Vue */
    .fade-enter-active, .fade-leave-active { transition: opacity 0.5s ease; }
    .fade-enter-from, .fade-leave-to { opacity: 0; }
    
    .slide-fade-enter-active { transition: all 0.3s ease-out; }
    .slide-fade-leave-active { transition: all 0.3s cubic-bezier(1.0, 0.5, 0.8, 1.0); }
    .slide-fade-enter-from, .slide-fade-leave-to { transform: translateY(-10px); opacity: 0; }

    /* Animasi Galeri */
    .gallery-card img { transition: transform 0.5s ease; cursor: pointer; }
    .gallery-card:hover img { transform: scale(1.1); }

    /* Tombol Outline Custom */
    .btn-outline-custom {
        display: inline-block;
        padding: 10px 25px;
        font-weight: bold;
        text-decoration: none;
        background: transparent;
        border: 2px solid #006BBB;
        color: #006BBB;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-outline-custom:hover {
        background-color: #006BBB;
        color: white;
    }
</style>

<script>
    // Inisialisasi Vue App khusus untuk bagian fitur
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                activeTab: 0, // Tab pertama otomatis terbuka
                features: [
                    {
                        icon: 'fas fa-leaf',
                        title: 'Suasana Alam Asri',
                        desc: 'Terletak jauh dari kebisingan kota, memberikan ketenangan maksimal untuk relaksasi Anda. Nikmati udara segar yang berhembus menyejukkan.',
                        image: 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                    },
                    {
                        icon: 'fas fa-shield-alt',
                        title: 'Keamanan & Kebersihan',
                        desc: 'Air kolam yang selalu difilter secara berkala dan area yang dipantau demi kenyamanan bersama. Kami mengutamakan standar higienitas tertinggi.',
                        image: 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                    },
                    {
                        icon: 'fas fa-utensils',
                        title: 'Kuliner Lokal Khas',
                        desc: 'Nikmati ikan bakar segar hasil pancingan Anda sendiri dengan bumbu rahasia dapur kami. Disajikan hangat di gazebo keluarga.',
                        image: 'https://placehold.co/800x600/FFC973/0A2540?text=Kuliner+Jukut+Etam'
                    }
                ]
            }
        }
    }).mount('#vue-features-app');
</script>