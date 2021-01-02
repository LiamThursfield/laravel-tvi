<template>
    <div>
        <input-group
            :error_message="error_message"
            :input_autocomplete="input_name"
            :input_id="input_name"
            :input_max="input_max"
            :input_min="input_min"
            :input_name="input_name"
            :input_required="template_field.is_required"
            input_type="number"
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
        name: "NumberField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
        computed: {
            input_max() {
                try {
                    return this.template_field.settings.max;
                } catch (e) {
                    return '';
                }
            },
            input_min() {
                try {
                    return this.template_field.settings.min;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
