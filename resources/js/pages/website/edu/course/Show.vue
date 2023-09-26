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
                        :src="course.images[0]"
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
                <p class="opacity-50">
                    Course/Programme Selection
                </p>

                <div class="flex flex-row mt-2 space-x-4">
                    <button
                        :class="purchaseSelectionClass('standalone')"
                        type="button"
                        @click="purchaseSelection = 'standalone'"
                    >
                        <span>Standalone</span>
                        <span class="text-sm">Start now!</span>
                    </button>

                    <button
                        :class="purchaseSelectionClass('programme_1')"
                        type="button"
                        @click="purchaseSelection = 'programme_1'"
                    >
                        <span>Programme 1</span>
                        <span class="text-sm">Start date: 01/11/2023</span>
                    </button>

                    <button
                        :class="purchaseSelectionClass('programme_2')"
                        type="button"
                        @click="purchaseSelection = 'programme_2'"
                    >
                        <span>Programme 2</span>
                        <span class="text-sm">Start date: 01/12/2023</span>
                    </button>
                </div>

                <div class="flex flex-row justify-center">
                    <button
                        class="button button-primary flex flex-row justify-center mt-6 text-xl"
                        style="min-width: 300px"
                        :disabled="!purchaseSelection || isLoadingCheckout"
                        @click="purchaseCourse"
                    >
                        £{{ course.price }} | Purchase

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