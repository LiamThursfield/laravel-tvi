<template>
    <header class="bg-theme-secondary px-4 py-12 text-theme-secondary-contrast">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex flex-col items-center md:flex-col md:items-center">
                <div class="aspect-ratio-16-9 max-w-xl relative w-full align-right">
                    <iframe
                        :src="course.video_preview"
                        class="h-full w-full"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen
                    />
                </div>
            </div>
            <div class="flex flex-col items-center md:flex-row md:items-start">
<!--                <img-->
<!--                    class="rounded-lg w-60"-->
<!--                    :src="course.primary_image"-->
<!--                    :alt="course.name + ' Primary Image'"-->
<!--                />-->

                <section class="mt-8 text-center md:ml-8 md:mt-0 md:text-center">
                    <strong class="text-sm font-light md:text-sm pb-2">{{ course.creator.name }}</strong>
                    <h1 class="text-2xl font-bold md:text-2xl">{{ course.name }}</h1>

                    <p class="mt-4">{{ course.summary }}</p>
                </section>
            </div>

            <div class="flex flex-row justify-center mt-5">
                <a
                    class="button button-primary flex flex-row justify-center max-w-250px mt-6 rounded-full text-xl w-full"
                    href="#purchase"
                >
                    {{ __('messages.sign-up') }}
                </a>
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
