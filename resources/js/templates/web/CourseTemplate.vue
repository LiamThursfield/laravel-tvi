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

        <faq :data="faqs"></faq>

        <about-author :data="author"></about-author>

        <testimonials></testimonials>

        <course-footer></course-footer>

    </main>
</template>

<script>
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
                return this.getLayoutFieldData('faq');
            },
            legals() {
                return this.getLayoutFieldData('legals');
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
            },
            getLayoutFieldData(slug, defaultValue = null) {
                // Example method used to get page content, with a fallback value
                try {
                    return this.layout?.content[slug].data ? this.layout.content[slug].data : defaultValue;
                } catch (e) {
                    return defaultValue;
                }
            }
        }
    }
</script>
