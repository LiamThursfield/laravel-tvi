<template>
    <section
        v-if="course.video_preview"
        class="bg-grey-800 px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div
                v-if="showTitle"
                class="max-w-screen-md"
            >
                <p class="font-bold mb-4 text-lg">
                    {{__('messages.course-preview') }}:
                </p>
            </div>
            <!-- TODO:: Text box and video aligned to the right on desktop. Mobile text up, video down -->
            <div class="aspect-ratio-16-9 max-w-xl relative w-full">
                <iframe
                    :src="course.video_preview"
                    class="h-full w-full"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                />
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "VideoPreview",
        props: {
            course: {
                required: true,
                type: Object,
            },
            showTitle: {
                default: false,
                required: false,
                type: Boolean
            }
        },
    }
</script>
