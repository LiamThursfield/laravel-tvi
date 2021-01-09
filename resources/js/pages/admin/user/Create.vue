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
                    :errorMessage="getPageErrorMessage('first_name')"
                    inputAutocomplete="first_name"
                    :inputAutofocus="true"
                    inputId="first_name"
                    inputName="first_name"
                    :inputRequired="true"
                    inputType="text"
                    labelText="First Name"
                    v-model="formData.first_name"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('last_name')"
                    inputAutocomplete="last_name"
                    inputId="last_name"
                    inputName="last_name"
                    :inputRequired="true"
                    inputType="text"
                    labelText="Last Name"
                    v-model="formData.last_name"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('email')"
                    inputAutocomplete="off"
                    inputId="email"
                    inputName="email"
                    :inputRequired="true"
                    inputType="email"
                    labelText="Email"
                    v-model="formData.email"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('password')"
                    inputAutocomplete="off"
                    inputId="password"
                    inputName="password"
                    :inputRequired="true"
                    inputType="password"
                    labelText="Password"
                    v-model="formData.password"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('password_confirmation')"
                    inputAutocomplete="off"
                    inputId="password_confirmation"
                    inputName="password_confirmation"
                    :inputRequired="true"
                    inputType="password"
                    labelText="Confirm Password"
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
                        :checkboxId="`user-role-${role_key}`"
                        :checkboxName="`user-role-${role_key}`"
                        :labelText="role_label"
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
