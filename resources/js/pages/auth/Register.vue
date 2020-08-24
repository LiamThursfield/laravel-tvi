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
                        :error_message="$page.errors.first_name ? $page.errors.first_name[0] : ''"
                        input_autocomplete="given-name"
                        :input_autofocus="true"
                        input_id="first_name"
                        input_name="first_name"
                        :input_required="true"
                        input_type="first_name"
                        label_text="First Name"
                        v-model="form.first_name"
                    />

                    <input-group
                        class="mt-4"
                        :error_message="$page.errors.last_name ? $page.errors.last_name[0] : ''"
                        input_autocomplete="family-name"
                        input_id="last_name"
                        input_name="last_name"
                        :input_required="true"
                        input_type="last_name"
                        label_text="Last Name"
                        v-model="form.last_name"
                    />
                </div>

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
                            bg-theme-primary px-4 py-2 rounded shadow text-theme-primary-contrast
                            focus:outline-none focus:shadow-outline-primary
                            hover:bg-cyan-800 hover:shadow-lg
                            transition-all ease-in-out duration-300
                        "
                        type="submit"
                    >
                        Register
                    </button>

                    <inertia-link
                        class="
                            text-gray-900
                            hover:text-cyan-500
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
