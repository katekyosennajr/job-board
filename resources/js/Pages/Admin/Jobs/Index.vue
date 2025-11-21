<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    jobs: Array,
});

// State sorting
const sortBy = ref("id");
const sortDirection = ref("asc");

// Method sorting
const sortJobs = (key) => {
    if (sortBy.value === key) {
        sortDirection.value = sortDirection.value === "asc" ? "desc" : "asc";
    } else {
        sortBy.value = key;
        sortDirection.value = "asc";
    }
};

// Computed sorted data
const sortedJobs = computed(() => {
    return [...props.jobs].sort((a, b) => {
        let x = a[sortBy.value];
        let y = b[sortBy.value];

        if (x < y) return sortDirection.value === "asc" ? -1 : 1;
        if (x > y) return sortDirection.value === "asc" ? 1 : -1;
        return 0;
    });
});

const approve = (id) => {
    router.post(`/admin/jobs/${id}/approve`);
};

const rejectJob = (id) => {
    router.post(`/admin/jobs/${id}/reject`);
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-5">Approval Jobs</h1>

        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
            <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 border-b">

                        <!-- Nomor urut -->
                        <th class="py-3 px-4 border font-semibold text-left">
                            No
                        </th>

                        <!-- ID Database (sortable) -->
                        <th
                            class="py-3 px-4 border font-semibold text-left cursor-pointer hover:bg-gray-200 transition"
                            @click="sortJobs('id')"
                        >
                            ID
                            <span class="text-xs opacity-50">
                                {{ sortBy === 'id' ? (sortDirection === 'asc' ? '▲' : '▼') : '' }}
                            </span>
                        </th>

                        <th class="py-3 px-4 border font-semibold text-left">Title</th>
                        <th class="py-3 px-4 border font-semibold text-left">Company</th>
                        <th class="py-3 px-4 border font-semibold text-left">Status</th>
                        <th class="py-3 px-4 border font-semibold text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="(job, index) in sortedJobs"
                        :key="job.id"
                        class="border-b hover:bg-gray-50 transition"
                    >
                        <td class="py-3 px-4 border">{{ index + 1 }}</td>

                        <td class="py-3 px-4 border">{{ job.id }}</td>
                        <td class="py-3 px-4 border font-medium">{{ job.title }}</td>
                        <td class="py-3 px-4 border">{{ job.company_id }}</td>
                        <td class="py-3 px-4 border capitalize">{{ job.status }}</td>

                        <td class="py-3 px-4 border space-x-2">
                            <button
                                class="px-4 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                @click="approve(job.id)"
                            >
                                Approve
                            </button>

                            <button
                                class="px-4 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                @click="rejectJob(job.id)"
                            >
                                Reject
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-if="sortedJobs.length === 0"
                class="text-center py-6 text-gray-500"
            >
                Tidak ada job pending.
            </div>
        </div>
    </div>
</template>
