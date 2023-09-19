<template>
    <section class="bg-grey-100">
        <div class="flex flex-col min-h-screen min-w-screen">
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

            <div class="flex flex-col items-center justify-center mt-6">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="text-3xl font-bold text-gray-700">{{ course.name }}</h1>
                    <p
                        class="text-gray-500"
                        @click="toggleCourseJson"
                    >
                        {{ course.description }}
                    </p>

                    <div
                        v-if="showCourseJson"
                        class="opacity-50 mt-12"
                        @click="toggleCourseJson"
                    >
                        <pre class="text-xs">{{ course }}</pre>
                    </div>


                    <button
                        class="button button-primary flex flex-row mt-4"
                        :disabled="isLoadingCheckout"
                        @click="purchaseCourse"
                    >
                        Purchase

                        <icon-loader-circle
                            v-if="isLoadingCheckout"
                            class="animate-spin-slow ml-2 w-5"
                        />
                    </button>
                </div>
            </div>

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
            showCourseJson: false,
            isLoadingCheckout: false,
            checkoutErrors: null,
            checkoutResponse: null,
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
    }
}
</script>