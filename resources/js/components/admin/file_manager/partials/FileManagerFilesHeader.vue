<template>
    <h2 class="flex flex-row items-center justify-between">
        <span class="text-theme-base-subtle-contrast">
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
                            text-theme-base-subtle-contrast
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
                        class="text-theme-base-subtle-contrast"
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
</template>

<script>
    export default {
        name: "FileManagerFilesHeader",
        props: {
            canChangeDirectory: {
                default: false,
                type: Boolean
            },
            currentDirectoryList: {
                required: true,
                type: Array
            },
            showBreadcrumbs: {
                default: false,
                type: Boolean
            }
        },
        methods: {
            changeDirectoryViaBreadcrumb(breadcrumbIndex) {
                this.$emit('changeDirectoryViaBreadcrumb', breadcrumbIndex)
            }
        }
    }
</script>
