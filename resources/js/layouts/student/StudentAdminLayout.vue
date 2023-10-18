<template>
    <div>
        <main
            id="admin-layout"
            class="flex min-h-screen"
        >
            <side-menu
                :url="url()"
                :menu="sideMenu"
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
    </div>
</template>

<script>
import { router } from '@inertiajs/vue2'

import FileManagerModal from "../../components/admin/modals/FileManagerModal";
import PageAlerts from "../../components/core/alerts/PageAlerts";

export default {
    name: "StudentAdminLayout",
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
    data() {
        return {
            sideMenu: {
                main: {
                    children: {
                        dashboard: {
                            children: false,
                            icon: "icon-chalkboard",
                            label: "Courses",
                            requiresAllPermissions: [],
                            requiresAnyPermissions: [],
                            route: "student.admin.index",
                        },
                    },
                    label: "Main",
                    requiresAllPermissions: [],
                    requiresAnyPermissions: [],
                    showLabel: false,
                },
            },
        }
    },
    computed: {
        metaDescription() {
            return this.getMetaDataField(
                'description',
                'SIGI - powered by Laravel, Tailwind, Vue, and Inertia'
            );
        },
        metaTitle() {
            return this.getMetaDataField(
                'title',
                'SIGI'
            );
        }
    },
    mounted() {
        router.on('success', event => {
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
