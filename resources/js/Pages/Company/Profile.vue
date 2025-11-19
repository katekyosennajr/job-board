<script setup>
import { ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user

const form = useForm({
  company_name: '',
  email: user.email,
  website: '',
  industry: '',
  location: '',
  description: '',
  logo: null,
  password: '',
  password_confirmation: ''
})

const logoPreview = ref(null)

const onFileSelected = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.logo = file
    const reader = new FileReader()
    reader.onload = (e) => {
      logoPreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const submit = () => {
  if (form.logo instanceof File) {
    form.post(route('company.profile.update'), {
      forceFormData: true
    })
  } else {
    form.patch(route('company.profile.update'))
  }
}

const deleteAccount = () => {
  if (confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.')) {
    useForm({ password: '' }).delete(route('profile.destroy'))
  }
}
</script>

<template>
  <Head title="Profil Perusahaan" />

  <AppLayout>
    <div class="max-w-4xl mx-auto px-4 py-8">
      <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Profil Perusahaan</h1>
        <p class="text-slate-600 mt-2">Kelola informasi perusahaan Anda</p>
      </div>

      <div class="grid gap-8">
        <!-- Logo Section -->
        <div class="bg-white rounded-xl border border-slate-200 p-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Logo Perusahaan</h2>
          
          <div class="flex items-center gap-8">
            <!-- Logo Preview -->
            <div class="flex-shrink-0">
              <div class="w-32 h-32 rounded-lg bg-slate-100 flex items-center justify-center overflow-hidden border-4 border-slate-200">
                <img 
                  v-if="logoPreview" 
                  :src="logoPreview" 
                  alt="Logo Preview" 
                  class="w-full h-full object-cover"
                />
                <span v-else class="text-4xl">🏢</span>
              </div>
            </div>

            <!-- Upload Section -->
            <div class="flex-1">
              <label class="block mb-4">
                <span class="text-slate-700 font-semibold mb-2 block">Unggah Logo</span>
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

        <!-- Company Info Section -->
        <div class="bg-white rounded-xl border border-slate-200 p-8">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Informasi Perusahaan</h2>

          <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Company Name -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Perusahaan</label>
                <input 
                  v-model="form.company_name" 
                  type="text" 
                  placeholder="PT. Contoh Indonesia"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>

              <!-- Email -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input 
                  v-model="form.email" 
                  type="email" 
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>

              <!-- Website -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Website</label>
                <input 
                  v-model="form.website" 
                  type="url" 
                  placeholder="https://perusahaan.com"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>

              <!-- Industry -->
              <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Industri</label>
                <select 
                  v-model="form.industry"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                >
                  <option value="">Pilih Industri</option>
                  <option value="technology">Teknologi</option>
                  <option value="finance">Keuangan</option>
                  <option value="healthcare">Kesehatan</option>
                  <option value="retail">Retail</option>
                  <option value="education">Pendidikan</option>
                  <option value="manufacturing">Manufaktur</option>
                  <option value="real-estate">Real Estate</option>
                  <option value="other">Lainnya</option>
                </select>
              </div>

              <!-- Location -->
              <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Kantor Pusat</label>
                <input 
                  v-model="form.location" 
                  type="text" 
                  placeholder="Kota, Indonesia"
                  class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
                />
              </div>
            </div>

            <!-- Description -->
            <div>
              <label class="block text-sm font-semibold text-slate-700 mb-2">Tentang Perusahaan</label>
              <textarea 
                v-model="form.description" 
                rows="6"
                placeholder="Ceritakan tentang perusahaan Anda, visi, misi, dan budaya kerja..."
                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"
              ></textarea>
              <p class="text-sm text-slate-600 mt-1">Maksimal 1000 karakter</p>
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
