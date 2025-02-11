<template>
    <div class="p-4 md:p-6 dark:text-white text-slate-800">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-start items-start sm:items-center mb-4 gap-4">
            <a v-if="props.uid"
                class="p-3 sm:p-4 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-xs uppercase font-medium text-slate-500 dark:text-slate-600"
                href="#/index">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 sm:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div class="w-full">
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight dark:text-gray-100 text-gray-900 break-words" v-if="props.uid">
                    Browsing Index: <code class="text-lg sm:text-xl break-all">{{ props.uid }}</code>
                </h2>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight dark:text-gray-100 text-gray-900" v-else>
                    Select an index
                </h2>
            </div>
        </div>

        <!-- Search Section -->
        <div v-if="props.uid">
            <input @input="handleSearch" type="search" v-model="query" id="search"
                class="w-full p-3 sm:p-4 rounded-xl bg-slate-100 dark:bg-slate-200 border border-slate-300 dark:border-slate-800 text-sm sm:text-base"
                :placeholder="'Type to search in ' + props.uid">
            <p v-if="!isLoading" class="pt-3 sm:pt-4 text-sm sm:text-base text-slate-800 dark:text-white">
                Found {{ documentCount }} documents
            </p>

            <!-- Documents List -->
            <div class="mt-4" ref="scrollContainer">
                <ul>
                    <li v-if="documents?.length" v-for="(document, index) in documents" :key="document.id"
                        class="dark:bg-slate-950 bg-slate-200 p-2 sm:p-3 my-3 sm:my-4 rounded-xl border border-slate-300 dark:border-slate-800">
                        <div class="p-2">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 sm:gap-0 mb-3 sm:mb-4">
                                <span class="font-semibold text-xs sm:text-sm text-slate-800 dark:text-white break-words">
                                    Document ID: {{ document.id }}
                                </span>
                                <div class="flex justify-end gap-2">
                                    <button @click="deleteDocument(index)"
                                        class="bg-red-600 text-white p-2 text-xs rounded font-medium uppercase">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="max-h-48 w-full overflow-y-auto p-2 sm:p-4 dark:bg-slate-800 bg-slate-500 text-white font-mono text-xs rounded">
                                <pre class="text-wrap whitespace-pre-wrap break-words">{{ formattedJSON(document) }}</pre>
                            </div>
                        </div>
                    </li>
                </ul>
                
                <!-- Loading State -->
                <div v-if="isLoading" class="flex justify-center items-center py-4">
                    <svg class="size-8 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 21C10.5316 20.9987 9.08574 20.6382 7.78865 19.9498C6.49156 19.2614 5.38261 18.2661 4.55853 17.0507C3.73446 15.8353 3.22029 14.4368 3.06088 12.977C2.90147 11.5172 3.10167 10.0407 3.644 8.67604C4.18634 7.31142 5.05434 6.10024 6.17229 5.14813C7.29024 4.19603 8.62417 3.53194 10.0577 3.21378C11.4913 2.89563 12.9809 2.93307 14.3967 3.32286C15.8124 3.71264 17.1113 4.44292 18.18 5.45C18.3205 5.59062 18.3993 5.78125 18.3993 5.98C18.3993 6.17875 18.3205 6.36937 18.18 6.51C18.1111 6.58075 18.0286 6.63699 17.9376 6.67539C17.8466 6.71378 17.7488 6.73357 17.65 6.73357C17.5512 6.73357 17.4534 6.71378 17.3624 6.67539C17.2714 6.63699 17.189 6.58075 17.12 6.51C15.8591 5.33065 14.2303 4.62177 12.508 4.5027C10.7856 4.38362 9.07478 4.86163 7.66357 5.85624C6.25237 6.85085 5.22695 8.30132 4.75995 9.96345C4.29296 11.6256 4.41292 13.3979 5.09962 14.9819C5.78633 16.5659 6.99785 17.865 8.53021 18.6604C10.0626 19.4558 11.8222 19.6989 13.5128 19.3488C15.2034 18.9987 16.7218 18.0768 17.8123 16.7383C18.9028 15.3998 19.4988 13.7265 19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12C21 14.3869 20.0518 16.6761 18.364 18.364C16.6761 20.0518 14.387 21 12 21Z" fill="currentColor"></path> </g></svg>
                </div>

                <!-- End of Results Message -->
                <div v-if="!isLoading && !hasMore" class="text-center py-4 text-sm text-slate-500">
                    No more documents to load
                </div>
            </div>
        </div>

        <!-- Index List -->
        <div v-else>
            <ul class="py-4">
                <li class="dark:bg-slate-950 bg-slate-100 first:rounded-t-xl last:rounded-b-xl border border-slate-300 dark:border-slate-800 p-3 sm:p-4"
                    v-for="index, i in indexes?.indexes">
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-4 items-start sm:items-center">
                        <div class="flex justify-start gap-3 sm:gap-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-10 sm:size-12 p-2 dark:bg-slate-800 bg-slate-500 rounded-md text-gray-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                            <div>
                                <p class="text-xs sm:text-sm">Name: <code class="font-bold break-all">{{ i }}</code></p>
                                <p class="text-xs sm:text-sm">Documents: {{ index.numberOfDocuments }}</p>
                            </div>
                        </div>
                        <a @click="triggerRefresh()"
                            class="w-full sm:w-auto text-center dark:bg-slate-800 bg-slate-500 tracking-wider py-2 px-4 text-xs font-medium uppercase rounded text-white"
                            :href="'/laravel-meilisearch/#/index/' + i">
                            View Documents
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(['uid', 'q'])
import { onMounted, ref, onUnmounted } from 'vue';

