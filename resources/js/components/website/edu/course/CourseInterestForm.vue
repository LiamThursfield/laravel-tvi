<template>
    <section
        id="interest-form"
        class="px-4 py-12"
    >
        <standard-form
            class="max-w-screen-sm mx-auto"
            :form="form"
            :form-data-overrides="{
                'course_name': course.name
            }"
            :title-override="transWithFallback('messages.register_interest', 'Register Interest')"
        />
    </section>
</template>

<script>
    import StandardForm from "../../cms/forms/StandardForm.vue";

    export default {
        name: "CourseInterestForm",
        components: {
            StandardForm
        },
        props: {
            course: {
                required: true,
                type: Object,
            },
            form: {
                required: true,
                type: Object,
            }
        }
    }
</script>
