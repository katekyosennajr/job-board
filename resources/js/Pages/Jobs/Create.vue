<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
  title: '',
  description: '',
  location: '',
  job_type: '',
  kategori: '',
  min_salary: '',
  max_salary: '',
})

const submit = () => {
  form.post(route('jobs.store'))
}
</script>

<template>
  <Head title="Tambah Pekerjaan" />

  <AuthenticatedLayout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4">
      <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-slate-900">Post Lowongan Pekerjaan Baru</h1>
          <p class="text-slate-600 mt-2">Isi detail lengkap untuk menarik pelamar terbaik</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <form @submit.prevent="submit" class="p-8 space-y-6">
            
            <!-- Title -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Pekerjaan</label>
              <input
                v-model="form.title"
                type="text"
                placeholder="Contoh: Senior Frontend Developer"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
              />
              <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                {{ form.errors.title }}
              </div>
            </div>

            <!-- Description -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Pekerjaan</label>
              <textarea
                v-model="form.description"
                placeholder="Jelaskan detail pekerjaan, tanggung jawab, dan persyaratan..."
                rows="6"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
              ></textarea>
              <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                {{ form.errors.description }}
              </div>
            </div>

            <!-- Location -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi</label>
              <input
                v-model="form.location"
                type="text"
                placeholder="Contoh: Jakarta, Bandung"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
              />
              <div v-if="form.errors.location" class="text-red-500 text-sm mt-1">
                {{ form.errors.location }}
              </div>
            </div>

            <!-- Job Type & Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Pekerjaan</label>
                <select
                  v-model="form.job_type"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                >
                  <option value="">-- Pilih Jenis --</option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Kontrak">Kontrak</option>
                  <option value="Freelance">Freelance</option>
                  <option value="Remote">Remote</option>
                </select>
                <div v-if="form.errors.job_type" class="text-red-500 text-sm mt-1">
                  {{ form.errors.job_type }}
                </div>
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                <input
                  v-model="form.kategori"
                  type="text"
                  placeholder="Contoh: IT, Marketing, Sales"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                />
                <div v-if="form.errors.kategori" class="text-red-500 text-sm mt-1">
                  {{ form.errors.kategori }}
                </div>
              </div>
            </div>

            <!-- Salary Range -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gaji Minimum (Rp)</label>
                <input
                  v-model="form.min_salary"
                  type="number"
                  placeholder="3000000"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                />
                <div v-if="form.errors.min_salary" class="text-red-500 text-sm mt-1">
                  {{ form.errors.min_salary }}
                </div>
              </div>

              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gaji Maksimum (Rp)</label>
                <input
                  v-model="form.max_salary"
                  type="number"
                  placeholder="5000000"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                />
                <div v-if="form.errors.max_salary" class="text-red-500 text-sm mt-1">
                  {{ form.errors.max_salary }}
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t border-slate-200">
              <a href="/jobs" class="px-6 py-2 bg-slate-200 hover:bg-slate-300 text-slate-900 font-medium rounded-lg transition">
                Batal
              </a>
              <button
                type="submit"
                :disabled="form.processing"
                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-medium rounded-lg transition"
              >
                {{ form.processing ? 'Memposting...' : 'Post Lowongan' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
