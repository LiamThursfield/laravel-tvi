<template>
    <div>
        <slot />

        <div class="border-2 border-theme-subtle p-4 rounded">
            <div
                v-if="isLoadingRepeaterTemplate"
                class="flex flex-row items-start text-theme-base-subtle-contrast w-full"
            >
                <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                <span class="text-left">Loading</span>
            </div>

            <div v-else-if="isInitialisedContent && isRepeaterTemplateFields">

                <div v-if="isEditableContentRows">
                    <div
                        v-for="(row, key) in editableContent"
                        :key="`repeater-${templateField.id}-editor-${row.key}`"
                        class="border-b-2 border-theme-subtle mb-6 pb-6"
                    >
                        <content-editor
                            :template-fields="repeaterTemplateFields"
                            v-model="editableContent[key]"
                        />

                        <div class="flex flex-row justify-end mt-6">
                            <button
                                class="
                                    button button-small
                                    bg-theme-danger text-theme-danger-contrast text-sm`
                                    focus:outline-none focus:ring
                                    hover:bg-theme-danger-contrast hover:text-theme-danger
                                "
                                type="button"
                                @click="deleteRepeaterRow(key)"
                            >
                                Delete Row
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-end">
                    <button
                        class="button button-primary-subtle button-small text-sm"
                        type="button"
                        @click="addRepeaterRow"
                    >
                        Add Row
                    </button>
                </div>
            </div>

            <p
                v-else-if="isInitialisedContent && !isRepeaterTemplateFields"
                class="text-theme-base-subtle-contrast"
            >
                Repeater template has no fields.
            </p>
        </div>

        <confirmation-modal
            confirm-text="Delete"
            confirm-type="danger"
            :show-modal="showDeleteModal"
            message-text="Are you sure you want to delete this repeater row?"
            @cancelAction="cancelDeleteRepeaterRow"
            @closeModal="cancelDeleteRepeaterRow"
            @confirmAction="confirmDeleteRepeaterRow"
        />
    </div>
</template>

<script>
    import _ from "lodash";

    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";

    import InputGroup from "../../../../core/forms/InputGroup";
    import ConfirmationModal from "../../../../core/modals/ConfirmationModal";

    export default {
        name: "RepeaterField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            ConfirmationModal,
            InputGroup,
        },
        data() {
            return {
                isInitialisedContent: false,
                isLoadingRepeaterTemplate: false,
                newRowCount: 0,
                repeaterRowToDelete: null,
                repeaterTemplate: null,
                showDeleteModal: false,
            }
        },
        computed: {
            isEditableContentRows() {
                try {
                    return Array.isArray(this.editableContent) && this.editableContent.length;
                } catch (e) {
                    return false;
                }
            },
            isRepeaterTemplateFields() {
                return this.repeaterTemplateFields && this.repeaterTemplateFields.length;
            },
            repeaterTemplateId() {
                try {
                    return this.templateField.settings.template_id;
                } catch (e) {
                    return false;
                }
            },
            repeaterTemplateFields() {
                try {
                    return this.repeaterTemplate.template_fields;
                } catch (e) {
                    return null;
                }
            },
        },
        created() {
            this.getRepeaterTemplate();
        },
        methods: {
            addRepeaterRow() {
                let row = {};
                _.forEach(this.repeaterTemplateFields, (templateField) => {
                    row[templateField.id] = {
                        data: '',
                        template_field_id: templateField.id,
                        template_field_order: templateField.order,
                        template_field_slug: templateField.slug,
                        template_field_type: templateField.type,
                    };
                });

                row.key = 'new-' + this.newRowCount;
                this.newRowCount++;

                this.editableContent.push(row);
            },
            cancelDeleteRepeaterRow() {
                this.showDeleteModal = false;
                this.repeaterRowToDelete = null;
            },
            confirmDeleteRepeaterRow() {
                this.editableContent.splice(this.repeaterRowToDelete, 1);
                this.cancelDeleteRepeaterRow();
            },
            deleteRepeaterRow(key) {
                this.showDeleteModal = true;
                this.repeaterRowToDelete = key;
            },
            doesObjectHaveKeys(obj) {
                try {
                    return Object.keys(obj).length;
                } catch (e) {
                    return false;
                }
            },
            getRepeaterTemplate() {
                this.isLoadingRepeaterTemplate = true;

                if (!this.repeaterTemplateId) {
                    this.$errorToast('No repeater template id set.');
                    return;
                }

                axios.get(
                    this.$route('admin.api.cms.templates.show', this.repeaterTemplateId),
                ).then(response => {
                    this.repeaterTemplate = response.data.data;
                    this.setInitialContent();
                }).catch(e => {
                    this.$errorToast('Failed to load repeater template');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }).finally(() => {
                    this.isLoadingRepeaterTemplate = false;
                });
            },
            onEditableContentUpdate: _.debounce(function () {
                let content = _.cloneDeep(this.editableContent);
                _.forEach(content, (row, key) => {
                    this.$delete(content[key], 'key');
                })

                this.$emit('input', content);
            }, 100),
            setInitialContent() {
                if (!this.content || this.content === '') {
                    this.editableContent = [];
                    this.isInitialisedContent = true;
                    return;
                }

                let content = [];
                let count = 0;
                _.forEach(this.content, row => {
                    let rowFormatted = {};

                    // Get current row content
                    if (this.doesObjectHaveKeys(row)) {
                        rowFormatted = _.cloneDeep(row);
                    }

                    rowFormatted.key = 'existing=' + count;
                    count++;

                    // Set the defaults for any missing content in the row
                    _.forEach(this.repeaterTemplateFields, templateField => {
                        if (!rowFormatted.hasOwnProperty(templateField.id)) {
                            rowFormatted[templateField.id] = {
                                data: '',
                                template_field_id: templateField.id,
                                template_field_order: templateField.order,
                                template_field_slug: templateField.slug,
                                template_field_type: templateField.type,
                            };
                        }
                    });

                    content.push(rowFormatted);
                });


                this.editableContent = _.cloneDeep(content);
                this.isInitialisedContent = true;
            }
        }
    }
</script>
