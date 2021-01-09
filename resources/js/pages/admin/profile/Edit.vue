<template>
    <form
        class="max-w-5xl mx-auto"
        @submit.prevent="submit"
    >
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
                Edit Profile
            </h1>
            <inertia-link
                v-if="userCan('profile.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.profile.index')"
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
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Save Changes
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
                    inputAutocomplete="new_email"
                    inputId="email"
                    inputName="email"
                    :inputRequired="true"
                    inputType="email"
                    labelText="Email"
                    v-model="formData.email"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AdminProfileIndex",
        layout: 'admin-layout',
        components: {InputGroup},
        props: {
            auth: Object,
            profile: Object,
        },
        data() {
            return {
                formData: {
                    email: null,
                    first_name: null,
                    last_name: null,
                }
            }
        },
        mounted() {
            this.formData.email = this.profile.email;
            this.formData.first_name = this.profile.first_name;
            this.formData.last_name = this.profile.last_name;
        },
        methods: {
            submit() {
                this.$inertia.put(this.$route('admin.profile.update'), this.formData);
            }
        }
    }
</script>
