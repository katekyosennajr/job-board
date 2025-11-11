<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    location: '',
    type: 'full-time',
    category: '',
    salary_min: '',
    salary_max: '',
    requirements: [],
    expires_at: '',
});

const submit = () => {
    form.post(route('jobs.store'));
};

const requirementInput = ref('');
const addRequirement = () => {
    if (requirementInput.value.trim()) {
        form.requirements.push(requirementInput.value.trim());
        requirementInput.value = '';
    }
};

const removeRequirement = (index) => {
    form.requirements.splice(index, 1);
};
</script>

<template>
    <Head title="Post New Job" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post New Job</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6 space-y-6">
                        <div>
                            <InputLabel for="title" value="Job Title" />
                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div>
                            <InputLabel for="description" value="Description" />
                            <textarea
                                id="description"
                                v-model="form.description"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="5"
                                required
                            ></textarea>
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="location" value="Location" />
                                <TextInput
                                    id="location"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.location"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.location" />
                            </div>

                            <div>
                                <InputLabel for="type" value="Job Type" />
                                <select
                                    id="type"
                                    v-model="form.type"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="full-time">Full Time</option>
                                    <option value="part-time">Part Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="remote">Remote</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.type" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="category" value="Category (Optional)" />
                            <TextInput
                                id="category"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.category"
                                placeholder="e.g. Software Development, Marketing"
                            />
                            <InputError class="mt-2" :message="form.errors.category" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="salary_min" value="Min Salary (Optional)" />
                                <TextInput
                                    id="salary_min"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.salary_min"
                                    placeholder="5000000"
                                />
                                <InputError class="mt-2" :message="form.errors.salary_min" />
                            </div>

                            <div>
                                <InputLabel for="salary_max" value="Max Salary (Optional)" />
                                <TextInput
                                    id="salary_max"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.salary_max"
                                    placeholder="8000000"
                                />
                                <InputError class="mt-2" :message="form.errors.salary_max" />
                            </div>
                        </div>

                        <div>
                            <InputLabel value="Requirements (Optional)" />
                            <div class="flex gap-2 mt-1">
                                <TextInput
                                    v-model="requirementInput"
                                    type="text"
                                    class="flex-1"
                                    placeholder="Add a requirement and press Enter"
                                    @keyup.enter="addRequirement"
                                />
                                <button
                                    @click="addRequirement"
                                    type="button"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700"
                                >
                                    Add
                                </button>
                            </div>
                            <div v-if="form.requirements.length > 0" class="mt-2 space-y-1">
                                <div v-for="(req, index) in form.requirements" :key="index" class="flex items-center gap-2 text-sm">
                                    <span class="flex-1">• {{ req }}</span>
                                    <button
                                        @click="removeRequirement(index)"
                                        type="button"
                                        class="text-red-600 hover:text-red-800"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <InputLabel for="expires_at" value="Expires At (Optional)" />
                            <TextInput
                                id="expires_at"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.expires_at"
                            />
                            <InputError class="mt-2" :message="form.errors.expires_at" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Post Job</PrimaryButton>
                            <a :href="route('jobs.index')" class="text-gray-600 hover:text-gray-800">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


