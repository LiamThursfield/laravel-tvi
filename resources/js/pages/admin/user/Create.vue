<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('users.create')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Create User
            </h1>

            <inertia-link
                v-if="userCan('users.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.users.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save
                    class="
                        w-5
                        md:mr-2
                    "
                />
                <span
                    class="hidden md:inline"
                >
                    Create User
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">

                <input-group
                    :error-message="getPageErrorMessage('first_name')"
                    input-autocomplete="first_name"
                    :input-autofocus="true"
                    input-id="first_name"
                    input-name="first_name"
                    :input-required="true"
                    input-type="text"
                    label-text="First Name"
                    @errorHidden="clearPageErrorMessage('first_name')"
                    v-model="formData.first_name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('last_name')"
                    input-autocomplete="last_name"
                    input-id="last_name"
                    input-name="last_name"
                    :input-required="true"
                    input-type="text"
                    label-text="Last Name"
                    @errorHidden="clearPageErrorMessage('last_name')"
                    v-model="formData.last_name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    input-autocomplete="off"
                    input-id="email"
                    input-name="email"
                    :input-required="true"
                    input-type="email"
                    label-text="Email"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="formData.email"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('password')"
                    input-autocomplete="off"
                    input-id="password"
                    input-name="password"
                    :input-required="true"
                    input-type="password"
                    label-text="Password"
                    @errorHidden="clearPageErrorMessage('password')"
                    v-model="formData.password"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('password_confirmation')"
                    input-autocomplete="off"
                    input-id="password_confirmation"
                    input-name="password_confirmation"
                    :input-required="true"
                    input-type="password"
                    label-text="Confirm Password"
                    @errorHidden="clearPageErrorMessage('password_confirmation')"
                    v-model="formData.password_confirmation"
                />
            </div>
        </div>

        <div v-if="isSelectableRoles"
             class="bg-white mt-6 py-6 shadow-subtle rounded-lg"
        >
            <div class="block px-6 w-full">
                <p class="font-medium mb-4 text-theme-base-contrast tracking-wider">
                    Roles
                </p>

                <div class="space-y-2">
                    <inline-checkbox-group
                        v-for="(role_label, role_key) in selectableRoles"
                        :key="`user-role-${role_key}`"
                        :input-id="`user-role-${role_key}`"
                        :input-name="`user-role-${role_key}`"
                        :label-text="role_label"
                        v-model="formData.roles[role_key]"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import _ from "lodash";
    import InlineCheckboxGroup from "../../../components/core/forms/InlineCheckboxGroup";
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AdminUserCreate",
        components: {
            InlineCheckboxGroup,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            selectableRoles: {
                default: null,
            },
        },
        data() {
            return {
                formData: {
                    email: '',
                    first_name: '',
                    last_name: '',
                    password: '',
                    password_confirmation: '',
                    roles: {},
                },
            }
        },
        computed: {
            isSelectableRoles() {
                try {
                    return Object.keys(this.selectableRoles).length > 0;
                } catch (e) {
                    return false;
                }
            }
        },
        mounted() {
            this.initialiseRoles();
        },
        methods: {
            initialiseRoles() {
                _.forEach(this.selectableRoles, (role_label, role_key) => {{
                    if (!this.formData.roles.hasOwnProperty(role_key)) {
                        this.formData.roles[role_key] = false;
                    }
                }});
            },
            submit() {
                this.$inertia.post(
                    this.$route('admin.users.store'),
                    this.formData
                );
            }
        }
    }
</script>
