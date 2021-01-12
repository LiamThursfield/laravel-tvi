<template>
    <div>
        <transition :name="transitionName">
            <p
                v-if="isError"
                :class="errorClass"
            >
                {{ errorMessage }}
            </p>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "FormFieldError",
        props: {
            errorClass: {
                required: true,
                type: String,
            },
            errorMessage: {
                required: true,
                type: String,
            },
            isError: {
                required: true,
                type: Boolean,
            },
            transitionName: {
                default: "slide-down-fade",
                type: String,
            }
        }
    }
</script>
