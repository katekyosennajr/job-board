<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)
const jobs = computed(() => page.props.jobs || [])
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">

            <h3 class="text-lg font-semibold mb-4">
              Selamat datang, {{ user.name }}!
            </h3>

            <p class="text-gray-600 mb-6">
              Kamu login sebagai <strong>{{ user.role || 'unknown' }}</strong>.
            </p>

            <!-- ================= ADMIN ================= -->
            <div v-if="user.role === 'admin'" class="space-y-4">
              <Link
                href="/admin/jobs"
                class="block p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition"
              >
                <h4 class="font-semibold text-yellow-900">Approval Jobs</h4>
                <p class="text-sm text-yellow-700 mt-1">
                  Lihat dan kelola job yang menunggu persetujuan.
                </p>
              </Link>

              <Link
                href="/admin/users"
                class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition"
              >
                <h4 class="font-semibold text-purple-900">Manage Users</h4>
                <p class="text-sm text-purple-700 mt-1">
                  Kelola perusahaan dan pencari kerja.
                </p>
              </Link>
            </div>

            <!-- ================= COMPANY ================= -->
            <div v-else-if="user.role === 'company'" class="space-y-4">
              <Link
                :href="route('jobs.index')"
                class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <h4 class="font-semibold text-blue-900">Kelola Pekerjaan</h4>
                <p class="text-sm text-blue-700 mt-1">
                  Buat dan kelola lowongan pekerjaan kamu.
                </p>
              </Link>
            </div>

            <!-- ================= CANDIDATE ================= -->
            <div v-else class="space-y-4">
              <div class="p-4 bg-green-50 rounded-lg">
                <h4 class="font-semibold text-green-900">Pekerjaan yang tersedia</h4>
                <p class="text-sm text-green-700 mt-1 mb-4">
                  Berikut lowongan pekerjaan yang sudah disetujui dan dapat kamu lamar.
                </p>

                <div v-if="jobs.length > 0" class="space-y-3">
                  <div
                    v-for="job in jobs"
                    :key="job.id"
                    class="p-4 border rounded hover:bg-green-100 transition"
                  >
                    <h3 class="font-bold text-lg">{{ job.title }}</h3>

                    <p class="text-gray-600 text-sm">
                      {{ job.description?.substring(0, 80) }}...
                    </p>

                    <Link
                      :href="`/jobs/${job.id}`"
                      class="mt-2 inline-block text-green-700 hover:text-green-900 font-semibold"
                    >
                      Detail →
                    </Link>
                  </div>
                </div>

                <p v-else class="text-gray-500 text-sm">
                  Belum ada job yang disetujui.
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
