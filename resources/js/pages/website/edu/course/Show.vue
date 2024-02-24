<template>
    <section class="bg-white">
        <div
            v-if="checkoutResponse === 'success'"
            class="bg-theme-success text-theme-success-contrast px-4 py-2 text-center"
        >
            {{__('messages.purchase-success') }}
        </div>

        <div
            v-else-if="checkoutResponse === 'cancel'"
            class="bg-theme-warning text-theme-warning-contrast px-4 py-2 text-center"
        >
            {{__('messages.purchase-cancel') }}
        </div>

        <header class="bg-gray-800 px-4 py-12">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex flex-col items-center md:flex-row md:items-start">
                    <img
                        class="rounded-lg w-60"
                        :src="course.primary_image"
                        :alt="course.name + ' Primary Image'"
                    />

                    <section class="mt-8 text-center md:ml-8 md:mt-0 md:text-left">
                        <strong class="text-sm font-light text-white md:text-sm">{{ course.creator.name }}</strong>
                        <h1 class="text-3xl font-bold text-white md:text-4xl">{{ course.name }}</h1>

                        <p class="mt-4 text-gray-400">{{ course.summary }}</p>
                    </section>
                </div>
            </div>
        </header>

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

        <section class="bg-grey-800 px-4 py-6 shadow-subtle mt-4">
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

        <section class="px-4 py-6">
            <div class="container max-w-screen-lg mx-auto">
                <!-- If there are instalment plans, show selection -->
                <template v-if="orderedInstalmentPlans">
                    <p class="opacity-50">
                        {{__('messages.payment-options') }}
                    </p>

                    <div class="flex flex-row mt-2 space-x-4">
                        <button
                            :class="paymentSelectionClass('full')"
                            type="button"
                            @click="selectPaymentType('full')"
                        >
                            <span>{{__('messages.pay-in-full') }}</span>
                            <span
                                v-if="course.currency === 'GBP'"
                                class="text-sm"
                            >
                                 {{ course.currency | currencySymbol }} {{ course.current_price | priceDecimal }}
                            </span>
                            <span
                                v-else-if="course.currency === 'Lei'"
                                class="text-sm"
                            >
                                {{ course.current_price }}  {{ course.currency | priceDecimal }}
                            </span>
                            <span
                                v-else-if="course.currency === 'E'"
                                class="text-sm"
                            >
                                 {{ course.current_price | priceDecimal }} Euro
                            </span>
                        </button>

                        <button
                            v-for="instalmentPlan in orderedInstalmentPlans"
                            :key="`instalment_plan_${instalmentPlan.id}`"
                            :class="paymentSelectionClass('instalment', instalmentPlan)"
                            type="button"
                            @click="selectPaymentType('instalment', instalmentPlan)"
                        >
                            <span>{{ instalmentPlan.instalment_count }} {{__('messages.pay-instalments') }}</span>
                            <span class="text-sm">{{ instalmentPlan.instalment_current_price | priceDecimal }}</span>
                        </button>
                    </div>
                </template>

                <div class="flex flex-row justify-center">
                    <button
                        class="button button-primary flex flex-row justify-center mt-6 text-xl"
                        style="min-width: 300px"
                        :disabled="!paymentType || isLoadingCheckout"
                        @click="purchaseCourse"
                    >
                        {{__('messages.purchase') }}&nbsp;

                        <template
                            v-if="paymentType === 'full'"
                            class="text-sm"
                        >
                            <span
                                v-if="course.currency === 'GBP'"
                            >
                                 {{ course.currency | currencySymbol }} {{ course.current_price | priceDecimal }}
                            </span>
                            <span
                                v-else-if="course.currency === 'Lei'"
                            >
                                {{ course.current_price }}  {{ course.currency | priceDecimal }}
                            </span>
                            <span
                                v-else-if="course.currency === 'E'"
                            >
                                 {{ course.current_price | priceDecimal }} Euro
                            </span>
                        </template>
                        <template v-else>
                            {{ instalmentSelection.instalment_count }} months x £{{ instalmentSelection.instalment_current_price | priceDecimal }}
                        </template>

                        <icon-loader-circle
                            v-if="isLoadingCheckout"
                            class="animate-spin-slow ml-2 w-5"
                        />
                    </button>
                </div>
            </div>
        </section>

        <section class="px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold">{{ __('messages.course-content') }}:</span>
                </div>
                <section class="divide-y divide-gray-300 max-w-full mt-6 mb-6 mx-auto px-4 border">
                    <ul class="divide-y divide-gray-300 bg-gray-50 rounded-md px-4 py-2 mt-4">
                        <li
                            v-for="section in course.sections"
                            :key="'section-' + section.title"
                            class="py-2"
                        >
                            <button
                                type="button"
                                @click="showSection(section.id)"
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
                            </button>

                            <ul
                                class="divide-y divide-gray-300 bg-gray-100 rounded-md px-4 py-2 mt-2"
                                :class="{'hidden ease-in-out duration-300 transition-colors': section.id === sectionToShow  }"
                            >
                                <li
                                    v-for="(lecture, index) in section.child_items"
                                    :key="'lecture-' + lecture.title"
                                    class="p-2 ease-in-out duration-300 transition-colors
                                           focus:outline-none focus:ring focus:ring-primary
                                           hover:bg-theme-base-subtle"
                                >
                                    <div class="grid grid-cols-2 space-x-4">
                                        <span class="text-sm font-medium">
                                             {{ index + ' ' + lecture.title }}
                                        </span>
                                        <span class="text-sm font-medium text-right">
                                            {{ lecture.content_length ?  lecture.content_length + ' mins':'' }}
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </div>
        </section>

        <section class="px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold">FAQ</span>
                </div>
            </div>
        </section>

        <section class="px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold">Autor</span>
                </div>
            </div>
        </section>

        <section class="px-4 py-6 shadow-subtle">
            <div class="container max-w-screen-lg mx-auto">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-bold">Testimoniale</span>
                </div>
            </div>
        </section>

        <div
            v-if="checkoutErrors"
            class="flex flex-col min-h-screen min-w-screen"
        >
            <section
                class="bg-theme-danger mx-4 my-6 px-4 py-2 rounded text-theme-danger-contrast"
            >
                <strong>Checkout Error:</strong>
                <pre class="mt-2">{{ checkoutErrors }}</pre>
            </section>
        </div>
    </section>
