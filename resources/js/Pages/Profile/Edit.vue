<script setup>
import { ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user

const form = useForm({
  name: user.name,
  email: user.email,
  phone: '',
  location: '',
  bio: '',
  skills: '',
  profile_photo: null,
  password: '',
  password_confirmation: ''
})

const profilePhotoPreview = ref(null)

const onFileSelected = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.profile_photo = file
    const reader = new FileReader()
    reader.onload = (e) => {
      profilePhotoPreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const submit = () => {
  if (form.profile_photo instanceof File) {
    form.post(route('profile.update'), {
      forceFormData: true
    })
  } else {
    form.patch(route('profile.update'))
  }
}

const deleteAccount = () => {
  if (confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) {
    useForm({ password: '' }).delete(route('profile.destroy'))
  }
}
</script>

<template>
  <Head title="Edit Profil" />

  <AppLayout>
    <div class="max-w-4xl mx-auto px-4 py-8">
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Profil Saya</h1>
        <p class="text-slate-600 mt-2">Kelola informasi profil dan preferensi Anda</p>
      </div>

      <div class="grid gap-8">
        <!-- Profile Photo Section -->
        <div class="bg-white rounded-xl border border-slate-200 p-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Foto Profil</h2>
          
          <div class="flex items-center gap-8">
            <!-- Photo Preview -->
            <div class="flex-shrink-0">
              <div class="w-32 h-32 rounded-full bg-primary-100 flex items-center justify-center overflow-hidden border-4 border-primary-200">
                <img 
                  v-if="profilePhotoPreview" 
                  :src="profilePhotoPreview" 
                  alt="Preview" 
                  class="w-full h-full object-cover"
                />
                <span v-else class="text-4xl">👤</span>
              </div>
            </div>

            <!-- Upload Section -->
            <div class="flex-1">
              <label class="block mb-4">
                <span class="text-slate-700 font-semibold mb-2 block">Unggah Foto Profil</span>
                <input 
                  type="file" 
                  accept="image/*" 
                  @change="onFileSelected"
                  class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-600 file:text-white hover:file:bg-primary-700"
                />
              </label>
              <p class="text-sm text-slate-600">Format: JPG, PNG. Ukuran maksimal 5MB</p>
            </div>
          </div>
        </div>

        <!-- Basic Info Section -->
        <div class="bg-white rounded-xl border border-slate-200 p-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Informasi Dasar</h2>

          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Name -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                <input 
                  v-model="form.name" 
                  type="text" 
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
                <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</p>
              </div>

              <!-- Email -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input 
                  v-model="form.email" 
                  type="email" 
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
                <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
              </div>

              <!-- Phone -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon</label>
                <input 
                  v-model="form.phone" 
                  type="tel" 
                  placeholder="+62..."
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>

              <!-- Location -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi</label>
                <input 
                  v-model="form.location" 
                  type="text" 
                  placeholder="Kota, Indonesia"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>
            </div>

            <!-- Bio -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Tentang Saya</label>
              <textarea 
                v-model="form.bio" 
                rows="4"
                placeholder="Ceritakan tentang pengalaman, keahlian, dan tujuan karir Anda..."
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
              ></textarea>
            </div>

            <!-- Skills -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Keahlian</label>
              <textarea 
                v-model="form.skills" 
                rows="3"
                placeholder="Pisahkan dengan koma. Contoh: JavaScript, Vue.js, Tailwind CSS"
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
              ></textarea>
              <p class="text-sm text-slate-600 mt-1">Pisahkan setiap keahlian dengan koma</p>
            </div>

            <button 
              type="submit"
              :disabled="form.processing"
              class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold disabled:opacity-50"
            >
              {{ form.processing ? 'Menyimpan...' : 'Simpan Perubahan' }}
            </button>
          </form>
        </div>

        <!-- Security Section -->
        <div class="bg-white rounded-xl border border-slate-200 p-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Keamanan</h2>

          <form @submit.prevent="submit" class="space-y-6">
            <!-- New Password -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
              <input 
                v-model="form.password" 
                type="password" 
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
              />
              <p v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</p>
            </div>

            <!-- Confirm Password -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
              <input 
                v-model="form.password_confirmation" 
                type="password" 
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
              />
            </div>

            <button 
              type="submit"
              :disabled="form.processing"
              class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-semibold disabled:opacity-50"
            >
              {{ form.processing ? 'Memperbarui...' : 'Perbarui Password' }}
            </button>
          </form>
        </div>

        <!-- Danger Zone -->
        <div class="bg-red-50 rounded-xl border border-red-200 p-8">
          <h2 class="text-2xl font-bold text-red-900 mb-4">Zona Berbahaya</h2>
          <p class="text-red-800 mb-6">Menghapus akun adalah tindakan permanen dan tidak dapat dibatalkan.</p>
          
          <button 
            @click="deleteAccount"
            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold"
          >
            Hapus Akun
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
