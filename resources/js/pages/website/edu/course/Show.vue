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
                        <p class="mt-4 text-gray-400">{{ course.description }}</p>
                    </section>
                </div>
            </div>
        </header>

        <section class="px-4 py-6">
            <div class="container max-w-screen-lg mx-auto">
                <!-- If there are instalment plans, show selection -->
                <template v-if="orderedInstalmentPlans">
                    <p class="opacity-50">
                        Payment options
                    </p>

                    <div class="flex flex-row mt-2 space-x-4">
                        <button
                            :class="paymentSelectionClass('full')"
                            type="button"
                            @click="selectPaymentType('full')"
                        >
                            <span>Pay in full</span>
                            <span class="text-sm">£{{ course.current_price | priceDecimal }}</span>
                        </button>

                        <button
                            v-for="instalmentPlan in orderedInstalmentPlans"
                            :key="`instalment_plan_${instalmentPlan.id}`"
                            :class="paymentSelectionClass('instalment', instalmentPlan)"
                            type="button"
                            @click="selectPaymentType('instalment', instalmentPlan)"
                        >
                            <span>{{ instalmentPlan.instalment_count }} Instalments</span>
                            <span class="text-sm">£{{ instalmentPlan.instalment_current_price | priceDecimal }}</span>
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
                        Purchase


                        <template
                            v-if="paymentType === 'full'"
                            class="text-sm"
                        >
                            £{{ course.current_price | priceDecimal }}
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


        <div class="flex flex-col min-h-screen min-w-screen">

            <p
                class="bg-theme-danger mx-4 my-6 px-4 py-2 rounded text-theme-danger-contrast"
                v-if="checkoutErrors"
            >
                <strong>Checkout Error:</strong>
                <pre class="mt-2">{{ checkoutErrors }}</pre>
            </p>

        </div>
    </section>
</template>

<script>
import _ from 'lodash';

export default {
    name: "EduCourseShow",
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
