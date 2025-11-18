<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
defineProps({ applications: Array });
</script>

<template>
    <Head title="Lamaran Saya" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800">Lamaran Saya</h2>
        </template>

        <div class="py-10 max-w-4xl mx-auto">
            <div class="bg-white shadow rounded-lg p-6 space-y-4">

                <div
                    v-for="a in applications"
                    :key="a.id"
                    class="border p-4 rounded-lg"
                >
                    <h3 class="font-semibold text-lg">{{ a.job.title }}</h3>
                    <p class="text-gray-600">Perusahaan: {{ a.job.company.name }}</p>
                    <p class="text-gray-500 text-sm">
                        Dilamar: {{ new Date(a.created_at).toLocaleDateString() }}
                    </p>

                    <Link
                        :href="`/jobs/${a.job.id}`"
                        class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg"
                    >
                        Lihat Job
                    </Link>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
