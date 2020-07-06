<template>
    <div class="card">
        <div class="card-header" :id="`roleCardHeader-${index}`">
            <h2 class="mb-0 d-flex justify-content-between">
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
            </h2>
        </div>
        <div
            :aria-labelledby="`roleCardHeader-${index}`"
            :data-parent="`#${dataParent}`"
            :id="`rolePermissions-${index}`"
            class="collapse">
            <div class="card-body">
                <ul class="list-group">
                    <permission-in-role-card
                        v-for="permission of rolePermissions"
                        :role="role"
                        :permission="permission.name"
                        :id="permission.id"
                        :key="permission.id"
                        @delete-permission-from-role="removePermission"></permission-in-role-card>
                </ul>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Add new role</span>
                    </div>
                    <!--<input type="text" class="form-control" placeholder="Role" v-model="newRole" :disabled="addingInProgress">-->
                    <select v-model="addedPermission">
                        <option value="" disabled>Choose permission</option>
                        <option v-for="permission of newPermissionsForRole" :value="permission">{{permission}}</option>
                    </select>
                    <div class="input-group-append">
                        <button
                            class="btn btn-success"
                            type="submit"
                            @click="addPermission"
                            :disabled="addingInProgress || addedPermission === ''">
                            <span v-if="newPermissionsQueryInProgress" class="spinner-border spinner-border-sm"></span>
                            <span v-else>Add</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="module">
    import PermissionInRoleCard from "./PermissionInRoleCard";
    export default {
        name: "RoleAccordionCard",
        components: {PermissionInRoleCard},
        props: ['role', 'index', 'dataParent'],
        data: function () {
            return {
                rolePermissions: [],
                removingInProgress: false,
                addingInProgress: false,
                addedPermission: '',
                newPermissionsForRole: [],
                newPermissionsQueryInProgress: false,
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
                    const response = await axios.get(`/admin/roles/${this.role}`);
                    this.rolePermissions = response.data.result;
                    if (this.rolePermissions.length === 0) {
                        this.rolePermissions.push({id: 0, name: 'The role does not have permissions.'});
                    }
                } catch (error) {
                    this.error = error;
                } finally {
                    this.loadingInProgress = false;
                }
                await this.getPermissionsForRole();
            },
            removeRole: async function () {
                if (!confirm(`Do you really want to remove the role with "${this.role}" name`)) {
                    return;
                }
                this.removingInProgress = true;
                try {
                    const response = await axios.delete(`admin/roles/${this.role}`);
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
            },
            removePermission: function (id) {
                const index = this.rolePermissions.indexOf(
                    this.rolePermissions.find((permission) => {
                        return permission.id === id;
                }));
                this.rolePermissions.splice(index, 1);
            },
            addPermission: async function () {
                this.newPermissionsQueryInProgress = true;
                try {
                    const response = await axios.patch(`admin/roles/${this.role}`, {
                        permissionName: this.addedPermission,
                        type: 'add',
                    });
                    if (response.data.result !== 'success') {
                        alert(response.data.result);
                    } else {
                        const permissionResponse = await axios.get(`admin/permissions/${this.addedPermission}`);
                        this.rolePermissions.push(permissionResponse.data.result);
                        // TODO Удалять и добавлять разрешения в выпадающий список
                    }
                } catch (error) {
                    console.log(error.message)
                } finally {
                    this.newPermissionsQueryInProgress = false;
                }
            },
            getPermissionsForRole: async function () {
                this.newPermissionsQueryInProgress = true;
                try {
                    const response = await axios.get('/admin/permissions');
                    if (!Array.isArray(response.data.result)) {
                        alert(response.data.result);
                    }
                    const currentRolePermissionsName = this.rolePermissions.map((permission) => permission.name);
                    this.newPermissionsForRole = response.data.result.filter((permission) =>
                        !currentRolePermissionsName.includes(permission)
                    );
                } catch (error) {
                    this.error = error;
                } finally {
                    this.newPermissionsQueryInProgress = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
