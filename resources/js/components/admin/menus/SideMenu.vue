<template>
    <nav
        :key="url"
        class="side-menu"
        :class="{
            'side-menu-open': isMobileSideMenuOpen
        }"
    >
        <!-- Header -->
        <div class="relative">
            <div
                class="
                    absolute flex flex-row items-center justify-start
                    bottom-0 left-0 top-0
                    transition-default transition-colors
                    lg:hidden
                "
            >
                <button
                    class="menu-toggle"
                    type="button"
                    @click="hideMobileSideMenu"
                >
                    <icon-close />
                </button>
            </div>

            <inertia-link
                class="logo"
                :href="$route('admin.index')"
            >
                <logo-light class="mr-2 w-6"/>
                <span>SIGI</span>
            </inertia-link>
        </div>

        <div
            v-for="(menuSection, menuSectionKey) in visibleMenu"
            :key="menuSectionKey"
            class="menu-section"
        >
            <p
                v-if="menuSection.showLabel"
                class="menu-subheading"
            >
                {{ menuSection.label }}
            </p>

            <ul class="root-menu">
                <side-menu-item
                    v-for="(menuItem, menuItemKey) in menuSection.children"
                    :key="`${menuSectionKey}.${menuItemKey}`"
                    class="root-menu-item"
                    :menu-item="menuItem"
                    :menu-item-key="`${menuSectionKey}.${menuItemKey}`"
                    :toggled-items="toggledItems"
                    @openItem="onMenuItemOpened"
                    @toggleItem="onMenuItemToggled"
                />
            </ul>

            <div
                v-if="menuSectionKey !== lastMenuSection"
                 class="menu-separator"
            ></div>
        </div>
    </nav>
</template>

