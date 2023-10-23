<template>
    <div>
        <main
            id="admin-layout"
            class="flex min-h-screen"
        >
            <div class="flex flex-1 flex-col max-w-full">
                <student-top-menu />

                <page-alerts />

                <div class="bg-theme-base flex-1 p-8">
                    <slot/>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import PageAlerts from "../../components/core/alerts/PageAlerts";

import StudentTopMenu from "../../components/student/admin/menus/StudentTopMenu.vue";

export default {
    name: "StudentAdminLayout",
    components: {
        PageAlerts,
        StudentTopMenu,
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
    }
}
</script>
