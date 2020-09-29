<template>
    <li
        class="
            flex flex-row items-start justify-between py-2 space-x-4
            ease-in-out duration-300 transition-colors
            hover:bg-gray-100
        "
    >
        <div class="flex flex-row items-start">
            <component
                class="min-w-5 mr-2 w-5"
                :is="fileIcon"
            />
            <span>{{ file.meta.basename }}</span>
        </div>
        <div class="flex flex-row items-center space-x-2">
            <a
                v-if="file.url"
                class="
                    flex flex-row items-center justify-center rounded text-gray-500
                    ease-in-out duration-300 transition-colors
                    focus:outline-none
                    hover:text-theme-primary
                "
                :href="file.url"
                rel="noreferrer noopener nofollow"
                target="_blank"
            >
                <icon-external-link class="w-5" />
            </a>

            <button
                v-if="isFileDropdownMeta"
                :id="infoButtonId"
                class="
                    flex flex-row items-center justify-center rounded text-gray-500
                    ease-in-out duration-300 transition-colors
                    focus:outline-none
                    hover:text-theme-primary
                "
                type="button"
            >
                <icon-info-square class="w-5" />
            </button>

            <div
                v-if="isFileDropdownMeta"
                ref="infoDropdownMenu"
                class="
                    flex flex-col px-4 py-4 space-y-3
                    focus:outline-none
                "
            >
                <p
                    v-for="(value, label) in fileDropdownMeta"
                    :key="label"
                >
                    <span class="block text-gray-500 text-xs">
                        {{  label }}
                    </span>
                    <span class="block break-all text-gray-700 text-sm">
                        {{  value }}
                    </span>
                </p>
            </div>
        </div>
    </li>
</template>

<script>
    import prettyBytes from 'pretty-bytes';
    import slugify from 'slugify';
    import tippy from 'tippy.js';
    import 'tippy.js/animations/shift-away-extreme.css';

    import IconExternalLink from "../../../core/icons/IconExternalLink";
    import IconInfoSquare from "../../../core/icons/IconInfoSquare";

    export default {
        name: "FileManagerFilesListFile",
        components: {IconInfoSquare, IconExternalLink},
        props: {
            file: {
                required: true,
                type: Object
            }
        },
        computed: {
            etag() {
              return this.file.meta.etag.split('"').join('');
            },
            fileDropdownMeta() {
                let meta = {};

                if (this.fileUpdatedAt) {
                    meta["Last Updated"] = this.fileUpdatedAt;
                }

                if (this.fileSize) {
                    meta["Size"] = this.fileSize;
                }

                if (this.fileExtension) {
                    meta["File Extension"] = this.fileExtension;
                }

                if (this.file.url) {
                    meta["URL"] = this.file.url;
                }

                return meta;
            },
            fileExtension() {
                try {
                    return this.file.meta.extension;
                } catch (e) {
                    return false;
                }
            },
            fileIcon() {
                try {
                    switch (this.file.meta.mimetype.toLowerCase()) {
                        case 'image/jpeg':
                        case 'image/png':
                            return 'icon-photo';
                        case 'application/pdf':
                        case 'text/plain':
                            return 'icon-file-text';
                        default:
                            return 'icon-file';
                    }
                } catch (e) {
                    return 'icon-file';
                }
            },
            fileNameSlug() {
                return slugify(this.file.meta.basename, {
                    remove: '.'
                });
            },
            fileSize() {
                try {
                    return prettyBytes(this.file.meta.size);
                } catch (e) {
                    return false;
                }
            },
            fileUpdatedAt() {
                try {
                    let date = new Date(this.file.meta.timestamp)
                    return date.toLocaleString();
                } catch (e) {
                    return false;
                }
            },
            infoButtonId() {
                return 'info-button-' + this.fileNameSlug ;
            },
            isFileDropdownMeta() {
                try {
                    return Object.keys(this.fileDropdownMeta).length
                } catch(e) {
                    return false;
                }
            }
        },
        mounted() {
            this.initialiseFileDropdown();
        },
        methods: {
            initialiseFileDropdown() {
                if (!this.isFileDropdownMeta) {
                    return;
                }

                let infoDropdownMenu = this.$refs.infoDropdownMenu;
                infoDropdownMenu.style.display = 'block';

                tippy('#' + this.infoButtonId,{
                    animation: 'shift-away-extreme',
                    content: infoDropdownMenu,
                    interactive: true,
                    placement: 'bottom-end',
                    theme: 'dropdown',
                    trigger: 'click',
                });
            },
        },
    }
</script>
