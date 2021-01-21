<template>
    <main
        id="admin-layout"
        class="flex min-h-screen"
    >
        <side-menu
            :url="url()"
        />

        <div class="flex flex-1 flex-col max-w-full">
            <top-menu />

            <page-alerts />

            <div class="bg-theme-base flex-1 p-8">
                <slot/>
            </div>
        </div>


        <!-- Singleton Modals -->
        <file-manager-modal class="z-30" />
    </main>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia'

    import FileManagerModal from "../../components/admin/modals/FileManagerModal";
    import PageAlerts from "../../components/core/alerts/PageAlerts";

    export default {
        name: "AdminLayout",
        components: {
            FileManagerModal,
            PageAlerts
        },
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
                    'Laravel TVI - A CMS powered by Laravel, Tailwind, Vue, and Inertia'
                );
            },
            metaTitle() {
                return this.getMetaDataField(
                    'title',
                    'Laravel TVI'
                );
            }
        },
        mounted() {
            Inertia.on('success', event => {
                this.hideMobileSideMenu();
            })
        },
        methods: {
            getMetaDataField(slug, fallback = '') {
                try {
                    return this.$page.props.meta[slug] ?? fallback;
                } catch (e) {
                    console.log(e);
                    return fallback;
                }
            },
            url() {
                return location.pathname.substr(1)
            },
            hideMobileSideMenu() {
                if (this.$store.state.isMobileSideMenuOpen) {
                    this.$store.commit('hideMobileSideMenu');
                }
            },
        }
    }
</script>
