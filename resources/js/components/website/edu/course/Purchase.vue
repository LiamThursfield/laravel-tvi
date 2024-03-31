<template>
    <section
        id="purchase"
        class="px-4 py-12"
    >
        <div class="container max-w-screen-lg mx-auto">
            <div
                v-if="checkoutResponse === 'success'"
                class="bg-theme-success-contrast text-theme-accent-contrast px-4 py-2 text-center"
            >
                {{__('messages.purchase-success') }}
            </div>

            <div
                v-else-if="checkoutResponse === 'cancel'"
                class="bg-theme-warning text-theme-warning-contrast px-4 py-2 text-center"
            >
                {{__('messages.purchase-cancel') }}
            </div>
        </div>

        <div class="container max-w-screen-lg mx-auto">
            <!-- If there are instalment plans, show selection -->
            <template v-if="orderedInstalmentPlans">
                <p class="font-bold mb-4 text-lg">
                    {{__('messages.payment-options') }}
                </p>

                <div class="flex flex-row mt-2 space-x-4">
                    <button
                        :class="paymentSelectionClass('full')"
                        type="button"
                        @click="selectPaymentType('full')"
                    >
                        <span>
                            <strong>
                                {{__('messages.pay-in-full') }}
                            </strong>
                        </span>
                        <span
                            v-if="course.currency === 'GBP'"
                            class="text-sm"
                        >
                             {{ course.currency | currencySymbol }} {{ course.current_price | priceDecimalUnlessWhole }}
                        </span>
                        <span
                            v-else-if="course.currency === 'RON'"
                            class="text-sm"
                        >
                            {{ course.current_price | priceDecimalUnlessWhole }} Lei
                            <small class="font-weight-lighter">(TVA inclus)</small>
                        </span>
                        <span
                            v-else-if="course.currency === 'EUR'"
                            class="text-sm"
                        >
                             {{ course.current_price | priceDecimal }} Euro
                        </span>
                        <small class="font-weight-lighter">
                            *{{ __('messages.pay-in-full-note', { savingPercentage: 40 }) }}
                        </small>
                    </button>

                    <button
                        v-for="instalmentPlan in orderedInstalmentPlans"
                        :key="`instalment_plan_${instalmentPlan.id}`"
                        :class="paymentSelectionClass('instalment', instalmentPlan)"
                        type="button"
                        @click="selectPaymentType('instalment', instalmentPlan)"
                    >
                        <span>
                            <strong>
                                {{ __('messages.pay-in-instalments', { numberOfInstalments: instalmentPlan.instalment_count }) }}
                            </strong>
                        </span>

                        <span
                            v-if="course.currency === 'GBP'"
                            class="text-sm"
                        >
                             {{ course.currency | currencySymbol }} {{ instalmentPlan.instalment_current_price | priceDecimalUnlessWhole }}
                        </span>
                        <span
                            v-else-if="course.currency === 'RON'"
                            class="text-sm"
                        >
                            {{ instalmentPlan.instalment_current_price | priceDecimalUnlessWhole }} Lei
                            <small>(TVA inclus)</small>
                        </span>
                        <span
                            v-else-if="course.currency === 'EUR'"
                            class="text-sm"
                        >
                             {{ instalmentPlan.instalment_current_price | priceDecimalUnlessWhole }} Euro
                        </span>
                        <small>
                            *{{__('messages.pay-in-instalments-note', { numberOfInstalments: instalmentPlan.instalment_count }) }}
                        </small>
                    </button>
                </div>
            </template>

            <div class="flex flex-row justify-center">
                <button
                    class="button button-primary flex flex-row justify-center max-w-250px mt-6 rounded-full text-xl w-full"
                    :disabled="!paymentType || isLoadingCheckout"
                    @click="purchaseCourse"
                >
                    {{__('messages.sign-up') }}

                    <icon-loader-circle
                        v-if="isLoadingCheckout"
                        class="animate-spin-slow ml-2 w-5"
                    />
                </button>
            </div>
        </div>

        <div
            v-if="checkoutErrors"
            class="container max-w-screen-lg mx-auto min-h-screen min-w-screen"
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
    import _ from "lodash";

    export default {
        name: "Purchase",
        props: {
            course: {
                required: true,
                type: Object,
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
        methods: {
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
