<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    jobs: Array,
    sortBy: String,
    sortDir: String,
});

// method sorting
function sort(column) {
    const newDir =
        props.sortBy === column && props.sortDir === 'asc'
            ? 'desc'
            : 'asc';

    router.get(route('admin.jobs.approval'), {
        sortBy: column,
        sortDir: newDir,
    }, {
        preserveState: true,
        replace: true,
    });
}
</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto px-4 py-8">

            <h1 class="text-2xl font-bold mb-4">Approval Jobs</h1>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th @click="sort('id')" class="p-2 cursor-pointer">
                            ID 
                            <span v-if="sortBy === 'id'">
                                {{ sortDir === 'asc' ? '▲' : '▼' }}
                            </span>
                        </th>

                        <th @click="sort('title')" class="p-2 cursor-pointer">
                            Title 
                            <span v-if="sortBy === 'title'">
                                {{ sortDir === 'asc' ? '▲' : '▼' }}
                            </span>
                        </th>

                        <th class="p-2">Company</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="job in jobs" :key="job.id" class="border-t">
                        <td class="p-2">{{ job.id }}</td>
                        <td class="p-2">{{ job.title }}</td>
                        <td class="p-2">{{ job.company_name }}</td>
                        <td class="p-2">
                            <span class="px-3 py-1 rounded bg-yellow-200">
                                Pending
                            </span>
                        </td>
                    </tr>

                    <tr v-if="jobs.length === 0">
                        <td colspan="4" class="text-center p-4 text-gray-500">
                            No jobs pending approval.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
