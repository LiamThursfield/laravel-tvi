<template>
    <!--  Clickable Link  -->
    <inertia-link
        v-if="isClickable"
        :class="linkClass"
        :href="link.url"
    >
        <slot>
            {{ link.label }}
        </slot>
    </inertia-link>
    <!--  Non-Clickable Link  -->
    <div
        v-else
        :class="linkClass"
    >
        <slot>
            {{ link.label }}
        </slot>
    </div>
</template>

<script>
    export default {
        name: "PaginationLink",
        props: {
            forceDisabled: {
                default: false,
                type: Boolean
            },
            link: {
                required: true,
                type: Object
            },
            linkClass: {
                default: "",
                type: String | Array
            }
        },
        computed: {
            isDisabled() {
                return this.forceDisabled || this.link.url === null;
            },
            isClickable() {
                return !this.isDisabled && !this.link.active;
            }
        }
    }
</script>
