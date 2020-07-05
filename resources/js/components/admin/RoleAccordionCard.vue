<template>
    <div class="card">
        <div class="card-header" :id="`roleCardHeader-${index}`">
            <h2 class="mb-0">
                <div class="d-flex justify-content-between">
                    <button
                        :aria-controls="`rolePermissions-${index}`"
                        :data-target="`#rolePermissions-${index}`"
                        @click="getRolePermissions"
                        class="btn btn-link"
                        data-toggle="collapse"
                        type="button">
                        {{ role }}
                    </button>
                    <button class="btn btn-link" @click="removeRole">
                        <span v-if="removingInProgress" class="spinner-border spinner-border-sm"></span>
                        <span v-else>Delete</span>
                    </button>
                </div>
            </h2>
        </div>
        <div
            :aria-labelledby="`roleCardHeader-${index}`"
            :data-parent="`#${dataParent}`"
            :id="`rolePermissions-${index}`"
            class="collapse">
            <div class="card-body">
                <ul>
                    <li v-for="permission of rolePermissions" :key="permission.id">{{ permission.name }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script type="module">
    export default {
        name: "RoleAccordionCard",
        props: ['role', 'index', 'dataParent'],
        data: function () {
            return {
                rolePermissions: [],
                removingInProgress: false,
            }
        },
        computed: {
            isFirstRole: function () {
                return this.index === 0 ? 'true' : 'false';
            },
        },
        methods: {
            getRolePermissions: async function () {
                this.loadingInProgress = true;
                if (this.rolePermissions.length !== 0) {
                    return;
                }
                try {
                    const response = await axios.get(`/admin/roles/${this.role}/permissions`);
                    this.rolePermissions = response.data;
                    if (this.rolePermissions.length === 0) {
                        this.rolePermissions = [{id: 0, name: 'The role does not have permissions.'}];
                    }
                } catch (error) {
                    this.error = error;
                } finally {
                    this.loadingInProgress = false;
                }
            },
            removeRole: async function () {
                if (!confirm(`Do you really want to remove the role with ${this.role} name`)) {
                    return;
                }
                this.removingInProgress = true;
                try {
                    const response = await axios.post('/admin/roles/delete', {
                        roleName: this.role,
                    });
                    if (response.data.result !== 'success') {
                        alert(response.data.result);
                    } else {
                        this.$emit('delete-role-accordion-card', this.index);
                    }
                } catch (error) {
                    console.log(error.message)
                } finally {
                    this.removingInProgress = false;
                }
            }
        }

    }
</script>

<style scoped>

</style>
