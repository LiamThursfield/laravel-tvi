<template>
    <transition
        v-if="showModal"
        name="fade"
    >
        <div
            class="absolute bg-gray-800 bg-opacity-75 flex h-full inset-0 items-center justify-center w-full p-4 z-30"
            @keypress.enter.prevent.stop="confirmAction(false)"
        >
            <div
                class="bg-theme-card max-h-full max-w-full overflow-y-auto relative rounded shadow-md text-theme-card-contrast w-160"
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


                <div class="px-4">
                    <h2
                        class="font-semibold text-center text-lg"
                    >
                        {{ headerText }}s
                    </h2>

                    <div
                        v-if="editableMenuItem"
                        class="mt-6"
                    >
                        <input-group
                            :input-autofocus="true"
                            input-id="menu_item_label"
                            input-name="menu_item_label"
                            input-placeholder="Label"
                            label-text="Label"
                            v-model="editableMenuItem.label"
                        />

                        <input-group
                            class="mt-4"
                            input-id="menu_item_href"
                            input-name="menu_item_href"
                            input-placeholder="URL/Href"
                            label-text="URL/Href"
                            v-model="editableMenuItem.href"
                        />

                        <input-group
                            class="mt-4"
                            input-id="menu_item_custom_class"
                            input-name="menu_item_custom_class"
                            input-placeholder="Custom Class"
                            label-text="Custom Class"
                            v-model="editableMenuItem.custom_class"
                        />

                        <input-group
                            class="mt-4"
                            input-id="menu_item_target"
                            input-name="menu_item_target"
                            input-placeholder="Target"
                            label-text="Target"
                            v-model="editableMenuItem.target"
                        />

                        <input-group
                            class="mt-4"
                            input-id="menu_item_rel"
                            input-name="menu_item_rel"
                            input-placeholder="Rel"
                            label-text="Rel"
                            v-model="editableMenuItem.rel"
                        />

                    </div>

                </div>


                <div
                    class="
                        flex flex-col items-center justify-end mb-4 mt-8 px-4 space-y-2
                        sm:flex-row sm:space-x-3 sm:space-y-0
                    "
                >
                    <button
                        class="
                            bg-theme-base-subtle min-w-24 px-4 py-2 rounded text-center text-theme-base-subtle-contrast w-full
                            ease-in-out duration-300 transition-colors
                            sm:w-auto
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-base-subtle-contrast hover:text-theme-base-subtle
                        "
                        type="button"
                        @click="cancelAction"
                    >
                        Cancel
                    </button>

                    <button
                        class="
                            bg-theme-primary border border-theme-primary flex flex-row items-center justify-center px-4
                            py-2 min-w-24 px-4 py-2 rounded text-center text-theme-primary-contrast w-full
                            ease-in-out duration-300 transition-colors
                            sm:w-auto
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-primary-hover hover:border-theme-primary-hover hover:text-theme-primary-hover-contrast
                        "
                        :disabled="!isMenuItemValid"
                        type="button"
                        @click="confirmAction"
                    >
                        {{ confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import _ from 'lodash';
    import { mixin as clickaway } from 'vue-clickaway';
    import InputGroup from "../../../core/forms/InputGroup";

    export default {
        name: "MenuItemModal",
        mixins: [
            clickaway
        ],
        components: {
            InputGroup
        },
        props: {
            isCreate: {
                default: true,
                type: Boolean,
            },
            menuItem: {
                default: () => {
                    return {
                        custom_class: '',
                        child_items: [],
                        href: '',
                        label: '',
                        rel: '',
                        target: '',
                    };
                }
            },
            resetOnClose: {
                default: false,
                type: Boolean,
            },
            showModal: {
                default: true,
                type: Boolean
            }
        },
        data() {
            return {
                defaultMenuItem: {
                    custom_class: '',
                    child_items: [],
                    href: '',
                    label: '',
                    rel: '',
                    target: '',
                },
                editableMenuItem: {
                    custom_class: '',
                    child_items: [],
                    href: '',
                    label: '',
                    rel: '',
                    target: '',
                },
            }
        },
        computed: {
            confirmText() {
                return this.isCreate ?
                    'Add' :
                    'Update';
            },
            isMenuItemValid() {
                try {
                    return this.editableMenuItem.label.length;
                } catch (e) {
                    return false;
                }
            },
            headerText() {
                return this.isCreate ?
                    'Add Menu Item' :
                    'Update Menu Item';
            }
        },
        methods: {
            cancelAction() {
                this.$emit('cancelAction');
            },
            closeModal() {
                this.$emit('closeModal');
            },
            confirmAction(showError = true) {
                if (!this.isMenuItemValid) {
                    if (showError) {
                        this.$errorToast('Menu item data is invalid.');
                    }
                    return;
                }

                this.$emit('confirmAction', this.editableMenuItem);
                this.editableMenuItem = _.cloneDeep(this.defaultMenuItem);
            },
            onMenuItemChange() {
                this.editableMenuItem = _.cloneDeep(this.menuItem);
                try {
                    _.forEach(this.defaultMenuItem, (value, key) => {
                        if (!this.editableMenuItem.hasOwnProperty(key)) {
                            this.$set(this.editableMenuItem, key, this.defaultMenuItem[key]);
                        }
                    });
                } catch (e) {
                    this.editableMenuItem = _.cloneDeep(defaultMenuItem);
                }
            },
            onShowModal() {
                try {
                    let body = document.getElementsByTagName('body')[0];

                    if (this.showModal) {
                        body.classList.add('overflow-y-hidden');
                    } else {
                        body.classList.remove('overflow-y-hidden');

                        if (this.resetOnClose) {
                            this.editableMenuItem = _.cloneDeep(this.defaultMenuItem);
                        }
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        },
        watch: {
            menuItem: {
                handler: 'onMenuItemChange',
                deep: true,
            },
            showModal: {
                handler: 'onShowModal'
            }
        }
    }
</script>

