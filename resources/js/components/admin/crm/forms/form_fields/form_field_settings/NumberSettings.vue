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
                :input-id="`form-field-${formField.order}-min`"
                :input-name="`form-field-${formField.order}-min`"
                input-type="number"
                label-text="Minimum Value"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.min"
            />

            <input-group
                class="flex-1 mt-4"
                :input-id="`form-field-${formField.order}-max`"
                :input-name="`form-field-${formField.order}-max`"
                input-type="number"
                label-text="Maximum Value"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.max"
            />
        </div>
    </div>
</template`>
<script>
    import { formFieldSettingsMixin } from "../../../../../../mixins/admin/crm/form-field-settings";
    import InputGroup from "../../../../../core/forms/InputGroup";

    export default {
        name: "FormFieldNumberSettings",
        mixins: [
            formFieldSettingsMixin,
        ],
        components: {
            InputGroup
        }
    }
</script>
