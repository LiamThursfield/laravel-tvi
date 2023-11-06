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

                        <input-group
                            :input-autofocus="true"
                            input-id="lecture_item_content_length"
                            input-name="lecture_item_content_length"
                            input-placeholder="Content Length in minutes"
                            label-text="Content Length in minutes"
                            v-model="editableLectureItem.content_length"
                            class="mb-4"
                        />

                        <hr class="py-4">

                        <checkbox-group
                            class="mb-4"
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
                            class="mb-4"
                        />

                        <div
                            v-if="editableLectureItem.preview_url"
                            class="mb-4"
                        >
                            <h2 class="font-weight-bolder">Preview</h2>
                            <div class="px-4 space-y-2">
                                <iframe :src="editableLectureItem.preview_url" width="540" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>

                        <hr class="py-4">

                        <input-group
                            :input-autofocus="true"
                            input-id="lecture_item_video_url"
                            input-name="lecture_item_video_url"
                            input-placeholder="Video URL"
                            label-text="Video URL"
                            v-model="editableLectureItem.video_url"
                            class="mb-4"
                        />

                        <section
                            v-if="editableLectureItem.video_url"
                            class="px-4 space-y-2"
                        >
                            <h2>Video</h2>
                            <iframe :src="editableLectureItem.video_url" width="540" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                        </section>
                    </div>

                    <hr class="py-4">

                    <div class="px-4 space-y-2" v-if="editableLectureItem.id">
                        <!-- TODO:: Create a new uploader that only uploads when Add is clicked? -->
                        <label for="file-uploader">Upload course PDFs</label>
                        <file-manager-file-uploader
                            id="file-uploader"
                            :directory="uploaderDirectory"
                            :url="$route('admin.api.file-manager.files.store', {'lecture': editableLectureItem.id})"
                            @filesAdded="onFileUploaderFilesAdded"
                            @queueCompleted="onFileUploaderCompleted"
                            class="mb-4"
                        />
                    </div>

                    <div>
                        <p>Files</p>
                        <ul class="list-group">
                            <li
                                v-for="file in editableLectureItem.files"
                                :key="`file-` + file.id"
                                class="list-group-item"
                            >
                                {{ file.file_path}}
                                <!-- Open file in new tab -->
                                <a
                                    v-if="file.url"
                                    class="
                                        flex flex-row items-center justify-center rounded text-theme-base-subtle-contrast
                                        ease-in-out duration-300 transition-colors
                                        focus:text-theme-primary focus:outline-none
                                        hover:text-theme-primary
                                    "
                                    :href="file.url"
                                    rel="noreferrer noopener nofollow"
                                    target="_blank"
                                    @click.stop=""
                                >
                                    <icon-external-link class="w-5" />
                                </a>
                            </li>
                        </ul>
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
    import WysiwygField from "../../cms/content/content_fields/WysiwygField";
    import FileManagerFileUploader from "../../file_manager/partials/FileManagerFileUploader";

    export default {
        name: "LectureItemModal",
        mixins: [
            clickaway
        ],
        components: {
            WysiwygField,
            InputGroup,
            CheckboxGroup,
            TextAreaGroup,
            FileManagerFileUploader,
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
            },
            showFileUploader() {
                return this.canUploadFiles && this.userCan('file_manager.edit');
            },
            uploaderDirectory() {
                let url = 'PDFs';

                if (this.currentDirectory !== '/') {
                    url += this.currentDirectory;
                }

                return url;
            },
            loadFiles() {
                if (this.isLoadingFiles) {
                    return;
                }

                this.isLoadingFiles = true;
                this.files = [];

                let params = {
                    directory: this.currentDirectory
                };

                axios.get(
                    this.$route('admin.api.file-manager.files.show'),
                    {
                        params,
                        cancelToken: filesCancelToken.token
                    }
                ).then(response => {
                    if (response.data.hasOwnProperty('files')) {
                        this.editableLectureItem.files = response.data.files;
                    }
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load files');
                    }
                }).finally(() => {
                    this.isLoadingFiles = false;
                });

            },
        },
        methods: {
            onFileUploaderFilesAdded() {
                this.isLoadingFileUpload = true;
            },
            onFileUploaderCompleted() {
                this.isLoadingFileUpload = false;
            },
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
                            this.loadFiles();
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

