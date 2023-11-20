<template>
    <section>
        <div :id="containerId" />
    </section>
</template>
<script>
    import WaveSurfer from "wavesurfer.js";
    export default {
        name: "Wavesurfer",
        props: {
            audioUrl: {
                type: String,
                required: true,
            },
            containerIdOverride: {
                type: String,
                default: null,
            },
            height: {
                type: [String, Number],
                default: "8em"
            },
            mediaControls: {
                type: Boolean,
                default: false
            },
            normalize: {
                type: Boolean,
                default: false
            },
            width: {
                type: [String, Number],
                default: "100%"
            },
        },
        data() {
            return {
                containerId: '',
                wavesurfer: null,
            }
        },
        computed: {
            wavesurferOptions() {
                return {
                    container: "#" + this.containerId,
                    height: this.height,
                    mediaControls: this.mediaControls,
                    normalize: this.normalize,
                    url: this.audioUrl,
                    width: this.width,
                }
            }
        },
        created() {
            if (this.containerIdOverride) {
                this.containerId = this.containerIdOverride;
            } else {
                this.containerId = 'wavesurfer_' + new Date().getTime();
            }
        },
        mounted() {
            this.$nextTick(() => {
                this.wavesurfer = WaveSurfer.create(this.wavesurferOptions);
            })
        }
    }
</script>
