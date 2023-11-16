<template>
    <div>
        <h2 class="text-4xl lg:text-5xl font-bold lg:tracking-tight">
           {{ header }}
        </h2>
        <p
            v-if="content"
            class="text-lg mt-4 text-slate-600"
        >
            {{ content }}
        </p>
    </div>
</template>
<script>
    export default {
        name: "SimpleBanner",
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
