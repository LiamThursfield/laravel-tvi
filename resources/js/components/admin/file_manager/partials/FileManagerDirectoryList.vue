<template>
    <ul>
        <template v-if="isLoadingDirectories">
            <li
                class="flex flex-row items-start text-theme-base-subtle-contrast py-1 w-full"
            >
                <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                <span class="text-left">Loading</span>
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
                    <span class="text-left">Parent Directory</span>
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
                    <span class="text-left">{{ directory.label }}</span>
                </button>
            </li>
        </template>
    </ul>
</template>

<script>
    export default {
        name: "FileManagerDirectoryList",
        props: {
            canChangeDirectory: {
                default: false,
                type: Boolean
            },
            directories: {
                required: true,
                type: Array
            },
            isLoadingDirectories: {
                default: false,
                type: Boolean
            },
            parentDirectory: {
                required: true,
                type: String | null
            },
        },
        methods: {
            changeDirectory(directory) {
                this.$emit('changeDirectory', directory);
            }
        }
    }
</script>
