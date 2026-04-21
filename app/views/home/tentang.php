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

    .hero-tentang {
        background: linear-gradient(rgba(0, 107, 187, 0.85), rgba(10, 37, 64, 0.95)), 
        url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        min-height: 66vh; 
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 66px; 
        position: relative;
    }

    .image-accent-wrapper {
        position: relative;
        z-index: 1;
        display: inline-block;
    }
    .image-accent-wrapper::before {
        content: '';
        position: absolute;
        top: -15px;
        left: -15px;
        width: 100px;
        height: 100px;
        border-top: 5px solid var(--gold);
        border-left: 5px solid var(--gold);
        border-radius: 12px 0 0 0;
        z-index: -1;
    }

    .card-fasilitas {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem 1.5rem;
        height: 100%;
        text-align: center;
        border: none;
        border-bottom: 4px solid var(--primary-blue);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        top: 0;
        cursor: pointer;
    }

    .card-fasilitas:hover {
        top: -10px;
        box-shadow: 0 15px 35px rgba(0, 107, 187, 0.1);
        border-bottom: 4px solid var(--gold);
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        background-color: #f8fcfd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        color: var(--dark-gold);
        font-size: 2.5rem;
        transition: all 0.3s ease;
    }

    .card-fasilitas:hover .icon-wrapper {
        background-color: var(--primary-blue);
        color: white;
        transform: rotateY(180deg);
    }

    .btn-outline-gold {
        display: inline-block;
        padding: 12px 30px;
        font-weight: 600;
        background: transparent;
        border: 2px solid var(--dark-gold);
        color: var(--dark-gold);
        border-radius: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-outline-gold:hover {
        background-color: var(--dark-gold);
        color: white;
        box-shadow: 0 8px 20px rgba(216, 165, 72, 0.2);
    }

    .maps-frame iframe {
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        width: 100%;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }
    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }

    .animate-fadeIn {
        animation: fadeIn 0.8s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="hero-tentang animate-fadeIn">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn" style="color: var(--gold); letter-spacing: 3px; font-size: 0.85rem;">
            Profil Destinasi
        </span>
        <h1 class="display-4 fw-bold animate-fadeIn mb-0 playfair" style="color: #ffffff; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Tentang Kami
        </h1>
        <div class="animate-fadeIn" style="width: 80px; height: 4px; background-color: var(--gold); margin: 1.5rem auto; border-radius: 50px;"></div>
        <p class="lead mb-0 animate-fadeIn mx-auto" style="font-weight: 300; max-width: 650px; line-height: 1.8; color: rgba(255,255,255,0.9);">
            Mengenal lebih dekat kisah dan visi destinasi rekreasi keluarga kebanggaan kota Samarinda.
        </p>
    </div>
    
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 40px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #ffffff;"></path>
        </svg>
    </div>
</section>

<div class="container my-5 py-4 animate-fadeIn">
    <div class="row align-items-center mb-5 pb-5">
        <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
            <span class="text-uppercase fw-bold" style="color: var(--primary-blue); letter-spacing: 2px; font-size: 0.85rem;">Sejarah Kami</span>
            <h2 class="display-6 fw-bold mb-4 mt-2 playfair" style="color: var(--dark-blue);">Kisah Jukut Etam</h2>
            <div style="width: 50px; height: 3px; background-color: var(--gold); margin-bottom: 25px;"></div>
            
            <p class="text-muted" style="text-align: justify; line-height: 1.8; font-size: 1.05rem;">
                Berdiri sejak tahun <strong style="color: var(--dark-blue);">2015</strong>, Jukut Etam lahir dari visi untuk menciptakan destinasi rekreasi keluarga yang memadukan kesegaran kolam renang dengan ketenangan arena pemancingan dalam satu area terpadu. Pada tahun <strong style="color: var(--dark-blue);">2018</strong>, kami bangga dapat diakui secara resmi oleh Dinas Pariwisata Kota Samarinda.
            </p>
            <p class="text-muted" style="text-align: justify; line-height: 1.8; font-size: 1.05rem;">
                Mengambil filosofi dari bahasa lokal, <em style="color: var(--primary-blue);">"Jukut Etam"</em> memiliki makna <strong>"Ikan Kita"</strong> atau bisa dimaknai <strong>"Tempat Kita Bersama"</strong>. Kami berkomitmen memberikan pelayanan dan kebersihan maksimal agar setiap pengunjung merasa seperti berada di rumah sendiri.
            </p>
        </div>

        <div class="col-lg-6">
            <div class="image-accent-wrapper mx-auto text-center" style="max-width: 100%;">
                <img class="img-fluid rounded-4 shadow-lg" 
                    style="max-width: 100%; height: auto; object-fit: cover;" 
                    src="<?= BASE_URL ?>/assets/img/kolamutama.jpeg"
                    alt="Sejarah Jukut Etam">
                <div class="text-center mt-3">
                    <h4 class="playfair mb-0" style="color: var(--dark-blue); font-weight: 700;">Est. <span style="color: var(--dark-gold);">2015</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="background-color: var(--light-bg); padding: 5rem 0;" id="vue-app-fasilitas">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold" style="color: var(--primary-blue); letter-spacing: 2px; font-size: 0.85rem;">Layanan Kami</span>
            <h2 class="display-6 fw-bold mt-2 playfair" style="color: var(--dark-blue);">Fasilitas Utama</h2>
            <div style="width: 60px; height: 3px; background-color: var(--gold); margin: 15px auto 0;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <transition-group name="fade">
                <div class="col-lg-4 col-md-6" v-for="(fas, index) in dataFasilitas" :key="index">
                    <div class="card-fasilitas">
                        <div class="icon-wrapper">
                            <i :class="fas.icon"></i>
                        </div>
                        <h4 class="playfair mb-3" style="color: var(--dark-blue); font-weight: 700;">{{ fas.nama_fasilitas }}</h4>
                        <p class="text-muted mb-0" style="line-height: 1.6;">
                            {{ fas.keterangan }}
                        </p>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</div>

<div class="container my-5 py-5">
    <div class="row align-items-center">
        <div class="col-lg-5 mb-5 mb-lg-0">
            <span class="text-uppercase fw-bold" style="color: var(--primary-blue); letter-spacing: 2px; font-size: 0.85rem;">Akses Mudah</span>
            <h2 class="display-6 fw-bold mt-2 mb-4 playfair" style="color: var(--dark-blue);">Lokasi Kami</h2>
            
            <p class="text-muted mb-4" style="line-height: 1.8; font-size: 1.1rem;">
                Kunjungi kami dengan mudah melalui petunjuk arah Google Maps di samping. Area parkir kami sangat luas dan dijaga ketat, aman untuk kendaraan roda dua maupun roda empat keluarga Anda.
            </p>
            
            <a href="https://maps.app.goo.gl/e4y2y8deHCUYZ5Nc7" target="_blank" class="btn-outline-gold mt-2">
                Buka di Google Maps <i class="fas fa-location-arrow ms-2"></i>
            </a>
        </div>
        <div class="col-lg-7">
            <div class="maps-frame position-relative">
                <div style="position: absolute; top: 15px; left: 15px; right: -15px; bottom: -15px; background-color: var(--gold); opacity: 0.2; border-radius: 16px; z-index: -1;"></div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6772540685065!2d117.21303027308214!3d-0.4818079352720428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5d5cbd465ca5f%3A0x4593cafdfd4fb6dd!2sPemancingan%20%26%20Kolam%20Renang%20%22JUKUT%20ETAM%22!5e0!3m2!1sid!2sid!4v1776131472316!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://kit.fontawesome.com/your-kit-code.js"></script>

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