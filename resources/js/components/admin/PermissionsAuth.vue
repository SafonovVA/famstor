<template>
    <div>
        <template v-if="loadingInProgress">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </template>
        <template v-else-if="!hasErrors">
            <ul>
                <li v-for="permission of allPermissions">{{ permission }}</li>
            </ul>
        </template>
        <span v-else>{{ error.message }}</span>
    </div>
</template>

<script type="module">
    export default {
        name: "PermissionsAuth",
        data: function() {
            return {
                allPermissions: [],
                error: {},
                loadingInProgress: false,
            };
        },
        mounted: function() {
            this.getAllPermissions();
        },
        computed: {
            hasErrors: function () {
                return Object.keys(this.error).length !== 0;
            }
        },
        methods: {
            getAllPermissions: async function() {
                this.loadingInProgress = true;
                try {
                    const response = await axios.get('/admin/permissions');
                    this.allPermissions = response.data.result;
                } catch (error) {
                    this.error = error;
                } finally {
                    this.loadingInProgress = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
