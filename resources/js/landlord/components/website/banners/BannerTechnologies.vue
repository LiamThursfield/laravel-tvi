<template>
    <div>
        <h2 class="font-semibold text-center text-lg text-slate-500">Built with future-proof technologies</h2>
        <div class="flex gap-8 md:gap-20 items-center justify-center mt-10 flex-wrap">
            <component
                v-for="icon in icons"
                :key="icon"
                class="h-full w-8 md:w-12"
                :is="icon"
                stroke-width="1.5"
            />
        </div>
    </div>
</template>
<script>
    export default {
        name: "BannerTechnologies",
        data() {
            return {
                icons: [
                    "icon-brand-laravel",
                    "icon-brand-inertia",
                    "icon-brand-vue",
                    "icon-brand-tailwind"
                ]
            }
        }
    }
</script>
