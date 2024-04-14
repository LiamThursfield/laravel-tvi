<template>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-16">
        <div
            v-for="(cell, index) in content"
            :key="`cell-${index}`"
            class="flex gap-4 items-start"
        >
            <div>
                <div class="mt-1 bg-black rounded-full w-5 h-5 p-0.5">
                    <icon-check class="h-full text-white w-full"/>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-lg">{{ cell.header }}</h3>
                <p class="text-slate-500 mt-2 leading-relaxed">{{ cell.description }}</p>
            </div>
        </div>
    </div>
</template>
<script>
    import IconCheck from "../../../../components/core/icons/IconCheck.vue";
    export default {
        name: "BannerGrid",
        components: {IconCheck},
        props: {
            content: {
                type: Array,
                default: () => {
                    return [
                        {
                            header: "Build and manage your website",
                            description: "All your online presence managed in one place."
                        },
                        {
                            header: "SEO Enabled",
                            description: "Full SEO tooling to set and update meta for all web pages."
                        },
                        {
                            header: "Sell Online Courses",
                            description: "Manage, publish, and sell courses with ease. Video, audio, and text lessons."
                        },
                        {
                            header: "Online Ads",
                            description: "Our experts will help you create and manage online ads."
                        },
                        {
                            header: "Multiple Payment Options",
                            description: "Yur customers can pay with credit card, PayPal, and more."
                        },
                        {
                            header: "24/7 Support",
                            description: "Our team is here to help you with any questions you may have."
                        },
                    ]
                }
            }
        }
    }
</script>
