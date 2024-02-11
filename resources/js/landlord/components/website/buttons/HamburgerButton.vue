<template>
    <button
        class="
            cursor-pointer fill-current flex justify-center text-gray-600
            focus:outline-none focus:text-gray-900
            hover:text-theme-gray-900
            transition-colors
        "
        @click="toggleButton"
    >
        <span>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="h-6"
            >
                <path
                    v-if="showCloseIcon"
                    d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
                ></path>
                <path
                    v-else
                    fill-rule="evenodd"
                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                ></path>
            </svg>
        </span>
    </button>
</template>

<script>
    export default {
        name: "HamburgerButton",
        props: {
            showCloseIcon: {
                required: true,
                type: Boolean
            }
        },
        methods: {
            toggleButton() {
                this.$emit('button-toggled', !this.showCloseIcon);
            }
        }
    }
</script>
