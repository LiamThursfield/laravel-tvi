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
                    <span class="text-gray-500">
                        Directories
                    </span>
                </h2>

                <div class="mt-2">
                    <ul>
                        <template v-if="isLoadingDirectories">
                            <li
                                class="flex flex-row items-start text-gray-500 py-1 w-full"
                            >
                                <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                                <span>Loading</span>
                            </li>
                        </template>
                        <template v-else>
                            <li
                                v-if="parentDirectory !== null"
                            >
                                <button
                                    class="
                                        flex flex-row items-start py-1 w-full
                                        focus:outline-none focus:text-theme-primary
                                        hover:text-theme-primary
                                    "
                                    :disabled="!canChangeDirectory"
                                    type="button"
                                    @click="changeDirectory(parentDirectory)"
                                >
                                    <icon-arrow-bar-up class="mr-2 w-5"/>
                                    <span>Parent Directory</span>
                                </button>
                            </li>
                            <li
                                v-for="directory in directories"
                                :key="directory.directory"
                            >
                                <button
                                    class="
                                        flex flex-row items-start py-1 w-full
                                        focus:outline-none focus:text-theme-primary
                                        hover:text-theme-primary
                                    "
                                    type="button"
                                    :disabled="!canChangeDirectory"
                                    @click="changeDirectory(directory.directory)"
                                >
                                    <icon-folder class="mr-2 w-5"/>
                                    <span>{{ directory.label }}</span>
                                </button>
                            </li>
                        </template>
                    </ul>

                    <div
                        v-if="showCreateDirectoryButton"
                        class="mt-8 w-full"
                    >
                        <transition
                            name="slide-left" mode="out-in"
                        >
                            <button
                                v-if="!isCreatingDirectory"
                                key="intial"
                                class="
                                    border border-gray-500 flex flex-row items-center justify-center px-2 py-1 rounded text-gray-500 w-full
                                    ease-in-out duration-300 transition-colors
                                    focus:border-theme-primary focus:outline-none
                                    hover:bg-theme-primary hover:border-theme-primary hover:text-theme-primary-contrast
                                "
                                type="button"
                                @click="startCreatingDirectory"
                            >
                                Create Directory
                            </button>

                            <div
                                v-else
                                key="creating"
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
                                    class="border border-gray-500 px-4 py-1 rounded"
                                    placeholder="Directory Name"
                                    ref="new_directory"
                                    type="text"
                                    v-model="newDirectoryName"
                                >

                                <div class="flex flex-row mt-2 space-x-2 w-full">
                                    <button
                                        type="button"
                                        class="
                                            border border-gray-500 flex flex-row items-center justify-center px-2 py-1 rounded text-gray-500 w-1/2
                                            ease-in-out duration-300 transition-colors
                                            focus:bg-theme-danger focus:border-theme-danger focus:outline-none focus:text-theme-danger-contrast
                                            hover:bg-theme-danger hover:border-theme-danger hover:text-theme-danger-contrast
                                        "
                                        :disabled="isLoadingNewDirectory"
                                        @click="stopCreatingDirectory"
                                    >
                                        <icon-x class="w-5"/>
                                    </button>
                                    <button
                                        type="button"
                                        class="
                                            border border-theme-success flex flex-row items-center justify-center px-2 py-1 rounded text-theme-success w-1/2
                                            ease-in-out duration-300 transition-colors
                                            focus:outline-none focus:bg-theme-success focus:text-theme-success-contrast
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

            <div class="bg-white flex-1 p-6 shadow-subtle rounded-lg">
                <h2 class="flex flex-row items-center justify-between">
                    <span class="text-gray-500">
                        Files
                    </span>
                    <span
                        v-if="showBreadcrumbs"
                        class="flex flex-row space-x-2 text-sm"
                    >
                        <span
                            v-for="(breadcrumb, index) in currentDirectoryList"
                            :key="`breadcrumb_${index}`"
                            class="flex flex-row"
                        >
                            <template v-if="index < (currentDirectoryList.length - 1)">
                                <button
                                    class="
                                    text-gray-500
                                    focus:outline-none focus:text-theme-primary
                                    hover:text-theme-primary
                                "
                                    type="button"
                                    :disabled="!canChangeDirectory"
                                    @click="changeDirectoryViaBreadcrumb(index)"
                                >
                                    <template v-if="index === 0">
                                        root
                                    </template>
                                    <template v-else>
                                        {{ breadcrumb }}
                                    </template>
                                </button>

                                <span class="ml-2 text-gray-300">
                                    /
                                </span>
                            </template>

                            <template
                                v-else
                            >
                                <span
                                    class="text-gray-500"
                                    :class="{
                                        'opacity-50': !canChangeDirectory
                                    }"
                                >
                                    {{ breadcrumb}}
                                </span>
                            </template>
                        </span>
                    </span>
                </h2>

                <div class="mt-2">

                </div>
            </div>

        </div>

    </section>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: "FileManager",
        props: {
            initialise: {
                default: false,
                type: Boolean
            }
        },
        data() {
            return {
                currentDirectory: '/',
                directories: [],
                isInitialised: false,
                isCreatingDirectory: false,
                isLoadingDirectories: false,
                isLoadingFiles: false,
                isLoadingNewDirectory: false,
                newDirectoryName: '',
            }
        },
        computed: {
            canChangeDirectory() {
                return !this.isLoadingNewDirectory && !this.isLoadingDirectories;
            },
            canCreateDirectory() {
                if (!this.isCreatingDirectory) {
                    return false;
                }

                if (this.isLoadingNewDirectory) {
                    return false;
                }

                let name = _.trim(this.newDirectoryName);
                if (!name.length) {
                    return false;
                }

                return true;
            },
            currentDirectoryList() {
                let directory = _.trim(this.currentDirectory, '/');

                if (!directory) {
                    return ['/'];
                }

                let list = _.split(directory, '/');
                return ['/'].concat(list);
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
                return !this.isLoadingDirectories && this.userCan('file_manager.edit');
            },
        },

        mounted() {
            if (this.initialise) {
                this.initialiseFileManager();
            }
        },
        methods: {
            changeDirectory(newDirectory = '/') {
                if (!this.canChangeDirectory) {
                    // TODO: Error Toast
                    console.log('Unable to change directory.')
                    return;
                }

                this.currentDirectory = newDirectory;
                this.loadDirectories();
            },
            changeDirectoryViaBreadcrumb(index) {
                if (index > (this.currentDirectoryList.length - 1)) {
                    return;
                }

                let directory = this.getDirectoryViaBreadcrumb(index);
                if (directory) {
                    this.changeDirectory(directory);
                }
            },
            createDirectory() {
                if (!this.canCreateDirectory) {
                    // TODO: Error toast
                    console.error('Please enter a valid directory name');
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
                    // TODO: Error toast
                    this.isLoadingNewDirectory = false;
                    console.log(e);
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
                }).catch(e => {
                    // TODO: Error toast
                    console.log(e);
                }).finally(() => {
                    this.isLoadingDirectories = false;
                });
            },
            loadFileManager() {
                this.loadDirectories();
                this.loadFiles();
            },
            loadFiles() {

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
                    }, 350);
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
