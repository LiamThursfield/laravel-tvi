<template>
    <div>
        <slot/>

        <input-group
            class="mt-4"
            :input-id="`form-field-${formField.order}-max-length`"
            :input-name="`form-field-${formField.order}-max-length`"
            input-type="number"
            label-text="Max Length"
            @input="onEditableSettingsChange"
            v-model="editableFieldSettings.max_length"
        />
    </div>
</template>
<script>
    import { formFieldSettingsMixin } from "../../../../../../mixins/admin/crm/form-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "FormFieldTextSettings",
        mixins: [
            formFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
