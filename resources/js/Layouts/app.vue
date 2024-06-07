<script setup>
import { ref, computed } from 'vue'
import Home from '@/Pages/Home.vue'
import About from '@/Pages/About.vue'
import NotFound from '@/Pages/NotFound.vue'

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
    <a class="bg-red-500 p-2 rounded" href="/test/#/">Home</a> |
    <a href="/test/#/about">About</a> |
    <a href="/test/#/non-existent-path">Broken Link</a>
    <component :is="currentView" />
</template>
