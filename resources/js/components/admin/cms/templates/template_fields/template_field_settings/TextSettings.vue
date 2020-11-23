<template>
    <div>
        <slot/>

        <input-group
            class="mt-4"
            :input_id="`template-field-${template_field.order}-max-length`"
            :input_name="`template-field-${template_field.order}-max-length`"
            input_type="number"
            label_text="Max Length"
            @input="onEditableSettingsChange"
            v-model="editable_field_settings.max_length"
        />
    </div>
</template>
<script>
    import { templateFieldSettingsMixin } from "../../../../../../mixins/admin/cms/template-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "TemplateFieldTextSettings",
        mixins: [
            templateFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
