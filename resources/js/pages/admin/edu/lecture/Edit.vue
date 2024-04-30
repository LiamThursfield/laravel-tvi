<template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div class="flex flex-row space-x-2 text-sm mb-2">
                <span class="flex flex-row">
                    <template>
                        <inertia-link
                            class="
                                text-theme-base-subtle-contrast
                                focus:outline-none focus:text-theme-primary
                                hover:text-theme-primary
                            "
                            :href="$route('admin.edu.courses.edit', lecture.section.course.id)"
                        >
                           {{ lecture.section.course.name }}
                        </inertia-link>

                        <span
                            class="
                                ml-2 text-theme-base-subtle-contrast
                                focus:outline-none focus:text-theme-primary
                            "
                        >
                            /  {{ lecture.section.title }}
                        </span>
                    </template>
                </span>
        </div>

        <div
            v-if="userCan('lectures.edit')"
            class="flex flex-row items-center mb-6 sticky-menu"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit - <b>{{ lecture.title }}</b>
            </h1>

            <inertia-link
                v-if="userCan('lectures.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.edu.lectures.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Save
                </span>
            </button>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg">
            <h2>General details</h2>
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('title')"
                input-autocomplete="lecture_title"
                input-id="title"
                input-name="title"
                :input-required="true"
                input-type="text"
                label-text="Title"
                @errorHidden="clearPageErrorMessage('title')"
                @input="onNameInput"
                v-model="formData.title"
            />

            <div class="mt-4">
                <label>Description</label>
                <wysiwyg-field
                    :input-autofocus="true"
                    v-model="formData.description"
                />
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Lecture Preview</h2>
            <checkbox-group
                class="mt-4 mb-4"
                :error-message="getPageErrorMessage('can_be_previewed')"
                :input-id="`can_be_previewed`"
                :input-name="`can_be_previewed`"
                label-text="Lecture can be previewed?"
                @errorHidden="clearPageErrorMessage('can_be_previewed')"
                v-model="formData.can_be_previewed"
            />

            <input-group
                v-if="formData.can_be_previewed"
                :input-autofocus="true"
                input-id="lecture_item_preview_url"
                input-name="lecture_item_preview_url"
                input-placeholder="Preview URL"
                label-text="Preview URL"
                v-model="formData.preview_url"
                class="mb-4"
            />

            <div
                v-if="formData.preview_url"
                class="mb-4"
            >
                <h2 class="font-weight-bolder">Preview</h2>
                <div class="px-4 space-y-2">
                    <iframe :src="formData.preview_url" width="540" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>Video details</h2>
            <input-group
                class="mt-4"
                :error-message="getPageErrorMessage('content_length')"
                input-autocomplete="lecture_content_length_video"
                input-id="content_length"
                input-name="content_length"
                :input-required="false"
                input-type="text"
                label-text="Total content length in hours"
                @errorHidden="clearPageErrorMessage('content_length')"
                v-model="formData.content_length"
            />

            <input-group
                :input-autofocus="true"
                input-id="lecture_item_video_url"
                input-name="lecture_item_video_url"
                input-placeholder="Video URL"
                label-text="Video URL"
                v-model="formData.video_url"
                class="mb-4"
            />

            <section
                v-if="formData.video_url"
                class="px-4 space-y-2"
            >
                <h2>Video</h2>
                <iframe :src="formData.video_url" width="540" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            </section>
        </div>

        <div class="bg-white p-6 shadow-subtle rounded-lg mt-4">
            <h2>File details</h2>
            <div class="mt-4 px-4 space-y-2" v-if="formData.id">
                <!-- TODO:: Create a new uploader that only uploads when Add is clicked? -->
                <label for="file-uploader">Upload lecture PDFs</label>
                <file-manager-file-uploader
                    id="file-uploader"
                    :directory="uploaderDirectory"
                    :url="$route('admin.api.file-manager.files.store', {'lecture': formData.id})"
                    @filesAdded="onFileUploaderFilesAdded"
                    @queueCompleted="onFileUploaderCompleted"
                    class="mb-4"
                />
            </div>

            <div class="mb-4 px-4 space-y-2 mt-4" v-if="formData.files">
                <label>Files</label>
                <ul class="list-group">
                    <li
                        v-for="file in formData.files"
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
    </form>
</template>

<script>
import slugify from "slugify";
import InputGroup from "../../../../components/core/forms/InputGroup.vue";
import TextAreaGroup from "../../../../components/core/forms/TextAreaGroup.vue";
import CheckboxGroup from "../../../../components/core/forms/CheckboxGroup.vue";
import SectionItemsEditor from "../../../../components/admin/edu/sections/SectionItemsEditor.vue";
import _ from "lodash";
import WysiwygField from "../../../../components/admin/cms/content/content_fields/WysiwygField.vue";
import FileManagerFileUploader from "../../../../components/admin/file_manager/partials/FileManagerFileUploader.vue";

let CancelToken = axios.CancelToken;
let filesCancelToken = CancelToken.source();

export default {
    name: "AdminEduLectureEdit",
    components: {
        WysiwygField,
        TextAreaGroup,
        SectionItemsEditor,
        InputGroup,
        CheckboxGroup,
        FileManagerFileUploader,
    },
    layout: 'admin-layout',
    props: {
        'lecture': {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            autoUpdateSlug: false,
            currentDirectory: '/',
            isLoadingFileUpload: false,
            formData: {}
        }
    },
    computed: {
        uploaderDirectory() {
            let url = 'PDFs';

            if (this.currentDirectory !== '/') {
                url += this.currentDirectory;
            }

            return url;
        }
    },
    created() {
        this.transformSections();
        this.formData = {
            id: this.lecture.id,
            title: this.lecture.title,
            slug: this.lecture.slug,
            description: this.lecture.description,
            can_be_previewed: this.lecture.can_be_previewed,
            preview_url: this.lecture.preview_url,
            video_url: this.lecture.video_url,
            content_length: this.lecture.content_length,
            index: this.lecture.index,
            item_type: this.lecture.item_type,
            section_id: this.lecture.section_id,
            section: this.lecture.section,
            files: this.lecture.files,
            templateField: { type: 'wysiwyg'}
        };
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
        transformSections() {
            let sections = this.lecture.sections;

            _.forEach(sections, (section, key) => {
                _.forEach(section.child_items, (item, key) => {
                    item.child_items = [];
                });
            });

            this.lecture.sections = sections;
        },
        onNameInput() {
            if (!this.autoUpdateSlug) {
                return;
            }

            this.formData.slug = this.slugify(this.formData.name);
            this.computedUrl = this.formData.slug;
        },
        onSlugBlur() {
            this.formData.slug = this.slugify(this.formData.slug)
        },
        onSlugInput() {
            this.autoUpdateSlug = false;
            this.computedUrl = this.formData.slug;
        },
        slugify(value) {
            if (!value || !value.length) {
                return '';
            }

            return slugify(
                value, {
                    lower: true,
                }
            );
        },
        submit() {
            this.$inertia.put(
                this.$route('admin.edu.lectures.update', this.lecture.id),
                this.formData
            );
        }
    }
}
</script>
