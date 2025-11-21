<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const form = useForm({
  full_name: '',
  email: '',
  phone: '',
  location: '',
  summary: '',
  experience: '',
  education: '',
  skills: '',
});

const submit = () => {
  // TODO: Implement save CV functionality
  alert('Fitur simpan CV akan segera hadir!');
};
</script>

<template>
  <Head title="CV Builder" />
  
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800">CV Builder</h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
          <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Buat CV Profesional Anda</h1>
            <p class="text-slate-600">Lengkapi informasi di bawah ini untuk membuat CV yang menarik</p>
          </div>

          <form @submit.prevent="submit" class="space-y-6">
            <!-- Data Pribadi -->
            <div class="border-b border-slate-200 pb-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Data Pribadi</h3>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                  <input
                    v-model="form.full_name"
                    type="text"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="John Doe"
                  />
                </div>

                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                  <input
                    v-model="form.email"
                    type="email"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="john@example.com"
                  />
                </div>

                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Telepon</label>
                  <input
                    v-model="form.phone"
                    type="tel"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="08123456789"
                  />
                </div>

                <div>
                  <label class="block text-sm font-medium text-slate-700 mb-2">Lokasi</label>
                  <input
                    v-model="form.location"
                    type="text"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Jakarta, Indonesia"
                  />
                </div>
              </div>
            </div>

            <!-- Ringkasan Profil -->
            <div class="border-b border-slate-200 pb-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Ringkasan Profil</h3>
              <textarea
                v-model="form.summary"
                rows="4"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Ceritakan tentang diri Anda, keahlian, dan tujuan karir..."
              ></textarea>
            </div>

            <!-- Pengalaman Kerja -->
            <div class="border-b border-slate-200 pb-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Pengalaman Kerja</h3>
              <textarea
                v-model="form.experience"
                rows="6"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Contoh:&#10;Frontend Developer - PT Tech Indonesia (2020-2023)&#10;- Mengembangkan aplikasi web menggunakan Vue.js&#10;- Berkolaborasi dengan tim backend untuk integrasi API"
              ></textarea>
              <p class="text-sm text-slate-500 mt-2">Tuliskan pengalaman kerja Anda, satu per baris</p>
            </div>

            <!-- Pendidikan -->
            <div class="border-b border-slate-200 pb-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Pendidikan</h3>
              <textarea
                v-model="form.education"
                rows="4"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Contoh:&#10;S1 Teknik Informatika - Universitas Indonesia (2016-2020)&#10;SMA Negeri 1 Jakarta (2013-2016)"
              ></textarea>
              <p class="text-sm text-slate-500 mt-2">Tuliskan riwayat pendidikan Anda</p>
            </div>

            <!-- Skills -->
            <div class="pb-6">
              <h3 class="text-lg font-semibold text-slate-900 mb-4">Keahlian</h3>
              <textarea
                v-model="form.skills"
                rows="3"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                placeholder="Contoh: JavaScript, Vue.js, React, Node.js, Git, Figma"
              ></textarea>
              <p class="text-sm text-slate-500 mt-2">Pisahkan setiap keahlian dengan koma</p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
              <button
                type="submit"
                class="px-6 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium"
              >
                Simpan CV
              </button>
              <Link
                :href="route('dashboard')"
                class="px-6 py-2.5 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-medium"
              >
                Batal
              </Link>
            </div>
          </form>

          <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
              <strong>Tips:</strong> CV yang baik adalah CV yang jelas, ringkas, dan relevan dengan posisi yang Anda lamar. Fokus pada pencapaian dan hasil kerja Anda.
            </p>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
