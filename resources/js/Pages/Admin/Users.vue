<script setup>
defineProps({
  users: Array
})
</script>

<template>
  <div>
    <h1 class="text-xl font-bold mb-4">Manage Users</h1>

    <table class="min-w-full border">
      <tr class="border">
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Name</th>
        <th class="p-2 border">Email</th>
        <th class="p-2 border">Role</th>
      </tr>

      <tr v-for="u in users" :key="u.id" class="border">
        <td class="p-2 border">{{ u.id }}</td>
        <td class="p-2 border">{{ u.name }}</td>
        <td class="p-2 border">{{ u.email }}</td>
        <td class="p-2 border">{{ u.role }}</td>
      </tr>
    </table>
  </div>
</template>
