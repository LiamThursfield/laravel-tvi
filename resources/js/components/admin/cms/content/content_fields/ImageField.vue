<template>
    <div>
        <input-group
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
        </input-group>
    </div>
</template>

<script>
    // TODO: Replace with an image select modal
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import InputGroup from "../../../../core/forms/InputGroup";

    export default {
        name: "ImageField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
    }
</script>
