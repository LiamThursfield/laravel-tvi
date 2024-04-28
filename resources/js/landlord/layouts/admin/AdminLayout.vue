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
        </main>
    </div>
</template>

<script>
    import { router } from '@inertiajs/vue2'

    import PageAlerts from "../../../components/core/alerts/PageAlerts.vue";

    export default {
        name: "AdminLayout",
        components: {
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
                                icon: "icon-home",
                                label: "Dashboard",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: [],
                                route: "landlord.admin.index",
                            },
                        },
                        label: "Main",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: [],
                        showLabel: false,
                    },
                    admin: {
                        children : {
                            tenants: {
                                activeRoutes: ["landlord.admin.tenants.index", "landlord.admin.tenants.create", "landlord.admin.tenants.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Tenants",
                                        requiresAllPermissions: ["tenants.view"],
                                        requiresAnyPermissions: [],
                                        route: "landlord.admin.tenants.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Tenant",
                                        requiresAllPermissions: ["tenants.create"],
                                        requiresAnyPermissions: [],
                                        route: "landlord.admin.tenants.create",
                                    },
                                },
                                icon: "icon-app-window",
                                label: "Tenants",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["tenants.view", "tenants.create"],
                                route: false,
                            },
                            users: {
                                activeRoutes: ["landlord.admin.users.index", "landlord.admin.users.create", "landlord.admin.users.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Users",
                                        requiresAllPermissions: ["users.view"],
                                        requiresAnyPermissions: [],
                                        route: "landlord.admin.users.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create User",
                                        requiresAllPermissions: ["users.create"],
                                        requiresAnyPermissions: [],
                                        route: "landlord.admin.users.create",
                                    },
                                },
                                icon: "icon-users",
                                label: "Users",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["users.view", "users.create"],
                                route: false,
                            },
                        },
                        label: "Admin",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["users.view", "users.create", "tenants.view", "tenants.create"],
                        showLabel: true,
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
