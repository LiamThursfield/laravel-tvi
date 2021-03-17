` <template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('users.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="font-medium mr-auto text-lg">
                Edit User
                <span class="ml-2 opacity-75 text-sm">
                    {{ user.name }}
                </span>
            </h1>

            <inertia-link
                v-if="userCan('users.view')"
                class="
                    button button-default-responsive button-primary-subtle
                    flex flex-row items-center mr-2
                "
                :href="$route('admin.users.index')"
            >
                <icon-chevron-left
                    class="w-5 md:mr-2"
                />
                <span
                    class="hidden md:inline"
                >
                    Back
                </span>
            </inertia-link>

            <button
                class="
                    button button-default-responsive button-primary
                    flex flex-row items-center
                "
                type="submit"
            >
                <icon-save
                    class="
                        w-5
                        md:mr-2
                    "
                />
                <span
                    class="hidden md:inline"
                >
                    Save Changes
                </span>
            </button>
        </div>

        <div class="bg-white py-6 shadow-subtle rounded-lg">
            <div class="block px-6 w-full">

                <input-group
                    :error-message="getPageErrorMessage('first_name')"
                    input-autocomplete="off"
                    :input-autofocus="true"
                    input-id="first_name"
                    input-name="first_name"
                    :input-required="true"
                    input-type="text"
                    label-text="First Name"
                    @errorHidden="clearPageErrorMessage('first_name')"
                    v-model="formData.first_name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('last_name')"
                    input-autocomplete="off"
                    input-id="last_name"
                    input-name="last_name"
                    :input-required="true"
                    input-type="text"
                    label-text="Last Name"
                    @errorHidden="clearPageErrorMessage('last_name')"
                    v-model="formData.last_name"
                />

                <input-group
                    class="mt-4"
                    :error-message="getPageErrorMessage('email')"
                    input-autocomplete="off"
                    input-id="email"
                    input-name="email"
                    :input-required="true"
                    input-type="email"
                    label-text="Email"
                    @errorHidden="clearPageErrorMessage('email')"
                    v-model="formData.email"
                />
            </div>
        </div>

        <div v-if="isSelectableRoles"
             class="bg-white mt-6 py-6 shadow-subtle rounded-lg"
        >
            <div class="block px-6 w-full">
                <p class="font-medium mb-4 text-theme-base-contrast tracking-wider">
                    Roles
                </p>

                <div class="space-y-3">
                    <inline-checkbox-group
                        v-for="(role_label, role_key) in selectableRoles"
                        :key="`user-role-${role_key}`"
                        :input-id="`user-role-${role_key}`"
                        :input-name="`user-role-${role_key}`"
                        :label-text="role_label"
                        v-model="formData.roles[role_key]"
                    />
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import _ from "lodash";
    import InlineCheckboxGroup from "../../../components/core/forms/InlineCheckboxGroup";
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AdminUserEdit",
        components: {
            InlineCheckboxGroup,
            InputGroup,
        },
        layout: 'admin-layout',
        props: {
            selectableRoles: {
                required: true,
                type: Object,
            },
            user: {
                required: true,
                type: Object,
            },
        },
        data() {
            return {
                formData: null,
            }
        },
        computed: {
            isCurrentUser() {
                try {
                    return this.user.id === this.$page.props.auth.user.id;
                } catch (e) {
                    return false;
                }
            },
            isSelectableRoles() {
                try {
                    return Object.keys(this.selectableRoles).length > 0;
                } catch (e) {
                    return false;
                }
            }
        },
        created() {
            this.formData = {
                email:      this.user.email,
                first_name: this.user.first_name,
                last_name:  this.user.last_name,
                roles:      this.user.roles,
            };

            if (Array.isArray(this.formData.roles)) {
                this.formData.roles = {};
            }

            this.initialiseRoles();
        },
        methods: {
            initialiseRoles() {
                _.forEach(this.selectableRoles, (role_label, role_key) => {{
                    if (!this.formData.roles.hasOwnProperty(role_key)) {
                        this.formData.roles[role_key] = false;
                    }
                }});
            },
            submit() {
                this.$inertia.put(
                    this.$route('admin.users.update', this.user.id),
                    this.formData
                );
            }
        }
    }
</script>
