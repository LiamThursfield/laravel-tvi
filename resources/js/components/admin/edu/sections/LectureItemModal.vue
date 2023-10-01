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
                            v-model="editableLectureItem.title"
                        />

                        <text-area-group
                            :input-autofocus="true"
                            input-id="lecture_item_description"
                            input-name="lecture_item_description"
                            input-placeholder="Description"
                            label-text="Description"
                            v-model="editableLectureItem.description"
                        />

                        <checkbox-group
                            class="mt-4"
                            :error-message="getPageErrorMessage('can_be_previewed')"
                            :input-id="`can_be_previewed`"
                            :input-name="`can_be_previewed`"
                            label-text="Lecture can be previewed?"
                            @errorHidden="clearPageErrorMessage('can_be_previewed')"
                            v-model="editableLectureItem.can_be_previewed"
                        />

                        <input-group
                            v-if="editableLectureItem.can_be_previewed"
                            :input-autofocus="true"
                            input-id="lecture_item_preview_url"
                            input-name="lecture_item_preview_url"
                            input-placeholder="Preview URL"
                            label-text="Preview URL"
                            v-model="editableLectureItem.preview_url"
                        />

                        <input-group
                            :input-autofocus="true"
                            input-id="lecture_item_video_url"
                            input-name="lecture_item_video_url"
                            input-placeholder="Video URL"
                            label-text="Video URL"
                            v-model="editableLectureItem.video_url"
                        />

                        <input-group
                            :input-autofocus="true"
                            input-id="lecture_item_content_length"
                            input-name="lecture_item_content_length"
                            input-placeholder="Content Length in minutes"
                            label-text="Content Length in minutes"
                            v-model="editableLectureItem.content_length"
                        />

<!--                        <input-group-->
<!--                            :input-autofocus="true"-->
<!--                            input-id="lecture_item_item_type"-->
<!--                            input-name="lecture_item_item_type"-->
<!--                            input-placeholder="Item Type"-->
<!--                            label-text="Item Type"-->
<!--                            v-model="editableLectureItem.item_type"-->
<!--                        />-->

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
    import InputGroup from "../../../core/forms/InputGroup";
    import CheckboxGroup from "../../../core/forms/CheckboxGroup";
    import TextAreaGroup from "../../../core/forms/TextAreaGroup";

    export default {
        name: "LectureItemModal",
        mixins: [
            clickaway
        ],
        components: {
            InputGroup,
            CheckboxGroup,
            TextAreaGroup,
        },
        props: {
            isCreate: {
                default: true,
                type: Boolean,
            },
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
                },
            }
        },
        computed: {
            confirmText() {
                return this.isCreate ?
                    'Add' :
                    'Update';
            },
            isLectureItemValid() {
                try {
                    return this.editableLectureItem.title.length;
                } catch (e) {
                    return false;
                }
            },
            headerText() {
                return this.isCreate ?
                    'Add Lecture' :
                    'Update Lecture';
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
                console.log('first');
                console.log(this.lectureItem);
                this.editableLectureItem = _.cloneDeep(this.lectureItem);
                try {
                    _.forEach(this.defaultLectureItem, (value, key) => {
                        if (!this.editableLectureItem.hasOwnProperty(key)) {
                            console.log('yoyo');
                            this.$set(this.editableLectureItem, key, this.defaultLectureItem[key]);
                        }
                    });
                } catch (e) {
                    console.log('lol');
                    this.editableLectureItem = _.cloneDeep(this.defaultLectureItem);
                }
            },
            onShowModal() {
                console.log('onshowModal');
                console.log(this.editableLectureItem);
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

