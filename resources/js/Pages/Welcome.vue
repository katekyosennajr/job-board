<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const stats = ref([
  { label: 'Lowongan Kerja', value: '1500+' },
  { label: 'Perusahaan', value: '500+' },
  { label: 'Pelamar Sukses', value: '95%' },
]);

const featuredJobs = ref([
  { id: 1, title: 'Senior Frontend Developer', company: 'Tech Startup A', location: 'Jakarta', salary: 'Rp 15-20jt' },
  { id: 2, title: 'UI/UX Designer', company: 'Design Agency B', location: 'Bandung', salary: 'Rp 12-18jt' },
  { id: 3, title: 'Full Stack Developer', company: 'Fintech Corp', location: 'Remote', salary: 'Rp 18-25jt' },
  { id: 4, title: 'Data Scientist', company: 'AI Solutions', location: 'Jakarta', salary: 'Rp 20-30jt' },
]);
</script>

<template>
    <Head title="JobBoard - Platform Pencarian Kerja Terbaik" />

    <div class="min-h-screen bg-slate-50">
        <Navigation />

        <!-- Hero Section -->
        <section class="pt-20 pb-32 bg-gradient-to-br from-primary-50 via-white to-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                            Temukan <span class="text-primary-600">Karir Impian</span> Anda
                        </h1>
                        <p class="text-xl text-slate-600 mb-8 leading-relaxed">
                            Platform pencarian kerja terpercaya yang menghubungkan talenta terbaik dengan perusahaan top di Indonesia.
                        </p>
                        <div class="flex gap-4">
                            <Link
                                v-if="!$page.props.auth.user"
                                :href="route('register')"
                                class="px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-semibold shadow-lg hover:shadow-xl"
                            >
                                Daftar Sekarang
                            </Link>
                            <Link
                                :href="route('jobs.index')"
                                class="px-8 py-3 bg-slate-100 text-primary-600 rounded-lg hover:bg-slate-200 transition-colors font-semibold"
                            >
                                Lihat Lowongan
                            </Link>
                        </div>
                    </div>

                    <!-- Right Illustration -->
                    <div class="hidden lg:block">
                        <div class="bg-white rounded-2xl p-8 shadow-xl">
                            <div class="bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl h-80 flex items-center justify-center">
                            <div class="text-white text-center">
                                    <div class="text-6xl mb-4">💼</div>
                                    <p class="text-lg font-semibold">Ribuan Kesempatan Menunggu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        class="bg-white p-6 rounded-xl border border-slate-200 hover:shadow-lg hover:border-primary-200 transition-all cursor-pointer"
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
                            :href="route('jobs.index')"
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
