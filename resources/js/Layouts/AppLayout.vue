<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

defineProps({
  title: String,
});

const page = usePage();
const userRole = computed(() => page.props.auth.user?.role);
</script>

<template>
  <div class="min-h-screen bg-slate-50">
    <Navigation />
    
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <slot />
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center gap-2 font-bold text-xl mb-4">
              <div class="w-6 h-6 bg-primary-600 rounded"></div>
              JobBoard
            </div>
            <p class="text-slate-400 text-sm">Platform pencarian kerja terpercaya</p>
          </div>
          
          <div>
            <h3 class="font-semibold mb-4">Untuk Pelamar</h3>
            <ul class="space-y-2 text-slate-400 text-sm">
              <li><a href="#" class="hover:text-white transition">Cari Kerja</a></li>
              <li><a href="#" class="hover:text-white transition">Simpan Lamaran</a></li>
              <li><a href="#" class="hover:text-white transition">Unggah CV</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="font-semibold mb-4">Untuk Perusahaan</h3>
            <ul class="space-y-2 text-slate-400 text-sm">
              <li><a href="#" class="hover:text-white transition">Post Lowongan</a></li>
              <li><a href="#" class="hover:text-white transition">Kelola Jobs</a></li>
              <li><a href="#" class="hover:text-white transition">Lihat Pelamar</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="font-semibold mb-4">Lainnya</h3>
            <ul class="space-y-2 text-slate-400 text-sm">
              <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
              <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
              <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
            </ul>
          </div>
        </div>
        
        <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-400 text-sm">
          <p>&copy; .goodboop.RiantAndriansyah. Semua hak dilindungi.</p>
        </div>
      </div>
    </footer>
  </div>
</template>
