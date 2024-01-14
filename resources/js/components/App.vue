<script setup>

</script>

<template>

</template>

<script>
export default {
    data() {
        return {
            standData: {}, // Object to hold the returned standData from your endpoint
        }
    },
    mounted() {
        // Get the data from your endpoint when the component is created
        axios.get('/api/stand-publishers/'+standId)
            .then(response => {
                this.standData = response.data;
            });
    },
    methods: {
        formatDate(date) {
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString('ru-RU', options);
        }
    }
}
</script>


<style scoped>

</style>
