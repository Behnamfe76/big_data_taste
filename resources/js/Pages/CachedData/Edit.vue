<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
const props = defineProps(['data'])
const title = ref(props.data.title);
const titleError = ref(null);
const searchTime = ref(0);
const loading = ref(false);
async function createDataFetching() {
    loading.value = true;
    let start = new Date().getTime();
    router.put('/cached-data/' + props.data.id, {
        title: title.value
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            loading.value = false;
            searchTime.value = 0;
            let end = new Date().getTime();
            searchTime.value = end - start;
            title.value = null;
        }
    });
}
function createData() {
    if (!title.value) {
        titleError.value = 'title can\'t be empty';
        return;
    }
    createDataFetching();
}

watch(title, () => {
    if (title.value) {
        titleError.value = null;
    }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Cached Data</h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex gap-4 items-center">
                            <div class="w-1/2">
                                <label for="input-label"
                                    class="block text-sm font-medium mb-2 dark:text-white">Title</label>
                                <input v-model.trim="title" type="email" id="input-label"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="you@site.com">
                                <div class="text-red-500 p-2 pb-0 font-bold text-[16px]">{{ titleError }}</div>
                            </div>
                            <div class="h-full">
                                <span v-if="loading" class="dark:text-white">loading ...</span>
                                <span v-if="searchTime" class="dark:text-white">{{ searchTime / 1000 }} seconds</span>
                            </div>
                        </div>
                        <button @click="createData" type="button"
                            class="py-3 px-4 mt-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
