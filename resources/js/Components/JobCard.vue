<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  job: {
    type: Object,
    required: true,
  },
  showCompany: {
    type: Boolean,
    default: true,
  },
});

const jobUrl = computed(() => `/jobs/${props.job.id}`);

const statusColor = computed(() => {
  return {
    pending: 'bg-yellow-100 text-yellow-800',
    approved: 'bg-green-100 text-green-800',
    rejected: 'bg-red-100 text-red-800',
  }[props.job.status] || 'bg-slate-100 text-slate-800';
});

const statusLabel = computed(() => {
  return {
    pending: 'Menunggu',
    approved: 'Tersedia',
    rejected: 'Ditolak',
  }[props.job.status] || props.job.status;
});

const isFeatured = computed(() => props.job.featured === 1 || props.job.featured === true);
</script>

<template>
  <Link
    :href="jobUrl"
    class="block bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg hover:border-primary-300 transition-all group"
  >
    <div class="flex justify-between items-start mb-4">
      <div class="flex-1">
        <div class="flex items-center gap-2 mb-2">
          <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary-600 transition">
            {{ job.title }}
          </h3>
          <span
            v-if="isFeatured"
            class="px-2 py-1 bg-primary-100 text-primary-600 rounded text-xs font-bold"
          >
            ⭐ Featured
          </span>
        </div>
        <p v-if="showCompany" class="text-slate-600 font-medium">
          {{ job.company?.company_name || job.company?.name || 'Unknown Company' }}
        </p>
      </div>
      <span
        v-if="job.status"
        :class="['px-3 py-1 rounded-full text-xs font-semibold', statusColor]"
      >
        {{ statusLabel }}
      </span>
    </div>

    <p v-if="job.description" class="text-slate-600 text-sm mb-4 line-clamp-2">
      {{ job.description }}
    </p>

    <div class="flex flex-wrap gap-3 mb-4 text-sm text-slate-600">
      <span v-if="job.location" class="flex items-center gap-1">
        📍 {{ job.location }}
      </span>
      <span v-if="job.job_type" class="flex items-center gap-1">
        💼 {{ job.job_type }}
      </span>
      <span v-if="job.min_salary || job.max_salary" class="flex items-center gap-1">
        💰 {{ job.min_salary ? `Rp ${job.min_salary.toLocaleString('id-ID')}` : '' }}
        <span v-if="job.min_salary && job.max_salary">-</span>
        {{ job.max_salary ? `Rp ${job.max_salary.toLocaleString('id-ID')}` : '' }}
      </span>
    </div>

    <div v-if="job.kategori" class="flex gap-2 mb-4">
      <span class="px-3 py-1 bg-primary-50 text-primary-600 rounded-full text-xs font-semibold">
        {{ job.kategori }}
      </span>
    </div>

    <div class="flex items-center justify-between pt-4 border-t border-slate-200">
      <span class="text-xs text-slate-500">
        {{ job.created_at ? `Posted ${new Date(job.created_at).toLocaleDateString('id-ID')}` : '' }}
      </span>
      <span class="text-primary-600 font-semibold text-sm group-hover:translate-x-1 transition-transform">
        Lihat Detail →
      </span>
    </div>
  </Link>
</template>
