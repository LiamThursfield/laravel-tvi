<template>
    <div>
        <input-group
            :error-message="errorMessage"
            :input-autocomplete="inputName"
            input-class="border border-theme-base-subtle font-medium px-3 py-2 rounded-l w-full focus:border-theme-primary focus:outline-none focus:ring-0"
            :input-id="inputName"
            :input-name="inputName"
            :input-required="templateField.is_required"
            input-type="text"
            input-wrapper-class="flex flex-row items-center"
            label-class=""
            label-text=""
            v-model="editableContent"
        >
            <template v-slot:default>
                <slot/>
            </template>

            <template v-slot:inputAppend>
                <button
                    class="border border-l-0 border-theme-primary-subtle button button-primary-subtle rounded-l-none"
                    type="button"
                    @click="openFileManagerModal"
                >
                    Browse...
                </button>
            </template>
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
        methods: {
            onFileManagerFileSelected(file) {
                try {
                    this.editableContent = file.url;
                } catch (e) {
                    this.$errorToast(e);
                }
            },
            openFileManagerModal() {
                this.$store.commit('openFileManagerModel', this.onFileManagerFileSelected);
            },
        }
    }
</script>
