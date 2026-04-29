<section class="hero-tentang">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn label">Profil Destinasi</span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair">Tentang Kami</h1>
        <div class="animate-fadeIn divider"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto desc">
            Mengenal lebih dekat kisah dan visi destinasi rekreasi keluarga kebanggaan kota Samarinda.
        </p>
    </div>

    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none"
            style="position: relative; display: block; width: calc(100% + 1.3px); height: 40px;">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                style="fill: #ffffff;"></path>
        </svg>
    </div>
</section>

<div class="container my-5 py-4 animate-fadeIn">
    <div class="row align-items-center mb-5 pb-5">
        <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
            <span class="text-uppercase fw-bold fasilitas-label">Sejarah Kami</span>
            <h2 class="display-6 fw-bold mb-4 mt-2 playfair fasilitas-title">Kisah Jukut Etam</h2>
            <div class="fasilitas-divider" style="width: 50px; margin-bottom: 25px;"></div>

            <p class="text-muted" style="text-align: justify; line-height: 1.8; font-size: 1.05rem;">
                Berdiri sejak tahun <strong style="color: var(--dark-blue);">2015</strong>, Jukut Etam lahir dari visi
                untuk menciptakan destinasi rekreasi keluarga yang memadukan kesegaran kolam renang dengan ketenangan
                arena pemancingan dalam satu area terpadu. Pada tahun <strong
                    style="color: var(--dark-blue);">2018</strong>, kami bangga dapat diakui secara resmi oleh Dinas
                Pariwisata Kota Samarinda.
            </p>
            <p class="text-muted" style="text-align: justify; line-height: 1.8; font-size: 1.05rem;">
                Mengambil filosofi dari bahasa lokal, <em style="color: var(--primary-blue);">"Jukut Etam"</em> memiliki
                makna <strong>"Ikan Kita"</strong> atau bisa dimaknai <strong>"Tempat Kita Bersama"</strong>. Kami
                berkomitmen memberikan pelayanan dan kebersihan maksimal agar setiap pengunjung merasa seperti berada di
                rumah sendiri.
            </p>
        </div>

        <div class="col-lg-6">
            <div class="image-accent-wrapper mx-auto text-center">
                <img class="img-fluid rounded-4 shadow-lg" src="<?= BASE_URL ?>/assets/img/kolamutama.jpeg"
                    alt="Sejarah Jukut Etam">
                <div class="text-center mt-3">
                    <h4 class="playfair mb-0 est">Est. <span>2015</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fasilitas-section" id="vue-app-fasilitas">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold fasilitas-label">Layanan Kami</span>
            <h2 class="display-6 fw-bold mt-2 playfair fasilitas-title">Fasilitas Utama</h2>
            <div class="fasilitas-divider"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <transition-group name="fade">
                <div class="col-lg-4 col-md-6" v-for="(fas, index) in dataFasilitas" :key="index">
                    <div class="card-fasilitas">
                        <div class="icon-wrapper">
                            <i :class="fas.icon"></i>
                        </div>
                        <h4 class="playfair mb-3">{{ fas.nama_fasilitas }}</h4>
                        <p class="text-muted mb-0">{{ fas.keterangan }}</p>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</div>

<div class="maps-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <span class="text-uppercase fw-bold maps-label">Akses Mudah</span>
                <h2 class="display-6 fw-bold mt-2 mb-4 playfair maps-title">Lokasi Kami</h2>

                <p class="text-muted mb-4 maps-desc">
                    Kunjungi kami dengan mudah melalui petunjuk arah Google Maps di samping. Area parkir kami sangat
                    luas dan dijaga ketat, aman untuk kendaraan roda dua maupun roda empat keluarga Anda.
                </p>

                <a href="https://maps.app.goo.gl/e4y2y8deHCUYZ5Nc7" target="_blank" class="btn-outline-gold mt-2">
                    Buka di Google Maps <i class="fas fa-location-arrow ms-2"></i>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="maps-wrapper">
                    <div class="maps-decoration"></div>
                    <div class="maps-frame">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6772540685065!2d117.21303027308214!3d-0.4818079352720428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d5cbd465ca5f%3A0x4593cafdfd4fb6dd!2sPemancingan%20%26%20Kolam%20Renang%20%22JUKUT%20ETAM%22!5e0!3m2!1sid!2sid!4v1776131472316!5m2!1sid!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
    const phpDataFasilitas = <?= json_encode($fasilitas) ?>;

    const { createApp } = Vue;

    createApp({
        data() {
            return {
                dataFasilitas: phpDataFasilitas
            }
        }
    }).mount('#vue-app-fasilitas');
</script>