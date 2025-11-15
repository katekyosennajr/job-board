<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
  jobs: Array
})

const approve = (id) => {
  router.post(`/admin/jobs/${id}/approve`)
}

const rejectJob = (id) => {
  router.post(`/admin/jobs/${id}/reject`)
}
</script>

<template>
  <div>
    <h1 class="text-xl font-bold mb-4">Approval Jobs</h1>

    <table class="min-w-full border">
      <tr class="border">
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Title</th>
        <th class="p-2 border">Company</th>
        <th class="p-2 border">Status</th>
        <th class="p-2 border">Action</th>
      </tr>

      <tr v-for="job in jobs" :key="job.id" class="border">
        <td class="p-2 border">{{ job.id }}</td>
        <td class="p-2 border">{{ job.title }}</td>
        <td class="p-2 border">{{ job.company_id }}</td>
        <td class="p-2 border">{{ job.status }}</td>

        <td class="p-2 border space-x-2">
          <button
            class="px-3 py-1 bg-green-600 text-white rounded"
            @click="approve(job.id)"
          >
            Approve
          </button>

          <button
            class="px-3 py-1 bg-red-600 text-white rounded"
            @click="rejectJob(job.id)"
          >
            Reject
          </button>
        </td>
      </tr>
    </table>
  </div>
</template>
