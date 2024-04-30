<template>
    <main class="bg-theme-base px-4 text-theme-base-contrast">
        <div
            class="prose"
            v-html="mainContent"
        />
    </main>
</template>

<script>
    import { pageWithMetaMixin } from "../../mixins/website/page-with-meta";

    export default {
        name: "BasicPage",
        mixins: [
            pageWithMetaMixin
        ],
        props: {
            page: {
                required: true,
                type: Object
            }
        },
        computed: {
            mainContent() {
                return this.getContentFieldData('main-content');
            }
        }
    }
</script>
