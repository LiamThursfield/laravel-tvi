<template>
    <transition
        v-if="showModal"
        name="fade"
    >
        <div
            class="fixed bg-gray-800 bg-opacity-75 flex h-full inset-0 items-center justify-center w-full p-4 z-30"
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
                        {{ headerText }}
                    </h2>

                    <div
                        v-if="editableLectureItem"
                        class="mt-6"
                    >

                        <input-group
                            :input-autofocus="true"
                            input-id="lecture_item_title"
                            input-name="lecture_item_title"
                            input-placeholder="Title"
                            label-text="Title"
                            class="mb-4"
                            v-model="editableLectureItem.title"
                        />

                        <wysiwyg-field
                            class="mb-4"
                            :input-autofocus="true"
                            v-model="editableLectureItem.description"
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
                        :disabled="!isLectureItemValid"
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
    import InputGroup from "../../../core/forms/InputGroup.vue";
    import WysiwygField from "../../cms/content/content_fields/WysiwygField.vue";

    export default {
        name: "LectureItemModal",
        mixins: [
            clickaway
        ],
        components: {
            WysiwygField,
            InputGroup,
        },
        props: {
            lectureItem: {
                default: () => {
                    return {
                        id: '',
                        title: '',
                        description: '',
                        can_be_previewed: false,
                        preview_url: '',
                        video_url: '',
                        content_length: '',
                        item_type: 'lecture',
                        child_items: [],
                        templateField: { type: 'wysiwyg'},
                        section_id: null,
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
                currentDirectory: '/',
                isLoadingFileUpload: false,
                defaultLectureItem: {
                    id: '',
                    title: '',
                    description: '',
                    can_be_previewed: false,
                    preview_url: '',
                    video_url: '',
                    content_length: '',
                    item_type: 'lecture',
                    child_items: [],
                    section_id: null,
                },
                editableLectureItem: {
                    id: '',
                    title: '',
                    description: '',
                    can_be_previewed: false,
                    preview_url: '',
                    video_url: '',
                    content_length: '',
                    item_type: 'lecture',
                    child_items: [],
                    section_id: null,
                },
            }
        },
        computed: {
            confirmText() {
                return 'Add';
            },
            isLectureItemValid() {
                try {
                    return this.editableLectureItem.title.length;
                } catch (e) {
                    return false;
                }
            },
            headerText() {
                return 'Add Lecture';
            },
        },
        methods: {
            cancelAction() {
                this.$emit('cancelAction');
            },
            closeModal() {
                this.$emit('closeModal');
            },
            confirmAction(showError = true) {
                if (!this.isLectureItemValid) {
                    if (showError) {
                        this.$errorToast('Lecture data is invalid.');
                    }
                    return;
                }

                this.$emit('confirmAction', this.editableLectureItem);
                this.editableLectureItem = _.cloneDeep(this.defaultLectureItem);
            },
            onLectureItemChange() {
                this.editableLectureItem = _.cloneDeep(this.lectureItem);
                try {
                    _.forEach(this.defaultLectureItem, (value, key) => {
                        if (!this.editableLectureItem.hasOwnProperty(key)) {
                            this.$set(this.editableLectureItem, key, this.defaultLectureItem[key]);
                        }
                    });
                } catch (e) {
                    this.editableLectureItem = _.cloneDeep(this.defaultLectureItem);
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
                            this.editableLectureItem = _.cloneDeep(this.defaultLectureItem);
                        }
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        },
        watch: {
            lectureItem: {
                handler: 'onLectureItemChange',
                deep: true,
            },
            showModal: {
                handler: 'onShowModal'
            }
        }
    }
</script>

