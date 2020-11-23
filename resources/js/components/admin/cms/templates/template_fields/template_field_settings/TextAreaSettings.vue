<template>
    <div>
        <slot/>

        <div
            class="
                flex flex-col
                md:flex-row md:space-x-4
            "
        >
            <input-group
                class="flex-1 mt-4"
                :input_id="`template-field-${template_field.order}-max-length`"
                :input_name="`template-field-${template_field.order}-max-length`"
                input_type="number"
                label_text="Max Length"
                @input="onEditableSettingsChange"
                v-model="editable_field_settings.max_length"
            />

            <input-group
                class="flex-1 mt-4"
                :input_id="`template-field-${template_field.order}-max-length`"
                :input_name="`template-field-${template_field.order}-max-length`"
                input_type="text"
                label_text="Rows"
                @input="onEditableSettingsChange"
                v-model="editable_field_settings.rows"
            />
        </div>
    </div>
</template>
<script>
    import { templateFieldSettingsMixin } from "../../../../../../mixins/admin/cms/template-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "TemplateFieldTextAreaSettings",
        mixins: [
            templateFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
