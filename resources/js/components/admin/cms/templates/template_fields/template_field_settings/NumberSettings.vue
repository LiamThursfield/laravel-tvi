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
                :input_id="`template-field-${template_field.order}-min`"
                :input_name="`template-field-${template_field.order}-min`"
                input_type="number"
                label_text="Minimum Value"
                @input="onEditableSettingsChange"
                v-model="editable_field_settings.min"
            />

            <input-group
                class="flex-1 mt-4"
                :input_id="`template-field-${template_field.order}-max`"
                :input_name="`template-field-${template_field.order}-max`"
                input_type="number"
                label_text="Maximum Value"
                @input="onEditableSettingsChange"
                v-model="editable_field_settings.max"
            />
        </div>
    </div>
</template>
<script>
    import { templateFieldSettingsMixin } from "../../../../../../mixins/admin/cms/template-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "TemplateFieldNumberSettings",
        mixins: [
            templateFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
