<template>
    <div>
        <main
            id="course-layout"
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

                    <a
                        class="button button-small button-primary font-semibold"
                        href="#purchase"
                    >
                        {{ __('messages.purchase') }}
                    </a>
                </div>
            </nav>

            <slot />
        </main>
    </div>
</template>

<script>
    export default {
        name: "CourseLayout",
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
