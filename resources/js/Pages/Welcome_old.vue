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
    subtitle: 'Ribuan peluang kerja menanti Anda'
  },
  {
    gradient: 'from-emerald-600 to-teal-600',
    icon: '🚀',
    title: 'Berkembang Bersama',
    subtitle: 'Raih potensi terbaik Anda di perusahaan terkemuka'
  },
  {
    gradient: 'from-purple-600 to-pink-600',
    icon: '⭐',
    title: 'Mulai Petualangan Baru',
    subtitle: 'Hubungkan skill Anda dengan perusahaan impian'
  },
  {
    gradient: 'from-orange-500 to-red-600',
    icon: '🎯',
    title: 'Wujudkan Impian Karir',
    subtitle: 'Bersama JobBoard, kesuksesan ada di tangan Anda'
  },
];

const stats = ref([
  { label: 'Lowongan Kerja', value: '1500+' },
  { label: 'Perusahaan', value: '500+' },
  { label: 'Pelamar Sukses', value: '95%' },
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

    <div class="min-h-screen bg-slate-50">
        <Navigation />

        <!-- Hero Section with Carousel -->
        <section class="relative overflow-hidden pt-20 pb-32">
            <!-- Carousel Container -->
            <div class="relative h-96 bg-gradient-to-br from-slate-900 to-slate-800">
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
                    
                    <!-- Overlay Content -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white">
                            <div class="text-6xl mb-4 animate-bounce">{{ slide.icon }}</div>
                            <h1 class="text-5xl lg:text-6xl font-bold mb-4">{{ slide.title }}</h1>
                            <p class="text-xl text-white/90 mb-8 max-w-2xl">{{ slide.subtitle }}</p>
                            
                            <div class="flex gap-4 justify-center flex-wrap">
                                <Link
                                    v-if="!$page.props.auth.user"
                                    :href="route('register')"
                                    class="px-8 py-3 bg-white text-slate-900 rounded-lg hover:bg-slate-100 transition-colors font-semibold shadow-lg hover:shadow-xl"
                                >
                                    Daftar Sekarang
                                </Link>
                                <Link
                                    :href="route('jobs.index')"
                                    class="px-8 py-3 bg-slate-900/50 text-white border-2 border-white rounded-lg hover:bg-slate-900 transition-colors font-semibold backdrop-blur-sm"
                                >
                                    Lihat Lowongan
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Indicators -->
                <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-3">
                    <button
                        v-for="(slide, index) in slides"
                        :key="index"
                        @click="goToSlide(index)"
                        :class="[
                            'w-3 h-3 rounded-full transition-all',
                            currentSlide === index 
                                ? 'bg-white w-8' 
                                : 'bg-white/50 hover:bg-white/75'
                        ]"
                        :aria-label="`Go to slide ${index + 1}`"
                    ></button>
                </div>

                <!-- Next/Prev Buttons -->
                <button
                    @click="currentSlide = (currentSlide - 1 + slides.length) % slides.length"
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-colors z-10"
                >
                    ‹
                </button>
                <button
                    @click="currentSlide = (currentSlide + 1) % slides.length"
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 text-white rounded-full flex items-center justify-center transition-colors z-10"
                >
                    ›
                </button>
            </div>
        </section>

        <!-- Search Section -->
        <section class="py-12 bg-white border-b border-slate-200">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <input
                        type="text"
                        placeholder="Cari posisi atau perusahaan..."
                        class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                    />
                    <input
                        type="text"
                        placeholder="Lokasi..."
                        class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                    />
                    <button class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-semibold">
                        Cari
                    </button>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 gap-8 text-center">
                    <div v-for="stat in stats" :key="stat.label">
                        <div class="text-4xl font-bold text-primary-600 mb-2">{{ stat.value }}</div>
                        <p class="text-slate-600 font-medium">{{ stat.label }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Jobs -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h2 class="text-4xl font-bold text-slate-900 mb-2">Lowongan Unggulan</h2>
                    <p class="text-slate-600">Posisi terbaik yang tersedia hari ini</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        v-for="job in featuredJobs"
                        :key="job.id"
                        class="bg-white p-6 rounded-xl border border-slate-200 hover:shadow-lg hover:border-primary-200 transition-all"
                    >
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ job.title }}</h3>
                                <p class="text-slate-600 font-medium">{{ job.company }}</p>
                            </div>
                            <span class="px-3 py-1 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold">Baru</span>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm text-slate-600 mb-4">
                            <span>📍 {{ job.location }}</span>
                            <span>💰 {{ job.salary }}</span>
                        </div>

                        <Link
                            :href="route('jobs.show', job.id)"
                            class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-lg hover:bg-primary-100 transition-colors font-medium"
                        >
                            Lihat Detail →
                        </Link>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <Link
                        :href="route('jobs.index')"
                        class="inline-block px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-semibold shadow-lg hover:shadow-xl"
                    >
                        Lihat Semua Lowongan
                    </Link>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-primary-600 to-primary-700 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold mb-4">Siap Mulai Karir Baru?</h2>
                <p class="text-lg text-primary-100 mb-8">Bergabunglah dengan ribuan profesional yang sudah menemukan pekerjaan impian mereka</p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <Link
                        v-if="!$page.props.auth.user"
                        :href="route('register')"
                        class="px-8 py-3 bg-white text-primary-600 rounded-lg hover:bg-slate-100 transition-colors font-semibold"
                    >
                        Daftar Gratis
                    </Link>
                    <Link
                        :href="route('jobs.index')"
                        class="px-8 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-primary-600 transition-colors font-semibold"
                    >
                        Jelajahi Jobs
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="flex items-center gap-2 font-bold text-xl mb-4">
                            <div class="w-6 h-6 bg-primary-600 rounded"></div>
                            JobBoard
                        </div>
                        <p class="text-slate-400 text-sm">Platform pencarian kerja terpercaya Indonesia</p>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Untuk Pelamar</h3>
                        <ul class="space-y-2 text-slate-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Cari Kerja</a></li>
                            <li><a href="#" class="hover:text-white transition">Unggah CV</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Untuk Perusahaan</h3>
                        <ul class="space-y-2 text-slate-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Post Lowongan</a></li>
                            <li><a href="#" class="hover:text-white transition">Cari Talenta</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Lainnya</h3>
                        <ul class="space-y-2 text-slate-400 text-sm">
                            <li><a href="#" class="hover:text-white transition">Privasi</a></li>
                            <li><a href="#" class="hover:text-white transition">Syarat</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-8 text-center text-slate-400 text-sm">
                    <p>&copy; .goodboop.RiantAndriansyah. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
