<template>
    <main class="bg-theme-base text-theme-base-contrast">
        <course-header :course="course" />

        <course-features :course="course" />

        <course-content :course="course" />

        <course-description :course="course" />

        <course-call-to-action :data="courseCallToActionText" />

        <faq :faqs="faqs" />

        <about-author
            :bio="authorBio"
            :name="authorName"
        />

        <purchase
            v-if="course.status === 'PUBLISHED'"
            class="bg-theme-base-subtle"
            :course="course"
        />

        <course-interest-form
            v-else-if="interestForm"
            class="bg-theme-base-subtle "
            :course="course"
            :form="interestForm"
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

    import CourseHeader from "../../components/website/edu/course/CourseHeader.vue";
    import CourseFeatures from "../../components/website/edu/course/CourseFeatures.vue";
    import VideoPreview from "../../components/website/edu/course/VideoPreview.vue";
    import Purchase from "../../components/website/edu/course/Purchase.vue";
    import CourseContent from "../../components/website/edu/course/CourseContent.vue";
    import CourseDescription from "../../components/website/edu/course/CourseDescription.vue";
    import Faq from "../../components/website/edu/course/Faq.vue";
    import AboutAuthor from "../../components/website/edu/course/AboutAuthor.vue";
    import Testimonials from "../../components/website/edu/course/Testimonials.vue";
    import CourseFooter from "../../components/website/edu/course/CourseFooter.vue";
    import StandardForm from "../../components/website/cms/forms/StandardForm.vue";
    import CourseInterestForm from "../../components/website/edu/course/CourseInterestForm.vue";
    import CourseCallToAction from "../../components/website/edu/course/CourseCallToAction.vue";

    export default {
        name: "CoursePage",
        mixins: [
            pageWithMetaMixin
        ],
        components: {
            CourseCallToAction,
            CourseInterestForm,
            StandardForm,
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
            courseCallToActionText() {
                return this.getLayoutFieldData('course-call-to-action');
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
            interestForm() {
                return this.getLayoutFieldData('course-interest-form');
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
