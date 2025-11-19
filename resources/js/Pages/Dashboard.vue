<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import DashboardCandidate from './Dashboard/Candidate.vue';
import DashboardCompany from './Dashboard/Company.vue';
import DashboardAdmin from './Dashboard/Admin.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const dashboardComponent = computed(() => {
  const roleMap = {
    candidate: DashboardCandidate,
    company: DashboardCompany,
    admin: DashboardAdmin,
  };
  return roleMap[user.value?.role] || DashboardCandidate;
});
</script>

<template>
  <Head title="Dashboard" />
  <component :is="dashboardComponent" />
</template>
