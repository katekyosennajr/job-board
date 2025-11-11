<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  job: Object, // data job yang dikirim dari controller
})

const form = useForm({
  title: props.job.title || '',
  description: props.job.description || '',
  location: props.job.location || '',
  salary: props.job.salary || '',
})

// submit form ke route jobs.update
const submit = () => {
  form.put(route('jobs.update', props.job.id))
}
</script>

<template>
  <Head title="Edit Job" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Job
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submit" class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700">Title</label>
              <input
                v-model="form.title"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.title" class="text-red-500 text-sm mt-1">
                {{ form.errors.title }}
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Description</label>
              <textarea
                v-model="form.description"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              ></textarea>
              <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                {{ form.errors.description }}
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Location</label>
              <input
                v-model="form.location"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.location" class="text-red-500 text-sm mt-1">
                {{ form.errors.location }}
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Salary</label>
              <input
                v-model="form.salary"
                type="number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.salary" class="text-red-500 text-sm mt-1">
                {{ form.errors.salary }}
              </div>
            </div>

            <div class="flex items-center gap-4">
              <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none"
                :disabled="form.processing"
              >
                Update
              </button>

              <p v-if="form.recentlySuccessful" class="text-green-600">
                Job updated successfully!
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
