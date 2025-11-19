<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const selectedRole = ref('candidate');

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'candidate',
});

const submit = () => {
    form.role = selectedRole.value;
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Daftar ke JobBoard</h2>
            <p class="text-slate-600">Pilih tipe akun Anda</p>
        </div>

        <!-- Role Selection -->
        <div class="grid grid-cols-2 gap-4 mb-8">
            <!-- Candidate Button -->
            <button
                type="button"
                @click="selectedRole = 'candidate'"
                :class="[
                    'p-4 rounded-xl border-2 transition-all font-semibold',
                    selectedRole === 'candidate'
                        ? 'border-primary-600 bg-primary-50 text-primary-900'
                        : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'
                ]"
            >
                <div class="text-3xl mb-2">👤</div>
                <div>Pencari Kerja</div>
            </button>

            <!-- Company Button -->
            <button
                type="button"
                @click="selectedRole = 'company'"
                :class="[
                    'p-4 rounded-xl border-2 transition-all font-semibold',
                    selectedRole === 'company'
                        ? 'border-primary-600 bg-primary-50 text-primary-900'
                        : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'
                ]"
            >
                <div class="text-3xl mb-2">🏢</div>
                <div>Perusahaan</div>
            </button>
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nama Lengkap" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email input -->
            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Konfirmasi Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Sudah punya akun?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
