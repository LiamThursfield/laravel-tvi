<template>
    <li
        class="menu-item hover:bg-blue-50 hover:underline"
        :class="`menu-item-level-${menuItemLevel}`"
    >
        <button
            class="menu-link-parent font-weight-lighter text-sm"
            :class="{
                'menu-link-active': isActive,
                'toggled': isToggled,
            }"
            @click="toggleItem(menuItemKey)"
        >
            <icon-square-check-filled
                v-if="menuItem.completed"
                class="w-5 md:mr-2 text-green-600"
            />
            <icon-square-check
                v-else
                class="w-5 md:mr-2 text-green-600"
            />

            <span v-if="menuItem.video_url">
                <component
                    :is="'icon-alert-video'"
                    class="h-5 w-5"
                />
            </span>

            <span
                v-else
                class="h-5 w-5"
            ></span>

            <span class="ml-2">
                {{ menuItem.title }}
                <small class="font-weight-light">
                    {{ menuItem.content_length }} {{ __('messages.minutes') }}
                </small>
            </span>

            <icon-chevron-right class="indicator h-5 w-5" />
        </button>
    </li>
</template>

<script>
    import CollapseTransition from '@ivanv/vue-collapse-transition';
    import IconChevronRight from "../../core/icons/IconChevronRight.vue";
    import IconSquareCheckFilled from "../../core/icons/IconSquareCheckFilled.vue";
    import IconSquareCheck from "../../core/icons/IconSquareCheck.vue";

    export default {
        name: "SideMenuItem",
        components: {
            IconSquareCheck,
            IconSquareCheckFilled,
            'collapse-transition': CollapseTransition,
            IconChevronRight
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
            selectedLecture: {
                type: Object,
                required: false,
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
            isActive() {
                if (!this.selectedLecture) {
                    return false;
                }
                let isActive = false;

                if (this.selectedLecture.index == this.menuItemKey) {
                    isActive = true;
                }

                return isActive;
            },
            isToggled() {
                return !!this.toggledItems[this.menuItemKey];
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
