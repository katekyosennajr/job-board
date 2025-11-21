<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <Head title="Kebijakan Privasi" />
  
  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
          <h1 class="text-3xl font-bold text-slate-900 mb-6">Kebijakan Privasi</h1>
          
          <div class="prose prose-slate max-w-none">
            <p class="text-slate-600 mb-6">
              Terakhir diperbarui: {{ new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) }}
            </p>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">1. Pengumpulan Data</h2>
              <p class="text-slate-600 mb-3">
                Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Informasi akun (nama, email, password)</li>
                <li>Profil pengguna (foto, bio, lokasi)</li>
                <li>CV dan dokumen lamaran kerja</li>
                <li>Informasi lowongan pekerjaan yang Anda posting</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">2. Penggunaan Data</h2>
              <p class="text-slate-600 mb-3">
                Kami menggunakan informasi yang kami kumpulkan untuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Menyediakan, memelihara, dan meningkatkan layanan kami</li>
                <li>Memproses lamaran pekerjaan dan menghubungkan pencari kerja dengan perusahaan</li>
                <li>Mengirimkan notifikasi terkait aktivitas akun Anda</li>
                <li>Mencegah penipuan dan penyalahgunaan platform</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">3. Keamanan Data</h2>
              <p class="text-slate-600">
                Kami menggunakan langkah-langkah keamanan yang wajar untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Data Anda disimpan dengan enkripsi dan hanya dapat diakses oleh personel yang berwenang.
              </p>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">4. Berbagi Informasi</h2>
              <p class="text-slate-600 mb-3">
                Kami tidak menjual informasi pribadi Anda. Kami hanya membagikan informasi Anda dalam situasi berikut:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Dengan perusahaan ketika Anda melamar pekerjaan mereka</li>
                <li>Dengan penyedia layanan yang membantu operasional platform kami</li>
                <li>Jika diwajibkan oleh hukum atau proses hukum</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">5. Hak Anda</h2>
              <p class="text-slate-600 mb-3">
                Anda memiliki hak untuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Mengakses dan memperbarui informasi pribadi Anda</li>
                <li>Menghapus akun dan data Anda</li>
                <li>Menarik persetujuan untuk penggunaan data tertentu</li>
                <li>Mengajukan keluhan terkait penanganan data Anda</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">6. Cookies</h2>
              <p class="text-slate-600">
                Kami menggunakan cookies dan teknologi pelacakan serupa untuk meningkatkan pengalaman Anda di platform kami. Anda dapat mengatur browser Anda untuk menolak cookies, namun beberapa fitur mungkin tidak berfungsi dengan baik.
              </p>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">7. Perubahan Kebijakan</h2>
              <p class="text-slate-600">
                Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan dengan memposting kebijakan baru di halaman ini dan memperbarui tanggal "Terakhir diperbarui" di atas.
              </p>
            </section>

            <section>
              <h2 class="text-xl font-semibold text-slate-900 mb-3">8. Hubungi Kami</h2>
              <p class="text-slate-600">
                Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami melalui halaman kontak atau email ke privacy@jobboard.com
              </p>
            </section>
          </div>

          <div class="mt-8 pt-6 border-t border-slate-200">
            <Link
              :href="route('welcome')"
              class="text-primary-600 hover:text-primary-700 font-medium"
            >
              ← Kembali ke Beranda
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
