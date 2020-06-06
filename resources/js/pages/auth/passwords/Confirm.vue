<template>
    <div class="max-w-md w-full">
        <div
            class="bg-gray-200 rounded-md shadow-md"
        >
            <h1
                class="font-bold pb-6 pt-8 px-6 text-center text-gray-700 text-2xl tracking-wide"
            >
                Confirm Password
            </h1>

            <form
                class="px-6"
                @submit.prevent="submit"
            >

                <input-group
                    class="mt-4"
                    :error_message="$page.errors.password ? $page.errors.password[0] : ''"
                    input_autocomplete="current-password"
                    input_id="password"
                    input_name="password"
                    :input_required="true"
                    input_type="password"
                    label_text="Password"
                    v-model="form.password"
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
                    hover:text-gray-500
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
