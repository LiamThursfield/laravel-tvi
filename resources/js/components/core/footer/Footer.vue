<template>
    <section>
        <footer
            class="bg-neutral-200 text-center dark:bg-neutral-700 lg:text-left">
            <div
                class="p-4 text-center"
                :class="getClassValue"
            >
                {{ year + ' ' + tenantName }} © Copyright. Powered by
                <a
                    class="underline font-semibold"
                    :class="getLinkClassValue"
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
            classValue: {
                type: String,
                required: false,
            },
            linkClassValue: {
                type: String,
                required: false,
            }
        },
        computed: {
            year() {
                return dayjs().year();
            },
            getClassValue() {
                return this.classValue ? this.classValue : ' text-neutral-700 dark:text-neutral-200';
            },
            getLinkClassValue() {
                return this.linkClassValue ? this.linkClassValue : 'text-blue-900';
            }
        },
    }
</script>
