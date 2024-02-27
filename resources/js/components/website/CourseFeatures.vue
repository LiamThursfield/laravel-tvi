<template>
    <section class="bg-blue-600 px-4 py-6">
        <div class="container max-w-screen-lg mx-auto text-white">

            <p class="font-bold">{{__('messages.this-course-includes') }}:</p>

            <div class="grid grid-cols-3 items-center md:flex-row md:items-start">
                <ul class="py-3 col-auto mr-6">
                    <li class="flex flex-row items-center pb-2">
                        <icon-device-mobile
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.access-on-mobile') }}
                    </li>
                    <li v-if="course.has_webinars" class="flex flex-row items-center pb-2">
                        <icon-camera-check
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.webinars') }}
                    </li>
                    <li v-if="course.has_money_back_guarantee" class="flex flex-row items-center pb-2">
                        <icon-money-bag
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.money-back-gurantee') }}
                    </li>
                </ul>
                <ul class="py-3 col-auto mr-6">
                    <li v-if="course.has_captions" class="flex flex-row items-center pb-2">
                        <icon-text-caption
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.captions') }}
                    </li>
                    <li v-if="course.has_lifetime_access" class="flex flex-row items-center pb-2">
                        <icon-check
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.lifetime-access') }}
                    </li>
                    <li v-if="course.has_pdfs" class="flex flex-row items-center pb-2">
                        <icon-book-download
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.resources-pdfs') }}
                    </li>
                </ul>
                <ul class="py-3 col-auto mr-6">
                    <li v-if="course.has_student_discount" class="flex flex-row items-center pb-2">
                        <icon-discount
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.student-discount') }}
                    </li>
                    <li v-if="course.has_cerfiticate" class="flex flex-row items-center pb-2">
                        <icon-certificate
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.certificate') }}
                    </li>
                    <li v-if="course.has_seo" class="flex flex-row items-center pb-2">
                        <icon-speaker
                            class="w-5 md:mr-2"
                        />
                        {{ __('messages.seo-exposure') }}
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script>
    import IconDeviceMobile from "../core/icons/IconDeviceMobile";
    import IconTextCaption from "../core/icons/IconTextCaption";
    import IconSpeaker from "../core/icons/IconSpeaker";
    import IconBookDownload from "../core/icons/IconBookDownload";
    import IconCheck from "../core/icons/IconCheck";
    import IconLanguage from "../core/icons/IconLanguage";
    import IconCertificate from "../core/icons/IconCertificate";
    import IconMoneyBag from "../core/icons/IconMoneyBag";
    import IconCameraCheck from "../core/icons/IconCameraCheck";

    export default {
        name: "CourseFeatures",
        components: {
            IconDeviceMobile,
            IconTextCaption,
            IconSpeaker,
            IconBookDownload,
            IconCheck,
            IconLanguage,
            IconCertificate,
            IconMoneyBag,
            IconCameraCheck,
        },
        props: {
            course: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                sectionToShow: false,
            }
        },
        methods: {
            showSection(sectionId) {
                this.sectionToShow = sectionId;
            },
        }
    }
</script>
