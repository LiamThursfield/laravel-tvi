<template>
    <div class="auth-card-container">
        <div
            class="auth-card"
        >
            <h1
                class="auth-header"
            >
                Password Reset
            </h1>

            <p
                v-if="$page.props.flash.status"
                class="pb-8 px-6 text-center text-green-700"
            >
                {{ $page.props.flash.status }}
            </p>

            <form
                v-else
                class="px-6"
                @submit.prevent="submit"
            >

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
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>

        <div class="flex justify-between mt-4">
            <inertia-link
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-theme-base-subtle-contrast
                "
                :href="$route('login')"
            >
                Login
            </inertia-link>

            <inertia-link
                v-if="$routeCheck('register')"
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-theme-base-subtle-contrast
                "
                :href="$route('register')"
            >
                Register
            </inertia-link>
        </div>

    </div>
</template>

<script>
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AuthPasswordEmail",
        components: {InputGroup},
        layout: 'auth-layout',
        data() {
            return {
                form: {
                    email: '',
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(
                    this.$route('password.email'),
                    this.form
                );
            }
        }
    }
</script>