const code = ref(`const foo = 'bar';`);
const indexes = ref()
const documents = ref([])
const query = ref("")
const documentCount = ref(null)
const currentPage = ref(0)
const isLoading = ref(false)
const hasMore = ref(true)
const scrollContainer = ref(null)
const ITEMS_PER_PAGE = 20
let searchTimeout = null

const deleteDocument = (index) => {
    documents.value.splice(index, 1);
};

const formattedJSON = (doc) => {
    return JSON.stringify(doc, null, 2)
};

function triggerRefresh() {
    setTimeout(() => {
        resetAndFetchDocuments()
    }, 100);
}

// Reset pagination and fetch documents
const resetAndFetchDocuments = async () => {
    documents.value = []
    currentPage.value = 0
    hasMore.value = true
    await getDocuments()
}

// Debounced search handler
const handleSearch = () => {
    if (searchTimeout) {
        clearTimeout(searchTimeout)
    }
    searchTimeout = setTimeout(() => {
        resetAndFetchDocuments()
    }, 300)
}

async function getIndexes() {
    try {
        const response = await window.axios.get('/laravel-meilisearch/indexes');
        indexes.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function getDocuments() {
    if (isLoading.value || !hasMore.value) return

    try {
        isLoading.value = true
        const skip = currentPage.value * ITEMS_PER_PAGE
        const response = await window.axios.get(
            `/laravel-meilisearch/index/${props.uid}?q=${query.value}&skip=${skip}&take=${ITEMS_PER_PAGE}`
        );
        
        const newDocuments = response.data?.hits || []
        documentCount.value = response.data?.nbHits || 0

        // Append new documents to existing ones
        documents.value = [...documents.value, ...newDocuments]
        
        // Check if we've reached the end
        hasMore.value = documents.value.length < documentCount.value
        
        // Increment page counter
        currentPage.value++
    } catch (error) {
        console.error(error);
    } finally {
        isLoading.value = false
    }
}

// Infinite scroll handler
const handleScroll = () => {
    if (!scrollContainer.value) return

    const container = scrollContainer.value
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement
    
    // Load more when user reaches near bottom
    if (scrollHeight - scrollTop <= clientHeight + 100) {
        getDocuments()
    }
}

// Setup and cleanup scroll listener
onMounted(() => {
    getIndexes()
    if (props.q) {
        query.value = props.q
    }
    resetAndFetchDocuments()
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
    if (searchTimeout) {
        clearTimeout(searchTimeout)
    }
})
</script>