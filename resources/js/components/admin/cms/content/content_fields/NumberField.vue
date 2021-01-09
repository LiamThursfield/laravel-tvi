<template>
    <div>
        <input-group
            :errorMessage="errorMessage"
            :inputAutocomplete="inputName"
            :inputId="inputName"
            :inputMax="inputMax"
            :inputMin="inputMin"
            :inputName="inputName"
            :inputRequired="templateField.is_required"
            inputType="number"
            labelText=""
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
