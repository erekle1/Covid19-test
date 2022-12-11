<template>
    <div class="row">
        <h3>Generate Access Token</h3>
    </div>
    <div class="row row-cols-2">
        <div class="form-group">
            <select class="form-select" v-model="role">
                <option value="all" selected>All Privileges</option>
                <option value="read">Read Privileges</option>
            </select>
        </div>
        <div class="form-group ">
            <button type="button" @click="generateToken" class="btn btn-success">Generate</button>
        </div>
    </div>

</template>

<script>
export default {
    name: "AccessToken",
    data() {
        return {
            role: 'all'
        }
    },
    methods: {
        generateToken() {
            this.axios.post('/api/tokens/create').then((res) => {
                console.log(res.data);
            });
        }
    }
}
</script>

<style scoped>

</style>
