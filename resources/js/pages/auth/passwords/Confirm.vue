<template>
    <div class="auth-card-container">
        <div
            class="auth-card"
        >
            <h1
                class="auth-header"
            >
                Confirm Password
            </h1>

            <form
                class="px-6"
                @submit.prevent="submit"
            >

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
                        Confirm Password
                    </button>
                </div>
            </form>
        </div>

        <div class="flex justify-end mt-4">
            <inertia-link
                v-if="$routeCheck('password.request')"
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-theme-base-subtle-contrast
                "
                :href="$route('password.request')"
            >
                Forgot Your Password?
            </inertia-link>
        </div>

    </div>
</template>

<script>
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AuthPasswordConfirm",
        components: {InputGroup},
        layout: 'auth-layout',
        data() {
            return {
                form: {
                    password: '',
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(
                    this.$route('password.confirm'),
                    this.form
                );
            }
        }
    }
</script>
