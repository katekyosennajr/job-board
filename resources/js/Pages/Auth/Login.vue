<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const selectedRole = ref('candidate');

const form = useForm({
    email: '',
    password: '',
    remember: false,
    role: 'candidate',
});

const submit = () => {
    form.role = selectedRole.value;
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-2">Masuk ke JobBoard</h2>
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

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
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
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Lupa password?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </PrimaryButton>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-slate-600">Belum punya akun?</p>
            <Link
                :href="route('register')"
                class="text-primary-600 hover:text-primary-700 font-semibold"
            >
                Daftar di sini
            </Link>
        </div>
    </GuestLayout>
</template>
