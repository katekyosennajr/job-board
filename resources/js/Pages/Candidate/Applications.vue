<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  applications: {
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
    <Head title="Aplikasi Saya" />

    <AppLayout>
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Aplikasi Pekerjaan Saya</h1>
                <p class="text-slate-600">Pantau status lamaran kamu di sini</p>
            </div>

            <div v-if="applications.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <p class="text-4xl mb-4">📭</p>
                <p class="text-slate-600 font-semibold mb-6">Kamu belum melamar pekerjaan apapun</p>
                <Link
                    href="/jobs"
                    class="inline-block px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold"
                >
                    Cari Lowongan →
                </Link>
            </div>

            <div v-else class="space-y-4">
                <div
                    v-for="app in applications"
                    :key="app.id"
                    class="bg-white rounded-xl border border-slate-200 p-6 hover:border-primary-300 transition"
                >
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <Link
                                :href="`/jobs/${app.job.id}`"
                                class="text-xl font-bold text-slate-900 hover:text-primary-600 transition"
                            >
                                {{ app.job.title }}
                            </Link>
                            <p class="text-slate-600 mt-1">{{ app.job.company?.company_name || app.job.company?.name || 'Unknown Company' }}</p>
                            
                            <div class="flex gap-4 mt-3 text-sm text-slate-600">
                                <span>📍 {{ app.job.location }}</span>
                                <span>💼 {{ app.job.job_type }}</span>
                            </div>
                        </div>

                        <div class="text-right">
                            <div :class="`px-4 py-2 rounded-lg border font-semibold text-sm ${statusColor(app.status)}`">
                                {{ statusLabel(app.status) }}
                            </div>
                            <p class="text-slate-600 text-sm mt-3">
                                {{ new Date(app.created_at).toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric'
                                }) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
