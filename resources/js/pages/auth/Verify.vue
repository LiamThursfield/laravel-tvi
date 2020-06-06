<template>
    <div class="max-w-md w-full">
        <div
            class="bg-gray-200 py-8 rounded-md shadow-md"
        >
            <h1
                class="font-bold pb-6 px-6 text-center text-gray-700 text-2xl tracking-wide"
            >
                Verify Your Email Address
            </h1>

            <p
                v-if="resent"
                class="pb-8 px-6 text-center text-green-700"
            >
                A fresh verification link has been sent to your email address.
            </p>

            <p class="mb-4 px-6 text-center">
                Before proceeding, please check your email for a verification link.
            </p>

            <p class="px-6 text-center">
                If you did not receive the email
                <br>
                <inertia-link
                    class="
                        cursor-pointer text-indigo-600
                        hover:underline
                    "
                    :href="$route('verification.resend')"
                    method="post"
                >
                    click here to request another
                </inertia-link>
            </p>
        </div>

        <div class="flex justify-end mt-4">
            <inertia-link
                class="
                    text-gray-300 text-sm tracking-wide
                    hover:text-gray-500
                "
                :href="$route('logout')"
                method="post"
            >
                Logout
            </inertia-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AuthVerify",
        layout: 'auth-layout',
        props: {
            resent: {
                default: false,
                type: Boolean
            }
        },
    }
</script>
