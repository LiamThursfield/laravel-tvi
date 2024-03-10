<template>
    <main class="bg-theme-base text-theme-base-contrast">
        <course-header :course="course" />

        <course-features :course="course" />

        <video-preview :course="course" />

        <purchase
            class="bg-theme-base-subtle"
            :course="course"
        />

        <course-description :course="course" />

        <course-content :course="course" />

        <faq :faqs="faqs"></faq>

        <about-author :data="author"></about-author>

        <testimonials></testimonials>

        <course-footer></course-footer>

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
    import Faq from "../../components/website/Faq";
    import AboutAuthor from "../../components/website/AboutAuthor";
    import Testimonials from "../../components/website/Testimonials";
    import CourseFooter from "../../components/website/CourseFooter";

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
            CourseHeader,
            Faq,
            AboutAuthor,
            Testimonials,
            CourseFooter
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
            layout() {
                try {
                    return this.page.data.layout
                } catch (e) {
                    console.error('Failed to load template layout', e)
                }
            },
            course() {
                return this.getContentFieldData('course');
            },
            author() {
                return this.getLayoutFieldData('author');
            },
            faqs() {
                try {
                    return this.formatRepeaterFieldData(
                        this.getLayoutFieldData('global-faqs')
                    )
                } catch (e) {
                    return null;
                }
            },
            legals() {
                return this.getLayoutFieldData('legals');
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
            }
        },
        methods: {

        }
    }
</script>
