<template>
    <div class="auth-card-container">
        <div
            class="auth-card"
        >
            <h1
                class="auth-header"
            >
                Welcome
            </h1>


            <form
                class="px-6"
                @submit.prevent="submit"
            >
                <div
                    class="
                        flex flex-col
                        md:flex-row md:space-x-2
                    "
                >
                    <input-group
                        class="mt-4"
                        :error-message="getPageErrorMessage('first_name')"
                        input-autocomplete="given-name"
                        :input-autofocus="true"
                        input-class="auth-input"
                        input-id="first_name"
                        input-name="first_name"
                        :input-required="true"
                        input-type="first_name"
                        label-text="First Name"
                        @errorHidden="clearPageErrorMessage('first_name')"
                        v-model="form.first_name"
                    />

                    <input-group
                        class="mt-4"
                        :error-message="getPageErrorMessage('last_name')"
                        input-autocomplete="family-name"
                        input-class="auth-input"
                        input-id="last_name"
                        input-name="last_name"
                        :input-required="true"
                        input-type="last_name"
                        label-text="Last Name"
                        @errorHidden="clearPageErrorMessage('last_name')"
                        v-model="form.last_name"
                    />
                </div>

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    input-autocomplete="email"
                    input-class="auth-input"
                    input-id="email"
                    input-name="email"
                    :input-required="true"
                    input-type="email"
                    label-text="Email"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="form.email"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('password')"
                    input-autocomplete="new-password"
                    input-class="auth-input"
                    input-id="password"
                    input-name="password"
                    :input-required="true"
                    input-type="password"
                    label-text="Password"
                    @errorHidden="clearPageErrorMessage('password')"
                    v-model="form.password"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('password_confirmation')"
                    input-autocomplete="new-password"
                    input-class="auth-input"
                    input-id="password_confirmation"
                    input-name="password_confirmation"
                    :input-required="true"
                    input-type="password"
                    label-text="Confirm Password"
                    @errorHidden="clearPageErrorMessage('password_confirmation')"
                    v-model="form.password_confirmation"
                />

                <div class="flex flex-row items-center justify-between mt-4 py-6">
                    <button
                        class="
                            bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-primary-hover hover:shadow-lg
                            transition-all ease-in-out duration-300
                        "
                        type="submit"
                    >
                        Register
                    </button>

                    <inertia-link
                        class="
                            text-gray-900
                            hover:text-theme-primary
                            transition-all ease-in-out duration-300
                        "
                        :href="$route('login')"
                    >
                        Already registered?
                    </inertia-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import InputGroup from "../../components/core/forms/InputGroup";

    export default {
        name: "AuthRegister",
        components: {InputGroup},
        layout: 'auth-layout',
        data() {
            return {
                form: {
                    email: '',
                    first_name: '',
                    last_name: '',
                    password: '',
                    password_confirmation: '',
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(
                    this.$route('register'),
                    this.form
                );
            }
        }
    }
</script>
