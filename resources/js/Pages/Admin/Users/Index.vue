<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import useSort from "@/Composables/useSort";

const props = defineProps({
    users: Array,
});
const usersData = ref(props.users);

const { sortedItems, sortKey, sortDirection, sortBy } = useSort(usersData);
</script>

<template>
    <Head title="Manage Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800">Manage Users</h2>
        </template>

        <div class="py-8 max-w-6xl mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                <h1 class="text-2xl font-bold mb-5">Daftar Pengguna</h1>

                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 border-b select-none">
                            <th 
                                class="py-3 px-4 border text-left font-semibold cursor-pointer"
                                @click="sortBy('id')"
                            >
                                ID
                                <span 
                                    class="sort-arrow"
                                    :class="{
                                        'sort-active': sortKey === 'id'
                                    }"
                                >
                                    {{ sortDirection === 'asc' && sortKey === 'id' ? '▲' : '▼' }}
                                </span>
                            </th>

                            <th 
                                class="py-3 px-4 border text-left font-semibold cursor-pointer"
                                @click="sortBy('name')"
                            >
                                Nama
                                <span 
                                    class="sort-arrow"
                                    :class="{ 'sort-active': sortKey === 'name' }"
                                >
                                    {{ sortDirection === 'asc' && sortKey === 'name' ? '▲' : '▼' }}
                                </span>
                            </th>

                            <th 
                                class="py-3 px-4 border text-left font-semibold cursor-pointer"
                                @click="sortBy('email')"
                            >
                                Email
                                <span 
                                    class="sort-arrow"
                                    :class="{ 'sort-active': sortKey === 'email' }"
                                >
                                    {{ sortDirection === 'asc' && sortKey === 'email' ? '▲' : '▼' }}
                                </span>
                            </th>

                            <th 
                                class="py-3 px-4 border text-left font-semibold cursor-pointer"
                                @click="sortBy('role')"
                            >
                                Role
                                <span 
                                    class="sort-arrow"
                                    :class="{ 'sort-active': sortKey === 'role' }"
                                >
                                    {{ sortDirection === 'asc' && sortKey === 'role' ? '▲' : '▼' }}
                                </span>
                            </th>

                            <th 
                                class="py-3 px-4 border text-left font-semibold cursor-pointer"
                                @click="sortBy('created_at')"
                            >
                                Tgl Bergabung
                                <span 
                                    class="sort-arrow"
                                    :class="{ 'sort-active': sortKey === 'created_at' }"
                                >
                                    {{ sortDirection === 'asc' && sortKey === 'created_at' ? '▲' : '▼' }}
                                </span>
                            </th>

                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="u in sortedItems"
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
