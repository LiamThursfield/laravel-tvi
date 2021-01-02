<template>
    <div>
        <text-area-group
            :error_message="error_message"
            :input_autocomplete="input_name"
            :input_id="input_name"
            :input_name="input_name"
            :input_required="template_field.is_required"
            input_type="text"
            label_text=""
            v-model="editable_content"
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
