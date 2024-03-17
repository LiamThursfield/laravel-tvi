<template>
    <section class="max-w-5xl mx-auto">
        <div class="flex flex-row items-center mb-6">
            <h1 class="font-medium mr-auto text-lg">
                Purchase #{{ purchase.id }}
            </h1>

            <inertia-link
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center
                "
                :href="$route('admin.edu.course-purchases.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    All Purchases
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Purchase Details
                </h2>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Course
                    </span>
                    {{ purchase.course.name }}

                    <inertia-link
                        v-if="userCan('edu_courses.edit')"
                        class="text-sm text-theme-base-subtle-contrast"
                        :href="$route('admin.edu.courses.edit', purchase.course.id)"
                    >
                        (Edit Course)
                    </inertia-link>
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Purchased At
                    </span>
                    {{ purchase.created_at | humanFriendlyDateTime }}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Redeemed At
                    </span>
                    <template v-if="purchase.redeemed_at">
                        {{ purchase.redeemed_at | humanFriendlyDateTime }}
                    </template>
                    <template v-else>
                        Not redeemed
                    </template>
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Refundable?
                    </span>
                    {{ purchase.is_refundable ? "Yes" : "No" }}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Email Address
                    </span>
                    {{ purchase.email_address }}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Type
                    </span>
                    {{ types.hasOwnProperty(purchase.type) ? types[purchase.type] : purchase.type }}
                </p>

                <p
                    v-if="isInstalmentPlan"
                    class="mt-2"
                >
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Instalment Plan
                    </span>
                    {{ purchase.instalment_plan.instalment_count }} payments @ {{ purchase.currency | currencySymbol }} {{ instalmentPlanPrice | priceDecimal}}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Status
                    </span>
                    {{ statuses.hasOwnProperty(purchase.status) ? statuses[purchase.status] : purchase.status }}
                </p>
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Payment Details
                </h2>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Payment Gateway:
                    </span>
                    {{ purchase.payment_gateway }}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Total Price Due:
                    </span>
                    {{ purchase.currency | currencySymbol }} {{ purchase.total_price_due | priceDecimal }}
                </p>

                <p class="mt-2">
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Total Price Paid:
                    </span>
                    {{ purchase.currency | currencySymbol }} {{ purchase.total_price_paid | priceDecimal }}
                </p>

                <p
                    v-if="purchase.full_price_paid_at"
                    class="mt-2"
                >
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Full Price Paid At:
                    </span>
                    {{ purchase.full_price_paid_at | humanFriendlyDateTime }}
                </p>
                <p
                    v-else
                    class="mt-2"
                >
                    <span class="block font-semibold text-theme-base-subtle-contrast text-xs">
                        Total Price Outstanding:
                    </span>
                    {{ purchase.currency | currencySymbol }}{{ purchase.total_price_outstanding | priceDecimal }}
                </p>
            </div>
        </div>

        <div class="bg-white mt-6 py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">
                <h2 class="font-semibold">
                    Payments
                </h2>
            </div>

            <div class="block mt-8 overflow-x-auto w-full">
                <table class="table table-hover table-striped w-full">
                    <thead>
                    <tr>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Paid At</th>
                        <th>{{ purchase.payment_gateway }} Response</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="(payment) in purchase.purchase_payments"
                        :key="`payment-${payment.id}`"
                    >
                        <td>
                            {{ payment.due_date | humanFriendlyDate }}
                        </td>
                        <td>
                            {{
                                paymentStatuses.hasOwnProperty(payment.status) ?
                                    paymentStatuses[payment.status] : payment.status
                            }}
                        </td>
                        <td>
                            {{ payment.currency | currencySymbol }}{{ payment.price | priceDecimal }}
                        </td>
                        <td v-if="payment.paid_at">
                            {{ payment.paid_at | humanFriendlyDateTime }}
                        </td>
                        <td v-else>
                            -
                        </td>
                        <td>
                            <span
                                class="cursor-pointer font-semibold hover:underline"
                                @click="showPaymentGatewayResponse(payment)"
                            >
                                {{ payment.payment_gateway_response_id }}
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <generic-modal
            :show-modal="showPaymentGatewayResponseModal"
            @closeModal="closePaymentGatewayResponseModal"
        >
            <div class="px-4 pb-4">
                <pre class="bg-theme-base-subtle px-2 py-1 rounded">{{ selectedPayment ? selectedPayment.payment_gateway_response : '' }}</pre>
            </div>
        </generic-modal>

    </section>
</template>

<script>
    import _ from 'lodash';
    import GenericModal from "../../../../../components/core/modals/GenericModal.vue";

    export default {
        name: "AdminEDUCoursePurchaseShow",
        components: {GenericModal},
        layout: 'admin-layout',
        props: {
            paymentStatuses: {
                required: true,
                type: Object
            },
            purchase: {
                required: true,
                type: Object
            },
            statuses: {
                required: true,
                type: Object
            },
            types: {
                required: true,
                type: Object
            },
        },
        data() {
            return {
                showPaymentGatewayResponseModal: false,
                selectedPayment: null
            }
        },
        computed: {
            isInstalmentPlan() {
                try {
                    return this.purchase.instalment_plan.id;
                } catch (e) {
                    return false;
                }
            },
            instalmentPlanPrice() {
                try {
                    if (!this.isInstalmentPlan) {
                        return false;
                    }

                    return this.purchase.purchase_payments[0].price;
                } catch (e) {
                    return 0;
                }
            }
        },
        methods: {
            closePaymentGatewayResponseModal() {
                this.showPaymentGatewayResponseModal = false;
                this.selectedPayment = null;
            },
            showPaymentGatewayResponse(payment) {
                this.selectedPayment = payment;
                this.showPaymentGatewayResponseModal = true;
            }
        }
    }
</script>
