<template>
    <div class="auth-card-container">
        <div
            class="auth-card pb-8"
        >
            <h1
                class="auth-header"
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
                        cursor-pointer text-theme-primary
                        hover:underline
                    "
                    as="button"
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
                    hover:text-theme-base-subtle-contrast
                "
                as="button"
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
