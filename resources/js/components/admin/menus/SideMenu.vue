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
                    absolute flex flex-row items-center inset-0 justify-start
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
                TVI
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
                    :menuItem="menuItem"
                    :menuItemKey="`${menuSectionKey}.${menuItemKey}`"
                    :toggledItems="toggledItems"
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
                                requiresAnyPermissions: [],
                                requiresAllPermissions: [],
                                route: "admin.index",
                            },
                        },
                        label: "Main",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: [],
                        showLabel: false,
                    },
                    settings: {
                        children : {
                            users: {
                                activeRoutes: ["admin.users.index", "admin.users.create"],
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
                                icon: "icon-home",
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
                return this.userCanAny(menu.requiresAnyPermissions) && this.userCanAll(menu.requiresAllPermissions);
            },
            getVisibleMenuWithChildren(menu) {
                if (!menu) {
                    return false;
                }

                // Ensure the user has permission to view the current menu
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
