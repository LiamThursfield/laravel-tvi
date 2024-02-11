<template>
    <div class="max-w-screen-xl mx-auto px-5">

        <hero-with-svg
            header="The one-stop platform for your courses"
            content="SIGI is the last product you'll need to manage your entire web presence including: Website, Course Platform, etc. You name it, we have it!"
        >
            <template v-slot:svg>
                <astronaut-on-moon />
            </template>

            <template v-slot:ctas>
                <a
                    class="
                        rounded text-center transition border-2 border-transparent flex gap-1 items-center justify-center ring-offset-2 ring-gray-200 px-5 py-2.5 bg-black text-white
                        focus-visible:ring-2
                        hover:bg-gray-800
                    "
                    href="#"
                >
                    Get Started
                </a>

                <a
                    class="
                        rounded text-center transition ring-offset-2 ring-gray-200 px-5 py-2.5 bg-white border-2 border-black text-black flex gap-1 items-center justify-center
                        focus-visible:ring-2
                        hover:bg-gray-100
                    "
                    href="#"
                >
                    More Info
                </a>
            </template>
        </hero-with-svg>

        <simple-banner
            class="mt-16 md:mt-0"
            header="Everything you need to start selling courses"
            content="SIGI comes batteries included. It takes the best parts of state-of-the-art tools and adds its own innovations, allowing you to create & sell courses with ease."
        />

        <banner-grid class="mt-16"/>

        <banner-technologies class="mt-24"/>

        <banner-block
            class="mt-20"
            header="What are you waiting for?"
            content="Get started now and kick off your online platform!"
        >
            <template v-slot:ctas>
                <div class="flex mt-5">
                    <a
                        class="rounded text-center transition focus-visible:ring-2 ring-offset-2 ring-gray-200 px-5 py-2.5 bg-white text-black border-2 border-transparent"
                        href="#"
                    >
                        Get Started
                    </a>
                </div>
            </template>
        </banner-block>
    </div>
</template>

<script>
import AstronautOnMoon from "../../../components/svgs/AstronautOnMoon";
import BannerBlock from "../../../components/website/banners/BannerBlock";
import BannerGrid from "../../../components/website/banners/BannerGrid";
import BannerTechnologies from "../../../components/website/banners/BannerTechnologies";
import HeroWithSvg from "../../../components/website/heroes/HeroWithSvg";
import SimpleBanner from "../../../components/website/banners/SimpleBanner";

export default {
    name: "Index",
    components: {
        AstronautOnMoon,
        BannerBlock,
        BannerGrid,
        BannerTechnologies,
        HeroWithSvg,
        SimpleBanner,
    },
    layout: 'website-layout'
}
</script>
