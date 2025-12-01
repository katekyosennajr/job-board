<script setup>
import { ref, computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import JobCard from '@/Components/JobCard.vue';
import SearchFilter from '@/Components/SearchFilter.vue';

const page = usePage();

const props = defineProps({
  jobs: {
    type: [Array, Object],
    default: () => [],
  },
});

const isCompanyView = computed(() => page.props.auth.user?.role === 'company');

const sortBy = ref('newest');
const filters = ref({
  search: '',
  location: '',
  jobType: '',
  category: '',
  minSalary: 0,
  maxSalary: 200000000,
});

const jobsData = computed(() => {
  if (typeof props.jobs === 'object' && props.jobs.data) {
    return props.jobs.data;
  }
  return Array.isArray(props.jobs) ? props.jobs : [];
});

const filteredJobs = computed(() => {
  let result = jobsData.value;

  if (filters.value.search) {
    result = result.filter(job =>
      job.title.toLowerCase().includes(filters.value.search.toLowerCase()) ||
      job.description.toLowerCase().includes(filters.value.search.toLowerCase())
    );
  }

  if (filters.value.location) {
    result = result.filter(job =>
      job.location?.toLowerCase().includes(filters.value.location.toLowerCase())
    );
  }

  if (filters.value.jobType) {
    result = result.filter(job =>
      job.job_type?.toLowerCase() === filters.value.jobType.toLowerCase()
    );
  }

  if (filters.value.category) {
    result = result.filter(job =>
      job.kategori?.toLowerCase() === filters.value.category.toLowerCase()
    );
  }

  if (filters.value.minSalary > 0) {
    result = result.filter(job => (job.max_salary || 0) >= filters.value.minSalary);
  }

  if (filters.value.maxSalary < 200000000) {
    result = result.filter(job => (job.min_salary || 0) <= filters.value.maxSalary);
  }

  if (sortBy.value === 'newest') {
    return result;
  } else if (sortBy.value === 'salary-high') {
    return [...result].sort((a, b) => (b.max_salary || 0) - (a.max_salary || 0));
  } else if (sortBy.value === 'salary-low') {
    return [...result].sort((a, b) => (a.min_salary || 0) - (b.min_salary || 0));
  }

  return result;
});

const handleFilter = (newFilters) => {
  filters.value = newFilters;
};

const hapus = (id) => {
  if (confirm('Yakin ingin menghapus pekerjaan ini?')) {
    Inertia.delete(route('jobs.destroy', id))
  }
}
</script>

<template>
  <Head :title="isCompanyView ? 'Kelola Pekerjaan' : 'Cari Pekerjaan'" />

  <AuthenticatedLayout v-if="isCompanyView">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pekerjaan</h2>
    </template>

    <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <a href="/jobs/create" class="bg-primary-600 text-white px-4 py-2 rounded mb-4 inline-block font-semibold">+ Tambah Pekerjaan</a>

        <div v-if="jobsData.length === 0" class="text-gray-600">Belum ada data pekerjaan.</div>

        <div v-for="job in jobsData" :key="job.id" class="bg-white p-5 rounded-lg shadow mb-4">
          <h3 class="text-lg font-semibold">{{ job.title }}</h3>
          <p class="text-gray-700">{{ job.location }} • {{ job.job_type }} • {{ job.kategori }}</p>
          <p class="text-sm text-gray-600">Gaji: Rp{{ job.min_salary }} - Rp{{ job.max_salary }}</p>
          <p class="mt-2 text-gray-800">{{ job.description }}</p>
          <span class="inline-block mt-2 text-yellow-700 font-semibold">{{ job.status?.toUpperCase() }}</span>

          <div class="flex gap-4 mt-3">
            <a :href="`/jobs/${job.id}/edit`" class="text-primary-600 font-semibold">Edit</a>
            <button @click="hapus(job.id)" class="text-red-600 font-semibold">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>

  <AppLayout v-else>
    <div class="max-w-7xl mx-auto px-4 py-8">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Cari Pekerjaan</h1>
        <p class="text-slate-600">{{ filteredJobs.length }} pekerjaan tersedia</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1">
          <SearchFilter @filter="handleFilter" />
        </div>

        <div class="lg:col-span-3">
          <div class="mb-6 flex justify-between items-center">
            <div class="flex gap-2 flex-wrap">
              <button
                @click="sortBy = 'newest'"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-colors',
                  sortBy === 'newest'
                    ? 'bg-primary-600 text-white'
                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                ]"
              >
                Terbaru
              </button>
              <button
                @click="sortBy = 'salary-high'"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-colors',
                  sortBy === 'salary-high'
                    ? 'bg-primary-600 text-white'
                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                ]"
              >
                Gaji Tertinggi
              </button>
              <button
                @click="sortBy = 'salary-low'"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-colors',
                  sortBy === 'salary-low'
                    ? 'bg-primary-600 text-white'
                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                ]"
              >
                Gaji Terendah
              </button>
            </div>
          </div>

          <div v-if="filteredJobs.length > 0" class="space-y-4">
            <JobCard
              v-for="job in filteredJobs"
              :key="job.id"
              :job="job"
              show-company
            />
          </div>

          <div v-else class="bg-white rounded-xl border border-slate-200 p-12 text-center">
            <div class="text-4xl mb-4">🔍</div>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">Pekerjaan Tidak Ditemukan</h3>
            <p class="text-slate-600 mb-6">
              Coba ubah filter atau cari dengan keyword yang berbeda
            </p>
            <button
              @click="handleFilter({ search: '', location: '', jobType: '', category: '', minSalary: 0, maxSalary: 200000000 })"
              class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold"
            >
              Reset Filter
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
