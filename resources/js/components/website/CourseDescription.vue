<template>
    <section class="bg-white px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="text-center">
                <p v-html="course.description">
                </p>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "CourseDescription",
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
    }
</script>
