<template>
    <ul>
        <template v-if="showFilesLoader">
            <li
                class="flex flex-row items-center justify-center text-gray-500 text-sm py-4 w-full"
            >
                <span class="flex items-center">
                    <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                    <span>Loading</span>
                </span>
            </li>
        </template>
        <template v-else-if="!isFiles">
            <li
                class="flex flex-row items-center justify-center text-gray-500 text-sm py-4 w-full"
            >
                <span>No files</span>
            </li>
        </template>
        <template v-else>
            <file-manager-files-list-file
                v-for="file in files"
                :key="file.meta.basename"
                class="-mx-6 px-6"
                :file="file"
            />
        </template>
    </ul>
</template>

<script>
    import FileManagerFilesListFile from "./FileManagerFilesListFile";

    export default {
        name: "FileManagerFilesList",
        components: {FileManagerFilesListFile},
        props: {
            files: {
                required: true,
                type: Array
            },
            showFilesLoader: {
                default: true,
                type: Boolean,
            }
        },
        computed: {
            isFiles() {
                return this.files.length;
            }
        },
    }
</script>
