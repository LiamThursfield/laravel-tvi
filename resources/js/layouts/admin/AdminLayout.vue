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
    </main>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia'

    import PageAlerts from "../../components/core/alerts/PageAlerts";

    export default {
        name: "AdminLayout",
        components: {PageAlerts},
        mounted() {
            Inertia.on('success', event => {
                this.hideMobileSideMenu();
            })
        },
        methods: {
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
