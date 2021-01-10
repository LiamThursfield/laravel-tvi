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
                :input-id="`template-field-${templateField.order}-max-length`"
                :input-name="`template-field-${templateField.order}-max-length`"
                input-type="number"
                label-text="Max Length"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.max_length"
            />

            <input-group
                class="flex-1 mt-4"
                :input-id="`template-field-${templateField.order}-rows`"
                :input-name="`template-field-${templateField.order}-rows`"
                input-type="text"
                label-text="Rows"
                @input="onEditableSettingsChange"
                v-model="editableFieldSettings.rows"
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
