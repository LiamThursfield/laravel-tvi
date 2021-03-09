<template>
    <div v-if="isUploadEnabled">
        <vue2-dropzone
            :id="id"
            :ref="id"
            :duplicate-check="true"
            :options="dropzoneOptions"
            @vdropzone-error="onError"
            @vdropzone-files-added="onFilesAdded"
            @vdropzone-sending="onSending"
            @vdropzone-queue-complete="onQueueComplete"
        />
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        name: "FileManagerFileUploader",
        components: {vue2Dropzone},
        props: {
            id: {
                default: "file-manager-file-uploader-dropzone",
                type: String
            },
            directory: {
                default: "/",
                type: String
            },
            url: {
                required: true,
                type: String
            },
        },
        computed: {
            dropzoneOptions() {
                let options = {};

                options.url = this.url;
                options.headers = {
                    ...axios.defaults.headers.common,
                    'X-XSRF-TOKEN': this.$cookies.get('XSRF-TOKEN')
                }

                return options;
            },
            isUploadEnabled() {
                try {
                    return !! this.$page.props.app.config.file_manager_uploads_enabled;
                } catch (e) {
                    return false;
                }
            }
        },
        methods: {
            onDirectoryChange() {
                try {
                    this.$refs[this.id].removeAllFiles();
                } catch (e) {
                    console.log(e);
                }
            },
            onError(file, message, xhr) {
                let error = "Failed to upload ";

                if (file && file.name) {
                    error += "'" + file.name + "' ";
                } else {
                    error += "file "
                }

                if (message && message.message) {
                    error += "- " + message.message;
                }

                this.$errorToast(error);
            },
            onFilesAdded() {
                this.$emit('filesAdded');
            },
            onQueueComplete() {
                this.$emit('queueCompleted');
            },
            onSending(file, xhr, formData) {
                formData.append('directory', this.directory);
            }
        },
        watch: {
            directory: {
                handler: "onDirectoryChange"
            }
        }
    }
</script>
