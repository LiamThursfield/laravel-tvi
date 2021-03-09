<template>
    <div>
        <slot/>

        <div
            v-if="isLoadingTemplates"
            class="flex flex-row items-start mt-4 text-theme-base-subtle-contrast w-full"
        >
            <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
            <span class="text-left">Loading</span>
        </div>

        <select-group
            v-else
            class="mt-4"
            :input-any-option-enabled="true"
            input-any-option-label="Please select a template"
            input-option-label-key="name"
            input-option-value-key="id"
            :input-id="`template-field-${templateField.order}-template-id`"
            :input-name="`template-field-${templateField.order}-template-id`"
            :input-options="repeaterTemplateOptions"
            :input-required="true"
            label-text="Repeater Template"
            @input="onEditableSettingsChange"
            v-model="editableFieldSettings.template_id"
        />
    </div>
</template>
<script>
    import { templateFieldSettingsMixin } from "../../../../../../mixins/admin/cms/template-field-settings";
    import SelectGroup from "../../../../../core/forms/SelectGroup";

    export default {
        name: "TemplateFieldRepeaterSettings",
        mixins: [
            templateFieldSettingsMixin,
        ],
        components: {
            SelectGroup
        },
        data() {
            return {
                isLoadingTemplates: false,
                repeaterTemplates: null,
            }
        },
        computed: {
            repeaterTemplateOptions() {
                let fallback = {
                    '': 'No templates available'
                }
                try {
                    if (!this.repeaterTemplates || !this.repeaterTemplates.length) {
                        return fallback;
                    }

                    return this.repeaterTemplates;
                } catch (e) {
                    return fallback;
                }


            }
        },
        mounted() {
            this.getRepeaterTemplates();
        },
        methods: {
            getRepeaterTemplates() {
                this.isLoadingTemplates = true;

                axios.get(
                    this.$route('admin.api.cms.templates.index'),
                    {
                        params: {
                            template_type: 'repeater'
                        }
                    }
                ).then(response => {
                    this.repeaterTemplates = response.data.data;
                }).catch(e => {
                    this.$errorToast('Failed to load selected template');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }).finally(() => {
                    this.isLoadingTemplates = false;
                });
            }
        }
    }
</script>
