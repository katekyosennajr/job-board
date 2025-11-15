<script setup>
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  jobs: Array
})
</script>

<template>
  <Head title="Approval Jobs" />

  <div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Approval Jobs</h1>

    <div class="bg-white p-6 rounded shadow">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="border-b">
            <th class="p-2">Judul</th>
            <th class="p-2">Perusahaan</th>
            <th class="p-2">Status</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="job in jobs" :key="job.id" class="border-b">
            <td class="p-2">{{ job.title }}</td>
            <td class="p-2">{{ job.company_id }}</td>
            <td class="p-2 capitalize">{{ job.status }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
