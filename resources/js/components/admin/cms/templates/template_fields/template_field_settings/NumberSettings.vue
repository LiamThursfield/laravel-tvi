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
                :inputId="`template-field-${templateField.order}-min`"
                :inputName="`template-field-${templateField.order}-min`"
                inputType="number"
                labelText="Minimum Value"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.min"
            />

            <input-group
                class="flex-1 mt-4"
                :inputId="`template-field-${templateField.order}-max`"
                :inputName="`template-field-${templateField.order}-max`"
                inputType="number"
                labelText="Maximum Value"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.max"
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
