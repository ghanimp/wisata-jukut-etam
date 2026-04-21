<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<style>
    /* Styling Tabel Premium Cove Theme */
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    .table-custom th { background-color: #006BBB; color: white; border: none; padding: 15px; }
    .table-custom td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f0f0f0; }
    .table-custom tbody tr { transition: all 0.3s ease; }
    .table-custom tbody tr:hover { background-color: #f8f9fa; transform: scale(1.01); }

    /* Styling Tombol Filter Vue */
    .vue-filter-btn { 
        border: 1px solid #dcdde1; 
        background: white; 
        color: #6c757d; 
        padding: 8px 18px; 
        border-radius: 30px; 
        transition: 0.3s; 
        font-size: 0.9rem; 
        font-weight: 600;
    }
    .vue-filter-btn.active, .vue-filter-btn:hover { 
        background-color: #006BBB; 
        color: #FFC973; 
        border-color: #006BBB; 
        box-shadow: 0 4px 10px rgba(0, 107, 187, 0.2);
    }

    /* Animasi Bintang */
    .star-filled { color: #FFC973; }
    .star-empty { color: #e4e5e9; }
    
    /* Animasi Muncul */
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-vue { animation: slideUp 0.6s ease-out forwards; }
    
    /* Transisi List Vue */
    .list-enter-active, .list-leave-active { transition: all 0.4s ease; }
    .list-enter-from, .list-leave-to { opacity: 0; transform: translateX(30px); }

    /* Badge styling */
    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }
    .bg-warning { background-color: #ffc107; color: #000; }
    .bg-success { background-color: #28a745; color: white; }
    .bg-danger { background-color: #dc3545; color: white; }
    
    /* Button styling */
    .btn-sm {
        padding: 5px 10px;
        font-size: 0.75rem;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .btn-success { background-color: #28a745; color: white; border: none; }
    .btn-warning { background-color: #ffc107; color: #000; border: none; }
    .btn-outline-danger { background: transparent; border: 1px solid #dc3545; color: #dc3545; }
    .btn-outline-danger:hover { background: #dc3545; color: white; }
    .rounded-circle { border-radius: 50% !important; }
    
    /* Alert styling */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-close {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
    }
</style>

<div id="vue-ulasan-app" class="container-fluid pt-3 pb-5 px-md-4 animate-vue">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
        <div class="mb-3 mb-md-0">
            <h3 class="fw-bold mb-1" style="color: #0A2540;"><i class="fas fa-comments me-2" style="color: #FFC973;"></i> Kelola Ulasan</h3>
            <p class="text-muted mb-0">Pantau dan moderasi ulasan dari pengunjung Jukut Etam.</p>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
            <i class="fas fa-check-circle me-2"></i> Notifikasi: Aksi terhadap ulasan berhasil dilakukan!
            <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
        </div>
    <?php endif; ?>

    <div class="d-flex mb-4 gap-2 flex-wrap">
        <button @click="setFilter('all')" :class="['vue-filter-btn', { active: currentFilter === 'all' }]">
            Semua ({{ totalAll }})
        </button>
        <button @click="setFilter('menunggu')" :class="['vue-filter-btn', { active: currentFilter === 'menunggu' }]">
            <i class="fas fa-clock me-1"></i> Menunggu ({{ totalMenunggu }})
        </button>
        <button @click="setFilter('disetujui')" :class="['vue-filter-btn', { active: currentFilter === 'disetujui' }]">
            <i class="fas fa-check-circle me-1"></i> Disetujui ({{ totalDisetujui }})
        </button>
        <button @click="setFilter('ditolak')" :class="['vue-filter-btn', { active: currentFilter === 'ditolak' }]">
            <i class="fas fa-times-circle me-1"></i> Ditolak ({{ totalDitolak }})
        </button>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive table-custom">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">ID</th>
                            <th width="15%">Nama Pengunjung</th>
                            <th width="15%">Rating</th>
                            <th width="25%">Isi Ulasan</th>
                            <th width="12%">Tanggal</th>
                            <th width="13%" class="text-center">Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody v-if="filteredUlasan.length > 0">
                        <transition-group name="list">
                            <tr v-for="item in filteredUlasan" :key="item.id">
                                <td class="text-center fw-bold text-muted">{{ item.id }}</td>
                                <td class="fw-semibold text-primary">{{ item.nama }}</td>
                                
                                <td>
                                    <i v-for="n in 5" :key="n" :class="['fas fa-star', n <= item.rating ? 'star-filled' : 'star-empty']"></i>
                                </td>
                                
                                <td>
                                    <p class="mb-0 text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" :title="item.ulasan">
                                        {{ item.ulasan }}
                                    </p>
                                </td>
                                <td class="text-muted small">{{ formatDate(item.created_at) }}</td>
                                <td class="text-center">
                                    <span v-if="item.status === 'menunggu'" class="badge bg-warning"><i class="fas fa-clock me-1"></i> Menunggu</span>
                                    <span v-else-if="item.status === 'disetujui'" class="badge bg-success"><i class="fas fa-check me-1"></i> Disetujui</span>
                                    <span v-else-if="item.status === 'ditolak'" class="badge bg-danger"><i class="fas fa-times me-1"></i> Ditolak</span>
                                </td>
                                <td class="text-center">
                                    <div v-if="item.status === 'menunggu'" class="d-inline-flex gap-1 mb-1">
                                        <a :href="'<?= BASE_URL ?>/index.php?c=admin&m=ulasanApprove&id=' + item.id" class="btn-sm btn-success rounded-circle" title="Setujui" onclick="return confirm('Setujui ulasan ini?')"><i class="fas fa-check"></i></a>
                                        <a :href="'<?= BASE_URL ?>/index.php?c=admin&m=ulasanReject&id=' + item.id" class="btn-sm btn-warning rounded-circle" title="Tolak" onclick="return confirm('Tolak ulasan ini?')"><i class="fas fa-times"></i></a>
                                    </div>
                                    <a :href="'<?= BASE_URL ?>/index.php?c=admin&m=ulasanHapus&id=' + item.id" class="btn-sm btn-outline-danger rounded-circle" title="Hapus" onclick="return confirm('Yakin hapus ulasan ini?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </transition-group>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                <p>Tidak ada ulasan dalam kategori filter ini.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const { createApp, ref, computed } = Vue;

    createApp({
        setup() {
            // Data ulasan dari PHP
            const ulasanData = <?= json_encode($ulasan ?? []) ?>;
            const ulasanList = ref(ulasanData);
            
            // Filter yang sedang aktif
            const currentFilter = ref('all');

            const setFilter = (filter) => {
                currentFilter.value = filter;
            };

            const formatDate = (dateString) => {
                if(!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            };

            // Filter ulasan berdasarkan status
            const filteredUlasan = computed(() => {
                if (currentFilter.value === 'all') return ulasanList.value;
                return ulasanList.value.filter(item => item.status === currentFilter.value);
            });

            // Hitung jumlah berdasarkan status
            const totalAll = computed(() => ulasanList.value.length);
            const totalMenunggu = computed(() => ulasanList.value.filter(i => i.status === 'menunggu').length);
            const totalDisetujui = computed(() => ulasanList.value.filter(i => i.status === 'disetujui').length);
            const totalDitolak = computed(() => ulasanList.value.filter(i => i.status === 'ditolak').length);

            return {
                ulasanList, currentFilter, filteredUlasan, 
                setFilter, formatDate, 
                totalAll, totalMenunggu, totalDisetujui, totalDitolak
            };
        }
    }).mount('#vue-ulasan-app');
</script>