<template>
    <section>
        <div
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
                 Layout
            </h1>

            <inertia-link
                v-if="userCan('cms.create')"
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                :href="$route('admin.cms.layouts.create')"
            >
                <icon-plus class="w-5 md:mr-2"/>

                <span
                    class="hidden md:inline"
                >
                    Create Layout
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
                        input_autocomplete="layout_name_search"
                        input_class="form-control form-control-short"
                        input_id="layout_name"
                        input_name="layout_name"
                        input_placeholder="Layout Name"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Layout Name"
                        v-model="editable_search_options.layout_name"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <input-group
                        input_autocomplete="layout_slug_search"
                        input_class="form-control form-control-short"
                        input_id="layout_slug"
                        input_name="layout_slug"
                        input_placeholder="Layout Slug"
                        input_type="text"
                        :label_hidden="true"
                        label_text="Layout Slug"
                        v-model="editable_search_options.layout_slug"
                    />
                </div>

                <div class="w-full md:w-1/3">
                    <select-group
                        :label_hidden="true"
                        label_text="Template"
                        :select_any_enabled="true"
                        select_any_label="Template"
                        select_class="form-control form-control-short"
                        select_id="template_id"
                        select_name="template_id"
                        select_option_label_key="name"
                        select_option_value_key="id"
                        :select_options="templates"
                        v-model="editable_search_options.template_id"
                    />
                </div>
            </div>

            <p
                v-if="!layouts_data"
                class="bg-theme-base-subtle mt-8 mx-6 px-6 py-4 rounded text-center text-theme-base-subtle-contrast"
            >
                No layouts
            </p>

            <template v-else>

                <!-- Search Results -->
                <div class="block mt-8 overflow-x-auto w-full">
                    <table class="table table-hover table-striped w-full">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Template</th>
                            <th v-if="show_layout_actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(layout, index) in layouts_data"
                            :key="`layout-${layout.id}`"
                        >
                            <td>
                                {{ layout.name }}
                            </td>
                            <td>
                                {{ layout.slug }}
                            </td>
                            <td>
                                {{  layout.template.name }}
                            </td>
                            <td v-if="show_layout_actions">
                                <div class="flex flex-row items-center justify-end -mx-1">
                                    <inertia-link
                                        v-if="userCan('cms.edit')"
                                        class="
                                            flex flex-row items-center inline-flex mx-1 px-2 py-1 rounded text-theme-base-subtle-contrast text-sm tracking-wide
                                            focus:outline-none focus:ring
                                            hover:bg-theme-info hover:text-theme-info-contrast
                                        "
                                        :href="$route('admin.cms.layouts.edit', layout.id)"
                                        title="Edit Layout"
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
                                        title="Delete Layout"
                                        @click="checkDelete(layout)"
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
                    <pagination :pagination="layouts.pagination" />
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
        name: "AdminCMSLayoutIndex",
        components: {
            ConfirmationModal,
            InputGroup,
            SelectGroup
        },
        layout: 'admin-layout',
        props: {
            layouts: Object,
            search_options: Object|Array,
            templates: Object
        },
        data() {
            return {
                editable_search_options: {
                    per_page        : 15,
                    layout_name   : '',
                    layout_slug   : '',
                    template_id   : '',
                },
                is_initialised: false,
                is_loading_delete: false,
                show_delete_modal: false,
                layout_to_delete: null,
            }
        },
        mounted() {
            this.setSearchOptions(this.search_options);
        },
        computed: {
            delete_modal_text() {
                try {
                    return 'Do you really want to delete \'' + this.layout_to_delete.name + '\'?';
                } catch (e) {
                    return 'Do you really want to delete this layouts?'
                }
            },
            show_pagination() {
                try {
                    return this.layouts.pagination.last_page > 1;
                } catch (e) {
                    return false;
                }
            },
            show_layout_actions() {
                return this.userCan('cms.edit') || this.userCan('cms.delete');
            },
            layouts_data() {
                if (!this.layouts || !this.layouts.data || this.layouts.data.length < 1) {
                    return false;
                }

                return this.layouts.data;
            }
        },
        methods: {
            cancelDelete() {
                if (!this.is_loading_delete) {
                    this.show_delete_modal = false;
                    this.layout_to_delete = null;
                }
            },
            checkDelete(layout) {
                this.show_delete_modal = true;
                this.layout_to_delete = layout;
            },
            confirmDelete() {
                if (this.is_loading_delete) {
                    return this.$errorToast('It\'s only possible to delete one layouts at a time.');
                }
                this.$inertia.delete(
                    this.$route('admin.cms.layouts.destroy', this.layout_to_delete.id),
                    {
                        only: [
                            'flash',
                            'layouts'
                        ]
                    }
                );
                this.layout_to_delete = null;
                this.show_delete_modal = false;
            },
            onSearchOptionsUpdate: _.debounce(function () {
                if (!this.is_initialised) {
                    this.is_initialised = true;

                    // If there are already search results, don't attempt search
                    if (this.layouts_data) {
                        return;
                    }
                }

                Inertia.get(
                    this.$route('admin.cms.layouts.index'),
                    this.editable_search_options,
                    {
                        only: ['layouts'],
                        preserveState: true,
                    }
                );
            }, 500),
            setSearchOptions(new_options = {}) {
                let options = {
                    per_page        : 15,
                    layout_name   : '',
                    layout_slug   : '',
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
