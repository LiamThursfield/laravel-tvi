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
                required: false,
            },
            containerIdOverride: {
                type: String,
                default: null,
            },
            cursorColor: {
                type: String,
                default: "#111"
            },
            cursorWidth: {
                type: Number,
                default: 0
            },
            barGap: {
                type: [Number, NaN],
                default: 0
            },
            barRadius: {
                type: [Number, NaN],
                default: 50
            },
            barWidth: {
                type: [Number, NaN],
                default: 3
            },
            height: {
                type: [String, Number],
                default: "8em"
            },
            media: {
                type: String,
                required: false,
            },
            mediaControls: {
                type: Boolean,
                default: false
            },
            normalize: {
                type: Boolean,
                default: false
            },
            progressColor: {
                type: String,
                default: "#555"
            },
            splitChannels: {
                type: Boolean,
                default: false,
            },
            theme: {
                type: String,
                default: "base"
            },
            waveColor: {
                type: String,
                default: "#999"
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
                let options = {
                    barGap: this.barGap,
                    barRadius: this.barRadius,
                    barWidth: this.barWidth,
                    container: "#" + this.containerId,
                    cursorWidth: this.cursorWidth,
                    height: this.height,
                    mediaControls: this.mediaControls,
                    normalize: this.normalize,
                    splitChannels: this.splitChannels,
                    width: this.width,
                }

                if (this.media) {
                    options.media = this.media;
                } else if (this.audioUrl) {
                    options.url = this.audioUrl;
                } else {
                    console.error('No valid url or media source set');
                }

                options = Object.assign(options, this.getColorOptions());

                return options;
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
        },
        methods: {
            getColorOptions() {
                let defaultColors = {
                    cursorColor: this.cursorColor,
                    progressColor: this.progressColor,
                    waveColor: this.waveColor,
                };

                if (!this.theme) {
                    return defaultColors;
                }

                switch (this.theme) {
                    case 'primary':
                        return {
                            cursorColor: "#1D4ED8",
                            progressColor: "#2563EB",
                            waveColor: "#666666",
                        }
                    case 'base':
                    default:
                        return defaultColors;
                }
            }
        }
    }
</script>
