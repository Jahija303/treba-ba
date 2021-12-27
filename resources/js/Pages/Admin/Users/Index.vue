<template>
    <admin-layout title="Users">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Users</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreateUserModal" type="button" class="btn btn-primary">
                            <i class="fas fa-folder-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </template>
        <template #mainContent>
            <div class="content-wrapper ml-3 mr-3 mt-0">
                <table class="table table-hover">
                    <thead id="table-head">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <!--<th>Update</th>-->
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users.data">
                        <td class="font-weight-bold align-middle">{{ user.id }}</td>
                        <td class="align-middle">
                            <img :src="user.profile_photo_url" :alt="user.firstname" class="rounded-full h-8 w-8 object-cover">
                        </td>
                        <td class="align-middle">{{ user.firstname }} {{ user.lastname }}</td>
                        <td class="align-middle">{{ user.email }}</td>
                        <td class="align-middle">{{ user.username }}</td>
                        <td class="align-middle"><h5><span span class="badge badge-primary">{{ getRoleName(user.id) }}</span></h5></td>
                        <td class="align-middle" v-if="user.status === 1"><h5><span class="badge badge-success">active</span></h5></td>
                        <td class="align-middle" v-else-if="user.status === 0"><h5><span class="badge badge-danger">inactive</span></h5></td>
                        <!--<td class="pt-4 align-middle">
                            <toggle-button @switched="statusUpdated" :id="user.id" :defaultState="user.status"/>
                        </td>-->
                        <td class="max-w-0xl align-middle">
                            <a class="mr-4" href="#">
                                <i class="fas fa-edit fa-lg" @click="openEditUserRoleModal(user)" style="color: #007bff"></i>
                            </a>
                            <a href="#">
                                <i class="fas fa-trash-alt fa-lg" @click="confirmDeleteUser(user)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="users.links" />
            </div>

            <!-- Create User Modal -->
            <jet-dialog-modal :marginTop="false" :show="createUserModal" @close="closeModal">
                <template #title>
                    Add User
                </template>

                <template #content>
                    Please enter the user data in all of the required fields.

                    <div class="mt-4">
                        <jet-label value="First name*" />
                        <jet-input ref="firstname" type="text" class="mt-1 block w-full" placeholder="First name"
                                   v-model="form.firstname" required autofocus />

                        <jet-input-error :message="form.errors.firstname" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Last name*" />
                        <jet-input ref="lastname" type="text" class="mt-1 block w-full" placeholder="Last name"
                                   v-model="form.lastname" required />

                        <jet-input-error :message="form.errors.lastname" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Address*" />
                        <jet-input ref="address" type="text" class="mt-1 block w-full" placeholder="Address"
                                   v-model="form.address" required />

                        <jet-input-error :message="form.errors.address" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="City*"/>
                        <select id="citySelect" class="mt-1 block w-100 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedCity($event)">
                            <option v-for="city in cities"
                                    :value="city.id">
                                {{city.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.city_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Email*" />
                        <jet-input ref="email" type="email" class="mt-1 block w-full" placeholder="Email"
                                   v-model="form.email" required />

                        <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Username*" />
                        <jet-input ref="username" type="text" class="mt-1 block w-full" placeholder="Username"
                                   v-model="form.username" required />

                        <jet-input-error :message="form.errors.username" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Password*" />
                        <jet-input ref="password" type="password" class="mt-1 block w-full" placeholder="Password"
                                   v-model="form.password" required autocomplete="new-password" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="User role*"/>
                        <select id="roleSelect" class="mt-1 block w-100 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedRole($event)">
                            <option v-for="role in roles"
                                    :value="role.name"
                                    :selected="role.id === 3">
                                {{role.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.role" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="createUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Add User
                    </jet-button>
                </template>
            </jet-dialog-modal>

            <!-- Delete User Confirmation Modal -->
            <jet-dialog-modal :show="confirmUserDeletion" @close="closeModal">
                <template #title>
                    Delete User
                </template>

                <template #content>
                    Are you sure you want to delete this user? Once this user is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this user.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete User
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Edit User Modal -->
            <jet-dialog-modal :show="editUserRoleModal" @close="closeModal">
                <template #title>
                    Edit User Role
                </template>

                <template #content>
                    <div class="mt-4">
                        <jet-label value="User role*"/>
                        <select id="roleSelect" class="mt-1 block w-100 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedRole($event)">
                            <option v-for="role in roles"
                                    :value="role.name"
                                    :selected="role.name === this.form.role">
                                {{role.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.role" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label value="Status*"/>
                        <select id="statusSelect" class="mt-1 block w-100 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedStatus($event)">
                            <option :value="1"
                                    :selected="this.form.status === 1">
                                Active
                            </option>
                            <option :value="0"
                                    :selected="this.form.status === 0">
                                Inactive
                            </option>
                        </select>

                        <jet-input-error :message="form.errors.status" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="updateUserRole" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update User Role
                    </jet-button>
                </template>
            </jet-dialog-modal>

        </template>
    </admin-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AdminLayout from "../../../Layouts/AdminLayout";
import { Link } from '@inertiajs/inertia-vue3'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import Swal from "sweetalert2";
import Pagination from "@/Components/Pagination.vue";
import JetLabel from "@/Jetstream/Label.vue"
import ToggleButton from "../../../Jetstream/ToggleButton";

export default defineComponent({
    components: {
        Link,
        AdminLayout,
        JetDangerButton,
        JetDialogModal,
        JetSecondaryButton,
        JetInputError,
        JetButton,
        JetInput,
        JetDropdown,
        Pagination,
        JetLabel,
        ToggleButton,
    },
    data() {
        return {
            createUserModal: false,
            confirmUserDeletion: false,
            editUserRoleModal: false,

            form: this.$inertia.form({
                id: '',
                firstname: '',
                lastname: '',
                address: '',
                city_id: 1,
                email: '',
                username: '',
                password: '',
                role: 'user',
                status: 1,
            }),
        }
    },
    props: ['users', 'user_roles', 'roles', 'cities'],
    methods: {
        statusUpdated(value, id) {
            this.form.id = id
            this.form.status = value

            this.form.put(this.route('admin.users.update_status', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'User status updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating user status',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.reset()
                },
            })
        },
        getRoleName(userId) {
            let name
            this.user_roles.forEach(element => {
                if(element.model_id === userId) {
                    name = element.name
                }
            })
            return name
        },
        setFormDefaults() {
            this.form.city_id = 1
            this.form.role = 'user'
        },
        selectElement(id, valueToSelect) {
            let element = document.getElementById(id);
            element.value = valueToSelect;
        },
        selectedRole(e) {
            this.form.role = e.target.value
        },
        selectedStatus(e) {
            this.form.status = e.target.value
        },
        selectedCity(e) {
            this.form.city_id = e.target.value
        },
        openCreateUserModal() {
            this.createUserModal = true
            setTimeout(() => this.$refs.firstname.focus(), 250)
        },
        confirmDeleteUser(user) {
            this.form.id = user.id
            this.confirmUserDeletion = true
        },
        openEditUserRoleModal(user) {
            this.form.id = user.id
            this.form.role = this.getRoleName(user.id)
            this.form.status = user.status
            this.editUserRoleModal = true
        },
        createUser() {
            this.form.post(this.route('admin.users.store'), {
                preserveScroll: true,
                onSuccess:() => {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'New user added',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => this.$refs.firstname.focus(),
                onFinish: () => {
                    this.form.reset()
                    this.setFormDefaults()
                    this.selectElement('roleSelect', 'user')
                    this.selectElement('citySelect', '1')
                },
            })
        },
        deleteUser() {
            this.form.delete(this.route('admin.users.destroy', this.form.id), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'The selected user has been deleted.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error deleting user',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.reset()
                    this.setFormDefaults()
                }
            })
        },
        updateUserRole() {
            this.form.put(this.route('admin.users.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'User role updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating user role',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.reset()
                },
            })
        },
        closeModal() {
            this.createUserModal = false
            this.confirmUserDeletion = false
            this.editUserRoleModal = false
            this.form.clearErrors()
            this.editMode = false
            this.form.reset()
            this.setFormDefaults()
        },
    },
})

</script>

<style scoped>
#container {
    max-width: 100% !important;
}
#table-head {
    background-color: #007bff;
    color: white;
}
</style>
