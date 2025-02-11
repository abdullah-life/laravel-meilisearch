<template>
    <p>Product ID: {{ id }}</p>
</template>

<script setup>
const props = defineProps(['id'])
console.log(props)
</script>