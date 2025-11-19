<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const pendingJobs = ref([
  { id: 1, title: 'Senior Frontend Developer', company: 'Tech Startup A', posted: '2 jam lalu' },
  { id: 2, title: 'UI/UX Designer', company: 'Design Agency', posted: '5 jam lalu' },
  { id: 3, title: 'Data Scientist', company: 'AI Solutions', posted: '1 hari lalu' },
]);

const recentUsers = ref([
  { id: 1, name: 'John Doe', role: 'candidate', joined: '2 jam lalu' },
  { id: 2, name: 'Tech Company Inc', role: 'company', joined: '1 hari lalu' },
  { id: 3, name: 'Jane Smith', role: 'candidate', joined: '2 hari lalu' },
]);

const stats = [
  { label: 'Total Users', value: 542, icon: '👥' },
  { label: 'Total Companies', value: 87, icon: '🏢' },
  { label: 'Total Jobs', value: 234, icon: '📋' },
  { label: 'Pending Approval', value: pendingJobs.value.length, icon: '⏳' },
];

const getRoleColor = (role) => {
  return {
    candidate: 'bg-blue-100 text-blue-800',
    company: 'bg-purple-100 text-purple-800',
    admin: 'bg-red-100 text-red-800',
  }[role] || 'bg-slate-100 text-slate-800';
};

const getRoleLabel = (role) => {
  return {
    candidate: 'Pencari Kerja',
    company: 'Perusahaan',
    admin: 'Admin',
  }[role] || role;
};
</script>

<template>
  <AppLayout>
    <div>
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">Dashboard Admin</h1>
        <p class="text-slate-600">Kelola pengguna, pekerjaan, dan persetujuan posting</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div v-for="stat in stats" :key="stat.label" class="bg-white p-6 rounded-xl border border-slate-200">
          <div class="text-3xl mb-2">{{ stat.icon }}</div>
          <p class="text-slate-600 text-sm font-medium">{{ stat.label }}</p>
          <p class="text-3xl font-bold text-primary-600">{{ stat.value }}</p>
        </div>
      </div>

      <!-- Pending Jobs Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Pending Approvals -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Persetujuan Pending</h2>
            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
              {{ pendingJobs.length }} job
            </span>
          </div>

          <div v-if="pendingJobs.length > 0" class="space-y-4">
            <div
              v-for="job in pendingJobs"
              :key="job.id"
              class="p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition"
            >
              <h3 class="font-semibold text-slate-900">{{ job.title }}</h3>
              <p class="text-sm text-slate-600 mb-3">{{ job.company }} • {{ job.posted }}</p>
              <div class="flex gap-2">
                <Link
                  href="#"
                  class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-semibold text-center"
                >
                  ✓ Approve
                </Link>
                <Link
                  href="#"
                  class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-semibold text-center"
                >
                  ✕ Reject
                </Link>
              </div>
            </div>
          </div>

          <div class="text-center mt-6 pt-6 border-t border-slate-200">
            <Link
              href="/admin/jobs/approval"
              class="text-primary-600 hover:text-primary-700 font-semibold"
            >
              Lihat Semua Persetujuan →
            </Link>
          </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-900">Pengguna Terbaru</h2>
            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
              Top 3
            </span>
          </div>

          <div class="space-y-4">
            <div
              v-for="user in recentUsers"
              :key="user.id"
              class="flex items-center justify-between p-4 border border-slate-200 rounded-lg"
            >
              <div class="flex-1">
                <h3 class="font-semibold text-slate-900">{{ user.name }}</h3>
                <p class="text-sm text-slate-600">Joined {{ user.joined }}</p>
              </div>
              <span :class="['px-3 py-1 rounded-full text-sm font-semibold', getRoleColor(user.role)]">
                {{ getRoleLabel(user.role) }}
              </span>
            </div>
          </div>

          <div class="text-center mt-6 pt-6 border-t border-slate-200">
            <Link
              href="/admin/users"
              class="text-primary-600 hover:text-primary-700 font-semibold"
            >
              Kelola Semua Users →
            </Link>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="mt-8 bg-gradient-to-r from-primary-50 to-primary-100 p-6 rounded-xl border border-primary-200">
        <h3 class="font-semibold text-primary-900 mb-4">⚡ Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <Link
            href="/admin/jobs"
            class="p-4 bg-white rounded-lg hover:shadow-md transition text-center font-semibold text-slate-900"
          >
            📋 View All Jobs
          </Link>
          <Link
            href="/admin/users"
            class="p-4 bg-white rounded-lg hover:shadow-md transition text-center font-semibold text-slate-900"
          >
            👥 Manage Users
          </Link>
          <Link
            href="#"
            class="p-4 bg-white rounded-lg hover:shadow-md transition text-center font-semibold text-slate-900"
          >
            📊 Analytics
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
