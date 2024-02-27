<template>
    <section class="bg-white">

       <course-header :course="course"></course-header>

        <course-features :course="course"></course-features>

        <video-preview :course="course"></video-preview>

        <course-description :course="course"></course-description>

        <purchase :course="course"></purchase>

        <course-content :course="course"></course-content>

        <faq></faq>

        <about-author></about-author>

        <testimonials></testimonials>

    </section>
</template>

<script>
import Faq from "../../../../components/website/Faq";
import AboutAuthor from "../../../../components/website/AboutAuthor";
import Testimonials from "../../../../components/website/Testimonials";
import CourseContent from "../../../../components/website/CourseContent";
import Purchase from "../../../../components/website/Purchase";
import CourseDescription from "../../../../components/website/CourseDescription";
import VideoPreview from "../../../../components/website/VideoPreview";
import CourseFeatures from "../../../../components/website/CourseFeatures";
import CourseHeader from "../../../../components/website/CourseHeader";

export default {
    name: "EduCourseShow",
    components: {
        Faq,
        AboutAuthor,
        Testimonials,
        CourseContent,
        Purchase,
        CourseDescription,
        VideoPreview,
        CourseFeatures,
        CourseHeader
    },
    layout: 'website-layout',
    props: {
        course: {
            type: Object,
            required: true
        }
    }
}
</script>
