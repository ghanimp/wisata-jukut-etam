<section class="hero-info position-relative d-flex align-items-center justify-content-center">
    <div class="container text-center text-white position-relative z-1">
        <span class="text-uppercase fw-bold mb-3 d-block animate-fadeIn" style="color: #FFC973; letter-spacing: 3px; font-size: 0.85rem;">
            Informasi Tarif Jukut Etam
        </span>
        
        <h1 class="display-4 fw-bold animate-fadeIn mb-0" style="font-family: 'Playfair Display', serif; color: #ffffff; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Fasilitas & Harga
        </h1>
        
        <div class="animate-fadeIn" style="width: 80px; height: 4px; background-color: #FFC973; margin: 1.5rem auto; border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);"></div>
        
        <p class="lead mb-0 animate-fadeIn mx-auto" style="font-weight: 300; max-width: 650px; line-height: 1.8; color: rgba(255,255,255,0.9);">
            Transparansi harga untuk pengalaman liburan Anda. Temukan berbagai layanan unggulan kami di bawah ini.
        </p>
    </div>
    
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: hidden; line-height: 0; transform: rotate(180deg);">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 40px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #fdfaf5;"></path>
        </svg>
    </div>
</section>

<div class="fasilitas-wrapper mb-5 animate-fadeIn" id="vue-info-app">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-swimmer me-2"></i> Kolam Renang
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataKolam" :key="'kolam-'+index">
                            <span class="fw-500">{{ row.hari }}</span>
                            <span class="price-text fs-5">Rp{{ formatRupiah(row.harga) }} <span class="fs-6 text-muted fw-normal">/org</span></span>
                        </li>
                        
                        <li class="list-group-item bg-light">
                            <span><i class="far fa-clock text-primary me-2"></i> Jam Operasional</span>
                            <span class="fw-bold" style="color: #0A2540;">09:00 - 17:30 WITA</span>
                        </li>
                        <li class="list-group-item">
                            <span><i class="fas fa-id-card text-success me-2"></i> Promo Warga</span>
                            <span class="text-end text-muted small">Tunjukkan KTP untuk diskon khusus!</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-fish me-2"></i> Tarif Pemancingan
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataPemancingan" :key="'pancing-'+index">
                            <span class="fw-500">{{ row.nama }}</span>
                            <span class="price-text fs-5">{{ row.harga }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="info-card">
                    <div class="card-header-custom playfair">
                        <i class="fas fa-umbrella-beach me-2"></i> Sewa Alat & Fasilitas
                    </div>
                    <ul class="list-group list-group-flush list-group-custom">
                        <li class="list-group-item" v-for="(row, index) in dataSewa" :key="'sewa-'+index">
                            <span class="fw-500"><i class="fas fa-check-circle text-success me-2"></i> {{ row.nama_fasilitas }}</span>
                            <span class="price-text fs-5">{{ row.harga }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-md-6">
                <div class="info-box-premium info-box-blue">
                    <h5 class="playfair mb-3" style="color: #4285f4; font-weight: 700;">
                        <i class="fas fa-credit-card me-2" style="color: #FFC973;"></i> Metode Pembayaran
                    </h5>
                    <p class="mb-0 text-muted" style="line-height: 1.6;">
                        Menerima <strong style="color: #0A2540;">Uang Tunai</strong> (Senin-Jumat) dan <strong style="color: #0A2540;">QRIS/Transfer Bank</strong> (Sabtu, Minggu & Hari Libur Nasional).
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box-premium info-box-green">
                    <h5 class="playfair mb-3" style="color: #34a853; font-weight: 700;">
                        <i class="fas fa-fishing-rod me-2" style="color: #FFC973;"></i> Sewa Alat Pancing
                    </h5>
                    <p class="mb-0 text-muted" style="line-height: 1.6;">
                        Tidak repot bawa alat! Tersedia sewa joran pancing lengkap (termasuk kail, umpan racikan, dan ember).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-blue: #006BBB;
        --dark-blue: #0A2540;
        --gold: #FFC973;
        --light-bg: #fdfaf5;
    }
    
    .playfair {
        font-family: 'Playfair Display', serif;
    }

    .fasilitas-wrapper {
        background-color: var(--light-bg);
        padding: 4rem 0;
        border-radius: 20px;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.02);
    }

    .hero-info {
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

    .info-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 107, 187, 0.08);
    }

    .card-header-custom {
        background-color: var(--primary-blue);
        color: var(--gold);
        padding: 1.25rem;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: 1px;
        border-bottom: none;
    }

    .list-group-custom .list-group-item {
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.2rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--dark-blue);
        background-color: transparent;
        transition: background-color 0.2s ease;
    }

    .list-group-custom .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-custom .list-group-item:hover {
        background-color: #f8fcfd;
    }

    .price-text {
        color: #d8a548; 
        font-weight: 700;
    }

    .info-box-premium {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.8rem;
        height: 100%;
        box-shadow: 0 8px 25px rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .info-box-premium:hover {
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        transform: translateY(-3px);
    }

    .info-box-blue {
        border: 2px solid #4285f4;
    }

    .info-box-blue::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 6px; height: 100%;
        background-color: #4285f4;
    }

    .info-box-green {
        border: 2px solid #34a853;
    }

    .info-box-green::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 6px; height: 100%;
        background-color: #34a853;
    }
</style>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script>
    // Menyuntikkan array PHP dari database ke dalam variabel Javascript
    const phpDataKolam = <?= json_encode($harga_kolam) ?>;
    const phpDataPemancingan = <?= json_encode($harga_pemancingan) ?>;
    const phpDataSewa = <?= json_encode($harga_sewa) ?>;

    const { createApp } = Vue;

    createApp({
        data() {
            return {
                dataKolam: phpDataKolam,
                dataPemancingan: phpDataPemancingan,
                dataSewa: phpDataSewa
            }
        },
        methods: {
            formatRupiah(angka) {
                let number = Number(angka);
                return new Intl.NumberFormat('id-ID').format(number);
            }
        }
    }).mount('#vue-info-app');
</script>