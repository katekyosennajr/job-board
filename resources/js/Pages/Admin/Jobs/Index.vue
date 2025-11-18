<script setup>
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ jobs: Array })

const approve = (id) => {
  router.post(`/admin/jobs/${id}/approve`)
}

const rejectJob = (id) => {
  router.post(`/admin/jobs/${id}/reject`)
}
</script>

<template>
  <Head title="Approval Jobs" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Persetujuan</h2>
    </template>

    <div class="py-8 max-w-6xl mx-auto">
      <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-100 text-left border-b">
              <th class="p-3 font-semibold">No</th>
              <th class="p-3 font-semibold">Judul</th>
              <th class="p-3 font-semibold">Perusahaan</th>
              <th class="p-3 font-semibold">Status</th>
              <th class="p-3 font-semibold text-center">Terima/Tolak</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="job in jobs" :key="job.id" class="border-b hover:bg-gray-50 transition">
              <td class="p-3">{{ job.id }}</td>
              <td class="p-3 font-medium">{{ job.title }}</td>
              <td class="p-3">{{ job.company?.name ?? 'Unknown' }}</td>
              <td class="p-3">
                <span
                  class="px-3 py-1 rounded text-white text-sm shadow"
                  :class="{
                    'bg-yellow-500': job.status === 'pending',
                    'bg-green-600': job.status === 'approved',
                    'bg-red-600': job.status === 'rejected'
                  }"
                >
                  {{ job.status }}
                </span>
              </td>

              <td class="p-3 text-center space-x-2">
                <button
                  class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md"
                  @click="approve(job.id)"
                >
                  Approve
                </button>

                <button
                  class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md"
                  @click="rejectJob(job.id)"
                >
                  Reject
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>