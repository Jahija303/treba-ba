<template>
    <admin-layout title="Issues">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Issues</h1>
                    </div>
                    <div class="col text-right">
                        <Link :href="route('issues.report')">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-folder-plus"></i>
                                Add
                            </button>
                        </Link>
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
                        <th>Title</th>
                        <th>City</th>
                        <th>District</th>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Reported by</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="issue in issues.data">
                        <td class="font-weight-bold">{{ issue.id }}</td>
                        <td><Link :href="route('issues.show', issue.id)">{{ issue.title }}</Link></td>
                        <td>{{ issue.city_name }}</td>
                        <td>{{ issue.district_name }}</td>
                        <td>{{ issue.category_name }}</td>
                            <td v-if="issue.priority === 1"><h5><span class="badge badge-info">Moderate</span></h5></td>
                            <td v-if="issue.priority === 2"><h5><span class="badge badge-warning">Considerable</span></h5></td>
                            <td v-if="issue.priority === 3"><h5><span class="badge badge-danger">High</span></h5></td>
                        <td>{{ issue.user_username }}</td>
                            <td v-if="issue.status === 1"><h5><span class="badge badge-success">active</span></h5></td>
                            <td v-else-if="issue.status === 0"><h5><span class="badge badge-danger">inactive</span></h5></td>
                        <td>
                            <toggle-button @switched="statusUpdated" :id="issue.id" :defaultState="issue.status"/>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt fa-lg" @click="confirmDeleteIssue(issue)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="issues.links" />
            </div>

            <!-- Delete Issue Confirmation Modal -->
            <jet-dialog-modal :show="confirmIssueDeletion" @close="closeModal">
                <template #title>
                    Delete Issue
                </template>

                <template #content>
                    Are you sure you want to delete this issue? Once this issue is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this issue.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteIssue" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete Issue
                    </jet-danger-button>
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
import JetDropdown from '@/Jetstream/Dropdown.vue'
import Swal from "sweetalert2";
import Pagination from "@/Components/Pagination.vue";
import JetLabel from "@/Jetstream/Label.vue"
import ToggleButton from "../../../Jetstream/ToggleButton";

export default defineComponent({
    components: {
        ToggleButton,
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
    },
    data() {
        return {
            confirmIssueDeletion: false,

            form: this.$inertia.form({
                id: '',
                status: '',
            }),
        }
    },
    props: ['issues'],
    methods: {
        statusUpdated(value, id) {
            this.form.id = id
            this.form.status = value

            this.form.put(this.route('admin.issues.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'Issue status updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating issue status',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.reset()
                },
            })
        },
        confirmDeleteIssue(issue) {
            this.form.id = issue.id
            this.confirmIssueDeletion = true
        },
        deleteIssue() {
            this.form.delete(this.route('admin.issues.destroy', this.form.id), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'The selected issue has been deleted.',
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
                        title: 'Error deleting issue',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.reset()
                }
            })
        },
        closeModal() {
            this.confirmIssueDeletion = false
            this.form.clearErrors()
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
