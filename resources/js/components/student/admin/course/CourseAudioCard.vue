<template>
    <div>
        <av-bars
            audio-src="/static/bach.mp3">
        </av-bars>
        <h1>Heyo</h1>
    </div>
</template>

<script>
    import IconPlus from "../../../core/icons/IconPlus.vue";

    // See https://www.npmjs.com/package/vue-audio-visual/v/2.5.0 to get the player to work
    export default {
        name: "CourseAudioCard",
        components: {
            IconPlus,
        },
        props: {

        },
        computed: {
        },
        methods: {},
    }
</script>


<style scoped>
    .image-container {
        aspect-ratio: 16/9;
    }
</style>
