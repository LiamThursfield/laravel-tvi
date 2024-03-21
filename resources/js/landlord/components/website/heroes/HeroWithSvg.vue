<template>
    <section class="grid lg:grid-cols-2 place-items-center pt-16 pb-8 md:pt-12 md:pb-24">
        <div class="py-6 md:order-1 hidden md:block">
            <picture>
                <slot name="svg"/>
            </picture>
        </div>
        <div>
            <h1 class="text-5xl lg:text-6xl xl:text-7xl font-bold lg:tracking-tight xl:tracking-tighter">
                {{ header }}
            </h1>
            <p
                v-if="content"
                class="text-lg mt-4 text-slate-600 max-w-xl"
            >
                {{ content }}
            </p>

            <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <slot name="ctas"/>
            </div>
        </div>
    </section>
</template>
<script>
    import AstronautOnMoon from "../../svgs/AstronautOnMoon.vue";
    export default {
        components: {AstronautOnMoon},
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
