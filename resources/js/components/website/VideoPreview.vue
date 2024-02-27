<template>
    <section class="bg-grey-800 px-4 py-6 shadow-subtle mt-4">
        <div class="container max-w-screen-lg mx-auto flex flex-row justify-center">
            <div class="text-center">
                <iframe
                    :src="course.video_preview"
                    width="800"
                    height="360"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen
                ></iframe>
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
            }
        },
    }
</script>
