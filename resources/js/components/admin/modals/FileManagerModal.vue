<template>
    <transition
        name="fade"
    >
        <div
            v-show="isModelOpen"
            class="
                bg-navy-800 bg-opacity-50 fixed flex h-full inset-0 items-center justify-center w-full
                md:py-16 md:px-8
            "
            @click.self="closeModal"
        >
            <div
                class="
                    bg-white flex flex-col h-full pb-8 pt-4 w-full
                    md:rounded-lg
                "
            >
                <div
                    class="
                        flex flex-row px-4
                        md:px-8
                    "
                >
                    <h1 class="font-medium  text-lg">
                        File Manager
                    </h1>

                    <button
                        class="
                            flex items-center justify-center ml-auto p-1 rounded
                            ease-in-out duration-300 transition-colors
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-base-subtle
                        "
                        type="button"
                        @click="closeModal"
                    >
                        <icon-x class="h-5 w-5"/>
                    </button>
                </div>

                <div
                    class="
                        bg-theme-base flex-1 mt-8 mx-4 p-6 rounded-lg
                        md:mx-8
                    "
                >
                    <file-manager
                        :enable-file-select="true"
                        :initialise="isModelOpen"
                        @fileSelected="onFileSelected"
                    />
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import FileManager from "../file_manager/FileManager";
    export default {
        name: "FileManagerModal",
        components: {FileManager},
        computed: {
            isModelOpen() {
                return this.$store.getters.isFileManagerOpen;
            }
        },
        methods: {
            closeModal() {
                this.$store.commit('closeFileManagerModal')
            },
            onFileSelected(file) {
                this.$store.state.fileManagerModalCallback(file);

                this.$store.commit('closeFileManagerModal');
            }
        }
    }
</script>
