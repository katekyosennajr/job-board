<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();

defineProps({
  job: {
    type: Object,
    required: true,
  },
  applicants: {
    type: Array,
    required: true,
  },
});

const statusColor = (status) => {
  return {
    'pending': 'bg-yellow-50 text-yellow-700 border-yellow-200',
    'accepted': 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'rejected': 'bg-red-50 text-red-700 border-red-200',
    'interview': 'bg-blue-50 text-blue-700 border-blue-200'
  }[status] || 'bg-slate-50 text-slate-700 border-slate-200';
};

const statusLabel = (status) => {
  return {
    'pending': '⏳ Menunggu',
    'accepted': '✓ Diterima',
    'rejected': '✕ Ditolak',
    'interview': '📞 Interview'
  }[status] || status;
};
</script>

<template>
  <Head :title="`Applicants - ${job.title}`" />

  <AppLayout>
    <div class="max-w-4xl mx-auto">
      <Link
        href="/jobs"
        class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold mb-8"
      >
        ← Kembali
      </Link>

      <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Pelamar untuk: {{ job.title }}</h1>
        <p class="text-slate-600">Total pelamar: <strong>{{ applicants.length }}</strong></p>
      </div>

      <div v-if="applicants.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
        <p class="text-4xl mb-4">📭</p>
        <p class="text-slate-600 font-semibold">Belum ada yang melamar untuk posisi ini</p>
      </div>

      <div v-else class="space-y-4">
        <div
          v-for="app in applicants"
          :key="app.id"
          class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg transition"
        >
          <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-4 flex-1">
              <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <span class="text-2xl">👤</span>
              </div>
              
              <div class="flex-1">
                <h3 class="text-xl font-bold text-slate-900">
                  {{ app.candidate?.name || 'Unknown Candidate' }}
                </h3>
                <p class="text-slate-600 text-sm">
                  {{ app.candidate?.email || 'No email' }}
                </p>

                <div class="flex gap-4 mt-3 text-sm text-slate-600">
                  <span>📅 Melamar {{ new Date(app.created_at).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                  }) }}</span>
                </div>
              </div>
            </div>

            <div class="text-right">
              <div :class="`px-4 py-2 rounded-lg border font-semibold text-sm mb-4 ${statusColor(app.status)}`">
                {{ statusLabel(app.status) }}
              </div>
              
              <div class="space-y-2">
                <button
                  v-if="app.status === 'pending'"
                  class="block w-full px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold text-sm"
                >
                  ✓ Terima
                </button>
                <button
                  v-if="app.status === 'pending'"
                  class="block w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold text-sm"
                >
                  ✕ Tolak
                </button>
                <button
                  v-if="app.status !== 'rejected'"
                  class="block w-full px-4 py-2 border border-slate-300 text-slate-600 rounded-lg hover:bg-slate-50 transition font-semibold text-sm"
                >
                  Hubungi
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
