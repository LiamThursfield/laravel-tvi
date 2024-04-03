<template>
    <div class="auth-card-container">
        <div
            class="auth-card"
        >
            <h1
                class="auth-header"
            >
                {{ __('messages.password-reset') }}
            </h1>

            <form
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
                    :label-text="__('messages.email')"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="form.email"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('password')"
                    input-autocomplete="new-password"
                    :input-autofocus="true"
                    input-class="auth-input"
                    input-id="password"
                    input-name="password"
                    :input-required="true"
                    input-type="password"
                    :label-text="__('messages.password')"
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
                    :label-text="__('messages.confirm-password')"
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
                        {{ __('messages.password-reset') }}
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
                :href="$route('student.login')"
            >
                {{ __('messages.login') }}
            </inertia-link>

            <inertia-link
                v-if="$routeCheck('student.register')"
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-theme-base-subtle-contrast
                "
                :href="$route('student.register')"
            >
                {{ __('messages.register') }}
            </inertia-link>
        </div>

    </div>
</template>

<script>
    import InputGroup from "../../../../components/core/forms/InputGroup.vue";

    export default {
        name: "StudentAuthPasswordReset",
        components: {InputGroup},
        layout: 'auth-layout',
        props: {
            email: {
                default: '',
                type: String
            },
            token: {
                default: '',
                type: String
            }
        },
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    token: '',
                }
            }
        },
        mounted() {
            this.form.email = this.email;
            this.form.token = this.token;
        },
        methods: {
            submit() {
                this.$inertia.post(
                    this.$route('student.password.update'),
                    this.form
                );
            }
        }
    }
</script>
