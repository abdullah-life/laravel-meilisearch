<script setup>
import { ref, computed } from 'vue'
import Home from '@/Pages/Home.vue'
import About from '@/Pages/About.vue'
import NotFound from '@/Pages/NotFound.vue'
import BaseLayout from './Layouts/BaseLayout.vue';

const routes = {
    '/': Home,
    '/about': About
}

const currentPath = ref(window.location.hash)

window.addEventListener('hashchange', () => {
    currentPath.value = window.location.hash
})

const currentView = computed(() => {
    return routes[currentPath.value.slice(1) || '/'] || NotFound
})
</script>

<template>
    <BaseLayout>
        <component :is="currentView" />
    </BaseLayout>
</template>
