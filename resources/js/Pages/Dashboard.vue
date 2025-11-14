<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { computed, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth.user)

onMounted(() => {
  console.log('User dari Inertia:', user.value)
})
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

            <!-- Kalo company -->
            <div v-if="user.role === 'company'" class="space-y-4">
              <Link
                :href="route('jobs.index')"
                class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition"
              >
                <h4 class="font-semibold text-blue-900">Kelola Pekerjaan</h4>
                <p class="text-sm text-blue-700 mt-1">
                  Buat dan kelola lowongan pekerjaan kamu di sini.
                </p>
              </Link>
            </div>

            <!-- Kalo applicant -->
            <div v-else class="space-y-4">
              <div class="block p-4 bg-green-50 rounded-lg">
                <h4 class="font-semibold text-green-900">Find Jobs</h4>
                <p class="text-sm text-green-700 mt-1">
                  Jelajahi berbagai lowongan pekerjaan yang tersedia.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
