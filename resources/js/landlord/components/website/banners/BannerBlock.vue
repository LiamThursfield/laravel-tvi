<template>
    <div class="bg-black p-8 md:px-20 md:py-20 mx-auto max-w-5xl rounded-lg flex flex-col items-center text-center">
        <h2 class="text-white text-4xl md:text-6xl tracking-tight">
            {{ header }}
        </h2>

        <p
            v-if="content"
            class="text-white mt-4 text-lg md:text-xl"
        >
            {{ content }}
        </p>

        <slot name="ctas" />
    </div>
</template>
<script>
    export default {
        name: "BannerBlock",
        props: {
            header: {
                type: String,
                required: true,
            },
            content: {
                type: String,
                required: false,
            }
        }
    }
</script>
