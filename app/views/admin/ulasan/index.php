<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<div id="vue-ulasan-app" class="container-fluid pt-3 pb-5 px-md-4 animate-vue">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
        <div class="mb-3 mb-md-0">
            <h3 class="fw-bold mb-1 admin-heading"><i class="fas fa-comments me-2 admin-heading-icon"></i> Kelola Ulasan
            </h3>
            <p class="text-muted mb-0">Pantau dan moderasi ulasan dari pengunjung Jukut Etam.</p>
        </div>
    </div>

    <!-- Info Alert -->
    <div class="alert-info-custom mb-3">
        <i class="fas fa-info-circle me-2"></i>
        Total <strong>{{ totalAll }} ulasan</strong> dari pengunjung.
        <span v-if="totalMenunggu > 0" class="fw-bold" style="color: #856404;">{{ totalMenunggu }} menunggu</span>
        persetujuan.
    </div>

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

    <div class="admin-card">
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="admin-table">
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
                                <td class="fw-semibold pengunggah-name">{{ item.nama }}</td>

                                <td>
                                    <i v-for="n in 5" :key="n"
                                        :class="['fas fa-star', n <= item.rating ? 'star-filled' : 'star-empty']"></i>
                                </td>

                                <td>
                                    <p class="mb-0 text-muted small ulasan-text" :title="item.ulasan">
                                        {{ item.ulasan }}
                                    </p>
                                </td>
                                <td class="text-muted small">{{ formatDate(item.created_at) }}</td>
                                <td class="text-center">
                                    <span v-if="item.status === 'menunggu'" class="badge bg-warning"><i
                                            class="fas fa-clock me-1"></i> Menunggu</span>
                                    <span v-else-if="item.status === 'disetujui'" class="badge bg-success"><i
                                            class="fas fa-check me-1"></i> Disetujui</span>
                                    <span v-else-if="item.status === 'ditolak'" class="badge bg-danger"><i
                                            class="fas fa-times me-1"></i> Ditolak</span>
                                </td>
                                <td class="text-center">
                                    <!-- STATUS MENUNGGU: Tombol Setujui & Tolak -->
                                    <div v-if="item.status === 'menunggu'"
                                        class="d-flex flex-column gap-1 align-items-center">
                                        <a href="#" class="btn-action btn-approve"
                                            @click.prevent="confirmAction('Setujui ulasan ini?', '<?= BASE_URL ?>/index.php?c=admin&m=ulasanApprove&id=' + item.id)"
                                            title="Setujui">
                                            <i class="fas fa-check me-1"></i> Setujui
                                        </a>
                                        <a href="#" class="btn-action btn-reject"
                                            @click.prevent="confirmAction('Tolak ulasan ini?', '<?= BASE_URL ?>/index.php?c=admin&m=ulasanReject&id=' + item.id)"
                                            title="Tolak">
                                            <i class="fas fa-times me-1"></i> Tolak
                                        </a>
                                    </div>

                                    <!-- STATUS LAIN: Tombol Hapus (Icon Doang) -->
                                    <div v-else>
                                        <a href="#" class="btn-delete"
                                            @click.prevent="confirmAction('Yakin hapus ulasan ini?', '<?= BASE_URL ?>/index.php?c=admin&m=ulasanHapus&id=' + item.id)"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
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
            const ulasanData = <?= json_encode($ulasan ?? []) ?>;
            const ulasanList = ref(ulasanData);

            const currentFilter = ref('all');

            const setFilter = (filter) => {
                currentFilter.value = filter;
            };

            const formatDate = (dateString) => {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
            };

            const filteredUlasan = computed(() => {
                if (currentFilter.value === 'all') return ulasanList.value;
                return ulasanList.value.filter(item => item.status === currentFilter.value);
            });

            const totalAll = computed(() => ulasanList.value.length);
            const totalMenunggu = computed(() => ulasanList.value.filter(i => i.status === 'menunggu').length);
            const totalDisetujui = computed(() => ulasanList.value.filter(i => i.status === 'disetujui').length);
            const totalDitolak = computed(() => ulasanList.value.filter(i => i.status === 'ditolak').length);

            const confirmAction = (message, url) => {
                document.getElementById('confirmMessage').innerText = message;
                document.getElementById('confirmLink').href = url;
                document.getElementById('confirmModal').style.display = 'flex';
            };

            return {
                ulasanList, currentFilter, filteredUlasan,
                setFilter, formatDate,
                totalAll, totalMenunggu, totalDisetujui, totalDitolak,
                confirmAction
            };
        }
    }).mount('#vue-ulasan-app');
</script>