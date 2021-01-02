<template>
    <div>
        <text-area-group
            :error_message="error_message"
            :input_autocomplete="input_name"
            :input_id="input_name"
            :input_maxlength="input_maxlength"
            :input_name="input_name"
            :input_required="template_field.is_required"
            :input_rows="input_rows"
            input_type="text"
            label_text=""
            v-model="editable_content"
        >
            <slot/>
        </text-area-group>
    </div>
</template>

<script>
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import TextAreaGroup from "../../../../core/forms/TextAreaGroup";

    export default {
        name: "TextAreaField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            TextAreaGroup,
        },
        computed: {
            input_maxlength() {
                try {
                    return this.template_field.settings.max_length;
                } catch (e) {
                    return '';
                }
            },
            input_rows() {
                try {
                    return this.template_field.settings.rows;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
