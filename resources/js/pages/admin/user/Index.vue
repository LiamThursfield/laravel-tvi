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
                                <button
                                    v-if="userCan('users.edit')"
                                    class="
                                        border border-navy-300 flex-row items-center inline-flex mx-1 px-2 rounded text-navy-300 text-sm tracking-wide
                                        focus:outline-none focus:shadow-outline
                                        hover:bg-theme-info hover:border-theme-info hover:text-theme-info-contrast
                                    "
                                >
                                    <icon-edit
                                        class="h-4 w-4"
                                    />
                                    <span class="ml-1">
                                        Edit
                                    </span>
                                </button>

                                <button
                                    v-if="userCan('users.delete')"
                                    class="
                                        border border-navy-300 flex-row items-center inline-flex mx-1 px-2 rounded text-navy-300 text-sm tracking-wide
                                        focus:outline-none focus:shadow-outline
                                        hover:bg-theme-danger hover:border-theme-danger hover:text-theme-danger-contrast
                                    "
                                    :disabled="isUserCurrent(user)"
                                    @click="checkUserDelete(user)"
                                >
                                    <icon-trash
                                        class="h-4 w-4"
                                    />
                                    <span class="ml-1">
                                        Delete
                                    </span>
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
                    return this.$errorToast('Only able to delete one user at a time.');
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
            deleteUser() {

            },
            isUserCurrent(user) {
                try {
                    return user.id === this.$page.auth.user.id;
                } catch (e) {
                    return false;
                }
            },
        }
    }
</script>
