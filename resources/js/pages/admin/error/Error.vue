<template>
    <section class="flex flex-col items-center justify-center p-6 h-full">
        <div>
            <h1
                class="font-black text-7xl text-center"
                :class="errorTitleCase"
            >
                {{ isAllowedError ? status : 'Error' }}
            </h1>

            <p class="font-semibold mt-4 max-w-full text-center text-theme-base-subtle-contrast text-lg w-72">
                {{ errorDescription }}
            </p>
        </div>
    </section>
</template>

<script>

    export default {
        name: "AdminError",
        layout: 'admin-layout',
        props: {
            status: {
                required: true,
                type: Number,
            },
        },
        computed: {
            errorDescription() {
                if (!this.isAllowedError) {
                    return 'Whoops, something went wrong on our servers. We are looking into it.'
                }

                return {
                    403: 'Sorry, you are forbidden from accessing this page.',
                    404: 'Sorry, the page you are looking for could not be found.',
                    500: 'Whoops, something went wrong on our servers. We are looking into it.',
                    503: 'Sorry, we are doing some maintenance. Please check back soon.',
                }[this.status]
            },
            errorTitleCase() {
                if (!this.isAllowedError) {
                    return 'text-theme-danger-contrast';
                }

                return {
                    403: 'text-theme-warning-contrast',
                    404: 'text-theme-info-contrast',
                    500: 'text-theme-danger-contrast',
                    503: 'text-theme-primary',
                }[this.status];
            },
            isAllowedError() {
                let allowed_errors = [403, 404, 500, 503];
                return allowed_errors.indexOf(this.status) >= 0;
            }
        }
    }
</script>
