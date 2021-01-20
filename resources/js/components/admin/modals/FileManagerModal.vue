<template>
    <transition
        name="fade"
    >
        <div
            v-show="isModelOpen"
            class="bg-navy-800 bg-opacity-50 fixed flex h-full inset-0 items-center justify-center py-16 px-8 w-full"
            @click.self="closeModal"
        >
            <div class="bg-white flex flex-col h-full pb-8 rounded-lg w-full">
                <button
                    class="
                            flex h-5 items-center justify-center ml-auto mr-3 mt-3 rounded text-theme-base-subtle-contrast w-5
                            ease-in-out duration-300 transition-colors
                            focus:outline-none focus:ring focus:ring-primary
                            hover:bg-theme-base-subtle
                        "
                    type="button"
                    @click="closeModal"
                >
                    <icon-x />
                </button>

                <h1 class="font-medium px-8 text-lg">
                    File Manager
                </h1>

                <div class="bg-theme-base flex-1 mt-8 mx-8 p-6 rounded-lg">
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
