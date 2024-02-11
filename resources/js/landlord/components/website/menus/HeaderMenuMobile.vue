<template>
    <transition name="slide-left">
        <nav
            v-show="isVisible"
            class="
                 absolute bg-white inset-0 pt-20 z-30 w-full
                md:hidden
            "
        >
            <div class="border-t border-opacity-25 border-white box-border flex flex-col h-full overflow-auto">

                <!-- Navigation Links -->
                <ul class="flex-1">
                    <li
                        v-for="(navigationLink, key) in navigationLinks"
                        :key="'header-link-mobile-' + key"
                        @click="linkSelected"
                    >
                        <inertia-link
                            class="
                                block pointer p-4 text-l text-center text-gray-600
                                focus:bg-gray-100 focus:text-gray-900
                                hover:bg-gray-100 hover:text-gray-900
                                transition-colors
                            "
                            :title="navigationLink.label"
                            :to="navigationLink.href"
                        >
                            {{ navigationLink.label }}
                        </inertia-link>
                    </li>
                </ul>
            </div>
        </nav>
    </transition>
</template>

<script>
    export default {
        name: "HeaderMenuMobile",
        props: {
            isVisible: {
                required: true,
                type: Boolean
            },
            navigationLinks: {
                required: true,
                type: Object | Array
            },
        },
        methods: {
            linkSelected() {
                this.$emit('link-selected', true);
            },
        }
    }
</script>
