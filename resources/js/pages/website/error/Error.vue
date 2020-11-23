<template>
    <section class="flex flex-col items-center justify-center h-full min-h-screen p-6">
        <div class="text-center">
            <h1
                class="font-black text-7xl text-center"
                :class="error_title_class"
            >
                {{ is_allowed_error ? status : 'Error' }}
            </h1>

            <p class="font-semibold mt-4 max-w-full text-center text-theme-base-subtle-contrast text-lg w-72">
                {{ error_description }}
            </p>

            <inertia-link
                v-if="status !== 503"
                class="
                    button
                    font-semibold inline-block mt-8 mx-auto px-12 text-lg
                "
                :class="error_button_class"
                href="/"
            >
                Go Home
            </inertia-link>
        </div>
    </section>
</template>

<script>

    export default {
        name: "WebsiteError",
        layout: 'website-layout',
        props: {
            status: {
                required: true,
                type: Number,
            },
        },
        computed: {
            error_button_class() {
                if (!this.is_allowed_error) {
                    return 'bg-theme-danger text-theme-danger-contrast hover:bg-theme-danger-contrast hover:text-theme-danger';
                }

                return {
                    403: 'bg-theme-warning text-theme-warning-contrast hover:bg-theme-warning-contrast hover:text-theme-warning',
                    404: 'bg-theme-info text-theme-info-contrast hover:bg-theme-info-contrast hover:text-theme-info',
                    500: 'bg-theme-danger text-theme-danger-contrast hover:bg-theme-danger-contrast hover:text-theme-danger',
                }[this.status];
            },
            error_description() {
                if (!this.is_allowed_error) {
                    return 'Whoops, something went wrong on our servers. We are looking into it.'
                }

                return {
                    403: 'Sorry, you are forbidden from accessing this page.',
                    404: 'Sorry, the page you are looking for could not be found.',
                    500: 'Whoops, something went wrong on our servers. We are looking into it.',
                    503: 'Sorry, we are doing some maintenance. Please check back soon.',
                }[this.status]
            },
            error_title_class() {
                if (!this.is_allowed_error) {
                    return 'text-theme-danger-contrast';
                }

                return {
                    403: 'text-theme-warning-contrast',
                    404: 'text-theme-info-contrast',
                    500: 'text-theme-danger-contrast',
                    503: 'text-theme-primary',
                }[this.status];
            },
            is_allowed_error() {
                let allowed_errors = [403, 404, 500, 503];
                return allowed_errors.indexOf(this.status) >= 0;
            }
        }
    }
</script>
