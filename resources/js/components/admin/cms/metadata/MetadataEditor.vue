<template>
    <div>
        <div class="flex flex-row space-x-4">
            <button
                :class="getTabClass(tab_key_meta)"
                type="button"
                @click="selectTab(tab_key_meta)"
            >
                Metadata
            </button>

            <button
                :class="getTabClass(tab_key_open_graph)"
                type="button"
                @click="selectTab(tab_key_open_graph)"
            >
                Open Graph Data
            </button>
        </div>

        <transition
            name="slide-left"
            mode="out-in"
        >
            <div
                v-if="tab_selected === tab_key_meta"
                key="tab_key_meta"
            >
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.title')"
                    input-id="metadata_title"
                    input-name="metadata_title"
                    input-type="text"
                    label-text="Title"
                    @errorHidden="clearPageErrorMessage('metadata.title')"
                    v-model="editableMetadata.title"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.description')"
                    input-id="metadata_description"
                    input-name="metadata_description"
                    input-type="text"
                    label-text="Meta Description"
                    @errorHidden="clearPageErrorMessage('metadata.description')"
                    v-model="editableMetadata.description"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.canonical')"
                    input-id="metadata_canonical"
                    input-name="metadata_canonical"
                    input-type="text"
                    label-text="Canonical"
                    @errorHidden="clearPageErrorMessage('metadata.canonical')"
                    v-model="editableMetadata.canonical"
                />
            </div>

            <div
                v-if="tab_selected === tab_key_open_graph"
                key="tab_key_open_graph"
            >
                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.og_title')"
                    input-id="metadata_og_title"
                    input-name="metadata_og_title"
                    input-type="text"
                    label-text="OG Title"
                    @errorHidden="clearPageErrorMessage('metadata.og_title')"
                    v-model="editableMetadata.og_title"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.og_description')"
                    input-id="metadata_og_description"
                    input-name="metadata_og_description"
                    input-type="text"
                    label-text="OG Description"
                    @errorHidden="clearPageErrorMessage('metadata.og_description')"
                    v-model="editableMetadata.og_description"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.og_type')"
                    input-id="metadata_og_type"
                    input-name="metadata_og_type"
                    input-type="text"
                    label-text="OG Type"
                    @errorHidden="clearPageErrorMessage('metadata.og_type')"
                    v-model="editableMetadata.og_type"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.og_url')"
                    input-id="metadata_og_url"
                    input-name="metadata_og_url"
                    input-type="text"
                    label-text="OG URL"
                    @errorHidden="clearPageErrorMessage('metadata.og_url')"
                    v-model="editableMetadata.og_url"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('metadata.og_image')"
                    input-class="border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0"
                    input-id="metadata_og_image"
                    input-name="metadata_og_image"
                    input-type="text"
                    input-wrapper-class="flex flex-row items-center"
                    label-text="OG Image"
                    @errorHidden="clearPageErrorMessage('metadata.og_image')"
                    v-model="editableMetadata.og_image"
                >
                    <template v-slot:inputAppend>
                        <button
                            class="border border-l-0 border-theme-primary-subtle button button-primary-subtle rounded-l-none"
                            type="button"
                            @click="openOgImageFileManagerModal"
                        >
                            Browse...
                        </button>
                    </template>
                </input-group>
            </div>
        </transition>
    </div>
</template>

<script>
    import _ from 'lodash';

    import InputGroup from '../../../core/forms/InputGroup';

    export default {
        name: 'MetadataEditor',
        components: {
            InputGroup,
        },
        model: {
            prop: 'metadata',
        },
        props: {
            metadata: {
                required: true,
                type: Object | null,
            }
        },
        data() {
            return {
                editableMetadata: {
                    canonical: '',
                    description: '',
                    title: '',
                    og_description: '',
                    og_image: '',
                    og_title: '',
                    og_type: '',
                    og_url: '',
                },
                tab_key_meta: 'meta',
                tab_key_open_graph: 'og',
                tab_selected: 'meta',
            }
        },
        created() {
            try {
                if (this.metadata && Object.keys(this.metadata).length) {
                    this.editableMetadata = _.cloneDeep(this.metadata);
                }
            } catch (e) {
                return;
            }
        },
        methods: {
            getTabClass(key) {
                let tabClass = 'border-b-2 border-white pb-1 text-lg focus:outline-none '

                if (this.tab_selected === key) {
                    tabClass += 'text-theme-primary focus:border-theme-primary hover:border-theme-primary';
                } else {
                    tabClass += 'text-theme-base-subtle-contrast focus:border-theme-base-subtle-contrast hover:border-theme-base-subtle-contrast';
                }

                return tabClass;
            },
            onEditableMetadataUpdate: _.debounce(function () {
                this.$emit('input', this.editableMetadata);
            }, 100),
            onOgImageFileManagerFileSelected(file) {
                try {
                    this.editableMetadata.og_image = file.url;
                } catch (e) {
                    this.$errorToast(e);
                }
            },
            openOgImageFileManagerModal() {
                this.$store.commit('openFileManagerModel', this.onOgImageFileManagerFileSelected);
            },
            selectTab(key) {
                this.tab_selected = key;
            }
        },
        watch: {
            editableMetadata: {
                deep: true,
                handler: 'onEditableMetadataUpdate'
            }
        }
    }
</script>
