<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    featuredJobs: Array,
});

const currentSlide = ref(0);
let slideInterval;

const slides = [
  {
    gradient: 'from-blue-600 to-indigo-600',
    icon: '💼',
    title: 'Temukan Karir Impian',
    subtitle: 'Jelajahi ribuan peluang kerja dari perusahaan terbaik'
  },
  {
    gradient: 'from-emerald-600 to-teal-600',
    icon: '🚀',
    title: 'Berkembang Bersama',
    subtitle: 'Raih potensi terbaik Anda di tim yang tepat'
  },
  {
    gradient: 'from-purple-600 to-pink-600',
    icon: '⭐',
    title: 'Hubungkan Karir',
    subtitle: 'Temukan posisi yang sesuai dengan skill Anda'
  },
];

const stats = ref([
  { label: 'Lowongan Aktif', value: '1500+' },
  { label: 'Perusahaan Terdaftar', value: '500+' },
  { label: 'Sukses Merekrut', value: '95%' },
]);

onMounted(() => {
  slideInterval = setInterval(() => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
  }, 5000);
});

onUnmounted(() => {
  clearInterval(slideInterval);
});

const goToSlide = (index) => {
  currentSlide.value = index;
  clearInterval(slideInterval);
  slideInterval = setInterval(() => {
    currentSlide.value = (currentSlide.value + 1) % slides.length;
  }, 5000);
};
</script>

<template>
    <Head title="JobBoard - Platform Pencarian Kerja Terbaik" />

    <div class="min-h-screen bg-white">
        <Navigation />

        <!-- Hero Section -->
        <section class="relative overflow-hidden">
            <div class="relative h-80 md:h-96 bg-gradient-to-br from-slate-900 to-slate-800">
                <!-- Slides -->
                <div
                    v-for="(slide, index) in slides"
                    :key="index"
                    :class="[
                        'absolute inset-0 transition-opacity duration-1000',
                        currentSlide === index ? 'opacity-100' : 'opacity-0'
                    ]"
                >
                    <div :class="`absolute inset-0 bg-gradient-to-br ${slide.gradient}`"></div>
                    
                    <!-- Content -->
                    <div class="absolute inset-0 flex items-center justify-center px-4">
                        <div class="text-center text-white max-w-2xl">
                            <div class="text-5xl md:text-6xl mb-3">{{ slide.icon }}</div>
                            <h1 class="text-3xl md:text-4xl font-semibold mb-3">{{ slide.title }}</h1>
                            <p class="text-base md:text-lg text-white/90">{{ slide.subtitle }}</p>
                        </div>
                    </div>
                </div>

                <!-- Indicators -->
                <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2">
                    <button
                        v-for="(slide, index) in slides"
                        :key="index"
                        @click="goToSlide(index)"
                        :class="[
                            'w-2 h-2 rounded-full transition-all',
                            currentSlide === index 
                                ? 'bg-white w-6' 
                                : 'bg-white/40 hover:bg-white/70'
                        ]"
                    ></button>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div v-for="stat in stats" :key="stat.label">
                        <div class="text-3xl md:text-4xl font-semibold text-indigo-600 mb-2">{{ stat.value }}</div>
                        <p class="text-sm md:text-base text-slate-600">{{ stat.label }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Jobs -->
        <section class="py-16 md:py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <h2 class="text-2xl md:text-3xl font-semibold text-slate-900 mb-2">Lowongan Terbaru</h2>
                    <p class="text-slate-600 text-sm md:text-base">Peluang karir terbaru dari perusahaan terpilih</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-10">
                    <div
                        v-for="job in featuredJobs"
                        :key="job.id"
                        class="bg-white p-5 rounded-lg border border-slate-200 hover:shadow-md hover:border-indigo-200 transition-all"
                    >
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-slate-900">{{ job.title }}</h3>
                                <p class="text-sm text-slate-600 mt-1">{{ job.company }}</p>
                            </div>
                            <span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded text-xs font-medium whitespace-nowrap ml-2">Baru</span>
                        </div>

                        <div class="flex flex-wrap gap-3 text-xs md:text-sm text-slate-600 mb-4">
                            <span class="flex items-center gap-1">📍 {{ job.location }}</span>
                            <span class="flex items-center gap-1">💰 {{ job.salary }}</span>
                        </div>

                        <Link
                            :href="route('jobs.show', job.id)"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-700"
                        >
                            Lihat Detail →
                        </Link>
                    </div>
                </div>

                <div class="text-center">
                    <Link
                        :href="route('jobs.index')"
                        class="inline-block px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors text-sm font-medium"
                    >
                        Lihat Semua Lowongan
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-white py-10 md:py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 mb-8">
                    <div>
                        <div class="flex items-center gap-2 font-semibold text-base mb-3">
                            <div class="w-5 h-5 bg-indigo-600 rounded"></div>
                            JobBoard
                        </div>
                        <p class="text-slate-400 text-xs md:text-sm">Platform pencarian kerja terpercaya Indonesia</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-3">Untuk Pencari Kerja</h3>
                        <ul class="space-y-2 text-slate-400 text-xs md:text-sm">
                            <li><a href="#" class="hover:text-white transition">Cari Pekerjaan</a></li>
                            <li><a href="#" class="hover:text-white transition">CV Builder</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-3">Untuk Perusahaan</h3>
                        <ul class="space-y-2 text-slate-400 text-xs md:text-sm">
                            <li><a href="#" class="hover:text-white transition">Post Lowongan</a></li>
                            <li><a href="#" class="hover:text-white transition">Cari Talenta</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-sm mb-3">Lainnya</h3>
                        <ul class="space-y-2 text-slate-400 text-xs md:text-sm">
                            <li><a href="#" class="hover:text-white transition">Privasi</a></li>
                            <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 text-center text-slate-400 text-xs">
                    <p>&copy; 2025.goodboop.Riant.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
