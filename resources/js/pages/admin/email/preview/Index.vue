<template>
    <div>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Emails Preview
            </h1>
        </div>

        <div
            v-for="(module, moduleName) in mailables"
            :key="moduleName"
            class="bg-white p-6 mt-4 shadow-subtle rounded-lg"
        >
            <h2 class="font-medium mr-auto text-lg">
                {{ moduleName }}
            </h2>

            <ul class="mt-2 space-y-1">
                <li
                    v-for="(mailable, id) in module"
                    :key="`${moduleName}-${id}`"
                >
                    <a
                        :href="mailable.url"
                        rel="noopener noreferrer"
                        target="_blank"
                    >
                        {{ mailable.name }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

    export default {
        name: "AdminEmailPreviewIndex",
        layout: 'admin-layout',
        props: {
            mailables: {
                type: Object,
                required: true,
            }
        }
    }
</script>
