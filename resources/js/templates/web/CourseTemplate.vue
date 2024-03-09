<template>
    <main class="bg-white">
        <course-header :course="course" />

        <course-features :course="course" />

        <video-preview :course="course" />

        <purchase
            class="bg-gray-100"
            :course="course"
        />

        <course-description :course="course" />

        <course-content :course="course" />
    </main>
</template>

<script>
    import { pageWithMetaMixin } from "../../mixins/website/page-with-meta";

    import CourseHeader from "../../components/website/CourseHeader.vue";
    import CourseFeatures from "../../components/website/CourseFeatures.vue";
    import VideoPreview from "../../components/website/VideoPreview.vue";
    import Purchase from "../../components/website/Purchase.vue";
    import CourseContent from "../../components/website/CourseContent.vue";
    import CourseDescription from "../../components/website/CourseDescription.vue";

    export default {
        name: "CourseTemplate",
        mixins: [
            pageWithMetaMixin
        ],
        components: {
            CourseDescription,
            CourseContent,
            Purchase,
            VideoPreview,
            CourseFeatures,
            CourseHeader
        },
        props: {
            page: {
                required: true,
                type: Object
            }
        },
        computed: {
            content() {
                try {
                    return this.page.data.content
                } catch (e) {
                    console.error('Failed to load template content', e)
                }
            },
            course() {
                return this.getContentFieldData('course');
            },
            metaTitle() {
                try {
                    if (this.getMetaField('title')) {
                        return this.getMetaField('title');
                    }

                    if (this.course.name) {
                        return this.course.name;
                    }

                    return this.page.data.name;
                } catch (e) {
                    return '';
                }
            },
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
