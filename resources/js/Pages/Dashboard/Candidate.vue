<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const stats = [
  { label: 'Lamaran Dikirim', value: 3, icon: '📤' },
  { label: 'Pekerjaan Disimpan', value: 2, icon: '❤️' },
  { label: 'Profil Views', value: 42, icon: '👁️' },
];
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

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <Link
          href="/jobs"
          class="bg-primary-600 text-white p-6 rounded-xl hover:bg-primary-700 transition font-semibold text-lg"
        >
          🔍 Cari Pekerjaan Baru
        </Link>
        <Link
          href="/profile"
          class="bg-slate-100 text-slate-900 p-6 rounded-xl hover:bg-slate-200 transition font-semibold text-lg"
        >
          👤 Edit Profil Saya
        </Link>
      </div>

      <!-- Applications Section -->
      <div class="bg-white rounded-xl border border-slate-200 p-6 mb-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Lamaran Terbaru</h2>
        <div class="text-center py-8">
          <p class="text-slate-600 mb-4">📭 Belum ada lamaran yang ditampilkan di sini</p>
          <Link
            href="/my-applications"
            class="inline-block text-primary-600 hover:text-primary-700 font-semibold"
          >
            Lihat Semua Lamaran →
          </Link>
        </div>
      </div>

      <!-- Info Section -->
      <div class="bg-primary-50 border border-primary-200 rounded-xl p-6">
        <h3 class="text-lg font-bold text-primary-900 mb-2">💡 Tips Meningkatkan Peluang</h3>
        <ul class="space-y-2 text-primary-800">
          <li>✓ Lengkapi profil dengan informasi yang detail</li>
          <li>✓ Tinjau ulang CV sebelum melamar</li>
          <li>✓ Cari pekerjaan yang sesuai dengan keahlian Anda</li>
          <li>✓ Perbarui status profil secara berkala</li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>
