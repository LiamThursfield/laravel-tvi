<template>
    <header class="bg-gray-800 px-4 py-12">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex flex-col items-center md:flex-row md:items-start">
                <img
                    class="rounded-lg w-60"
                    :src="course.primary_image"
                    :alt="course.name + ' Primary Image'"
                />

                <section class="mt-8 text-center md:ml-8 md:mt-0 md:text-left">
                    <strong class="text-sm font-light text-white md:text-sm pb-2">{{ course.creator.name }}</strong>
                    <h1 class="text-2xl font-bold text-white md:text-2xl">{{ course.name }}</h1>

                    <p class="mt-4 text-gray-400">{{ course.summary }}</p>
                </section>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: "CourseHeader",
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
    }
</script>
