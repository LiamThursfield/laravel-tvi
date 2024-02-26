<template>
    <section class="bg-white">
        <div
            v-if="checkoutResponse === 'success'"
            class="bg-theme-success text-theme-success-contrast px-4 py-2 text-center"
        >
            Successfully purchased course
        </div>

        <div
            v-else-if="checkoutResponse === 'cancel'"
            class="bg-theme-warning text-theme-warning-contrast px-4 py-2 text-center"
        >
            Course purchase cancelled
        </div>
        <h1 class="bg-yellow-100 px-4 py-2 text-center text-3xl bold">PREVIEW</h1>
        <header class="bg-gray-800 px-4 py-12">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex flex-col items-center md:flex-row md:items-start">
                    <img
                        class="rounded-lg w-48"
                        :src="course.primary_image"
                        alt="Course image preview"
                    />

                    <section class="mt-8 text-center md:ml-8 md:mt-0 md:text-left">
                        <h1 class="text-3xl font-bold text-white md:text-4xl">{{ course.name }}</h1>

                        <p class="mt-4 text-gray-400">{{ course.summary }}</p>

                        <div class="text-white">
                            <ul class="py-3">
                                <li class="flex flex-row items-center">
                                    <icon-device-mobile
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.access-on-mobile') }}
                                </li>
                                <li v-if="course.has_webinars" class="flex flex-row items-center">
                                    <icon-camera-check
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.webinars') }}
                                </li>
                                <li v-if="course.has_money_back_guarantee" class="flex flex-row items-center">
                                    <icon-money-bag
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.money-back-gurantee') }}
                                </li>
<!--                                <li-->
<!--                                    v-if="course.languages && course.languages.length > 1"-->
<!--                                    class="flex flex-row items-center"-->
<!--                                >-->
<!--                                    <icon-language-->
<!--                                        class="w-5 md:mr-2"-->
<!--                                    />-->
<!--                                    {{ __('messages.multiple-languages') }} -->
<!--                                </li>-->
                                <li v-if="course.has_cerfiticate" class="flex flex-row items-center">
                                    <icon-certificate
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.certificate') }}
                                </li>
                                <li v-if="course.has_captions" class="flex flex-row items-center">
                                    <icon-text-caption
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.captions') }}
                                </li>
                                <li v-if="course.has_lifetime_access" class="flex flex-row items-center">
                                    <icon-check
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.lifetime-access') }}
                                </li>
                                <li v-if="course.has_student_discount" class="flex flex-row items-center">
                                    <icon-discount
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.student-discount') }}
                                </li>
                                <li v-if="course.has_pdfs" class="flex flex-row items-center">
                                    <icon-book-download
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.resources-pdfs') }}
                                </li>
                                <li v-if="course.has_seo" class="flex flex-row items-center">
                                    <icon-speaker
                                        class="w-5 md:mr-2"
                                    />
                                    {{ __('messages.seo-exposure') }}
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </header>

        <section class="px-4 py-6">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex flex-row justify-center">
                    <button
                        class="button button-primary flex flex-row justify-center mt-6 text-xl"
                        style="min-width: 300px"
                        :disabled="isLoadingCheckout"
                        @click="purchaseCourse"
                    >
                        <span
                            v-if="course.currency === 'GBP'"
                        >
                             {{ course.currency + ' ' + course.price }}
                        </span>
                        <span v-else-if="course.currency === 'Lei'">
                             {{ course.price + ' ' +  course.currency }}
                        </span>
                        <span v-else-if="course.currency === 'EUR'">
                             {{ course.price + ' Euro' }}
                        </span>

                        <icon-loader-circle
                            v-if="isLoadingCheckout"
                            class="animate-spin-slow ml-2 w-5"
                        />
                    </button>
                </div>
            </div>
        </section>

        <section class="bg-white px-4 py-6 shadow-subtle mt-4">
            <div class="container max-w-screen-lg mx-auto flex flex-row justify-center">
                <div class="text-center">
                    <iframe :src="course.video_preview" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        <section class="bg-white px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <div class="text-center">
                    <p v-html="course.description">
                    </p>
                </div>
            </div>
        </section>

        <section class="px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <ul class="divide-y divide-gray-300 max-w-sm mt-6 mb-6 mx-auto px-4 border">

                    <li class="py-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-lg font-bold">{{ __('messages.course-content') }}</span>
                        </div>

                        <ul class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
                            <li
                                v-for="section in course.sections"
                                :key="'section-' + section.title"
                                class="py-2"
                            >
                                <div class="flex items-center space-x-4">
                                    <strong>{{ section.title }}</strong>
                                    <small class="mr-2 ml-auto">
                                        <span v-if="section.lecture_count">
                                            {{ section.child_items ? section.child_items.length + ' ' +__('messages.lectures') + ' | ':'' }}
                                        </span>
                                        {{ section.content_length ?  section.content_length + ' mins':'' }}
                                    </small>
                                </div>

                                <ul class="divide-y divide-gray-300 bg-gray-100 rounded-md px-4 py-2 mt-2">
                                    <li
                                        v-for="lecture in section.child_items"
                                        :key="'lecture-' + lecture.title"
                                        class="py-2"
                                    >
                                        <div class="flex items-center space-x-4">
                                            <span class="text-sm font-medium">
                                                 {{ lecture.title }}
                                                <small class="mr-2 ml-auto">
                                                    {{ lecture.content_length ?  lecture.content_length + ' mins':'' }}
                                                </small>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>
    </section>
