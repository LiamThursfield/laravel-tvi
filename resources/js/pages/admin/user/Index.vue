<template>
    <div class="bg-white py-6 shadow-subtle rounded-lg">
        <h1 class="font-semibold px-6 text-gray-850">
            Users
        </h1>

        <div class="block mt-4 overflow-x-auto w-full">
            <table
                class="table table-hover table-striped w-full"
            >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th v-if="showUsersActions"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(user, index) in usersData"
                        :key="`user-${user.id}`"
                    >
                        <td>
                            {{ user.name }}
                        </td>
                        <td>
                            {{ user.email }}
                        </td>
                        <td v-if="showUsersActions">
                            <div class="flex flex-row items-center justify-end -mx-1">
                                <inertia-link
                                    v-if="userCan('users.edit')"
                                    class="
                                        flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                        focus:outline-none focus:shadow-outline
                                        hover:bg-theme-info hover:text-theme-info-contrast
                                    "
                                    :href="$route('admin.users.edit', user.id)"
                                    title="Edit User"
                                >
                                    <icon-edit
                                        class="w-4"
                                    />
                                </inertia-link>

                                <button
                                    v-if="userCan('users.delete')"
                                    class="
                                        flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                        focus:outline-none focus:shadow-outline
                                        hover:bg-theme-danger hover:text-theme-danger-contrast
                                    "
                                    :disabled="isUserCurrent(user)"
                                    title="Delete User"
                                    @click="checkUserDelete(user)"
                                >
                                    <icon-trash
                                        class="w-4"
                                    />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-row justify-center mt-12 px-6">
            <pagination
                :pagination="users.pagination"
            />
        </div>

        <confirmation-modal
            confirmText="Delete"
            confirmType="danger"
            :showModal="showDeleteModal"
            :messageText="deleteModalText"
            @cancelAction="cancelUserDelete"
            @closeModal="cancelUserDelete"
            @confirmAction="confirmUserDelete"
        />
    </div>
</template>

<script>

    import ConfirmationModal from "../../../components/core/modals/ConfirmationModal";
    export default {
        name: "AdminUserIndex",
        components: {ConfirmationModal},
        layout: 'admin-layout',
        props: {
            users: Object,
        },
        data() {
            return {
                isLoadingUserDelete: false,
                showDeleteModal: false,
                userToDelete: null,
            }
        },
        computed: {
            deleteModalText() {
                try {
                    return 'Do you really want to delete \'' + this.userToDelete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this user?'
                }
            },
            showUsersActions() {
                return this.userCan('users.edit') || this.userCan('users.delete');
            },
            usersData() {
                if (!this.users || !this.users.data || this.users.data.length < 1) {
                    return false;
                }

                return this.users.data;
            }
        },
        methods: {
            cancelUserDelete() {
                if (!this.isLoadingUserDelete) {
                    this.showDeleteModal = false;
                    this.userToDelete = null;
                }
            },
            checkUserDelete(user) {
                this.showDeleteModal = true;
                this.userToDelete = user;
            },
            confirmUserDelete() {
                if (this.isLoadingUserDelete) {
                    return this.$errorToast('It\'s only possible to delete one user at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.users.destroy', this.userToDelete.id),
                    {
                        only: [
                            'flash',
                            'users'
                        ]
                    }
                );
                this.userToDelete = null
            },
            isUserCurrent(user) {
                try {
                    return user.id === this.$page.props.auth.user.id;
                } catch (e) {
                    return false;
                }
            },
        }
    }
</script>
