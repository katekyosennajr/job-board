<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const applications = ref([
  { id: 1, job_title: 'Senior Frontend Developer', company: 'Tech Startup', status: 'pending', date: '2 hari lalu' },
  { id: 2, job_title: 'UI/UX Designer', company: 'Design Agency', status: 'accepted', date: '5 hari lalu' },
  { id: 3, job_title: 'Full Stack Developer', company: 'Fintech Corp', status: 'rejected', date: '1 minggu lalu' },
]);

const savedJobs = ref([
  { id: 1, title: 'Data Scientist', company: 'AI Solutions', location: 'Jakarta', salary: 'Rp 20-30jt' },
  { id: 2, title: 'Backend Developer', company: 'Tech Startup', location: 'Remote', salary: 'Rp 18-25jt' },
]);

const stats = [
  { label: 'Lamaran Dikirim', value: applications.value.length, icon: '📤' },
  { label: 'Pekerjaan Disimpan', value: savedJobs.value.length, icon: '❤️' },
  { label: 'Profil Views', value: 42, icon: '👁️' },
];

const getStatusColor = (status) => {
  return {
    pending: 'bg-yellow-100 text-yellow-800',
    accepted: 'bg-green-100 text-green-800',
    rejected: 'bg-red-100 text-red-800',
  }[status] || 'bg-slate-100 text-slate-800';
};

const getStatusLabel = (status) => {
  return {
    pending: 'Menunggu',
    accepted: 'Diterima',
    rejected: 'Ditolak',
  }[status] || status;
};
</script>

<template>
  <AppLayout>
    <div>
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Dashboard Pencari Kerja</h1>
        <p class="text-slate-600">Kelola lamaran dan pekerjaan yang Anda simpan</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div v-for="stat in stats" :key="stat.label" class="bg-white p-6 rounded-xl border border-slate-200">
          <div class="text-3xl mb-2">{{ stat.icon }}</div>
          <p class="text-slate-600 text-sm font-medium">{{ stat.label }}</p>
          <p class="text-3xl font-bold text-primary-600">{{ stat.value }}</p>
        </div>
      </div>

      <!-- Applications Section -->
      <div class="bg-white rounded-xl border border-slate-200 p-6 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Lamaran Terbaru</h2>

        <div v-if="applications.length > 0" class="space-y-4">
          <div
            v-for="app in applications"
            :key="app.id"
            class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition"
          >
            <div class="flex-1">
              <h3 class="font-semibold text-slate-900">{{ app.job_title }}</h3>
              <p class="text-sm text-slate-600">{{ app.company }} • {{ app.date }}</p>
            </div>
            <span :class="['px-4 py-2 rounded-lg text-sm font-semibold', getStatusColor(app.status)]">
              {{ getStatusLabel(app.status) }}
            </span>
          </div>
        </div>

        <div class="text-center py-8">
          <Link
            href="/my-applications"
            class="text-primary-600 hover:text-primary-700 font-semibold"
          >
            Lihat Semua Lamaran →
          </Link>
        </div>
      </div>

      <!-- Saved Jobs Section -->
      <div class="bg-white rounded-xl border border-slate-200 p-6">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Pekerjaan yang Disimpan</h2>

        <div v-if="savedJobs.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <div
            v-for="job in savedJobs"
            :key="job.id"
            class="p-4 border border-slate-200 rounded-lg hover:border-primary-200 hover:shadow-md transition"
          >
            <div class="flex justify-between items-start mb-3">
              <div>
                <h3 class="font-semibold text-slate-900">{{ job.title }}</h3>
                <p class="text-sm text-slate-600">{{ job.company }}</p>
              </div>
              <button class="text-red-500 hover:text-red-700">❤️</button>
            </div>
            <p class="text-sm text-slate-600 mb-3">📍 {{ job.location }} • {{ job.salary }}</p>
            <Link
              href="#"
              class="text-primary-600 hover:text-primary-700 text-sm font-semibold"
            >
              Lamar Sekarang →
            </Link>
          </div>
        </div>

        <div class="text-center py-8 border-t border-slate-200 pt-8">
          <Link
            href="/jobs"
            class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold"
          >
            Temukan Pekerjaan Lainnya
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
