<template>
    <transition
        v-if="showModal"
        name="fade"
    >
        <div
            class="absolute bg-gray-800 bg-opacity-75 flex h-full inset-0 items-center justify-center w-full p-4 z-30"
            :class="componentName"
        >
            <div
                class="bg-theme-card max-h-full max-w-full overflow-y-auto relative rounded shadow-md text-theme-card-contrast w-96"
                v-on-clickaway="closeModal"
            >
                <div class="flex flex-row justify-end p-2">
                    <button
                        class="
                            flex h-5 items-center justify-center rounded text-gray-500 w-5
                            ease-in-out duration-300 transition-colors
                            focus:outline-none focus:shadow-outline-primary
                            hover:text-theme-primary
                        "
                        :disabled="isActionLoading"
                        @click="closeModal"
                    >
                        <icon-close />
                    </button>
                </div>

                <slot>
                    <div
                        v-if="isMessage"
                        class="flex flex-col items-center mt-6 px-4 text-center"
                    >
                        <h2
                            v-if="messageTitle"
                            class="font-semibold text-lg"
                        >
                            {{ messageTitle }}
                        </h2>
                        <p
                            v-if="messageText"
                            class="mt-2 text-center text-gray-700"
                        >
                            {{ messageText }}
                        </p>
                    </div>
                </slot>

                <div
                    class="
                        flex flex-col items-center justify-center mb-4 mt-8 px-4 space-y-2
                        sm:flex-row sm:space-x-3 sm:space-y-0
                    "
                >
                    <button
                        class="
                            border border-gray-500 min-w-24 px-4 py-2 rounded text-center text-gray-500 w-full
                            ease-in-out duration-300 transition-colors
                            sm:w-auto
                            focus:outline-none focus:shadow-outline-primary
                            hover:bg-gray-500 hover:text-white
                        "
                        :disabled="isActionLoading"
                        type="button"
                        @click="cancelAction"
                    >
                        {{ cancelText }}
                    </button>

                    <button
                        class="
                            border flex flex-row items-center justify-center px-4 py-2 min-w-24 px-4 py-2 rounded text-center w-full
                            ease-in-out duration-300 transition-colors
                            sm:w-auto
                            focus:outline-none focus:shadow-outline-primary
                        "
                        :class="confirmButtonClass"
                        :disabled="isActionLoading"
                        type="button"
                        @click="confirmAction"
                    >
                        <icon-loader-circle
                            v-if="isActionLoading"
                            class="animate-spin-slow mr-2 w-5"
                        />
                        <span v-else>
                            {{ confirmText }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import { mixin as clickaway } from 'vue-clickaway';

    export default {
        name: "ConfirmationModal",
        mixins: [clickaway],
        props: {
            componentName: {
                default: "confirmation-modal",
                type: String
            },
            cancelText: {
                default: "Cancel",
                type: String
            },
            confirmText: {
                default: "Confirm",
                type: String
            },
            confirmType: {
                default: 'primary',
                type: String
            },
            isActionLoading: {
                default: false,
                type: Boolean,
            },
            messageText: {
                default: 'Do you really want to continue?',
                type: String
            },
            messageTitle: {
                default: 'Are you sure?',
                type: String
            },
            showModal: {
                default: true,
                type: Boolean
            }
        },
        computed: {
            confirmButtonClass() {
                let classList = [];

                classList.push('bg-theme-' + this.confirmType);
                classList.push('border-theme-' + this.confirmType);
                classList.push('text-theme-' + this.confirmType + '-contrast');
                classList.push('hover:bg-theme-' + this.confirmType + '-hover');
                classList.push('hover:border-theme-' + this.confirmType + '-hover');
                classList.push('hover:text-theme-' + this.confirmType + '-hover-contrast');

                return classList;
            },
            isMessage() {
                return this.isMessageText && this.isMessageTitle;
            },
            isMessageText() {
                return !!this.messageText.length
            },
            isMessageTitle() {
                return !!this.messageTitle.length;
            },
        },
        methods: {
            cancelAction() {
                this.$emit('cancelAction');
            },
            closeModal() {
                this.$emit('closeModal');
            },
            confirmAction() {
                this.$emit('confirmAction');
            },
        }
    }
</script>

