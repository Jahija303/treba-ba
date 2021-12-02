<template>
    <admin-layout title="Permissions">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Permissions</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreatePermissionModal" type="button" class="btn btn-primary">
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
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="permission in permissions.data" :key="permission.id">
                        <td class="font-weight-bold">{{ permission.id }}</td>
                        <td>{{ permission.name }}</td>
                        <td>{{ formatDate(permission.created_at) }}</td>
                        <td class="max-w-0xl">
                            <a class="mr-4" href="#">
                                <i class="fas fa-edit fa-lg" @click="openEditPermissionModal(permission)" style="color: #007bff"></i>
                            </a>
                            <a href="#">
                                <i class="fas fa-trash-alt fa-lg" @click="confirmPermissionDeletion(permission)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="permissions.links" />
            </div>

            <!-- Delete Permission Confirmation Modal -->
            <jet-dialog-modal :show="confirmingPermissionDeletion" @close="closeModal">
                <template #title>
                    Delete Permission
                </template>

                <template #content>
                    Are you sure you want to delete this permission? Once this permission is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this permission.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deletePermission" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete Permission
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Create Permission Modal -->
            <jet-dialog-modal :show="createPermissionModal" @close="closeModal">
                <template #title>
                    Create Permission
                </template>

                <template #content>
                    Please enter the name of the permission you'd like to create.

                    <div class="mt-4">
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                   ref="name"
                                   v-model="form.name"
                                   @keyup.enter="createPermission" />

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="createPermission" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create permission
                    </jet-button>
                </template>
            </jet-dialog-modal>

            <!-- Edit Permission Modal -->
            <jet-dialog-modal :show="editPermissionModal" @close="closeModal">
                <template #title>
                    Edit Permission
                </template>

                <template #content>
                    Enter the new permission name.

                    <div class="mt-4">
                        <jet-input type="text" class="mt-1 block w-3/4"
                                   ref="name"
                                   v-model="form.name"
                                   @keyup.enter="updatePermission" />

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="updatePermission" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update permission
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
    import moment from "moment";
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import Swal from "sweetalert2";
    import Pagination from "@/Components/Pagination.vue";

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
            Pagination,
        },
        data() {
            return {
                confirmingPermissionDeletion: false,
                createPermissionModal: false,
                editPermissionModal: false,

                form: this.$inertia.form({
                    id: '',
                    name: '',
                }),
            }
        },
        props: {
            permissions: Object,
        },
        methods: {
            formatDate : function (date) {
                return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
            confirmPermissionDeletion(permission) {
                this.form.id = permission.id
                this.confirmingPermissionDeletion = true;
            },
            openCreatePermissionModal() {
                this.createPermissionModal = true
                setTimeout(() => this.$refs.name.focus(), 250)
            },
            openEditPermissionModal(permission) {
                this.editPermissionModal = true
                this.form.id = permission.id
                this.form.name = permission.name
                setTimeout(() => this.$refs.name.focus(), 250)
            },
            deletePermission() {
                this.form.delete(this.route('admin.permissions.destroy', this.form.id), {
                    preserveScroll: true,
                    onSuccess: ()=> {
                        this.closeModal()
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'success',
                            title: 'Permission has been deleted.',
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
                            title: 'Error deleting permission',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onFinish: () => {
                        this.form.reset()
                    }
                })
            },
            createPermission() {
                this.form.post(this.route('admin.permissions.store'), {
                    preserveScroll: true,
                    onSuccess:() => {
                        this.closeModal()
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'success',
                            title: 'New permission created',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onError: () => this.$refs.name.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
            updatePermission() {
                this.form.put(this.route('admin.permissions.update', this.form.id, this.form), {
                    preserveScroll: true,
                    onSuccess: ()=> {
                        this.closeModal()
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'success',
                            title: 'Permission updated.',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onError: () => {
                        this.resetForm = fals
                        Swal.fire({
                            position: 'top-end',
                            toast: 'true',
                            icon: 'error',
                            title: 'Error updating permission',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    },
                    onFinish: () => {
                        if(!this.editPermissionModal) {
                            this.form.reset()
                        }
                    }
                })
            },
            closeModal() {
                this.confirmingPermissionDeletion = false
                this.createPermissionModal = false
                this.editPermissionModal = false
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
.content-wrapper {
    min-height: 650px !important;
}
</style>
