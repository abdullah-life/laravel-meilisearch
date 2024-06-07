<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import HomeStats from '../Components/HomeStats.vue';
import Table from '../Components/Table.vue';

const data = ref()

async function getData() {
    try {
        const response = await axios.get('https://se-dev.lifepharmacy.com/stats', {
            headers: {
                'Authorization': 'Bearer Y0urVery-S3cureAp1K3y'
            }
        });
        data.value = response.data
    } catch (error) {
        console.error(error);
    }
}

onMounted(() => {
    getData()
})

</script>

<template>
    <div class="py-12">
        <div>
            <h3 class="pb-2 text-gray-600 font-medium text-xl">Overview:</h3>
            <HomeStats :d="data"></HomeStats>
        </div>
        <div class="mt-4">
            <h3 class="pb-2 text-gray-600 font-medium text-xl">Available Indexes:</h3>
            <Table :records="data?.indexes"></Table>
        </div>
    </div>
</template>