<script>

    import _ from 'lodash';
    import SideMenuItem from "./SideMenuItem";

    export default {
        name: "SideMenu",
        components: {SideMenuItem},
        props: {
            url: String,
        },
        data() {
            return {
                menu: {
                    main: {
                        children: {
                            dashboard: {
                                children: false,
                                icon: "icon-home",
                                label: "Dashboard",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: [],
                                route: "admin.index",
                            },
                        },
                        label: "Main",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: [],
                        showLabel: false,
                    },
                    cms: {
                        children : {
                            pages: {
                                activeRoutes: ["admin.cms.pages.index", "admin.cms.pages.create", "admin.cms.pages.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Pages",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.pages.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Page",
                                        requiresAllPermissions: ["cms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.pages.create",
                                    },
                                },
                                icon: "icon-layout-navbar",
                                label: "Pages",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                            layouts: {
                                activeRoutes: ["admin.cms.layouts.index", "admin.cms.layouts.create", "admin.cms.layouts.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Layouts",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.layouts.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Layout",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.layouts.create",
                                    },
                                },
                                icon: "icon-layout",
                                label: "Layouts",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                            templates: {
                                activeRoutes: ["admin.cms.templates.index", "admin.cms.templates.create", "admin.cms.templates.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Templates",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Template",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.create",
                                    },
                                },
                                icon: "icon-template",
                                label: "Templates",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                            menus: {
                                activeRoutes: ["admin.cms.menus.index", "admin.cms.menus.create", "admin.cms.menus.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Menus",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.menus.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Menu",
                                        requiresAllPermissions: ["cms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.menus.create",
                                    },
                                },
                                icon: "icon-columns",
                                label: "Menus",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                        },
                        label: "CMS",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["cms.edit", "cms.create", "cms.view"],
                        showLabel: true,
                    },
                    crm: {
                        children: {
                            forms: {
                                activeRoutes: ["admin.crm.forms.index", "admin.crm.forms.create", "admin.crm.forms.edit", "admin.crm.form-submissions.index", "admin.crm.form-submissions.show"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Forms",
                                        requiresAllPermissions: ["crm_forms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.forms.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Form",
                                        requiresAllPermissions: ["crm_forms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.forms.create",
                                    },
                                    submissions: {
                                        activeRoutes: ["admin.crm.form-submissions.index", "admin.crm.form-submissions.show"],
                                        icon: false,
                                        label: "View Form Submissions",
                                        requiresAllPermissions: ["crm_form_submissions.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.form-submissions.index",
                                    },
                                },
                                icon: "icon-forms",
                                label: "Forms",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_forms.create", "crm_forms.view"],
                            },
                            contacts: {
                                activeRoutes: ["admin.crm.contacts.index", "admin.crm.contacts.create", "admin.crm.contacts.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Contacts",
                                        requiresAllPermissions: ["crm_contacts.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.contacts.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Contact",
                                        requiresAllPermissions: ["crm_contacts.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.contacts.create",
                                    },
                                },
                                icon: "icon-id",
                                label: "Contacts",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_contacts.create", "crm_contacts.view"],
                            },
                            organisation_units: {
                                activeRoutes: ["admin.crm.organisation-units.index", "admin.crm.organisation-units.create", "admin.crm.organisation-units.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Units",
                                        requiresAllPermissions: ["crm_organisation_units.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.organisation-units.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Unit",
                                        requiresAllPermissions: ["crm_organisation_units.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.organisation-units.create",
                                    },
                                },
                                icon: "icon-building",
                                label: "Organisation Units",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_organisation_units.create", "crm_organisation_units.view"],
                            }
                        },
                        label: "CRM",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["crm_forms.create", "crm_forms.view", "crm_contacts.create", "crm_contacts.view", "crm_organisation_units.create", "crm_organisation_units.view"],
                        showLabel: true,
                    },
                    edu: {
                        children : {
                            course: {
                                children: false,
                                icon: "icon-folders",
                                label: "Courses",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["course.view"],
                                route: 'admin.course.index',
                            }
                        },
                        label: "Courses",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["course.view"],
                        showLabel: true,
                    },
                    utilities: {
                        children : {
                            file_manager: {
                                children: false,
                                icon: "icon-folders",
                                label: "File Manager",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["file_manager.view"],
                                route: 'admin.file_manager.index',
                            }
                        },
                        label: "Utilities",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["file_manager.view"],
                        showLabel: true,
                    },
                    settings: {
                        children : {
                            users: {
                                activeRoutes: ["admin.users.index", "admin.users.create", "admin.users.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Users",
                                        requiresAllPermissions: ["users.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create User",
                                        requiresAllPermissions: ["users.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.create",
                                    },
                                },
                                icon: "icon-users",
                                label: "Users",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["users.view", "users.create"],
                                route: false,
                            }
                        },
                        label: "Settings",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["users.view", "users.create"],
                        showLabel: true,
                    },
                },
                mountedItems: {},
                toggledItems: {}
            }
        },
        computed: {
            isMobileSideMenuOpen() {
                return this.$store.getters.isMobileSideMenuOpen;
            },
            lastMenuSection() {
                let keys = Object.keys(this.visibleMenu);
                return keys[keys.length - 1];
            },
            visibleMenu() {
                let visibleMenu = {};

                _.forEach(this.menu, (menuItem, key) => {
                    let item = this.getVisibleMenuWithChildren(menuItem);
                    if (item) {
                        visibleMenu[key] = item;
                    }
                });

                return visibleMenu;
            }
        },
        methods: {
            canViewMenu(menu) {
                // If there is a route, ensure it exists
                if (menu.route && menu.route.length && !this.$routeCheck(menu.route)) {
                    return false;
                }

                return this.userCanAny(menu.requiresAnyPermissions) && this.userCanAll(menu.requiresAllPermissions);
            },
            getVisibleMenuWithChildren(menu) {
                if (!menu) {
                    return false;
                }

                // Ensure the menu is valid and the user has permission to view it
                if (!this.canViewMenu(menu)) {
                    return false;
                }

                // If the menu has no children and the user has permission to view it, then show it
                if (!menu.children) {
                    return menu;
                }

                // Menu has children so only show visible children
                let visibleMenu = _.cloneDeep(menu);
                visibleMenu.children = {};

                _.forEach(menu.children, (child, key) => {
                    child = this.getVisibleMenuWithChildren(child);

                    if (child) {
                        visibleMenu.children[key] = child;
                    }
                });

                return visibleMenu;
            },
            hideMobileSideMenu() {
                this.$store.commit('hideMobileSideMenu');
            },
            onMenuItemOpened(itemKey) {
                this.$set(this.toggledItems, itemKey, true);
            },
            onMenuItemToggled(itemKey) {
                if (this.toggledItems[itemKey]) {
                    this.$set(this.toggledItems, itemKey, false);
                } else {
                    this.$set(this.toggledItems, itemKey, true);
                }
            },
        }
    }
</script>
