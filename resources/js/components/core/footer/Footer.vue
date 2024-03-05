<template>
    <section>
        <footer
            class="bg-neutral-200 text-center dark:bg-neutral-700 lg:text-left">
            <div class="p-4 text-center text-neutral-700 dark:text-neutral-200">
                {{ year + ' ' + tenantName }} © Copyright. Powered by
                <a
                    class="text-blue-900 underline font-semibold"
                    href="https://sigi.ro/"
                >
                    SIGI
                </a>
            </div>
        </footer>
    </section>
</template>
<script>
    import dayjs from "dayjs";
    export default {
        name: "TenantFooter",
        props: {
            tenantName: {
                type: String,
                required: false,
            },
        },
        computed: {
            year() {
                return dayjs().year();
            }
        },
    }
</script>
