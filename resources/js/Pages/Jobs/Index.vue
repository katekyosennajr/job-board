<script setup>
import { Head } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  jobs: Array,
})

const hapus = (id) => {
  if (confirm('Yakin ingin menghapus pekerjaan ini?')) {
    Inertia.delete(route('jobs.destroy', id))
  }
}
</script>

<template>
  <Head title="Manage Jobs" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Jobs</h2>
    </template>

    <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <a href="/jobs/create" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Pekerjaan</a>

        <div v-if="jobs.length === 0" class="text-gray-600">Belum ada data pekerjaan.</div>

        <div v-for="job in jobs" :key="job.id" class="bg-white p-5 rounded-lg shadow mb-4">
          <h3 class="text-lg font-semibold">{{ job.title }}</h3>
          <p class="text-gray-700">{{ job.location }} • {{ job.job_type }} • {{ job.kategori }}</p>
          <p class="text-sm text-gray-600">Gaji: Rp{{ job.min_salary }} - Rp{{ job.max_salary }}</p>
          <p class="mt-2 text-gray-800">{{ job.description }}</p>
          <span class="inline-block mt-2 text-yellow-700 font-semibold">{{ job.status?.toUpperCase() }}</span>

          <div class="flex gap-4 mt-3">
            <a :href="`/jobs/${job.id}/edit`" class="text-blue-600 font-semibold">Edit</a>
            <button @click="hapus(job.id)" class="text-red-600 font-semibold">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
