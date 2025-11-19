<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const myJobs = ref([
  { id: 1, title: 'Senior Frontend Developer', status: 'approved', applications: 12, posted: '5 hari lalu' },
  { id: 2, title: 'UI/UX Designer', status: 'pending', applications: 8, posted: '2 hari lalu' },
  { id: 3, title: 'Backend Developer', status: 'approved', applications: 18, posted: '1 minggu lalu' },
]);

const stats = [
  { label: 'Total Lowongan', value: myJobs.value.length, icon: '📋' },
  { label: 'Total Lamaran', value: 38, icon: '👥' },
  { label: 'Profile Views', value: 156, icon: '👁️' },
];

const getStatusColor = (status) => {
  return {
    approved: 'bg-green-100 text-green-800',
    pending: 'bg-yellow-100 text-yellow-800',
    rejected: 'bg-red-100 text-red-800',
  }[status] || 'bg-slate-100 text-slate-800';
};

const getStatusLabel = (status) => {
  return {
    approved: 'Approved',
    pending: 'Pending',
    rejected: 'Rejected',
  }[status] || status;
};
</script>

<template>
  <AppLayout>
    <div>
      <!-- Header -->
      <div class="mb-8 flex justify-between items-center">
        <div>
          <h1 class="text-4xl font-bold text-slate-900 mb-2">Dashboard Perusahaan</h1>
          <p class="text-slate-600">Kelola lowongan pekerjaan dan lihat lamaran masuk</p>
        </div>
        <Link
          href="/jobs/create"
          class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold"
        >
          + Post Lowongan
        </Link>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div v-for="stat in stats" :key="stat.label" class="bg-white p-6 rounded-xl border border-slate-200">
          <div class="text-3xl mb-2">{{ stat.icon }}</div>
          <p class="text-slate-600 text-sm font-medium">{{ stat.label }}</p>
          <p class="text-3xl font-bold text-primary-600">{{ stat.value }}</p>
        </div>
      </div>

      <!-- Jobs Management -->
      <div class="bg-white rounded-xl border border-slate-200 p-6">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Lowongan Anda</h2>

        <div v-if="myJobs.length > 0" class="space-y-4">
          <div
            v-for="job in myJobs"
            :key="job.id"
            class="flex items-center justify-between p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition group"
          >
            <div class="flex-1">
              <h3 class="font-semibold text-slate-900 mb-1">{{ job.title }}</h3>
              <div class="flex gap-4 text-sm text-slate-600">
                <span>{{ job.applications }} lamaran</span>
                <span>Posted {{ job.posted }}</span>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <span :class="['px-4 py-2 rounded-lg text-sm font-semibold', getStatusColor(job.status)]">
                {{ getStatusLabel(job.status) }}
              </span>

              <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                <Link
                  :href="`/jobs/${job.id}/edit`"
                  class="p-2 text-slate-600 hover:text-primary-600 transition"
                  title="Edit"
                >
                  ✏️
                </Link>
                <Link
                  :href="`/jobs/${job.id}/applicants`"
                  class="p-2 text-slate-600 hover:text-primary-600 transition"
                  title="Lihat Lamaran"
                >
                  👥
                </Link>
              </div>
            </div>
          </div>
        </div>

        <div v-else class="text-center py-12">
          <p class="text-slate-600 mb-4">Belum ada lowongan pekerjaan</p>
          <Link
            href="/jobs/create"
            class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold"
          >
            Buat Lowongan Pertama
          </Link>
        </div>
      </div>

      </div>
    </div>
  </AppLayout>
</template>

```