</template>

<script>
import _ from 'lodash';
import IconDeviceMobile from "../../../../components/core/icons/IconDeviceMobile";
import IconTextCaption from "../../../../components/core/icons/IconTextCaption";
import IconSpeaker from "../../../../components/core/icons/IconSpeaker";
import IconBookDownload from "../../../../components/core/icons/IconBookDownload";
import IconCheck from "../../../../components/core/icons/IconCheck";
import IconLanguage from "../../../../components/core/icons/IconLanguage";
import IconCertificate from "../../../../components/core/icons/IconCertificate";
import IconMoneyBag from "../../../../components/core/icons/IconMoneyBag";
import IconCameraCheck from "../../../../components/core/icons/IconCameraCheck";

export default {
    name: "EduCourseShow",
    components: {
        IconDeviceMobile,
        IconTextCaption,
        IconSpeaker,
        IconBookDownload,
        IconCheck,
        IconLanguage,
        IconCertificate,
        IconMoneyBag,
        IconCameraCheck
    },
    layout: 'website-layout',
    props: {
        course: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            isLoadingCheckout: false,
            checkoutErrors: null,
            checkoutResponse: null,
            paymentType: 'full',
            instalmentSelection: null,
            sectionToShow: false,
        }
    },
    computed: {
        orderedInstalmentPlans() {
            try {
                return _.orderBy(this.course.instalment_plans, 'instalment_count');
            } catch (e) {
                return false;
            }
        }
    },
    mounted() {
        this.getCheckoutResponse();
    },
    methods:{
        showSection(sectionId) {
            this.sectionToShow = sectionId;
        },
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
                this.$route('api.edu.courses.checkout', this.course.id),
                {
                    instalment_plan_id: this.instalmentSelection?.id
                }
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
        paymentSelectionClass(payment_type, instalment_id = null) {
            let base = 'cursor-pointer border flex flex-col px-8 py-2 rounded space-y-1 w-full items-center justify-center';

            if (
                (payment_type === 'full' && this.paymentType === 'full') ||
                (payment_type === 'instalment' && this.instalmentSelection === instalment_id)
            ) {
                return base + ' border-theme-primary text-theme-primary';
            }

            return base + ' border-gray-200 bg-grey-100 text-gray-500 hover:bg-gray-100';
        },
        selectPaymentType(payment_type, instalment = null) {
            this.paymentType = payment_type;
            this.instalmentSelection = instalment;
        }
    }
}
</script>
