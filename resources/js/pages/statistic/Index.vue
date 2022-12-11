<template>
    <div class="row">
        <h1 class="text-center">Covid 19 Statistics</h1>
    </div>
    <data-table/>
</template>

<script>
import DataTable from "../../components/table/data-table";
export default {
    name: "statIndex",
    components: {DataTable},
    methods: {
    },

    mounted() {
        console.log(this.$store.state.country.countries)
    }
}
</script>

<style scoped>

</style>
