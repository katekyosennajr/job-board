<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'

// inisialisasi form
const form = useForm({
    title: '',
    description: '',
    location: '',
    job_type: 'full-time',
    category: '',
    min_salary: '',
    max_salary: '',
    requirements: [],
    expires_at: '',
});

// submit handler
const submit = () => {
  form.post(route('jobs.store'), {
    onSuccess: () => {
      alert('✅ Job berhasil diposting!')
    },
    onError: () => {
      alert('❌ Terjadi kesalahan, periksa input kamu!')
    }
  })
}
</script>

<template>
  <Head title="Post New Job" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post New Job</h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit" class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700">Title</label>
              <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
              <div v-if="form.errors.title" class="text-red-500 text-sm">{{ form.errors.title }}</div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea v-model="form.description" class="mt-1 block w-full border-gray-300 rounded-md" rows="5" required></textarea>
              <div v-if="form.errors.description" class="text-red-500 text-sm">{{ form.errors.description }}</div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Location</label>
              <input v-model="form.location" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required />
              <div v-if="form.errors.location" class="text-red-500 text-sm">{{ form.errors.location }}</div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Job Type</label>
                <select v-model="form.job_type" class="mt-1 block w-full border-gray-300 rounded-md" required>
                  <option value="full-time">Full Time</option>
                  <option value="part-time">Part Time</option>
                  <option value="contract">Contract</option>
                  <option value="remote">Remote</option>
                </select>
                <div v-if="form.errors.job_type" class="text-red-500 text-sm">{{ form.errors.job_type }}</div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Category (Optional)</label>
                <input v-model="form.category" type="text" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="e.g. Software Development" />
                <div v-if="form.errors.category" class="text-red-500 text-sm">{{ form.errors.category }}</div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Min Salary (Optional)</label>
                <input v-model="form.min_salary" type="number" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="5000000" />
                <div v-if="form.errors.min_salary" class="text-red-500 text-sm">{{ form.errors.min_salary }}</div>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Max Salary (Optional)</label>
                <input v-model="form.max_salary" type="number" class="mt-1 block w-full border-gray-300 rounded-md" placeholder="8000000" />
                <div v-if="form.errors.max_salary" class="text-red-500 text-sm">{{ form.errors.max_salary }}</div>
              </div>
            </div>

            <div class="flex justify-end gap-2">
              <Link :href="route('jobs.index')" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</Link>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                :disabled="form.processing"
              >
                {{ form.processing ? 'Saving...' : 'Save Job' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>