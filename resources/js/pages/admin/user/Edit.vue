` <template>
    <form
        class="max-w-5xl mx-auto"
        autocomplete="off"
        @submit.prevent="submit"
    >
        <div
            v-if="userCan('profile.edit')"
            class="flex flex-row items-center mb-6"
        >
            <h1 class="mr-auto text-lg">
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
                    :error_message="getPageErrorMessage('first_name')"
                    input_autocomplete="off"
                    :input_autofocus="true"
                    input_id="first_name"
                    input_name="first_name"
                    :input_required="true"
                    input_type="text"
                    label_text="First Name"
                    v-model="formData.first_name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('last_name')"
                    input_autocomplete="off"
                    input_id="last_name"
                    input_name="last_name"
                    :input_required="true"
                    input_type="text"
                    label_text="Last Name"
                    v-model="formData.last_name"
                />

                <input-group
                    class="mt-4"
                    :error_message="getPageErrorMessage('email')"
                    input_autocomplete="off"
                    input_id="email"
                    input_name="email"
                    :input_required="true"
                    input_type="email"
                    label_text="Email"
                    v-model="formData.email"
                />
            </div>
        </div>
    </form>
</template>

<script>
    import InputGroup from "../../../components/core/forms/InputGroup";

    export default {
        name: "AdminUserEdit",
        components: {InputGroup},
        layout: 'admin-layout',
        props: {
            user: Object,
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
            }
        },
        created() {
            this.formData = {
                email:      this.user.email,
                first_name: this.user.first_name,
                last_name:  this.user.last_name,
            }
        },
        methods: {
            submit() {
                this.$inertia.put(
                    this.$route('admin.users.update', this.user.id),
                    this.formData
                );
            }
        }
    }
</script>
