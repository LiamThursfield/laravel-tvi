<template>
    <div>
        <slot />

        <editor
            ref="editor"
            api-key="yjslf080227w394afqv4gkul5yer7sxjorf08kvjgztc1n0i"
            :init="editorConfig"
            v-model="editableContent"
        />
    </div>
</template>

<script>
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import editor from '@tinymce/tinymce-vue';

    export default {
        name: "WysiwygField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            editor,
        },
        data() {
            return {
                editorFilePickerCallback: null,
            }
        },
        computed: {
            editorConfig() {
                return {
                    content_css: '/css/app.css',
                    file_picker_callback: this.onEditorFilePicker,
                    formats: {
                        alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-left' },
                        aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-center' },
                        alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-right' },
                        alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-justify' },
                        bold: { inline: 'strong', classes: 'font-bold' },
                        italic: { inline: 'em', classes: 'italic' },
                        underline: { inline: 'span', classes: 'underline'},
                        strikethrough: { inline: 'span', classes: 'line-through' },
                    },
                    min_height: 300,
                    plugins: 'code fullscreen image lists link',
                    skin: 'TVI',
                    skin_url: '/vendor/tinymce/skins/tvi',
                    toolbar: 'styleselect bold italic alignleft aligncenter alignright numlist bullist link image',
                };
            },
        },
        beforeDestroy() {
            this.$refs.editor.editor.destroy();
        },
        methods: {
            onEditorFilePicker(callback, value, meta) {
                this.editorFilePickerCallback = callback;
                this.$store.commit('openFileManagerModel', this.onFileManagerFileSelected);
            },
            onFileManagerFileSelected(file) {
                try {
                    this.editorFilePickerCallback(
                        file.url,
                        {alt: file.meta.filename ? file.meta.filename : ''}
                    );
                    this.editorFilePickerCallback = null;
                } catch (e) {
                    this.$errorToast(e);
                }
            }
        }
    }
</script>
