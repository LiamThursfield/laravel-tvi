<template>
    <section>
        <div
            class="
                flex flex-col mt-4 space-y-4
                md:flex-row md:items-start md:space-x-4 md:space-y-0
            "
        >
            <div
                class="
                    bg-white p-6 shadow-subtle overflow-hidden rounded-lg
                    md:w-72
                "
            >
                <h2 class="flex flex-row justify-between">
                    <span class="text-theme-base-subtle-contrast">
                        Directories
                    </span>
                </h2>

                <div class="mt-2">
                    <file-manager-directory-list
                        :can-change-directory="canChangeDirectory"
                        :directories="directories"
                        :is-loading-directories="isLoadingDirectories"
                        :parent-directory="parentDirectory"
                        @changeDirectory="changeDirectory"
                    />

                    <div
                        v-if="showCreateDirectoryButton"
                        class="mt-8 w-full"
                    >
                        <transition
                            name="slide-left-multiple"
                            mode="out-in"
                        >
                            <div
                                v-if="!isCreatingDirectory"
                            >
                                <button
                                    class="
                                        bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-full
                                        ease-in-out duration-300 transition-colors
                                        focus:outline-none focus:ring focus:ring-primary
                                        hover:bg-theme-primary hover:text-theme-primary-contrast
                                    "
                                    type="button"
                                    @click="startCreatingDirectory"
                                >
                                    Create Directory
                                </button>
                            </div>

                            <div
                                v-else
                                class="flex flex-col"
                            >
                                <label
                                    for="new_directory"
                                    hidden
                                >
                                    New Directory Name
                                </label>
                                <input
                                    id="new_directory"
                                    class="
                                        appearance-none border border-theme-base-subtle-contrast px-4 py-1 rounded shadow-none
                                        focus:outline-none focus:ring focus:ring-primary
                                    "
                                    placeholder="Directory Name"
                                    ref="new_directory"
                                    type="text"
                                    v-model="newDirectoryName"
                                >

                                <div class="flex flex-row mt-2 space-x-2 w-full">
                                    <button
                                        type="button"
                                        class="
                                            bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-1/2
                                            ease-in-out duration-300 transition-colors
                                            focus:bg-theme-danger focus:outline-none focus:text-theme-danger-contrast
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        :disabled="isLoadingNewDirectory"
                                        @click="stopCreatingDirectory"
                                    >
                                        <icon-x class="w-5"/>
                                    </button>
                                    <button
                                        type="button"
                                        class="
                                            bg-theme-base-subtle flex flex-row items-center justify-center px-2 py-1 rounded text-theme-base-subtle-contrast w-1/2
                                            ease-in-out duration-300 transition-colors
                                            focus:bg-theme-success focus:outline-none focus:text-theme-success-contrast
                                            hover:bg-theme-success hover:border-theme-success hover:text-theme-success-contrast
                                        "
                                        :disabled="!canCreateDirectory"
                                        @click="createDirectory"
                                    >
                                        <icon-check
                                            v-if="!isLoadingNewDirectory"
                                            class="w-5"
                                        />
                                        <icon-loader-circle
                                            v-else
                                            class="animate-spin-slow w-5"
                                        />
                                    </button>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <div class="bg-white shadow-subtle p-6 rounded-lg">
                    <file-manager-files-header
                        :can-change-directory="canChangeDirectory"
                        :current-directory-list="currentDirectoryList"
                        :show-breadcrumbs="showBreadcrumbs"
                        @changeDirectoryViaBreadcrumb="changeDirectoryViaBreadcrumb"
                    />

                    <file-manager-files-list
                        class="mt-2"
                        :enable-file-select="enableFileSelect"
                        :files="files"
                        :show-files-loader="showFilesLoader"
                        @fileSelected="onFileSelected"
                    />
                </div>

                <file-manager-file-uploader
                    v-show="showFileUploader"
                    class="mt-4"
                    :directory="uploaderDirectory"
                    :url="$route('admin.api.file-manager.files.store')"
                    @filesAdded="onFileUploaderFilesAdded"
                    @queueCompleted="onFileUploaderCompleted"
                />
            </div>

        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import FileManagerDirectoryList from "./partials/FileManagerDirectoryList";
    import FileManagerFilesHeader from "./partials/FileManagerFilesHeader";
    import FileManagerFilesList from "./partials/FileManagerFilesList";
    import FileManagerFileUploader from "./partials/FileManagerFileUploader";

    let CancelToken = axios.CancelToken;
    let filesCancelToken = CancelToken.source();

    export default {
        name: "FileManager",
        components: {
            FileManagerFileUploader,
            FileManagerDirectoryList,
            FileManagerFilesHeader,
            FileManagerFilesList,
        },
        props: {
            enableFileSelect: {
                default: false,
                type: Boolean,
            },
            initialise: {
                default: false,
                type: Boolean
            }
        },
        data() {
            return {
                currentDirectory: '/',
                directories: [],
                files: [],
                isInitialised: false,
                isCreatingDirectory: false,
                isLoadingDirectories: false,
                isLoadingFiles: false,
                isLoadingNewDirectory: false,
                isLoadingFileUpload: false,
                newDirectoryName: '',
            }
        },
        computed: {
            canChangeDirectory() {
                return !this.isLoadingNewDirectory && !this.isLoadingDirectories && !this.isLoadingFileUpload;
            },
            canCreateDirectory() {
                if (!this.isCreatingDirectory) {
                    return false;
                }

                if (this.isLoadingNewDirectory) {
                    return false;
                }

                if (this.isLoadingFileUpload) {
                    return false;
                }

                let name = _.trim(this.newDirectoryName);
                if (!name.length) {
                    return false;
                }

                return true;
            },
            canUploadFiles() {
                return !this.isLoadingDirectories;
            },
            currentDirectoryList() {
                let directory = _.trim(this.currentDirectory, '/');

                if (!directory) {
                    return ['/'];
                }

                let list = _.split(directory, '/');
                return ['/'].concat(list);
            },
            isUploadEnabled() {
                try {
                    return !! this.$page.props.app.config.file_manager_uploads_enabled;
                } catch (e) {
                    return false;
                }
            },
            newDirectoryNameFormatted() {
                if (!this.currentDirectoryList || this.currentDirectoryList.length < 2) {
                    return this.newDirectoryName;
                }

                let path = _.clone(this.currentDirectoryList);
                path = path.splice(1);

                path.push(this.newDirectoryName);

                return '/' + path.join('/');
            },
            parentDirectory() {
                if (!this.currentDirectoryList) {
                    return null;
                }

                if (this.currentDirectoryList.length === 1) {
                    return null;
                }

                if (this.currentDirectoryList.length === 2) {
                    return this.currentDirectoryList[0];
                }

                let list = _.clone(this.currentDirectoryList);

                return '/' + list.splice(1, this.currentDirectoryList.length - 2).join('/');
            },
            showBreadcrumbs() {
                return this.currentDirectoryList.length > 1;
            },
            showCreateDirectoryButton() {
                return this.isUploadEnabled && !this.isLoadingDirectories && !this.isLoadingFileUpload && this.userCan('file_manager.edit');
            },
            showFilesLoader() {
                return this.isLoadingDirectories || this.isLoadingFiles;
            },
            showFileUploader() {
                return this.canUploadFiles && this.userCan('file_manager.edit');
            },
            uploaderDirectory() {
                let url = '/';

                if (this.currentDirectory !== '/') {
                    url += this.currentDirectory;
                }

                return url;
            }
        },
        mounted() {
            if (this.initialise) {
                this.initialiseFileManager();
            }
        },
        methods: {
            cancelLoadFiles() {
                if (this.isLoadingFiles) {
                    filesCancelToken.cancel('Files load cancelled');
                    filesCancelToken = CancelToken.source();
                }
            },
            changeDirectory(newDirectory = '/') {
                if (!this.canChangeDirectory) {
                    this.$errorToast('Unable to change directory');
                    return;
                }

                this.currentDirectory = newDirectory;
                this.loadDirectories();
            },
            changeDirectoryViaBreadcrumb(breadcrumbIndex) {
                if (breadcrumbIndex > (this.currentDirectoryList.length - 1)) {
                    return;
                }

                let directory = this.getDirectoryViaBreadcrumb(breadcrumbIndex);
                if (directory) {
                    this.changeDirectory(directory);
                }
            },
            createDirectory() {
                if (!this.canCreateDirectory) {
                    this.$errorToast('Please enter a valid directory name');
                    return;
                }

                this.isLoadingNewDirectory = true;

                let params = {
                    directory: this.newDirectoryNameFormatted
                }

                axios.post(
                    this.$route('admin.api.file-manager.directories.store'), params
                ).then(response => {
                    this.isLoadingNewDirectory = false;
                    this.changeDirectory(this.newDirectoryNameFormatted)
                    this.stopCreatingDirectory();
                }).catch(e => {
                    let message = 'Failed to create directory';
                    if (e && e.response && e.response.data && e.response.data.message) {
                        message += ' - ' + e.response.data.message;
                    }

                    this.$errorToast(message);
                    this.isLoadingNewDirectory = false;
                });
            },
            getDirectoryViaBreadcrumb(index) {
                if (index === 0) {
                    return "/"
                }

                let breadcrumbs = _.clone(this.currentDirectoryList);
                breadcrumbs = breadcrumbs.splice(1, index);

                return '/' + breadcrumbs.join('/');
            },
            initialiseFileManager() {
                if (!this.isInitialised) {
                    this.isInitialised = true;
                    this.loadFileManager();
                }
            },
            loadDirectories() {
                if (this.isLoadingDirectories) {
                    return;
                }

                this.isLoadingDirectories = true;
                this.directories = [];
                this.cancelLoadFiles();

                let params = {
                    directory: this.currentDirectory
                };

                axios.get(
                    this.$route('admin.api.file-manager.directories.index'),
                    { params }
                ).then(response => {
                    if (response.data.hasOwnProperty('directories')) {
                        this.directories = response.data.directories;
                    }

                    this.loadFiles();
                }).catch(e => {
                    this.$errorToast('Failed to load directories');
                }).finally(() => {
                    this.isLoadingDirectories = false;
                });
            },
            loadFileManager() {
                this.loadDirectories();
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
                    this.$route('admin.api.file-manager.files.index'),
                    {
                        params,
                        cancelToken: filesCancelToken.token
                    }
                ).then(response => {
                    if (response.data.hasOwnProperty('files')) {
                        this.files = response.data.files;
                    }
                }).catch(e => {
                    if (!axios.isCancel(e)) {
                        this.$errorToast('Failed to load files');
                    }
                }).finally(() => {
                    this.isLoadingFiles = false;
                });

            },
            onFileSelected(file) {
                this.$emit('fileSelected', file);
            },
            onFileUploaderFilesAdded() {
                this.isLoadingFileUpload = true;
            },
            onFileUploaderCompleted() {
                this.isLoadingFileUpload = false;
                this.loadFiles();
            },
            onInitialise() {
                if (this.initialise) {
                    this.initialiseFileManager();
                }
            },
            startCreatingDirectory() {
                this.newDirectoryName = '';
                this.isCreatingDirectory = true;

                try {
                    setTimeout(() => {
                        this.$refs['new_directory'].focus();
                    }, 450);
                } catch (e) {}
            },
            stopCreatingDirectory() {
                if (!this.isCreatingDirectory) {
                    return;
                }

                // Do not allow user to initiate the "stop" action if a directory is being created
                if (this.isLoadingNewDirectory) {
                    return false;
                }

                this.newDirectoryName = '';
                this.isCreatingDirectory = false;

                try {
                    this.$refs['new_directory'].blur();
                } catch (e) {}
            }
        },
        watch: {
            initialise: {
                handler: 'onInitialise'
            }
        }
    }
</script>
