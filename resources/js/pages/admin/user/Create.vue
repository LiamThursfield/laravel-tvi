<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('profile.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
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
                    :error_message="getPageErrorMessage('first_name')"
                    input_autocomplete="first_name"
                    :input_autofocus="true"
                    input_id="first_name"
                    input_name="first_name"
                    :input_required="true"
                    input_type="text"
                    label_text="First Name"
                    v-model="formData.first_name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('last_name')"
                    input_autocomplete="last_name"
                    input_id="last_name"
                    input_name="last_name"
                    :input_required="true"
                    input_type="text"
                    label_text="Last Name"
                    v-model="formData.last_name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('email')"
                    input_autocomplete="off"
                    input_id="email"
                    input_name="email"
                    :input_required="true"
                    input_type="email"
                    label_text="Email"
                    v-model="formData.email"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('password')"
                    input_autocomplete="off"
                    input_id="password"
                    input_name="password"
                    :input_required="true"
                    input_type="password"
                    label_text="Password"
                    v-model="formData.password"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('password_confirmation')"
                    input_autocomplete="off"
                    input_id="password_confirmation"
                    input_name="password_confirmation"
                    :input_required="true"
                    input_type="password"
                    label_text="Confirm Password"
                    v-model="formData.password_confirmation"
                />
            </div>
        </div>

        <div v-if="is_selectable_roles"
             class="bg-white mt-6 py-6 shadow-subtle rounded-lg"
        >
            <div class="block px-6 w-full">
                <p class="font-medium mb-4 text-theme-base-contrast tracking-wider">
                    Roles
                </p>

                <div class="space-y-2">
                    <inline-checkbox-group
                        v-for="(role_label, role_key) in selectable_roles"
                        :key="`user-role-${role_key}`"
                        :checkbox_id="`user-role-${role_key}`"
                        :checkbox_name="`user-role-${role_key}`"
                        :label_text="role_label"
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
        selectable_roles: {
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
        is_selectable_roles() {
            try {
                return Object.keys(this.selectable_roles).length > 0;
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
            _.forEach(this.selectable_roles, (role_label, role_key) => {{
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
