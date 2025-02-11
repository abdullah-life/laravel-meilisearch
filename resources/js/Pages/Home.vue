<script setup>
import { onMounted, ref } from 'vue';

const indexes = ref()

async function getIndexes() {
    try {
        const response = await window.axios.get('/laravel-meilisearch/indexes');
        indexes.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

onMounted(() => {
    getIndexes()
})

</script>

<template>
    <div class="dark:bg-slate-700 bg-slate-200 dark:text-white">
        <div class="py-4 px-6">
            <div class="">

                <h2 class="text-2xl font-bold tracking-tight dark:text-gray-100 text-gray-900">Overview</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4">
                    <div class="dark:bg-slate-950 bg-slate-100 p-4 rounded-xl border border-slate-300 dark:border-slate-800">
                        <h3 class="font-semibold font-mono text-xs">Total Indexes</h3>
                        <p class="font-extralight text-xl">{{ indexes?.indexes ? Object.keys(indexes?.indexes).length :
                            0
                            }}</p>
                    </div>
                    <div class="dark:bg-slate-950 bg-slate-100 p-4 rounded-xl border border-slate-300 dark:border-slate-800">
                        <h3 class="font-semibold font-mono text-xs">Database Size</h3>
                        <p class="font-extralight text-xl">{{ indexes?.databaseSize ?? 0 }}</p>
                    </div>
                    <div class="dark:bg-slate-950 bg-slate-100 p-4 rounded-xl border border-slate-300 dark:border-slate-800">
                        <h3 class="font-semibold font-mono text-xs">Last Updated At</h3>
                        <p class="font-extralight text-xl">{{ indexes ? (new
                            Date(indexes?.lastUpdate))?.toLocaleString() : "-" }}</p>
                    </div>
                </div>
                <h2 class="text-2xl font-bold tracking-tight dark:text-gray-100 text-gray-900">Available Indexes</h2>

                <ul class="py-4">
                    <li class="dark:bg-slate-950 bg-slate-100 first:rounded-t-xl last:rounded-b-xl border border-slate-300 dark:border-slate-800 p-4 flex justify-between items-center"
                        v-for="index, i in indexes?.indexes">
                        <div class="flex justify-start gap-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-12 p-2 dark:bg-slate-800 bg-slate-500 rounded-md text-gray-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                            <div>
                                <p class="text-sm">Name: <code class="font-bold">{{ i }}</code></p>
                                <p class="text-sm">Documents: {{ index.numberOfDocuments }}</p>
                            </div>
                        </div>

                        <a class="dark:bg-slate-800 bg-slate-500 tracking-wider py-2 px-4 text-xs font-medium uppercase rounded text-white"
                            :href="'/laravel-meilisearch/#/index/' + i">
                            View Documents
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
