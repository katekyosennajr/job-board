<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  job: Object,
})

const form = useForm({
  title: props.job.title || '',
  description: props.job.description || '',
  location: props.job.location || '',
  job_type: props.job.job_type || '',
  category: props.job.category || '',
  min_salary: props.job.min_salary || '',
  max_salary: props.job.max_salary || '',
  status: props.job.status || 'pending',
})

const submit = () => {
  form.put(route('jobs.update', props.job.id), {
    onSuccess: () => alert('Data berhasil diperbarui!'),
    onError: (errors) => console.error(errors),
  })
}
</script>

<template>
  <Head title="Edit Job" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl">Edit Job</h2>
    </template>

    <div class="py-8">
      <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
        <form @submit.prevent="submit" class="space-y-4">
          <!-- fields same as Create -->
          <!-- Title -->
          <div>
            <label class="block text-sm">Title</label>
            <input v-model="form.title" class="w-full border rounded p-2" />
            <div v-if="form.errors.title" class="text-red-600 text-sm">{{ form.errors.title }}</div>
          </div>

          <!-- Description -->
          <div>
            <label class="block text-sm">Description</label>
            <textarea v-model="form.description" class="w-full border rounded p-2"></textarea>
            <div v-if="form.errors.description" class="text-red-600 text-sm">{{ form.errors.description }}</div>
          </div>

          <!-- Location, Job Type, Category, Salaries (same style as Create) -->
          <div>
            <label class="block text-sm">Location</label>
            <input v-model="form.location" class="w-full border rounded p-2" />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-sm">Job Type</label>
              <input v-model="form.job_type" class="w-full border rounded p-2" />
              <div v-if="form.errors.job_type" class="text-red-600 text-sm">{{ form.errors.job_type }}</div>
            </div>
            <div>
              <label class="block text-sm">Category</label>
              <input v-model="form.category" class="w-full border rounded p-2" />
              <div v-if="form.errors.category" class="text-red-600 text-sm">{{ form.errors.category }}</div>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-sm">Min Salary</label>
              <input type="number" v-model="form.min_salary" class="w-full border rounded p-2" />
            </div>
            <div>
              <label class="block text-sm">Max Salary</label>
              <input type="number" v-model="form.max_salary" class="w-full border rounded p-2" />
            </div>
          </div>

          <div class="flex justify-end gap-2">
            <button :disabled="form.processing" type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
