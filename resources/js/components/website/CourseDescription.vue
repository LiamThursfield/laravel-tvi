<template>
    <section class="px-4 py-12">
        <div class="container max-w-screen-lg mx-auto">
            <div class="max-w-screen-md">
                <p class="font-bold mb-4 text-xl">
                    {{__('messages.additional-course-details') }}
                </p>

                <div class="prose">
                    <p v-html="course.description" />
                </div>
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
