<template>
    <ul>
        <template v-if="showFilesLoader">
            <li
                class="flex flex-row items-center justify-center text-theme-base-subtle-contrast text-sm py-4 w-full"
            >
                <span class="flex items-center">
                    <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                    <span>Loading</span>
                </span>
            </li>
        </template>
        <template v-else-if="!isFiles">
            <li
                class="flex flex-row items-center justify-center text-theme-base-subtle-contrast text-sm py-4 w-full"
            >
                <span>No files</span>
            </li>
        </template>
        <template v-else>
            <file-manager-files-list-file
                v-for="file in files"
                :key="file.meta.basename"
                class="-mx-6 px-6"
                :enable-file-select="enableFileSelect"
                :file="file"
                @fileSelected="onFileSelected"
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
            enableFileSelect: {
                default: false,
                type: Boolean,
            },
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
        methods: {
            onFileSelected(file) {
                this.$emit('fileSelected', file);
            }
        }
    }
</script>
