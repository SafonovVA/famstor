<template>
    <div>
        <template v-if="loadingInProgress">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </template>
        <template v-else-if="!hasErrors">
            <div class="accordion" id="roleAccordion">
                <role-accordion-card
                    v-for="(role, index) of allRoles"
                    :key="index"
                    :role="role"
                    :index="index"
                    :dataParent="accordionId"
                    @delete-role-accordion-card="deleteAccordionCard"></role-accordion-card>
            </div>
        </template>
        <span v-else>{{ error.message }}</span>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Add new role</span>
            </div>
            <input type="text" class="form-control" placeholder="Role" v-model="newRole" :disabled="addingInProgress">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit" @click="addRole" :disabled="addingInProgress">
                    <span v-if="addingInProgress" class="spinner-border spinner-border-sm"></span>
                    <span v-else>Add</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script type="module">
    import RoleAccordionCard from "./RoleAccordionCard";
    export default {
        name: "RolesAuth",
        components: {RoleAccordionCard},
        data: function() {
            return {
                allRoles: [],
                error: {},
                accordionId: 'roleAccordion',
                loadingInProgress: false,
                newRole: '',
                addingInProgress: false,
            };
        },
        mounted: function() {
            this.getAllRoles();
        },
        computed: {
            hasErrors: function () {
                return Object.keys(this.error).length !== 0;
            }
        },
        methods: {
            getAllRoles: async function() {
                this.loadingInProgress = true;
                try {
                    const response = await axios.get('/admin/roles');
                    this.allRoles = response.data.result;
                } catch (error) {
                    this.error = error;
                } finally {
                    this.loadingInProgress = false;
                }
            },
            addRole: async function () {
                this.addingInProgress = true;
                try {
                    const roleName = this.newRole;
                    this.newRole = '';
                    const response = await axios.post('admin/roles', {
                        roleName: roleName,
                    });
                    if (response.data.result !== 'success') {
                        alert(response.data.result);
                    } else {
                        this.allRoles.push(roleName);
                    }
                } catch (error) {
                    console.log(error);
                } finally {
                    this.addingInProgress = false;
                }
            },
            deleteAccordionCard: function (index) {
                this.allRoles.splice(index, 1);
            }
        }
    }
</script>

<style scoped>

</style>
