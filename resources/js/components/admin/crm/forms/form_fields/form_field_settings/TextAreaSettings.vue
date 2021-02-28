<template>
    <div>
        <slot/>

        <input-group
            class="flex-1 mt-4"
            :input-id="`form-field-${formField.order}-max-length`"
            :input-name="`form-field-${formField.order}-max-length`"
            input-type="number"
            label-text="Max Length"
            @input="onEditableSettingsChange"
            v-model="editableFieldSettings.max_length"
        />

        <input-group
            class="flex-1 mt-4"
            :input-id="`form-field-${formField.order}-rows`"
            :input-name="`form-field-${formField.order}-rows`"
            input-type="text"
            label-text="Rows"
            @input="onEditableSettingsChange"
            v-model="editableFieldSettings.rows"
        />
    </div>
</template>
<script>
    import { formFieldSettingsMixin } from "../../../../../../mixins/admin/crm/form-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "FormFieldTextAreaSettings",
        mixins: [
            formFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
