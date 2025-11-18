<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const applications = page.props.applications;
</script>

<template>
    <Head title="Lamaran Saya" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold">Lamaran Saya</h2>
        </template>

        <div class="py-6 max-w-5xl mx-auto">
            <div
                v-for="app in applications"
                :key="app.id"
                class="p-4 mb-4 bg-white shadow rounded"
            >
                <h3 class="font-semibold text-lg">{{ app.job.title }}</h3>
                <p class="text-gray-600">Perusahaan: {{ app.job.company.name }}</p>
                <p>Status lamaran: <strong>{{ app.status }}</strong></p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
