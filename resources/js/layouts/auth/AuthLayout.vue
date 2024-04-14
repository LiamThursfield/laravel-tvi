<template>
    <div>
        <main
            id="auth-layout"
            class="bg-theme-base-contrast"
        >
            <div class="absolute inset-0  w-full">
                <div
                    class="auth-background-container bg-theme-primary"
                />
                <svg
                    class="fill-current -mt-px text-theme-primary"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1440 320"
                >
                    <path
                        fill-opacity="1"
                        d="M0,64L120,69.3C240,75,480,85,720,85.3C960,85,1200,75,1320,69.3L1440,64L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"
                    />
                </svg>
            </div>

            <div class="flex items-center min-h-screen min-w-full justify-center p-4 relative">
                <slot />
            </div>

            <tenant-footer
                :tenant-name="metaTenantName"
                :class="'text-white'"
                :link-class-value="'text-theme-primary hover:text-theme-primary-hover'"
            ></tenant-footer>
        </main>
    </div>
</template>

<script>
import TenantFooter from "../../components/core/footer/Footer.vue";

    export default {
        name: "AuthLayout",
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
        components: {
            TenantFooter
        },
        computed: {
            metaDescription() {
                return this.getMetaDataField(
                    'description',
                    'SIGI - powering your online presence'
                );
            },
            metaTitle() {
                return this.getMetaDataField(
                    'title',
                    'SIGI'
                );
            },
            metaTenantName() {
                return this.getMetaDataField(
                    'tenant',
                    'SIGI'
                );
            }
        },
        methods: {
            getMetaDataField(slug, fallback = '') {
                try {
                    return this.$page.props.meta[slug] ?? fallback;
                } catch (e) {
                    return fallback;
                }
            },
            url() {
                return location.pathname.substr(1)
            },
        }
    }
</script>
