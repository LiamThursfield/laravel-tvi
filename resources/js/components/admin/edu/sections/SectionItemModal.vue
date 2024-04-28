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
                        v-if="editableSectionItem"
                        class="mt-6"
                    >
                        <input-group
                            :input-autofocus="true"
                            input-id="section_item_title"
                            input-name="section_item_title"
                            input-placeholder="Title"
                            label-text="Title"
                            v-model="editableSectionItem.title"
                        />

                        <input-group
                            class="mt-4"
                            input-id="section_item_lecture_count"
                            input-name="section_item_lecture_count"
                            input-placeholder="Total Number of Lectures"
                            label-text="Total Number of Lectures"
                            v-model="editableSectionItem.lecture_count"
                        />

                        <input-group
                            class="mt-4"
                            input-id="section_item_content_length"
                            input-name="section_item_content_length"
                            input-placeholder="Total Length in minutes"
                            label-text="Total Length in minutes"
                            v-model="editableSectionItem.content_length"
                        />
                    </div>

                    <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
                        <h2>Files details</h2>
                        <div class="mt-4 px-4 space-y-2" v-if="editableSectionItem.id">
                            <!-- TODO:: Create a new uploader that only uploads when Add is clicked? -->
                            <label for="file-uploader">Upload resources (PDFs, etc...)</label>
                            <file-manager-file-uploader
                                id="file-uploader"
                                :directory="uploaderDirectory"
                                :url="$route('admin.api.file-manager.files.store', {'section': editableSectionItem.id})"
                                @filesAdded="onFileUploaderFilesAdded"
                                @queueCompleted="onFileUploaderCompleted"
                                class="mb-4"
                            />
                        </div>

                        <div class="mb-4 px-4 space-y-2 mt-4" v-if="editableSectionItem.files">
                            <label>Files</label>
                            <ul class="list-group">
                                <li
                                    v-for="file in editableSectionItem.files"
                                    :key="`file-` + file.id"
                                    class="
                                        flex flex-row items-start justify-between py-2 space-x-4
                                        ease-in-out duration-300 transition-all
                                        hover:bg-gray-100
                                    "
                                >
                                    <div class="flex flex-row items-start">
                                        {{ file.file_name}}
                                    </div>

                                    <div class="flex flex-row items-center space-x-2">
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
                                    </div>
                                </li>
                            </ul>
                        </div>
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
                        :disabled="!isSectionItemValid"
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
    import FileManagerFileUploader from "../../../../components/admin/file_manager/partials/FileManagerFileUploader.vue";

    let CancelToken = axios.CancelToken;
    let filesCancelToken = CancelToken.source();

    export default {
        name: "SectionItemModal",
        mixins: [
            clickaway
        ],
        components: {
            InputGroup,
            FileManagerFileUploader,
        },
        props: {
            isCreate: {
                default: true,
                type: Boolean,
            },
            sectionItem: {
                default: () => {
                    return {
                        title: '',
                        lecture_count: '',
                        content_length: '',
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
                currentDirectory: '/',
                isLoadingFileUpload: false,
                defaultSectionItem: {
                    title: '',
                    lecture_count: '',
                    content_length: '',
                    child_items: [],
                },
                editableSectionItem: {
                    title: '',
                    lecture_count: '',
                    content_length: '',
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
            isSectionItemValid() {
                try {
                    return this.editableSectionItem.title.length;
                } catch (e) {
                    return false;
                }
            },
            headerText() {
                return this.isCreate ?
                    'Add Section' :
                    'Update Section';
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
            }
        },
        methods: {
            onFileUploaderFilesAdded() {
                this.isLoadingFileUpload = true;
            },
            onFileUploaderCompleted() {
                this.isLoadingFileUpload = false;
                this.loadFiles();
            },
            loadFiles() {
                if (this.isLoadingFiles) {
                    return;
                }

                this.isLoadingFiles = true;
                this.formData.files = [];

                let params = {
                    directory: this.currentDirectory
                };

                axios.get(
                    this.$route('admin.api.file-manager.files.show', this.formData.id),
                    {
                        params,
                        cancelToken: filesCancelToken.token
                    }
                ).then(response => {
                    if (response.data.hasOwnProperty('files')) {
                        this.formData.files = response.data.files;
                    }
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load files');
                    }
                }).finally(() => {
                    this.isLoadingFiles = false;
                });

            },
            cancelAction() {
                this.$emit('cancelAction');
            },
            closeModal() {
                this.$emit('closeModal');
            },
            confirmAction(showError = true) {
                if (!this.isSectionItemValid) {
                    if (showError) {
                        this.$errorToast('Section data is invalid.');
                    }
                    return;
                }

                this.$emit('confirmAction', this.editableSectionItem);
                this.editableSectionItem = _.cloneDeep(this.defaultSectionItem);
            },
            onSectionItemChange() {
                this.editableSectionItem = _.cloneDeep(this.sectionItem);
                try {
                    _.forEach(this.defaultSectionItem, (value, key) => {
                        if (!this.editableSectionItem.hasOwnProperty(key)) {
                            this.$set(this.editableSectionItem, key, this.defaultSectionItem[key]);
                        }
                    });
                } catch (e) {
                    this.editableSectionItem = _.cloneDeep(defaultSectionItem);
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
                            this.editableSectionItem = _.cloneDeep(this.defaultSectionItem);
                        }
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        },
        watch: {
            sectionItem: {
                handler: 'onSectionItemChange',
                deep: true,
            },
            showModal: {
                handler: 'onShowModal'
            }
        }
    }
</script>

