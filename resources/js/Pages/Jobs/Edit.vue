<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  job: Object,
})

const form = useForm({
  title: props.job.title || '',
  description: props.job.description || '',
  location: props.job.location || '',
  job_type: props.job.job_type || '',
  kategori: props.job.kategori || '',
  min_salary: props.job.min_salary || '',
  max_salary: props.job.max_salary || '',
})

const submit = () => {
  form.put(route('jobs.update', props.job.id))
}
</script>

<template>
  <Head title="Edit Pekerjaan" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Pekerjaan
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
          <form @submit.prevent="submit" class="space-y-5">
            <div>
              <label class="block font-medium text-gray-700">Judul</label>
              <input
                v-model="form.title"
                type="text"
                class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.title" class="text-red-500 text-sm">
                {{ form.errors.title }}
              </div>
            </div>

            <div>
              <label class="block font-medium text-gray-700">Deskripsi</label>
              <textarea
                v-model="form.description"
                class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              ></textarea>
              <div v-if="form.errors.description" class="text-red-500 text-sm">
                {{ form.errors.description }}
              </div>
            </div>

            <div>
              <label class="block font-medium text-gray-700">Lokasi</label>
              <input
                v-model="form.location"
                type="text"
                class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.location" class="text-red-500 text-sm">
                {{ form.errors.location }}
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block font-medium text-gray-700">Jenis Pekerjaan</label>
                <select
                  v-model="form.job_type"
                  class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                >
                  <option value="">-- Pilih Jenis --</option>
                  <option value="Full Time">Full Time</option>
                  <option value="Part Time">Part Time</option>
                  <option value="Kontrak">Kontrak</option>
                </select>
                <div v-if="form.errors.job_type" class="text-red-500 text-sm">
                  {{ form.errors.job_type }}
                </div>
              </div>

              <div>
                <label class="block font-medium text-gray-700">Kategori</label>
                <input
                  v-model="form.kategori"
                  type="text"
                  placeholder="Contoh: Kasir, Admin, Sales..."
                  class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <div v-if="form.errors.kategori" class="text-red-500 text-sm">
                  {{ form.errors.kategori }}
                </div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block font-medium text-gray-700">Gaji Minimum</label>
                <input
                  v-model="form.min_salary"
                  type="number"
                  placeholder="cth: 3000000"
                  class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <div v-if="form.errors.min_salary" class="text-red-500 text-sm">
                  {{ form.errors.min_salary }}
                </div>
              </div>

              <div>
                <label class="block font-medium text-gray-700">Gaji Maksimum</label>
                <input
                  v-model="form.max_salary"
                  type="number"
                  placeholder="cth: 5000000"
                  class="w-full mt-1 rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <div v-if="form.errors.max_salary" class="text-red-500 text-sm">
                  {{ form.errors.max_salary }}
                </div>
              </div>
            </div>

            <div class="flex justify-end gap-3">
              <a href="/jobs" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded"
                :disabled="form.processing"
              >
                Perbarui
              </button>
              <p v-if="form.recentlySuccessful" class="text-green-600">
                Data berhasil diperbarui!
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
