<template>
    <div class="auth-card-container">
        <div
            class="auth-card"
        >
            <h1
                class="auth-header"
            >
                Welcome back
            </h1>

            <form
                class="px-6"
                @submit.prevent="submit"
            >
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    input-autocomplete="email"
                    :input-autofocus="true"
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
                    input-autocomplete="current-password"
                    input-class="auth-input"
                    input-id="password"
                    input-name="password"
                    :input-required="true"
                    input-type="password"
                    label-text="Password"
                    @errorHidden="clearPageErrorMessage('password')"
                    v-model="form.password"
                />

                <div class="mt-6">
                    <label class="cursor-pointer flex font-medium inline-block items-center text-theme-base-contrast">
                        <input
                            id="remember"
                            class="
                                leading-tight mr-2 rounded
                                focus:outline-none focus:ring focus:ring-primary
                            "
                            name="remember"
                            type="checkbox"
                            v-model="form.remember"
                        >
                        <span class="select-none text-sm">
                            Remember Me
                          </span>
                    </label>
                </div>

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
                        Sign In
                    </button>

                    <inertia-link
                        class="
                            text-gray-900
                            hover:text-theme-primary
                            transition-all ease-in-out duration-300
                        "
                        :href="$route('password.request')"
                    >
                        Forgot Password?
                    </inertia-link>
                </div>
            </form>
        </div>

        <div class="flex justify-end mt-4">
            <inertia-link
                v-if="$routeCheck('register')"
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-theme-base-subtle-contrast
                "
                :href="$route('register')"
            >
                Create a new account
            </inertia-link>
        </div>
    </div>
</template>

<script>
    import InputGroup from "../../components/core/forms/InputGroup";

    export default {
        name: "AuthLogin",
        components: {InputGroup},
        layout: 'auth-layout',
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    remember: null
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(
                    this.$route('login'),
                    this.form
                );
            }
        }
    }
</script>
