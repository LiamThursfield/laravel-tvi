<template>
    <section class="container mx-auto">
        <!-- TODO: Implement PageHeader style that can be used throughout the admin -->
        <div
            class="
                page-header
                mb-6 text-lg
            "
        >
            <h1>File Manager</h1>
        </div>

        <file-manager
            :initialise="true"
        />

    </section>
</template>

<script>
    import FileManager from "../../../components/admin/file_manager/FileManager";

    export default {
        name: "AdminFileManagerIndex",
        components: {FileManager},
        layout: 'admin-layout',
    }
</script>
