<template>
    <div>
        <slot/>

        <input-group
            class="mt-4"
            :input-id="`template-field-${templateField.order}-max-length`"
            :input-name="`template-field-${templateField.order}-max-length`"
            input-type="number"
            label-text="Max Length"
            @input="onEditableSettingsChange"
            v-model="editableFieldSettings.max_length"
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
