<template>
  <div class="dark-mode-toggle fixed bottom-6 right-6 z-50">
    <button @click="toggleDark" class="bg-slate-900 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-slate-700 transition">
      {{ isDark ? '☀️ Light Mode' : '🌙 Dark Mode' }}
    </button>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';

const isDark = ref(localStorage.getItem('darkMode') === 'true');

function toggleDark() {
  isDark.value = !isDark.value;
  localStorage.setItem('darkMode', isDark.value);
  document.documentElement.classList.toggle('dark', isDark.value);
}

watchEffect(() => {
  document.documentElement.classList.toggle('dark', isDark.value);
});
</script>

<style scoped>
.dark-mode-toggle {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
}
</style>
