<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  jobs: {
    type: Object,
    default: () => ({ data: [], links: [] }),
  },
})
</script>

<template>
  <Head title="My Jobs" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Jobs</h2>
        <Link
          :href="route('jobs.create')"
          class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
        >
          Post New Job
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <div v-if="!jobs.data || jobs.data.length === 0" class="text-center py-8 text-gray-500">
              No jobs posted yet. Click "Post New Job" to get started.
            </div>

            <div v-else class="space-y-4">
              <div
                v-for="job in jobs.data"
                :key="job.id"
                class="border rounded-lg p-4 hover:shadow-md transition"
              >
                <div class="flex justify-between items-start">
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ job.title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">
                      {{ job.location }} • {{ job.type }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ job.description }}</p>

                    <div class="flex gap-4 mt-3 text-sm">
                      <span v-if="job.salary_min && job.salary_max" class="text-gray-700">
                        ${{ job.salary_min }} - ${{ job.salary_max }}
                      </span>
                      <span
                        :class="{
                          'text-yellow-600': job.status === 'pending',
                          'text-green-600': job.status === 'approved',
                          'text-red-600': job.status === 'rejected',
                        }"
                      >
                        {{ job.status.toUpperCase() }}
                      </span>
                    </div>
                  </div>

                  <div class="flex gap-2 ml-4">
                    <Link
                      :href="route('jobs.edit', job.id)"
                      class="text-blue-600 hover:text-blue-800"
                    >
                      Edit
                    </Link>
                    <Link
                      :href="route('jobs.destroy', job.id)"
                      method="delete"
                      as="button"
                      class="text-red-600 hover:text-red-800"
                    >
                      Delete
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="jobs.links && jobs.links.length > 3" class="mt-6 flex justify-center gap-2">
              <Link
                v-for="link in jobs.links"
                :key="link.label"
                :href="link.url"
                :class="[
                  'px-3 py-1 border rounded',
                  link.active
                    ? 'bg-blue-600 text-white'
                    : 'bg-white text-gray-700 hover:bg-gray-100',
                ]"
                v-html="link.label"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
