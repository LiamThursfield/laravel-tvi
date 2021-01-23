<template>
    <div>
        <input-group
            :error-message="errorMessage"
            :input-autocomplete="inputName"
            :input-id="inputName"
            :input-max="inputMax"
            :input-min="inputMin"
            :input-name="inputName"
            :input-required="templateField.is_required"
            input-type="number"
            label-class=""
            label-text=""
            v-model="editableContent"
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
            inputMax() {
                try {
                    return this.templateField.settings.max;
                } catch (e) {
                    return '';
                }
            },
            inputMin() {
                try {
                    return this.templateField.settings.min;
                } catch (e) {
                    return '';
                }
            }
        }
    }
</script>
