<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Users
            </h1>

            <inertia-link
                v-if="userCan('users.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.users.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create User
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <h1 class="font-semibold px-6 text-gray-850">
                Search
                <button
                    class="
                        text-sm text-theme-base-subtle-contrast
                        focus:outline-none focus:text-theme-primary
                        hover:text-theme-primary
                    "
                    @click="setSearchOptions"
                >
                    (Clear)
                </button>
            </h1>

            <!--Search Panel -->
            <div
                class="
                    flex flex-col items-center mt-4 px-6 space-y-4
                    md:flex-row md:space-y-0 md:space-x-8
                "
            >
                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="user_first_name_search"
                        input-class="form-control form-control-short"
                        input-id="user_first_name"
                        input-name="user_first_name"
                        input-placeholder="First Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="First Name"
                        v-model="editableSearchOptions.user_first_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="user_last_name_search"
                        input-class="form-control form-control-short"
                        input-id="user_last_name"
                        input-name="user_last_name"
                        input-placeholder="Last Name"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Last Name"
                        v-model="editableSearchOptions.user_last_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input-autocomplete="user_email_search"
                        input-class="form-control form-control-short"
                        input-id="user_email"
                        input-name="user_email"
                        input-placeholder="Email"
                        input-type="text"
                        :label-hidden="true"
                        label-text="Email"
                        v-model="editableSearchOptions.user_email"
                    />
                </div>
            </div>

            <p
                v-if="!usersData"
                class="bg-theme-base-subtle mt-6 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No users
            </p>

            <template v-else>
                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table
                        class="table table-hover table-striped w-full"
                    >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th v-if="show_users_actions"></th>
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
                                <td v-if="show_users_actions">
                                    <div class="flex flex-row items-center justify-end -mx-1">
                                        <inertia-link
                                            v-if="userCan('users.edit')"
                                            class="
                                                flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                                focus:outline-none focus:ring
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
                                                focus:outline-none focus:ring
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
            </template>

            <!-- Pagination -->
            <div
                v-if="showPagination"
                class="flex flex-row justify-center mt-12 px-6"
            >
                <pagination :pagination="users.pagination" />
            </div>

            <confirmation-modal
                confirm-text="Delete"
                confirm-type="danger"
                :show-modal="showDeleteModal"
                :message-text="deleteModalText"
                @cancelAction="cancelUserDelete"
                @closeModal="cancelUserDelete"
                @confirmAction="confirmUserDelete"
            />
        </div>
    </section>
</template>

<script>

    import _ from "lodash";
    import {Inertia} from "@inertiajs/inertia";
    import ConfirmationModal from "../../../components/core/modals/ConfirmationModal";
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AdminUserIndex",
        components: {
            ConfirmationModal,
            InputGroup
        },
        layout: 'admin-layout',
        props: {
            searchOptions: Array | Object,
            users: Object,
        },
        data() {
            return {
                editableSearchOptions: {
                    per_page        : 15,
                    user_first_name : '',
                    user_last_name  : '',
                    user_email      : '',
                },
                isInitialised: false,
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
            show_users_actions() {
                return this.userCan('users.edit') || this.userCan('users.delete');
            },
            showPagination() {
                try {
                    return this.users.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            usersData() {
                if (!this.users || !this.users.data || this.users.data.length < 1) {
                    return false;
                }

                return this.users.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.searchOptions);
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
                this.showDeleteModal = false;
            },
            isUserCurrent(user) {
                try {
                    return user.id === this.$page.props.auth.user.id;
                } catch (e) {
                    return false;
                }
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.isInitialised) {
                    this.isInitialised = true;

                    // If there are already search results, don't attempt search
                    if (this.usersData) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.users.index'),
                    this.editableSearchOptions,
                    {
                        only: ['users'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page        : 15,
                    user_first_name : '',
                    user_last_name  : '',
                    user_email      : '',
                }

                try {
                    // Overwrite the defaults with any new options
                    _.forEach(new_options, (option, key) => {
                        options[key] = option;
                    })
                } catch (e) {
                    console.log(e);
                }

                this.editableSearchOptions = _.cloneDeep(options);
            }
        },
        watch: {
            editableSearchOptions: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
