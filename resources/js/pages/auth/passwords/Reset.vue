<template>
    <div class="max-w-md w-full">
        <div
            class="bg-gray-200 rounded-md shadow-md"
        >
            <h1
                class="font-bold pb-6 pt-8 px-6 text-center text-gray-700 text-2xl tracking-wide"
            >
                Password Reset
            </h1>

            <form
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

                <input-group
                    class="mt-4"
                    :error_message="$page.errors.password ? $page.errors.password[0] : ''"
                    input_autocomplete="new-password"
                    :input_autofocus="true"
                    input_id="password"
                    input_name="password"
                    :input_required="true"
                    input_type="password"
                    label_text="Password"
                    v-model="form.password"
                />

                <input-group
                    class="mt-4"
                    :error_message="$page.errors.password_confirmation ? $page.errors.password_confirmation[0] : ''"
                    input_autocomplete="new-password"
                    input_id="password_confirmation"
                    input_name="password_confirmation"
                    :input_required="true"
                    input_type="password"
                    label_text="Confirm Password"
                    v-model="form.password_confirmation"
                />

                <div class="flex flex-row items-center justify-between mt-4 py-6">
                    <button
                        class="
                            bg-indigo-600 px-4 py-2 rounded shadow text-white
                            focus:outline-none focus:shadow-outline-indigo
                            hover:bg-indigo-700 hover:shadow-lg
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
        name: "Login",
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
                    this.$route('password.update'),
                    this.form
                );
            }
        }
    }
</script>
