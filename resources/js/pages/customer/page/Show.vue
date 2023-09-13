<template>
    <!--
        This is just the file that's loaded for a CMS page
        It is recommended to follow an approach similar to the below i.e.:
            A dynamic component for the layout - that takes a slot for the template
            A dynamic component for the template that displays the page content accordingly
    -->
    <component
        v-if="layoutComponent"
        :is="layoutComponent"
        :layout="layout"
    >
        <component
            v-if="templateComponent"
            :is="templateComponent"
            :page="page"
        />
    </component>

</template>

<script>

    export default {
        name: 'PageShow',
        props: {
            page: {
                required: true,
                type: Object,
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
            layout() {
                try {
                    return this.page.data.layout;
                } catch (e) {
                    return null;
                }
            },
            layoutComponent() {
                // This is just stub code intended to be implemented for the specific website
                // Note: You will also have to import the components

                /**
                switch (this.layoutSlug) {
                    case 'blog-layout':
                        return 'BlogLayout';
                    case 'default-layout':
                    default:
                        return 'DefaultLayout';
                }
                 **/
            },
            layoutSlug() {
                try {
                    return this.layout.slug;
                } catch (e) {
                    return null;
                }
            },
            template() {
                try {
                    return this.page.data.template;
                } catch (e) {
                    return null;
                }
            },
            templateComponent() {
                // This is just stub code intended to be implemented for the specific website
                // Note: You will also have to import the components

                /**
                 switch (this.templateSlug) {
                    case 'home-template':
                        return 'HomeTemplate';
                    case 'default-template':
                    default:
                        return 'DefaultTemplate';
                }
                 **/
            },
            templateSlug() {
                try {
                    return this.template.slug;
                } catch (e) {
                    return null;
                }
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