<template>
    <div>
        <text-area-group
            :errorMessage="errorMessage"
            :inputAutocomplete="inputName"
            :inputId="inputName"
            :inputName="inputName"
            :inputRequired="templateField.is_required"
            inputType="text"
            labelText=""
            v-model="editableContent"
        >
            <slot/>
        </text-area-group>
    </div>
</template>

<script>
    // TODO: Find a suitable WYSIWYG plugin and replace
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import TextAreaGroup from "../../../../core/forms/TextAreaGroup";

    export default {
        name: "WysiwygField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            TextAreaGroup,
        },
    }
</script>
