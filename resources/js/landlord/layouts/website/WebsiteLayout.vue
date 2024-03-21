<template>
    <div>
        <main
            id="website-layout"
            class="bg-white"
        >
            <header-menu />

            <slot />

            <div class="mt-20">
                Copyright © {{ (new Date().getFullYear()) }} SIGI
            </div>
        </main>
    </div>
</template>

<script>
    import HeaderMenu from "../../components/website/menus/HeaderMenu.vue";

    export default {
        name: "LandlordWebsiteLayout",
        components: {HeaderMenu},
        metaInfo() {
            return {
                title: 'SIGI',
                meta: [
                    {
                        name: 'description',
                        content: 'SIGI - powered by Laravel, Tailwind, Vue, and Inertia',
                    }
                ]
            }
        },
    }
</script>
