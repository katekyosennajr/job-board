<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Dashboard Kandidat</h1>

    <div v-if="jobs.length === 0">
      Belum ada pekerjaan yang tersedia.
    </div>

    <ul class="space-y-4">
      <li
        v-for="job in jobs"
        :key="job.id"
        class="p-4 border rounded"
      >
        <h2 class="text-xl font-semibold">{{ job.title }}</h2>
        <p>{{ job.description }}</p>
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({
  jobs: Array,
});
</script>
