<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
                 Templates
            </h1>

            <inertia-link
                v-if="userCan('cms.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.templates.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Template
                </span>
            </inertia-link>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <h1 class="font-semibold px-6 text-gray-850">
                Search
            </h1>

            <!--Search Panel -->
            <div
                class="
                    flex flex-col items-center mt-4 px-6 space-y-4
                    md:flex-row md:space-y-0 md:space-x-8
                "
            >
                <div class="w-full md:w-1/3">
                    <input-group
                        input_autocomplete="template_name_search"
                        input_class="form-control form-control-short"
                        input_id="template_name"
                        input_name="template_name"
                        input_placeholder="Template Name"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Template Name"
                        v-model="editable_search_options.template_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input_autocomplete="template_slug_search"
                        input_class="form-control form-control-short"
                        input_id="template_slug"
                        input_name="template_slug"
                        input_placeholder="Template Slug"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Template Slug"
                        v-model="editable_search_options.template_slug"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <select-group
                        :label_hidden="true"
                        label_text="Template Type"
                        :select_any_enabled="true"
                        select_any_label="Template Type"
                        select_class="form-control form-control-short"
                        select_id="template_type"
                        select_name="template_type"
                        :select_options="template_types"
                        v-model="editable_search_options.template_type"
                    />
                </div>
            </div>

            <p
                v-if="!templates_data"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No templates
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Type</th>
                            <th v-if="show_template_actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(template, index) in templates_data"
                            :key="`template-${template.id}`"
                        >
                            <td>
                                {{ template.name }}
                            </td>
                            <td>
                                {{ template.slug }}
                            </td>
                            <td>
                                {{ getTemplateTypeLabel(template.type) }}
                            </td>
                            <td v-if="show_template_actions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.templates.edit', template.id)"
                                        title="Edit Template"
                                    >
                                        <icon-edit
                                            class="w-4"
                                        />
                                    </inertia-link>

                                    <button
                                        v-if="userCan('cms.delete')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-danger hover:text-theme-danger-contrast
                                        "
                                        title="Delete Template"
                                        @click="checkDelete(template)"
                                    >
                                        <icon-trash
                                            class="w-4"
                                        />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    v-if="show_pagination"
                    class="flex flex-row justify-center mt-12 px-6"
                >
                    <pagination :pagination="templates.pagination" />
                </div>
            </template>

            <confirmation-modal
                confirmText="Delete"
                confirmType="danger"
                :showModal="show_delete_modal"
                :messageText="delete_modal_text"
                @cancelAction="cancelDelete"
                @closeModal="cancelDelete"
                @confirmAction="confirmDelete"
            />
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import { Inertia } from '@inertiajs/inertia'
    import ConfirmationModal from "../../../../components/core/modals/ConfirmationModal";
    import InputGroup from "../../../../components/core/forms/InputGroup";
    import SelectGroup from "../../../../components/core/forms/SelectGroup";

    export default {
        name: "AdminCMSTemplateIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            search_options: Object|Array,
            templates: Object,
            template_types: Object
        },
        data() {
            return {
                editable_search_options: {
                    per_page        : 15,
                    template_name   : '',
                    template_slug   : '',
                    template_type   : '',
                },
                is_initialised: false,
                is_loading_delete: false,
                show_delete_modal: false,
                template_to_delete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.search_options);
        },
        computed: {
            delete_modal_text() {
                try {
                    return 'Do you really want to delete \'' + this.template_to_delete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this template?'
                }
            },
            show_pagination() {
                try {
                    return this.templates.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            show_template_actions() {
                return this.userCan('cms.edit') || this.userCan('cms.delete');
            },
            templates_data() {
                if (!this.templates || !this.templates.data || this.templates.data.length < 1) {
                    return false;
                }

                return this.templates.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.is_loading_delete) {
                    this.show_delete_modal = false;
                    this.template_to_delete = null;
                }
            },
            checkDelete(template) {
                this.show_delete_modal = true;
                this.template_to_delete = template;
            },
            confirmDelete() {
                if (this.is_loading_delete) {
                    return this.$errorToast('It\'s only possible to delete one template at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.templates.destroy', this.template_to_delete.id),
                    {
                        only: [
                            'flash',
                            'templates'
                        ]
                    }
                );
                this.template_to_delete = null;
                this.show_delete_modal = false;
            },
            getTemplateTypeLabel(type_slug) {
                try {
                     return this.template_types.hasOwnProperty(type_slug) ? this.template_types[type_slug] : type_slug;
                } catch (e) {
                    return type_slug;
                }
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.is_initialised) {
                    this.is_initialised = true;

                    // If there are already search results, don't attempt search
                    if (this.templates_data) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.templates.index'),
                    this.editable_search_options,
                    {
                        only: ['templates'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page        : 15,
                    template_name   : '',
                    template_slug   : '',
                    template_type   : '',
                }

                try {
                    // Overwrite the defaults with any new options
                    _.forEach(new_options, (option, key) => {
                        options[key] = option;
                    })
                } catch (e) {
                    console.log(e);
                }

                this.editable_search_options = _.cloneDeep(options);
            }
        },
        watch: {
            editable_search_options: {
                deep: true,
                handler: 'onSearchOptionsUpdate'
            }
        }
    }
</script>
