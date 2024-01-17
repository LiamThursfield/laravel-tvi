<template>
    <transition
        v-if="showModal"
        name="fade"
    >
        <div
            class="bg-gray-800 bg-opacity-75 fixed flex h-full inset-0 items-center justify-center w-full p-4 z-30"
            :class="componentName"
        >
            <div
                class="bg-theme-card max-h-full max-w-full overflow-y-auto relative rounded shadow-md text-theme-card-contrast w-96"
                v-on-clickaway="closeModal"
            >
                <div class="flex flex-row justify-end p-2">

                    <button
                        class="
                            flex items-center justify-center ml-auto p-1 rounded
                            ease-in-out duration-300 transition-colors
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-base-subtle
                        "
                        type="button"
                        @click="closeModal"
                    >
                        <icon-close class="h-5 w-5"/>
                    </button>
                </div>

                <slot />
            </div>
        </div>
    </transition>
</template>

<script>
    import { mixin as clickaway } from 'vue-clickaway';

    export default {
        name: "GenericModal",
        mixins: [clickaway],
        props: {
            componentName: {
                default: "generic-modal",
                type: String
            },
            showModal: {
                default: true,
                type: Boolean
            }
        },
        methods: {
            closeModal() {
                this.$emit('closeModal');
            },
            onShowModal() {
                try {
                    let body = document.getElementsByTagName('body')[0];

                    if (this.showModal) {
                        body.classList.add('overflow-y-hidden');
                    } else {
                        body.classList.remove('overflow-y-hidden');
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        },
        watch: {
            showModal: {
                handler: 'onShowModal'
            }
        }
    }
</script>

