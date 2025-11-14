<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user

const form = useForm({
  name: user.name,
  email: user.email,
  password: '',
  password_confirmation: ''
})

const submit = () => {
  form.patch(route('profile.update'))
}

const deleteForm = useForm({ password: '' })

const deleteAccount = () => {
  const pass = prompt('Masukkan password untuk menghapus akun:')
  if (!pass) return
  deleteForm.password = pass
  deleteForm.delete(route('profile.destroy'))
}
</script>

<template>
  <Head title="Profil" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800">Profil</h2>
    </template>

    <div class="py-10">
      <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 shadow rounded">
          <form @submit.prevent="submit" class="space-y-4">
            <div>
              <label class="block text-sm">Nama</label>
              <input v-model="form.name" type="text" class="mt-1 w-full border rounded p-2" />
              <p v-if="form.errors.name" class="text-red-600 text-sm">{{ form.errors.name }}</p>
            </div>

            <div>
              <label class="block text-sm">Email</label>
              <input v-model="form.email" type="email" class="mt-1 w-full border rounded p-2" />
              <p v-if="form.errors.email" class="text-red-600 text-sm">{{ form.errors.email }}</p>
            </div>

            <div>
              <label class="block text-sm">Password Baru</label>
              <input v-model="form.password" type="password" class="mt-1 w-full border rounded p-2" />
              <p v-if="form.errors.password" class="text-red-600 text-sm">{{ form.errors.password }}</p>
            </div>

            <div>
              <label class="block text-sm">Konfirmasi Password</label>
              <input v-model="form.password_confirmation" type="password" class="mt-1 w-full border rounded p-2" />
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded" :disabled="form.processing">
              Simpan
            </button>
          </form>
        </div>

        <div class="bg-white p-6 shadow rounded">
          <button @click="deleteAccount" class="bg-red-600 text-white px-4 py-2 rounded">
            Hapus Akun
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