</template>

<script>
import IconCameraCheck from "../../../../components/core/icons/IconCameraCheck";
import IconMoneyBag from "../../../../components/core/icons/IconMoneyBag";
import IconCertificate from "../../../../components/core/icons/IconCertificate";
import IconLanguage from "../../../../components/core/icons/IconLanguage";
import IconCheck from "../../../../components/core/icons/IconCheck";
import IconBookDownload from "../../../../components/core/icons/IconBookDownload";
import IconSpeaker from "../../../../components/core/icons/IconSpeaker";
import IconTextCaption from "../../../../components/core/icons/IconTextCaption";
import IconDeviceMobile from "../../../../components/core/icons/IconDeviceMobile";

export default {
    name: "EduCourseShow",
    components: {
        IconDeviceMobile,
        IconTextCaption,
        IconSpeaker, IconBookDownload, IconCheck, IconLanguage, IconCertificate, IconMoneyBag, IconCameraCheck},
    layout: 'website-layout',
    props: {
        course: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            showCourseJson: false,
            isLoadingCheckout: false,
            checkoutErrors: null,
            checkoutResponse: null,
            purchaseSelection: null,
        }
    },
    mounted() {
        this.getCheckoutResponse();
    },
    methods:{
        getCheckoutResponse() {
            try {
                let params = new URLSearchParams(window.location.search);
                let checkout = params.get('checkout');

                let allowedParams = [
                    'cancel',
                    'success',
                ];

                if (!allowedParams.includes(checkout)) {
                    return;
                }

                this.checkoutResponse = checkout;
            } catch (e) {
                // Do nothing
            }
        },
        purchaseCourse() {
            this.checkoutErrors = null;
            this.isLoadingCheckout = true;

            axios.post(
                this.$route('api.edu.courses.checkout', this.course.id)
            ).then(response => {
                if (!response.data.url) {
                    this.checkoutErrors = 'No checkout URL returned from server.';
                    return;
                }

                window.location.href = response.data.url;
            }).catch(e => {
                this.checkoutErrors = e?.response?.data?.message || e;
            }).finally(() => {
                this.isLoadingCheckout = false;
            })
        },
        toggleCourseJson() {
            this.showCourseJson = !this.showCourseJson;
        },
        purchaseSelectionClass(selection) {
            let base = 'cursor-pointer border flex flex-col px-8 py-2 rounded space-y-1 w-full items-center justify-center';
            if (selection === this.purchaseSelection) {
                return base + ' border-theme-primary text-theme-primary';
            }

            return base + ' border-gray-200 bg-grey-100 text-gray-500 hover:bg-gray-100';
        }
    }
}
</script>
