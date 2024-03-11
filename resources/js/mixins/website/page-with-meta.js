import _ from 'lodash';
import CourseLayout from "../../layouts/website/CourseLayout.vue";
import CoursePage from "../../page-templates/web/CoursePage.vue";

export const pageWithMetaMixin = {
    components: {
        // Layout Templates
        CourseLayout,
        // Page Templates
        CoursePage,
    },
    metaInfo() {
        return {
            title: this.metaTitle,
            meta: [
                {
                    name: 'description',
                    vmid: 'description',
                    content: this.metaDescription,
                },
                {
                    name: 'keywords',
                    vmid: 'keywords',
                    content: this.getMetaField('keywords'),
                },
                {
                    name: 'og:description',
                    vmid: 'og:description',
                    content: this.getMetaField('og_description', this.metaDescription),
                },
                {
                    name: 'og:title',
                    vmid: 'og:title',
                    content: this.getMetaField('og_title', this.metaTitle),
                },
                {
                    name: 'og:image',
                    vmid: 'og:image',
                    content: this.getMetaField('og_image'),
                },
                {
                    name: 'og:type',
                    vmid: 'og:type',
                    content: this.getMetaField('og_type'),
                },
                {
                    name: 'og:url',
                    vmid: 'og:url',
                    content: this.getMetaField('og_url'),
                },
            ]
        }
    },
    props: {
        page: {
            required: true,
            type: Object,
        },
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
            switch (this.layoutSlug) {
                case 'course-layout':
                    return 'course-layout';
            }

            console.log('No layout found');
        },
        layoutSlug() {
            try {
                return this.layout.slug;
            } catch (e) {
                return null;
            }
        },
        meta() {
            try {
                return this.page.data.metadata;
            } catch (e) {
                return {};
            }
        },
        metaDescription() {
            return this.getMetaField('description');
        },
        metaTitle() {
            try {
                if (this.getMetaField('title')) {
                    return this.getMetaField('title');
                }

                return this.page.data.name;
            } catch (e) {
                return '';
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
            switch (this.templateSlug) {
                case 'course-template':
                case 'course-page':
                    return 'course-page'; // TODO: Refactor to course-page
            }

            console.log('No template found');
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
        formatRepeaterFieldData(repeaterFieldData) {
            // Assumes data has been fetched via getContentFieldData/getLayoutFieldData
            try {
                let repeaterData = [];
                console.log(repeaterFieldData)

                _.forEach(repeaterFieldData, (repeaterRow) => {
                    console.log(repeaterRow);
                    let formattedRow = {};
                    _.forEach(repeaterRow, (repeaterRowField) => {
                        formattedRow[repeaterRowField.template_field_slug] = {
                            slug: repeaterRowField.template_field_slug,
                            order: repeaterRowField.template_field_order,
                            type: repeaterRowField.template_field_type,
                            data: repeaterRowField.data
                        }
                    });

                    repeaterData.push(formattedRow);
                });

                return repeaterData;
            } catch (e) {
                console.error('Error parsing repeater data', e);
                return null;
            }
        },
        getContentFieldData(slug, defaultValue = null) {
            // Example method used to get page content, with a fallback value
            try {
                return this.content[slug].data ? this.content[slug].data : defaultValue;
            } catch (e) {
                return defaultValue;
            }
        },
        getLayoutFieldData(slug, defaultValue = null) {
            // Example method used to get page content, with a fallback value
            try {
                return this.layout?.content[slug].data ? this.layout.content[slug].data : defaultValue;
            } catch (e) {
                return defaultValue;
            }
        },
        getMetaField(slug, defaultValue = '') {
            try {
                if (this.meta[slug]) {
                    return this.meta[slug];
                }

                return defaultValue;
            } catch (e) {
                return defaultValue;
            }
        }
    }

}
