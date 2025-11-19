<script setup>
import { ref, watch } from 'vue';

const emit = defineEmits(['filter']);

const searchQuery = ref('');
const selectedLocation = ref('');
const selectedJobType = ref('');
const selectedCategory = ref('');
const minSalary = ref(0);
const maxSalary = ref(200000000);

const jobTypes = ['Full-time', 'Part-time', 'Contract', 'Freelance', 'Remote'];
const categories = ['Technology', 'Design', 'Marketing', 'Sales', 'HR', 'Finance', 'Other'];
const locations = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Bali', 'Medan', 'Remote'];

const applyFilters = () => {
  emit('filter', {
    search: searchQuery.value,
    location: selectedLocation.value,
    jobType: selectedJobType.value,
    category: selectedCategory.value,
    minSalary: minSalary.value,
    maxSalary: maxSalary.value,
  });
};

const resetFilters = () => {
  searchQuery.value = '';
  selectedLocation.value = '';
  selectedJobType.value = '';
  selectedCategory.value = '';
  minSalary.value = 0;
  maxSalary.value = 200000000;
  emit('filter', {
    search: '',
    location: '',
    jobType: '',
    category: '',
    minSalary: 0,
    maxSalary: 200000000,
  });
};

watch(
  [searchQuery, selectedLocation, selectedJobType, selectedCategory, minSalary, maxSalary],
  applyFilters,
  { deep: true }
);
</script>

<template>
  <div class="bg-white rounded-xl border border-slate-200 p-6 space-y-6">
    <!-- Search Bar -->
    <div>
      <label class="block text-sm font-semibold text-slate-900 mb-2">Cari Posisi atau Keyword</label>
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Developer, Designer, Marketing..."
        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
      />
    </div>

    <!-- Location Filter -->
    <div>
      <label class="block text-sm font-semibold text-slate-900 mb-2">Lokasi</label>
      <select
        v-model="selectedLocation"
        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
      >
        <option value="">Semua Lokasi</option>
        <option v-for="loc in locations" :key="loc" :value="loc">
          {{ loc }}
        </option>
      </select>
    </div>

    <!-- Job Type Filter -->
    <div>
      <label class="block text-sm font-semibold text-slate-900 mb-3">Tipe Pekerjaan</label>
      <div class="flex flex-wrap gap-2">
        <button
          v-for="type in jobTypes"
          :key="type"
          @click="selectedJobType = selectedJobType === type ? '' : type"
          :class="[
            'px-4 py-2 rounded-lg border-2 font-medium transition-all',
            selectedJobType === type
              ? 'border-primary-600 bg-primary-50 text-primary-600'
              : 'border-slate-300 bg-white text-slate-600 hover:border-primary-300'
          ]"
        >
          {{ type }}
        </button>
      </div>
    </div>

    <!-- Category Filter -->
    <div>
      <label class="block text-sm font-semibold text-slate-900 mb-2">Kategori</label>
      <select
        v-model="selectedCategory"
        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
      >
        <option value="">Semua Kategori</option>
        <option v-for="cat in categories" :key="cat" :value="cat">
          {{ cat }}
        </option>
      </select>
    </div>

    <!-- Salary Range Filter -->
    <div>
      <label class="block text-sm font-semibold text-slate-900 mb-4">
        Range Gaji: Rp {{ minSalary.toLocaleString('id-ID') }} - Rp {{ maxSalary.toLocaleString('id-ID') }}
      </label>
      <div class="space-y-3">
        <input
          v-model.number="minSalary"
          type="range"
          min="0"
          max="200000000"
          step="5000000"
          class="w-full"
        />
        <input
          v-model.number="maxSalary"
          type="range"
          min="0"
          max="200000000"
          step="5000000"
          class="w-full"
        />
      </div>
    </div>

    <!-- Reset Button -->
    <button
      @click="resetFilters"
      class="w-full px-4 py-3 border-2 border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold"
    >
      Reset Filter
    </button>
  </div>
</template>
