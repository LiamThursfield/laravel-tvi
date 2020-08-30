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
                v-if="$page.flash.status"
                class="pb-8 px-6 text-center text-green-700"
            >
                {{ $page.flash.status }}
            </p>

            <form
                v-else
                class="px-6"
                @submit.prevent="submit"
            >

                <input-group
                    class="mt-4"
                    :error_message="$page.errors.email ? $page.errors.email[0] : ''"
                    input_autocomplete="email"
                    input_id="email"
                    input_name="email"
                    :input_required="true"
                    input_type="email"
                    label_text="Email"
                    v-model="form.email"
                />

                <div class="flex flex-row items-center justify-between mt-4 py-6">
                    <button
                        class="
                            bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast
                            focus:outline-none focus:shadow-outline-primary
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
                    hover:text-gray-500
                "
                :href="$route('login')"
            >
                Login
            </inertia-link>

            <inertia-link
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-gray-500
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
        name: "AuthPassowrdEmail",
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
