<template>
    <section>
        <course-footer-top :company="company" :footer-menu="footerMenu" />

        <course-footer-bottom :company="company" />
    </section>
</template>

<script>
import CourseFooterTop from "./CourseFooterTop.vue";
import CourseFooterBottom from "./CourseFooterBottom.vue";

export default {
    name: "CourseFooter",
    components: {CourseFooterBottom, CourseFooterTop},
    props: {
        company: {
            type: Object,
            required: false,
            default: () => [],
        },
        footerMenu: {
            type: Object,
            required: false,
            default: () => [],
        },
    },
}
</script>
