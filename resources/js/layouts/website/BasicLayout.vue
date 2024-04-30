<template>
    <div>
        <main
            id="basic-layout"
            class="bg-theme-base min-h-screen"
        >
            <nav
                class="bg-white px-4 py-3"
                :class="{
                    'shadow-lg sticky top-0 z-50': isStickyHeader
                }"
            >
                <div class="container flex flex-row items-center justify-between mx-auto">
                    <inertia-link
                        class="font-semibold hover:text-theme-primary-hover"
                        href="/"
                    >
                        {{ __('messages.homepage') }}
                    </inertia-link>
                </div>
            </nav>

            <div class="container max-w-screen-lg mx-auto pt-12">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
    export default {
        name: "BasicLayout",
        props: {
            layout: {
                required: true,
                type: Object
            }
        },
        computed: {
            isStickyHeader() {
                // TODO: Use observers
                return true;
            }
        },

    }
</script>
