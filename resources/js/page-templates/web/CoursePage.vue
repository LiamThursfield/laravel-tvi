<template>
    <main class="bg-theme-base text-theme-base-contrast">
        <course-header :course="course" />

        <course-features :course="course" />

        <purchase
            v-if="course.status === 'published'"
            class="bg-theme-base-subtle"
            :course="course"
        />

        <video-preview
            :course="course"
            :video-preview-text="videoPreviewText"
        />

        <course-description :course="course" />

        <course-content :course="course" />

        <faq :faqs="faqs" />

        <about-author
            :bio="authorBio"
            :name="authorName"
        />

        <testimonials :testimonials="testimonials" />

        <course-footer
            :company="company"
            :footer-menu="footerMenu"
        />

    </main>
</template>

<script>
    import { pageWithMetaMixin } from "../../mixins/website/page-with-meta";

    import CourseHeader from "../../components/website/course/CourseHeader.vue";
    import CourseFeatures from "../../components/website/course/CourseFeatures.vue";
    import VideoPreview from "../../components/website/course/VideoPreview.vue";
    import Purchase from "../../components/website/course/Purchase.vue";
    import CourseContent from "../../components/website/course/CourseContent.vue";
    import CourseDescription from "../../components/website/course/CourseDescription.vue";
    import Faq from "../../components/website/course/Faq.vue";
    import AboutAuthor from "../../components/website/course/AboutAuthor.vue";
    import Testimonials from "../../components/website/course/Testimonials.vue";
    import CourseFooter from "../../components/website/course/CourseFooter.vue";

    export default {
        name: "CoursePage",
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
            course() {
                return this.getContentFieldData('course');
            },
            authorBio() {
                return this.getLayoutFieldData('author-bio');
            },
            authorName() {
                return this.getLayoutFieldData('author-name');
            },
            company() {
                return this.getLayoutFieldData('company');
            },
            videoPreviewText() {
                return this.getLayoutFieldData('video-preview-text');
            },
            footerMenu() {
                return this.getLayoutFieldData('footer-menu');
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
            testimonials() {
                try {
                    return this.formatRepeaterFieldData(
                        this.getLayoutFieldData('global-testimonials')
                    )
                } catch (e) {
                    return null;
                }
            },
        },
        methods: {

        }
    }
</script>
