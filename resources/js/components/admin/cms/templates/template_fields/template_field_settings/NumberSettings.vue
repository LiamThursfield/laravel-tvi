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
                :input-id="`template-field-${templateField.order}-min`"
                :input-name="`template-field-${templateField.order}-min`"
                input-type="number"
                label-text="Minimum Value"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.min"
            />

            <input-group
                class="flex-1 mt-4"
                :input-id="`template-field-${templateField.order}-max`"
                :input-name="`template-field-${templateField.order}-max`"
                input-type="number"
                label-text="Maximum Value"
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
