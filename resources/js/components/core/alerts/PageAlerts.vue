<template>
    <section
        v-if="isVisibleAlerts"
    >
        <transition-group
            class="flex flex-col space-y-4"
            name="fade"
            tag="div"
        >
            <div
                v-if="isVisibleSuccess"
                class="bg-theme-success flex flex-row items-center px-4 py-4 relative shadow-subtle text-theme-success-contrast"
                key="alert-success"
            >
                <span class="flex-1">
                    {{ alertSuccess }}
                </span>
                <button
                    class="ml-2"
                    type="button"
                    @click="closeSuccess"
                >
                    <icon-close class="w-5 hover:text-theme-success-hover-contrast" />
                </button>
            </div>

            <div
                v-if="isVisibleWarning"
                class="bg-theme-warning flex flex-row items-center px-4 py-4 relative shadow-subtle text-theme-warning-contrast"
                key="alert-warning"
            >
                <span class="flex-1">
                    {{ alertWarning }}
                </span>
                <button
                    class="ml-2"
                    type="button"
                    @click="closeWarning"
                >
                  <icon-close class="w-5 hover:text-theme-warning-hover-contrast" />
                </button>
            </div>

            <div
                v-if="isVisibleError"
                class="bg-theme-danger flex flex-row items-center px-4 py-4 relative shadow-subtle text-theme-danger-contrast"
                key="alert-error"
            >
                <span class="flex-1">
                    {{ alertError }}
                </span>
                <button
                    class="ml-2"
                    type="button"
                    @click="closeError"
                >
                  <icon-close class="w-5 hover:text-theme-danger-hover-contrast" />
                </button>
            </div>
        </transition-group>
    </section>
</template>

<script>
    export default {
        name: "PageAlerts",
        data() {
            return {
                isClosedError: false,
                isClosedSuccess: false,
                isClosedWarning: false,
            }
        },
        computed: {
            alertError() {
                try {
                    return this.$page.props.flash.error;
                } catch (e) {
                    return false;
                }
            },
            alertSuccess() {
                try {
                    return this.$page.props.flash.success;
                } catch (e) {
                    return false;
                }
            },
            alertWarning() {
                try {
                    return this.$page.props.flash.warning;
                } catch (e) {
                    return false;
                }
            },
            isVisibleAlerts() {
                try {
                    return this.isVisibleError || this.isVisibleSuccess || this.isVisibleWarning;
                } catch (e) {
                    return false;
                }
            },
            isVisibleError() {
                return this.alertError && !this.isClosedError;
            },
            isVisibleSuccess() {
                return this.alertSuccess && !this.isClosedSuccess;
            },
            isVisibleWarning() {
                return this.alertWarning && !this.isClosedWarning;
            }
        },
        methods: {
            onAlertsChange() {
                this.isClosedError = false;
                this.isClosedSuccess = false;
                this.isClosedWarning = false;
            },
            closeError() {
                this.isClosedError = true;
                this.$page.props.flash.error = null;
            },
            closeSuccess() {
                this.isClosedSuccess = true;
                this.$page.props.flash.success = null;
            },
            closeWarning() {
                this.isClosedWarning = true;
                this.$page.props.flash.warning = null;
            },
        },
        watch: {
            alertError() { this.isClosedError = false },
            alertSuccess() { this.isClosedSuccess = false },
            alertWarning() { this.isClosedWarning = false },
        }
    }
</script>
