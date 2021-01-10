<template>
    <li
        class="menu-item"
        :class="`menu-item-level-${menuItemLevel}`"
    >
        <button
            v-if="hasChildren"
            class="menu-link-parent"
            :class="{
                'menu-link-active': isActive,
                'toggled': isToggled,
            }"
            @click="toggleItem(menuItemKey)"
        >
            <component
                v-if="menuItem.icon"
                :is="menuItem.icon"
                class="h-5 w-5"
            />

            <div
                v-else
                class="h-5 w-5"
            ></div>

            <span class="ml-2">
                {{ menuItem.label }}
            </span>

            <icon-chevron-right class="indicator h-5 w-5" />
        </button>

        <inertia-link
            v-else-if="routeHref"
            class="menu-link"
            :class="{'menu-link-active': isActive}"
            :href="routeHref"
            :preserve-state="preserveState"
        >
            <component
                v-if="menuItem.icon"
                :is="menuItem.icon"
                class="h-5 w-5"
            />

            <div
                v-else
                class="h-5 w-5"
            ></div>

            <span class="ml-2">
                {{ menuItem.label }}
            </span>
        </inertia-link>


        <template v-show="hasChildren">
            <collapse-transition dimension="height">
                <ul
                    v-show="isToggled"
                    class="sub-menu"
                >
                    <side-menu-item
                        v-for="(child, key) in menuItem.children"
                        :key="`${menuItemKey}.${key}`"
                        class="sub-menu-item"
                        :menu-item="child"
                        :menu-item-key="`${menuItemKey}.${key}`"
                        :menu-item-level="menuItemLevel + 1"
                        :toggled-items="toggledItems"
                        @openItem="onChildOpened"
                        @toggleItem="onChildToggled"
                    />
                </ul>
            </collapse-transition>
        </template>
    </li>
</template>

<script>
    import CollapseTransition from '@ivanv/vue-collapse-transition';
    import _ from 'lodash';

    export default {
        name: "SideMenuItem",
        components: {
            'collapse-transition': CollapseTransition
        },
        props: {
            menuItem: {
                type: Object,
                required: true,
            },
            menuItemKey: {
                type: String,
                required: true,
            },
            menuItemLevel: {
                type: Number,
                default: 1
            },
            toggledItems: {
                type: Object,
                default: () => { return {}; }
            }
        },
        computed: {
            hasChildren() {
                if (!this.menuItem.children) {
                    return false;
                }

                return Object.keys(this.menuItem.children).length > 0;
            },
            isActive() {
                let activeRoutes = [];

                if (this.menuItem.activeRoutes) {
                    if (Array.isArray(this.menuItem.activeRoutes)) {
                        activeRoutes = _.clone(this.menuItem.activeRoutes);
                    } else {
                        activeRoutes.push(this.menuItem.activeRoutes);
                    }
                }

                if (this.menuItem.route) {
                    activeRoutes.push(this.menuItem.route);
                }

                let isActive = false;
                _.forEach(activeRoutes, route => {
                    if (this.$routeCurrent(route)) {
                        isActive = true;
                    }
                });

                return isActive;
            },
            isToggled() {
                return !!this.toggledItems[this.menuItemKey];
            },
            routeHref() {
                try {
                    return this.$route(this.menuItem.route);
                } catch (e) {
                    // If the route doesn't exist, return as string
                    return this.menuItem.route;
                }
            },
            preserveState() {
                let preserve_state = false;
                try {
                    if (!this.menuItem.hasOwnProperty('preserveState')) {
                        return preserve_state;
                    }

                    return !!this.menuItem.preserveState
                } catch (e) {
                    return preserve_state
                }
            }
        },
        mounted() {
            // If the current item is active, let any parent elements know
            if (this.isActive) {
                this.openItem(this.menuItemKey);
            }
        },
        methods: {
            onChildOpened (itemKey) {
                // If a child is opened, also open this item
                this.openItem(itemKey);
                this.openItem(this.menuItemKey);
            },
            onChildToggled(itemKey) {
                this.toggleItem(itemKey)
            },
            openItem(itemKey) {
                this.$emit('openItem', itemKey);
            },
            toggleItem(itemKey) {
                this.$emit('toggleItem', itemKey);
            }
        }
    }
</script>
