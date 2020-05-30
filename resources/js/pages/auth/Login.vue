<template>
    <div class="max-w-md w-full">
        <div
            class="bg-gray-200 rounded-md shadow-md"
        >
            <h1
                class="font-bold pb-6 pt-8 px-6 text-center text-gray-700 text-2xl tracking-wide"
            >
                Welcome back
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
                    input_type="email"
                    label_text="Email"
                    v-model="form.email"
                />

                <input-group
                    class="mt-4"
                    :error_message="$page.errors.password ? $page.errors.password[0] : ''"
                    input_autocomplete="current-password"
                    input_id="password"
                    input_name="password"
                    input_type="password"
                    label_text="Password"
                    v-model="form.email"
                />

                <div class="mt-6">
                    <label class="cursor-pointer flex font-bold inline-block items-center text-gray-700">
                        <input
                            id="remember"
                            class="
                                leading-tight mr-2
                                focus:outline-none focus:shadow-outline-indigo
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
                            bg-indigo-600 px-4 py-2 rounded shadow text-white
                            focus:outline-none focus:shadow-outline-indigo
                            hover:bg-indigo-700 hover:shadow-lg
                            transition-all ease-in-out duration-300
                        "
                        type="submit"
                    >
                        Sign In
                    </button>

                    <a
                        class="
                            text-gray-900
                            hover:text-indigo-600
                            transition-all ease-in-out duration-300
                        "
                        href="/password/reset"
                    >
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>

        <div class="flex justify-end mt-4">
            <a
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-gray-500
                "
                href="/register"
            >
                Create a new account
            </a>
        </div>
    </div>
</template>

<script>
    import InputGroup from "../../components/core/forms/InputGroup";

    export default {
        name: "Login",
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
