<template>

    <section>

        <div
            class="
                flex flex-col mt-4 space-y-4
                md:flex-row md:space-x-4 md:space-y-0
            "
        >
            <div
                class="
                    bg-white p-6 shadow-subtle rounded-lg
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
                                class="text-gray-500 py-1"
                            >
                                Loading
                            </li>
                        </template>
                        <template v-else>
                            <li
                                v-if="parentDirectory !== null"
                            >
                                <button
                                    class="
                                        cursor-pointer flex flex-row items-start py-1 w-full
                                        focus:outline-none focus:text-theme-primary
                                        hover:text-theme-primary
                                    "
                                    type="button"
                                    @click="changeDirectory(parentDirectory)"
                                >
                                    <icon-arrow-bar-up class="mr-2"/>
                                    <span>Parent Directory</span>
                                </button>
                            </li>
                            <li
                                v-if="!directories.length"
                                class="text-gray-500 py-1"
                            >
                                No subdirectories
                            </li>
                            <li
                                v-for="directory in directories"
                                :key="directory.directory"
                            >
                                <button
                                    class="
                                        cursor-pointer flex flex-row items-start py-1 w-full
                                        focus:outline-none focus:text-theme-primary
                                        hover:text-theme-primary
                                    "
                                    type="button"
                                    @click="changeDirectory(directory.directory)"
                                >
                                    <icon-folder class="mr-2"/>
                                    <span>{{ directory.label }}</span>
                                </button>
                            </li>
                        </template>
                    </ul>
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
                                    cursor-pointer text-gray-500
                                    focus:outline-none focus:text-theme-primary
                                    hover:text-theme-primary
                                "
                                    type="button"
                                    @click="changeDirectoryViaBreadcrumb(index)"
                                >
                                    <template v-if="index === 0">
                                        root
                                    </template>
                                    <template v-else>
                                        {{ breadcrumb }}
                                    </template>
                                </button>

                                <span

                                    class="ml-2 text-gray-300"
                                >
                                    /
                                </span>
                            </template>

                            <template
                                v-else
                            >
                                <span class="text-gray-500">
                                    {{ breadcrumb}}
                                </span>
                            </template>
                        </span>
                    </span>
                </h2>
            </div>

        </div>

    </section>
</template>

<script>
    import _ from 'lodash';
    import IconChevronLeft from "../../core/icons/IconChevronLeft";

    export default {
        name: "FileManager",
        components: {IconChevronLeft},
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
                isLoadingDirectories: false,
                isLoadingFiles: false,
            }
        },
        computed: {
            currentDirectoryList() {
                let directory = _.trim(this.currentDirectory, '/');

                if (!directory) {
                    return ['/'];
                }

                let list = _.split(directory, '/');
                return ['/'].concat(list);
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
            }
        },

        mounted() {
            if (this.initialise) {
                this.initialiseFileManager();
            }
        },
        methods: {
            changeDirectory(newDirectory = '/') {
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
            }
        },
        watch: {
            initialise: {
                handler: 'onInitialise'
            }
        }
    }
</script>
