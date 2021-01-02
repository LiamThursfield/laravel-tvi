<template>
    <div>
        <input-group
            :error_message="error_message"
            :input_autocomplete="input_name"
            :input_id="input_name"
            :input_maxlength="input_maxlength"
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
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import InputGroup from "../../../../core/forms/InputGroup";

    export default {
        name: "TextField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
        computed: {
            input_maxlength() {
                try {
                    return this.template_field.settings.max_length;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
