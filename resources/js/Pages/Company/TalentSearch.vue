<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({
  candidates: {
    type: Array,
    default: () => []
  }
});

const searchQuery = ref('');
const locationFilter = ref('');

const filteredCandidates = computed(() => {
  return props.candidates.filter(candidate => {
    const matchesSearch = !searchQuery.value || 
      candidate.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesLocation = !locationFilter.value || 
      (candidate.location && candidate.location.toLowerCase().includes(locationFilter.value.toLowerCase()));
    return matchesSearch && matchesLocation;
  });
});
</script>

<template>
  <Head title="Cari Talenta" />
  
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800">Cari Talenta</h2>
    </template>

    <div class="py-12">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
          <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Temukan Kandidat Terbaik</h1>
            <p class="text-slate-600">Cari dan hubungi kandidat yang sesuai dengan kebutuhan perusahaan Anda</p>
          </div>

          <!-- Filters -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Cari Nama</label>
              <input
                v-model="searchQuery"
                type="text"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Cari berdasarkan nama..."
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-700 mb-2">Lokasi</label>
              <input
                v-model="locationFilter"
                type="text"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Cari berdasarkan lokasi..."
              />
            </div>
          </div>

          <!-- Candidates List -->
          <div v-if="filteredCandidates.length > 0" class="space-y-4">
            <div
              v-for="candidate in filteredCandidates"
              :key="candidate.id"
              class="border border-slate-200 rounded-lg p-5 hover:shadow-md hover:border-primary-200 transition"
            >
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <h3 class="text-lg font-semibold text-slate-900 mb-1">{{ candidate.name }}</h3>
                  <p class="text-sm text-slate-600 mb-3">{{ candidate.email }}</p>
                  
                  <div class="flex flex-wrap gap-3 text-sm text-slate-600">
                    <span v-if="candidate.location" class="flex items-center gap-1">
                      📍 {{ candidate.location }}
                    </span>
                    <span class="flex items-center gap-1">
                      📅 Bergabung {{ new Date(candidate.created_at).toLocaleDateString('id-ID') }}
                    </span>
                  </div>
                </div>

                <div class="flex gap-2">
                  <a
                    :href="`mailto:${candidate.email}`"
                    class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition text-sm font-medium"
                  >
                    Hubungi
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-else class="text-center py-12">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Tidak ada kandidat ditemukan</h3>
            <p class="text-slate-600">Coba ubah filter pencarian Anda</p>
          </div>

          <!-- Info Box -->
          <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
              <strong>Tips:</strong> Hubungi kandidat yang sesuai dengan kebutuhan posisi Anda. Pastikan untuk memberikan informasi yang jelas tentang posisi dan perusahaan Anda.
            </p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
