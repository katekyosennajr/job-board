<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const job = computed(() => page.props.job);

const apply = () => {
    router.post(route("jobs.apply", job.value.id), {});
};
</script>

<template>
    <Head :title="job.title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Pekerjaan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">
                        {{ job.title }}
                    </h1>

                    <p class="text-gray-700 text-sm mb-4">
                        Diposting oleh:
                        <span class="font-semibold">{{ job.company.name }}</span>
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="font-semibold text-gray-800">Lokasi:</p>
                            <p>{{ job.location }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="font-semibold text-gray-800">Tipe Pekerjaan:</p>
                            <p>{{ job.job_type }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="font-semibold text-gray-800">Kategori:</p>
                            <p>{{ job.kategori }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="font-semibold text-gray-800">Gaji:</p>
                            <p>
                                Rp {{ job.min_salary.toLocaleString() }} -
                                Rp {{ job.max_salary.toLocaleString() }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Deskripsi Pekerjaan</h3>
                        <p class="text-gray-700 whitespace-pre-line">
                            {{ job.description }}
                        </p>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <Link
                            href="/dashboard"
                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg text-gray-900 font-semibold transition"
                        >
                            Kembali
                        </Link>

                        <button
                            @click="apply"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition"
                        >
                            Lamar Pekerjaan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
