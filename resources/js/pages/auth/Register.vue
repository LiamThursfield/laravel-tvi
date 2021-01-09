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
                        :errorMessage="getPageErrorMessage('first_name')"
                        inputAutocomplete="given-name"
                        :inputAutofocus="true"
                        inputClass="auth-input"
                        inputId="first_name"
                        inputName="first_name"
                        :inputRequired="true"
                        inputType="first_name"
                        labelText="First Name"
                        v-model="form.first_name"
                    />

                    <input-group
                        class="mt-4"
                        :errorMessage="getPageErrorMessage('last_name')"
                        inputAutocomplete="family-name"
                        inputClass="auth-input"
                        inputId="last_name"
                        inputName="last_name"
                        :inputRequired="true"
                        inputType="last_name"
                        labelText="Last Name"
                        v-model="form.last_name"
                    />
                </div>

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('email')"
                    inputAutocomplete="email"
                    inputClass="auth-input"
                    inputId="email"
                    inputName="email"
                    :inputRequired="true"
                    inputType="email"
                    labelText="Email"
                    v-model="form.email"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('password')"
                    inputAutocomplete="new-password"
                    inputClass="auth-input"
                    inputId="password"
                    inputName="password"
                    :inputRequired="true"
                    inputType="password"
                    labelText="Password"
                    v-model="form.password"
                />

                <input-group
                    class="mt-4"
                    :errorMessage="getPageErrorMessage('password_confirmation')"
                    inputAutocomplete="new-password"
                    inputClass="auth-input"
                    inputId="password_confirmation"
                    inputName="password_confirmation"
                    :inputRequired="true"
                    inputType="password"
                    labelText="Confirm Password"
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
