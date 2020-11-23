<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
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
                        input_autocomplete="user_first_name_search"
                        input_class="form-control form-control-short"
                        input_id="user_first_name"
                        input_name="user_first_name"
                        input_placeholder="First Name"
                        input_type="text"
                        :label_hidden="true"
                        label_text="First Name"
                        v-model="editable_search_options.user_first_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input_autocomplete="user_last_name_search"
                        input_class="form-control form-control-short"
                        input_id="user_last_name"
                        input_name="user_last_name"
                        input_placeholder="Last Name"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Last Name"
                        v-model="editable_search_options.user_last_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input_autocomplete="user_email_search"
                        input_class="form-control form-control-short"
                        input_id="user_email"
                        input_name="user_email"
                        input_placeholder="Email"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Email"
                        v-model="editable_search_options.user_email"
                    />
                </div>
            </div>

            <p
                v-if="!users_data"
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
                                v-for="(user, index) in users_data"
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
            </template>

            <!-- Pagination -->
            <div
                v-if="show_pagination"
                class="flex flex-row justify-center mt-12 px-6"
            >
                <pagination :pagination="users.pagination" />
            </div>

            <confirmation-modal
                confirmText="Delete"
                confirmType="danger"
                :showModal="show_delete_modal"
                :messageText="delete_modal_text"
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
            search_options: Array | Object,
            users: Object,
        },
        data() {
            return {
                editable_search_options: {
                    per_page        : 15,
                    user_first_name : '',
                    user_last_name  : '',
                    user_email      : '',
                },
                is_initialised: false,
                is_loading_user_delete: false,
                show_delete_modal: false,
                user_to_delete: null,
            }
        },
        computed: {
            delete_modal_text() {
                try {
                    return 'Do you really want to delete \'' + this.user_to_delete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this user?'
                }
            },
            show_users_actions() {
                return this.userCan('users.edit') || this.userCan('users.delete');
            },
            show_pagination() {
                try {
                    return this.users.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            users_data() {
                if (!this.users || !this.users.data || this.users.data.length < 1) {
                    return false;
                }

                return this.users.data;
            }
        },
        mounted() {
            this.setSearchOptions(this.search_options);
        },
        methods: {
            cancelUserDelete() {
                if (!this.is_loading_user_delete) {
                    this.show_delete_modal = false;
                    this.user_to_delete = null;
                }
            },
            checkUserDelete(user) {
                this.show_delete_modal = true;
                this.user_to_delete = user;
            },
            confirmUserDelete() {
                if (this.is_loading_user_delete) {
                    return this.$errorToast('It\'s only possible to delete one user at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.users.destroy', this.user_to_delete.id),
                    {
                        only: [
                            'flash',
                            'users'
                        ]
                    }
                );

                this.user_to_delete = null
                this.show_delete_modal = false;
            },
            isUserCurrent(user) {
                try {
                    return user.id === this.$page.props.auth.user.id;
                } catch (e) {
                    return false;
                }
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.is_initialised) {
                    this.is_initialised = true;

                    // If there are already search results, don't attempt search
                    if (this.users_data) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.users.index'),
                    this.editable_search_options,
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

                this.editable_search_options = _.cloneDeep(options);
            }
        },
        watch: {
            editable_search_options: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
