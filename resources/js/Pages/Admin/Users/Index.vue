<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    users: Array,
});
</script>

<template>
    <Head title="Manage Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800">
                Manage Users
            </h2>
        </template>

        <div class="py-8 max-w-6xl mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h1 class="text-2xl font-bold mb-5">Daftar Pengguna</h1>

                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-3 px-4 border text-left font-semibold">ID</th>
                            <th class="py-3 px-4 border text-left font-semibold">Nama</th>
                            <th class="py-3 px-4 border text-left font-semibold">Email</th>
                            <th class="py-3 px-4 border text-left font-semibold">Role</th>
                            <th class="py-3 px-4 border text-left font-semibold">Tanggal Bergabung</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="u in users"
                            :key="u.id"
                            class="border-b hover:bg-gray-50 transition"
                        >
                            <td class="py-3 px-4 border">{{ u.id }}</td>
                            <td class="py-3 px-4 border font-medium">{{ u.name }}</td>
                            <td class="py-3 px-4 border">{{ u.email }}</td>
                            <td class="py-3 px-4 border capitalize">{{ u.role }}</td>
                            <td class="py-3 px-4 border">
                                {{ new Date(u.created_at).toLocaleDateString() }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div
                    v-if="users.length === 0"
                    class="text-center py-6 text-gray-500"
                >
                    Tidak ada pengguna ditemukan.
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
