<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({ job: Object, applicants: Array });
</script>

<template>
    <Head title="Daftar Pelamar" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800">
                Daftar Pelamar - {{ job.title }}
            </h2>
        </template>

        <div class="py-10 max-w-4xl mx-auto">
            <div class="bg-white shadow rounded-lg p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Nama</th>
                            <th class="py-2 text-left">Email</th>
                            <th class="py-2 text-left">Tanggal Lamar</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="a in applicants" :key="a.id" class="border-b">
                            <td class="py-2">{{ a.candidate.name }}</td>
                            <td class="py-2">{{ a.candidate.email }}</td>
                            <td class="py-2">{{ new Date(a.created_at).toLocaleDateString() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
