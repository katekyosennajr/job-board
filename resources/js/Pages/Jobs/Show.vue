<script setup>
import { computed, ref } from 'vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth.user);
const showNotification = ref(null);

const props = defineProps({
  job: {
    type: Object,
    required: true,
  },
  flash: {
    type: Object,
    default: () => ({}),
  },
});

const formattedDate = computed(() => {
  if (!props.job.created_at) return '';
  return new Date(props.job.created_at).toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
});

const salary = computed(() => {
  const job = props.job;
  if (!job.min_salary && !job.max_salary) return 'Salary not specified';
  if (job.min_salary && job.max_salary) {
    return `Rp ${job.min_salary.toLocaleString('id-ID')} - Rp ${job.max_salary.toLocaleString('id-ID')}`;
  }
  return `Rp ${(job.min_salary || job.max_salary).toLocaleString('id-ID')}`;
});

const apply = () => {
  if (!isLoggedIn.value) {
    window.location.href = route('login');
    return;
  }
  router.post(route('jobs.apply', props.job.id), {});
};
</script>

<template>
  <Head :title="job.title" />

  <AppLayout>
    <!-- Notification -->
    <div v-if="page.props.flash.success" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-800 font-semibold">
      ✓ {{ page.props.flash.success }}
    </div>
    <div v-if="page.props.flash.error" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 font-semibold">
      ✕ {{ page.props.flash.error }}
    </div>

    <div class="max-w-4xl">
      <!-- Back Link -->
      <Link
        href="/jobs"
        class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-semibold mb-8"
      >
        ← Kembali ke Daftar
      </Link>

      <div class="bg-white rounded-xl border border-slate-200 p-8 mb-8">
        <!-- Header -->
        <div class="mb-8 pb-8 border-b border-slate-200">
          <div class="flex items-start justify-between mb-4">
            <div>
              <h1 class="text-4xl font-bold text-slate-900 mb-2">{{ job.title }}</h1>
              <p class="text-xl text-slate-600 font-semibold">
                {{ job.company?.company_name || job.company?.name || 'Unknown Company' }}
              </p>
            </div>
            <span v-if="job.featured" class="px-4 py-2 bg-primary-100 text-primary-600 rounded-lg font-bold">
              ⭐ Featured
            </span>
          </div>
          <p class="text-slate-600">Posted {{ formattedDate }}</p>
        </div>

        <!-- Job Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="bg-slate-50 p-4 rounded-lg">
            <p class="text-sm text-slate-600 font-semibold mb-1">Tipe Pekerjaan</p>
            <p class="text-lg text-slate-900 font-bold">{{ job.job_type }}</p>
          </div>
          <div class="bg-slate-50 p-4 rounded-lg">
            <p class="text-sm text-slate-600 font-semibold mb-1">Lokasi</p>
            <p class="text-lg text-slate-900 font-bold">{{ job.location }}</p>
          </div>
          <div class="bg-slate-50 p-4 rounded-lg">
            <p class="text-sm text-slate-600 font-semibold mb-1">Gaji</p>
            <p class="text-lg text-slate-900 font-bold">{{ salary }}</p>
          </div>
          <div class="bg-slate-50 p-4 rounded-lg">
            <p class="text-sm text-slate-600 font-semibold mb-1">Kategori</p>
            <p class="text-lg text-slate-900 font-bold">{{ job.kategori }}</p>
          </div>
        </div>

        <!-- Description -->
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-4">Deskripsi Pekerjaan</h2>
          <div class="prose prose-sm max-w-none text-slate-700 whitespace-pre-wrap">
            {{ job.description }}
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 pt-8 border-t border-slate-200">
          <button
            @click="apply"
            class="flex-1 px-8 py-4 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-bold text-lg"
          >
            {{ isLoggedIn ? 'Lamar Sekarang' : 'Daftar untuk Lamar' }}
          </button>
          <button
            class="px-8 py-4 border-2 border-primary-300 text-primary-600 rounded-lg hover:bg-primary-50 transition font-bold"
          >
            ❤️ Simpan
          </button>
        </div>
      </div>

      <!-- Company Card -->
      <div v-if="job.company" class="bg-white rounded-xl border border-slate-200 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Tentang Perusahaan</h2>
        
        <div class="flex gap-6 mb-6">
          <div class="w-24 h-24 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-4xl">🏢</span>
          </div>
          <div class="flex-1">
            <h3 class="text-2xl font-bold text-slate-900">{{ job.company.company_name || job.company.name }}</h3>
            <p v-if="job.company.location" class="text-slate-600 mt-1">📍 {{ job.company.location }}</p>
            <p v-if="job.company.industry" class="text-slate-600">🏭 {{ job.company.industry }}</p>
          </div>
        </div>

        <div class="text-slate-700 mb-6">
          {{ job.company.description || 'Tidak ada deskripsi' }}
        </div>

        <div class="pt-6 border-t border-slate-200">
          <Link
            href="/jobs"
            class="inline-block px-6 py-2 bg-primary-50 text-primary-600 rounded-lg hover:bg-primary-100 transition font-semibold"
          >
            Lihat Lowongan Lain →
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
