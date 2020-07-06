<template>
    <li class="list-group-item d-flex justify-content-between">
        {{ permission }}
        <button class="btn btn-link" @click="removePermission">
            <span v-if="removingInProgress" class="spinner-border spinner-border-sm"></span>
            <span v-else>Delete</span>
        </button>
    </li>
</template>

<script>
    export default {
        name: "PermissionInRoleCard",
        props: ['role', 'permission', 'id'],
        data: function () {
            return {
                removingInProgress: false,
            };
        },
        methods: {
            removePermission: async function () {
                if (!confirm(`Do you really want to remove the permission with "${this.permission}" name from role ${this.role}`)) {
                    return;
                }
                this.removingInProgress = true;
                try {
                    const response = await axios.patch(`admin/roles/${this.role}`, {
                        permissionName: this.permission,
                        type: 'remove',
                    });
                    if (response.data.result !== 'success') {
                        alert(response.data.result);
                    } else {
                        this.$emit('delete-permission-from-role', this.id);
                    }
                } catch (error) {
                    console.log(error.message)
                } finally {
                    this.removingInProgress = false;
                }
            }
        },
    }
</script>

<style scoped>

</style>
