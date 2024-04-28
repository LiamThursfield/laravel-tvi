<template>
    <div>
        <main
            id="website-layout"
            class="bg-white"
        >
            <header-menu />

            <slot />

            <div class="mt-20 text-center">
                Copyright © {{ (new Date().getFullYear()) }} SIGI
            </div>
        </main>
    </div>
</template>

<script>
    import HeaderMenu from "../../components/website/menus/HeaderMenu.vue";

    export default {
        name: "LandlordWebsiteLayout",
        components: {HeaderMenu},
        metaInfo() {
            return {
                title: this.metaTitle,
                meta: [
                    {
                        name: 'description',
                        content: this.metaDescription,
                    }
                ]
            }
        },
        computed: {
            metaDescription() {
                return this.getMetaDataField(
                    'description',
                    'SIGI - powering your online presence'
                );
            },
            metaTitle() {
                return this.getMetaDataField(
                    'title',
                    'SIGI'
                );
            },
            metaTenantName() {
                return this.getMetaDataField(
                    'tenant',
                    'SIGI'
                );
            }
        },
        methods: {
            getMetaDataField(slug, fallback = '') {
                try {
                    return this.$page.props.meta[slug] ?? fallback;
                } catch (e) {
                    return fallback;
                }
            }
        }
    }
</script>
