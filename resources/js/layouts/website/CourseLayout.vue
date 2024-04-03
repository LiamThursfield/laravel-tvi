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
                        v-if="!logoUrl"
                        class="font-semibold hover:text-theme-primary-hover"
                        href="/"
                    >
                        {{ __('messages.homepage') }}
                    </inertia-link>

                    <inertia-link
                        v-else
                        class="logo"
                        href="/"
                    >
                        <img :src="logoUrl" class="mr-2 w-12"/>
                    </inertia-link>

                    <a
                        v-if="course.status === 'PUBLISHED'"
                        class="animate-bg-primary-to-secondary button button-primary font-semibold rounded-full"
                        href="#purchase"
                    >
                        {{ __('messages.sign-up') }}
                    </a>

                    <a
                        v-else
                        class="animate-bg-primary-to-secondary button button-primary font-semibold rounded-full"
                        href="#interest-form"
                    >
                        {{ transWithFallback('messages.register_interest', 'Register Interest') }}
                    </a>
                </div>
            </nav>

            <slot />
        </main>
    </div>
</template>

<script>
    import { pageWithMetaMixin } from "../../mixins/website/page-with-meta";

    export default {
        name: "CourseLayout",
        props: {
            page: {
                required: true,
                type: Object
            },
            layout: {
                required: true,
                type: Object
            }
        },
        computed: {
            content() {
                try {
                    return this.page.data.content;
                } catch (e) {
                    return null;
                }
            },
            course() {
                return this.getContentFieldData('course');
            },
            logoUrl() {
                try {
                    return this.page.data.logo_url;
                } catch (e) {
                    return null;
                }
            },
            isStickyHeader() {
                // TODO: Use observers
                return true;
            }
        },
        methods: {
            getContentFieldData(slug, defaultValue = null) {
                // Example method used to get page content, with a fallback value
                try {
                    return this.content[slug].data ? this.content[slug].data : defaultValue;
                } catch (e) {
                    return defaultValue;
                }
            }
        }
    }
</script>
