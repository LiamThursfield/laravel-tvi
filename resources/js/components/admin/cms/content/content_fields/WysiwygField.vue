<template>
    <div>
        <text-area-group
            :error-message="errorMessage"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-name="inputName"
            :input-required="templateField.is_required"
            input-type="text"
            label-text=""
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
