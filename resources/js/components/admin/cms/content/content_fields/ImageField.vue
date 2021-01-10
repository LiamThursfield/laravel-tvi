<template>
    <div>
        <input-group
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
