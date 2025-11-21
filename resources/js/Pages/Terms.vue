<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <Head title="Syarat & Ketentuan" />
  
  <AppLayout>
    <div class="py-12">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
          <h1 class="text-3xl font-bold text-slate-900 mb-6">Syarat & Ketentuan</h1>
          
          <div class="prose prose-slate max-w-none">
            <p class="text-slate-600 mb-6">
              Terakhir diperbarui: {{ new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }) }}
            </p>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">1. Penerimaan Ketentuan</h2>
              <p class="text-slate-600">
                Dengan mengakses dan menggunakan platform JobBoard, Anda setuju untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju dengan ketentuan ini, mohon untuk tidak menggunakan layanan kami.
              </p>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">2. Penggunaan Platform</h2>
              <p class="text-slate-600 mb-3">
                Anda setuju untuk menggunakan platform ini hanya untuk tujuan yang sah dan sesuai dengan ketentuan berikut:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Tidak melakukan tindakan yang melanggar hukum atau hak pihak lain</li>
                <li>Tidak memposting konten yang menyesatkan, palsu, atau menipu</li>
                <li>Tidak menggunakan platform untuk spam atau aktivitas yang mengganggu</li>
                <li>Menjaga kerahasiaan informasi akun Anda</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">3. Akun Pengguna</h2>
              <p class="text-slate-600 mb-3">
                Untuk menggunakan fitur tertentu, Anda harus membuat akun dengan informasi yang akurat dan lengkap. Anda bertanggung jawab untuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Menjaga keamanan password Anda</li>
                <li>Semua aktivitas yang terjadi di akun Anda</li>
                <li>Memberi tahu kami segera jika terjadi penggunaan tidak sah</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">4. Ketentuan untuk Perusahaan</h2>
              <p class="text-slate-600 mb-3">
                Perusahaan yang memposting lowongan pekerjaan setuju untuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Memposting lowongan yang sah dan nyata</li>
                <li>Tidak mendiskriminasi kandidat berdasarkan ras, agama, gender, atau karakteristik lainnya</li>
                <li>Menjaga kerahasiaan informasi kandidat yang melamar</li>
                <li>Memberikan informasi yang akurat tentang posisi dan perusahaan</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">5. Ketentuan untuk Pencari Kerja</h2>
              <p class="text-slate-600 mb-3">
                Pencari kerja yang menggunakan platform ini setuju untuk:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Memberikan informasi yang akurat dan jujur dalam profil dan lamaran</li>
                <li>Tidak memalsukan CV atau dokumen pendukung</li>
                <li>Menghormati proses rekrutmen perusahaan</li>
                <li>Tidak menyalahgunakan informasi kontak perusahaan</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">6. Konten Pengguna</h2>
              <p class="text-slate-600">
                Anda mempertahankan hak atas konten yang Anda posting, namun Anda memberikan kami lisensi untuk menggunakan, menampilkan, dan mendistribusikan konten tersebut dalam rangka menyediakan layanan. Kami berhak menghapus konten yang melanggar ketentuan ini.
              </p>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">7. Pembatasan Tanggung Jawab</h2>
              <p class="text-slate-600 mb-3">
                JobBoard tidak bertanggung jawab atas:
              </p>
              <ul class="list-disc list-inside text-slate-600 space-y-2 ml-4">
                <li>Keakuratan informasi lowongan yang diposting perusahaan</li>
                <li>Hasil dari proses rekrutmen atau hubungan kerja</li>
                <li>Kerugian yang timbul dari penggunaan platform</li>
                <li>Gangguan layanan atau kehilangan data</li>
              </ul>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">8. Penangguhan dan Penghentian</h2>
              <p class="text-slate-600">
                Kami berhak menangguhkan atau menghentikan akses Anda ke platform jika Anda melanggar ketentuan ini atau terlibat dalam aktivitas yang merugikan platform atau pengguna lain.
              </p>
            </section>

            <section class="mb-8">
              <h2 class="text-xl font-semibold text-slate-900 mb-3">9. Perubahan Ketentuan</h2>
              <p class="text-slate-600">
                Kami dapat mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan berlaku setelah diposting di halaman ini. Penggunaan berkelanjutan Anda terhadap platform setelah perubahan berarti Anda menerima ketentuan yang diperbarui.
              </p>
            </section>

            <section>
              <h2 class="text-xl font-semibold text-slate-900 mb-3">10. Hukum yang Berlaku</h2>
              <p class="text-slate-600">
                Syarat dan ketentuan ini diatur oleh hukum Republik Indonesia. Setiap sengketa akan diselesaikan melalui pengadilan yang berwenang di Indonesia.
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
