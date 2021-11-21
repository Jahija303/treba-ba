<template>
    <admin-layout title="Roles">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Roles</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreateRoleModal" type="button" class="btn btn-primary">
                            <i class="fas fa-folder-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </template>
        <template #mainContent>
            <div class="content-wrapper ml-3 mr-3 mt-0">
                <table class="table table-hover table-bordered">
                    <thead id="table-head">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="role in roles">
                        <td>{{ role.id }}</td>
                        <td>{{ role.name }}</td>
                        <td>{{ formatDate(role.created_at) }}</td>
                        <td>
                            <Link :href="route('admin.roles.edit', role.id)">
                                <i class="fas fa-edit" style="color: #007bff"></i>
                            </Link>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt" @click="confirmRoleDeletion(role)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Delete Role Confirmation Modal -->
            <jet-dialog-modal :show="confirmingRoleDeletion" @close="closeModal">
                <template #title>
                    Delete Role
                </template>

                <template #content>
                    Are you sure you want to delete this role? Once this role is deleted, all of its resources and data will be permanently deleted. Please confirm you would like to permanently delete this role.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteRole()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete Role
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Create Role Modal -->
            <jet-dialog-modal :show="createRoleModal" @close="closeModal">
                <template #title>
                    Create Role
                </template>

                <template #content>
                    Please enter the name of the role you'd like to create.

                    <div class="mt-4">
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                   ref="name"
                                   v-model="form.name"
                                   @keyup.enter="createRole" />

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Cancel
                    </jet-button>

                    <jet-secondary-button class="ml-2" @click="createRole" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create role
                    </jet-secondary-button>
                </template>
            </jet-dialog-modal>
        </template>
    </admin-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from "../../../Layouts/AdminLayout";
    import { Link } from '@inertiajs/inertia-vue3'
    import moment from "moment";
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import Swal from "sweetalert2";

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
        },
        data() {
            return {
                confirmingRoleDeletion: false,
                createRoleModal: false,

                form: this.$inertia.form({
                    id: '',
                    name: '',
                })
            }
        },
        props: ['roles'],
        methods: {
            formatDate : function (date) {
                return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
            confirmRoleDeletion(role) {
                this.confirmingRoleDeletion = true;
                this.form.id = role.id
            },
            openCreateRoleModal() {
                this.createRoleModal = true
                setTimeout(() => this.$refs.name.focus(), 250)
            },
            deleteRole() {
                this.form.delete(this.route('admin.roles.destroy', this.form.id), {
                    onSuccess: ()=> {
                        this.closeModal()
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'success',
                            title: 'Role has been deleted.',
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
                            title: 'Error deleting role',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onFinish: () => this.form.reset(),
                })
            },
            createRole() {
                this.form.post(this.route('admin.roles.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'success',
                            title: 'New role created',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onError: () => this.$refs.name.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
            closeModal() {
                this.confirmingRoleDeletion = false
                this.createRoleModal = false
                this.form.clearErrors()
                this.editMode = false
                this.form.reset()
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
