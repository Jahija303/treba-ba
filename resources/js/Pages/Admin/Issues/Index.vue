<template>
    <admin-layout title="Issues">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Issues</h1>
                    </div>
                    <div class="col text-right">
                        <Link href="#">
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
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="issue in issues.data">
                        <td class="font-weight-bold">{{ issue.id }}</td>
                        <td>{{ issue.title }}</td>
                        <td>{{ issue.city_name }}</td>
                        <td>{{ issue.district_name }}</td>
                        <td>{{ issue.category_name }}</td>
                            <td v-if="issue.priority === 1"><span class="badge badge-info">Moderate</span></td>
                            <td v-if="issue.priority === 2"><span class="badge badge-warning">Considerable</span></td>
                            <td v-if="issue.priority === 3"><span class="badge badge-danger">High</span></td>
                        <td>{{ issue.user_username }}</td>
                            <td v-if="issue.status === 1"><span class="badge badge-success">active</span></td>
                            <td v-else-if="issue.status === 0"><span class="badge badge-danger">inactive</span></td>
                        <td>
                            <button @click="flipIssueStatus(issue)" type="button" class="btn btn-primary">
                                <i class="fas"></i>
                                Flip status
                            </button>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt" @click="confirmDeleteIssue(issue)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="issues.links" />
            </div>

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
    },
    data() {
        return {
            form: this.$inertia.form({
                id: '',
            }),
        }
    },
    props: ['issues'],
    methods: {

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
