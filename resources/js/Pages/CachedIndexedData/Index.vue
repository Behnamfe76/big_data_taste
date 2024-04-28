<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash.debounce'
const props = defineProps(['data', 'searchParam'])
const searchParam = ref(props.searchParam);
const searchTime = ref(0);
const loading = ref(false);
watch(searchParam, debounce(() => {
    if (searchParam.value) {
        searchingData(searchParam.value)
    } else {
        router.get('/cached-indexed-data');
    }
}, 1200));

async function searchingData(param) {
    loading.value = true;
    let start = new Date().getTime();
    router.get('/cached-indexed-data', {
        search: param
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            loading.value = false;
            searchTime.value = 0;
            let end = new Date().getTime();
            searchTime.value = end - start;
            // console.log(start)
            // console.log(end);
            // console.log(searchTime.value / 1000)
        }
    });
}
async function removeData(id) {
    loading.value = true;
    let start = new Date().getTime();
    router.delete('/cached-indexed-data/' + id, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            loading.value = false;
            searchTime.value = 0;
            let end = new Date().getTime();
            searchTime.value = end - start;
            // console.log(start)
            // console.log(end);
            // console.log(searchTime.value / 1000)
        }
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Cached Indexed Data</h2>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 p-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        <div class="px-6 pt-4 pb-8  flex gap-4 justify-between items-center bg-white dark:bg-gray-900">
                            <!-- search -->
                            <div>
                                <div>
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative mt-1">
                                        <div
                                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input v-model="searchParam" type="text" id="table-search"
                                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search for items">
                                    </div>
                                    <span v-if="loading" class="dark:text-white">loading ...</span>
                                    <span v-if="searchTime" class="dark:text-white">{{ searchTime / 1000 }} seconds</span>
                                </div>
                            </div>

                            <Link :href="route('cached-indexed-data.create')">
                            <button type="button"
                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Create
                            </button>
                            </Link>
                        </div>

                        <!-- table of content -->
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        body
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        country
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        city
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        created at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(item, index) in props.data.data" :key="index"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ item.title }}
                                    </th>
                                    <td class="px-6 py-4 ">
                                        {{ item.body }}
                                    </td>
                                    <td style="word-break: break-all;"
                                        class="px-6 py-4 w-[12rem] overflow-hidden inline-flex">
                                        {{ item.image }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.country }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.city }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ item.created_at }}
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <Link :href="route('cached-indexed-data.edit', {
                                            id: item.id,
                                        })" class="hover:text-orange-500 text-lg cursor-pointer">EDIT</Link>
                                        <span @click="removeData(item.id)"
                                            class="hover:text-red-500 text-lg cursor-pointer">REMOVE</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <!-- pagination -->
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                            aria-label="Table navigation">
                            <span
                                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing
                                <span class="font-semibold text-gray-900 dark:text-white">{{ props.data.from }}-{{
                                    props.data.to }}</span>
                                of <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ props.data.total }}</span></span>

                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <button :disabled="!link.url" :href="link.url" class="disabled:pointer-events-none"
                                    v-for="(link, index) in props.data.links" :key="index">
                                    <Link :href="link.url" :class="link.active ? 'dark:bg-gray-700' : 'dark:bg-gray-800'"
                                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                                        ">

                                    {{ link.label }}
                                    </Link>
                                </button>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
