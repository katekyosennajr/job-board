<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  jobs: Object
})
</script>

<template>
  <Head title="Manage Jobs" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Jobs</h2>
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
            <div v-if="!jobs.data || jobs.data.length === 0" class="text-center py-12 text-gray-500">
              <p class="text-lg">No jobs posted yet</p>
              <p class="text-sm mt-2">Click "Post New Job" to get started</p>
            </div>

            <div v-else class="space-y-4">
              <div 
                v-for="job in jobs.data" 
                :key="job.id" 
                class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition"
              >
                <div class="flex justify-between items-start">
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ job.title }}</h3>
                    <div class="flex items-center gap-3 mt-1 text-sm text-gray-600">
                      <span>{{ job.location }}</span>
                      <span>•</span>
                      <span>{{ job.type }}</span>
                    </div>
                    
                    <p class="text-sm text-gray-600 mt-3 line-clamp-2">
                      {{ job.description }}
                    </p>

                    <div class="flex items-center gap-4 mt-3">
                      <span 
                        v-if="job.salary_min && job.salary_max" 
                        class="text-sm font-medium text-gray-700"
                      >
                        Rp {{ Number(job.salary_min).toLocaleString() }} - Rp {{ Number(job.salary_max).toLocaleString() }}
                      </span>

                      <span 
                        class="text-xs px-2 py-1 rounded-full font-medium"
                        :class="{
                          'bg-yellow-100 text-yellow-800': job.status === 'pending',
                          'bg-green-100 text-green-800': job.status === 'approved',
                          'bg-red-100 text-red-800': job.status === 'rejected'
                        }"
                      >
                        {{ job.status.toUpperCase() }}
                      </span>
                    </div>
                  </div>

                  <div class="flex gap-3 ml-4">
                    <Link 
                      :href="route('jobs.edit', job.id)" 
                      class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                    >
                      Edit
                    </Link>
                    <Link 
                      :href="route('jobs.destroy', job.id)" 
                      method="delete" 
                      as="button"
                      class="text-red-600 hover:text-red-800 text-sm font-medium"
                      @click="confirm('Are you sure you want to delete this job?')"
                    >
                      Delete
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="jobs.links && jobs.links.length > 3" class="mt-6 flex justify-center gap-1">
              <Link
                v-for="link in jobs.links"
                :key="link.label"
                :href="link.url"
                :class="[
                  'px-3 py-2 text-sm border rounded',
                  link.active 
                    ? 'bg-blue-600 text-white border-blue-600' 
                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
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