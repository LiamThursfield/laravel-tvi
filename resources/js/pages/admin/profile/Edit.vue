<template>
    <form
        class="max-w-5xl mx-auto"
        @submit.prevent="submit"
    >
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
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
                    input-autocomplete="new_email"
                    input-id="email"
                    input-name="email"
                    :input-required="true"
                    input-type="email"
                    label-text="Email"
                    @errorHidden="clearPageErrorMessage('email')"
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
