<template>
    <admin-layout title="Roles">
        <template #mainContent>
            <div class="content-wrapper ml-3 mr-3 mt-0">
                <div id="container" class="container mr-5 mb-6">
                    <div class="row w-100">
                        <div class="col">
                            <h2>Roles</h2>
                        </div>
                        <div class="col text-right">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-folder-plus"></i>
                                Add
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="role in roles">
                        <td>{{ role.id }}</td>
                        <td>{{ role.name }}</td>
                        <td>{{ formatDate(role.created_at) }}</td>
                        <td>
                            <a href="#">
                                <i class="fas fa-edit" style="color: #007bff"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt" @click="confirmRoleDeletion" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingRoleDeletion" @close="closeModal">
                <template #title>
                    Delete Account
                </template>

                <template #content>
                    Are you sure you want to delete this role? Once this role is deleted, all of its resources and data will be permanently deleted. Please confirm you would like to permanently delete this role.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteRole" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete Role
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>
        </template>
    </admin-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from "../../../Layouts/AdminLayout";
    import moment from "moment";
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        components: {
            AdminLayout,
            JetDangerButton,
            JetDialogModal,
            JetSecondaryButton,
        },
        data() {
            return {
                confirmingRoleDeletion: false,

                form: this.$inertia.form({
                    id: '',
                    name: '',
                    permissions: []
                })
            }
        },
        props: ['roles'],
        methods: {
            formatDate : function (date) {
                return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            },
            confirmRoleDeletion() {
                this.confirmingRoleDeletion = true;
            },
            deleteRole() {
                console.log("Deleting role")
            },
            closeModal() {
                this.confirmingRoleDeletion = false
            },
        },
    })

</script>

<style scoped>
#container {
    max-width: 100% !important;
}
</style>
