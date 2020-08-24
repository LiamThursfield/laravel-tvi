<template>
    <div class="bg-white py-6 shadow-subtle rounded-lg">
        <h1 class="font-semibold px-6 text-gray-850">
            Users
        </h1>

        <div class="block mt-4 overflow-x-auto w-full">
            <table
                class="table table-hover table-striped w-full"
            >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th v-if="showUsersActions"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(user, index) in usersData"
                        :key="`user-${user.id}`"
                    >
                        <td>
                            {{ user.name }}
                        </td>
                        <td>
                            {{ user.email }}
                        </td>
                        <td v-if="showUsersActions">
                            <div class="flex flex-row items-center justify-end -mx-1">
                                <inertia-link
                                    v-if="userCan('users.edit')"
                                    class="
                                        border border-navy-300 flex-row items-center inline-flex mx-1 px-2 rounded text-navy-300 text-sm tracking-wide
                                        hover:bg-theme-info hover:border-theme-info hover:text-theme-info-contrast
                                    "
                                    href="#edit"
                                >
                                    <icon-edit
                                        class="h-4 mr-1 w-4"
                                    />
                                    Edit
                                </inertia-link>

                                <inertia-link
                                    v-if="userCan('users.delete')"
                                    class="
                                        border border-navy-300 flex-row items-center inline-flex mx-1 px-2 rounded text-navy-300 text-sm tracking-wide
                                        hover:bg-theme-danger hover:border-theme-danger hover:text-theme-danger-contrast
                                    "
                                    href="#delete"
                                >
                                    <icon-trash
                                        class="h-4 mr-1 w-4"
                                    />
                                    Delete
                                </inertia-link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-row justify-center mt-12 px-6">
            <pagination
                :pagination="users.pagination"
            />
        </div>
    </div>
</template>

<script>

    export default {
        name: "AdminUserIndex",
        layout: 'admin-layout',
        props: {
            users: Object,
        },
        computed: {
            showUsersActions() {
                return this.userCan('users.edit') || this.userCan('users.delete');
            },
            usersData() {
                if (!this.users || !this.users.data || this.users.data.length < 1) {
                    return false;
                }

                return this.users.data;
            }
        }
    }
</script>
