<template>
    <admin-layout title="Districts">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Districts</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreateDistrictModal" type="button" class="btn btn-primary">
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
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">City</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="district in districts.data">
                        <td>{{ district.id }}</td>
                        <td>{{ district.name }}</td>
                        <td>{{ district.description }}</td>
                        <td v-if="district.status === 1"><span class="badge badge-success">active</span></td>
                        <td v-else-if="district.status === 0"><span class="badge badge-danger">inactive</span></td>
                        <td>{{ getCityName(district.city_id) }}</td>
                        <td>
                            <a href="#">
                                <i class="fas fa-edit" @click="openEditDistrictModal(district)" style="color: #007bff"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt" @click="confirmDeleteDistrict(district)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="districts.links" />
            </div>

            <!-- Create District Modal -->
            <jet-dialog-modal :show="createDistrictModal" @close="closeModal">
                <template #title>
                    Create District
                </template>

                <template #content>
                    Please enter the data in all of the required fields.

                    <div class="mt-4">
                        <jet-label>District name*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                   ref="name"
                                   v-model="form.name"/>

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>A short description of the district, something it is known for*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Description"
                                   ref="description"
                                   v-model="form.description"/>

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>It is located in*</jet-label>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedCity($event)">
                            <option v-for="city in citiesList" :value="city.id">{{city.name}}</option>
                        </select>

                        <jet-input-error :message="form.errors.city_id" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Cancel
                    </jet-button>

                    <jet-secondary-button class="ml-2" @click="createDistrict" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create District
                    </jet-secondary-button>
                </template>
            </jet-dialog-modal>

            <!-- Delete District Confirmation Modal -->
            <jet-dialog-modal :show="confirmDistrictDeletion" @close="closeModal">
                <template #title>
                    Delete District
                </template>

                <template #content>
                    Are you sure you want to delete this district? Once this district is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this district.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteDistrict" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete District
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Edit District Modal -->
            <jet-dialog-modal :show="editDistrictModal" @close="closeModal">
                <template #title>
                    Edit District
                </template>

                <template #content>
                    <div class="mt-4">
                        <jet-label>District Name</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4"
                                   ref="name"
                                   v-model="form.name"/>

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>Description</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4"
                                   ref="description"
                                   v-model="form.description"/>

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>It is located in*</jet-label>
                        <select class="mt-1 block w-3/4 border-gray-300
                                    focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                    focus:ring-opacity-50 rounded-md shadow-sm"
                                @change="selectedCity($event)">
                            <option v-for="city in citiesList"
                                    :value="city.id"
                                    :selected="city.id === this.form.city_id">
                                {{city.name}}
                            </option>
                        </select>

                        <jet-input-error :message="form.errors.city_id" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Cancel
                    </jet-button>

                    <jet-secondary-button class="ml-2" @click="updateDistrict" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update District
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
            createDistrictModal: false,
            confirmDistrictDeletion: false,
            editDistrictModal: false,

            form: this.$inertia.form({
                id: '',
                name: '',
                description: '',
                status: '',
                city_id: 1,
            }),

            citiesList: this.cities,
        }
    },
    props: ['districts', 'cities'],
    methods: {
        formatDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
        },
        getCityName(cityId) {
            let name
            this.citiesList.forEach(element => {
                if(element.id === cityId) {
                    name = element.name
                }
            })
            return name
        },
        selectedCity(e) {
            this.form.city_id = e.target.value
        },
        isNumber : function (evt) {
            const keysAllowed = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
            const keyPressed = evt.key;
            if (!keysAllowed.includes(keyPressed)) {
                evt.preventDefault()
            }
        },
        openCreateDistrictModal() {
            this.createDistrictModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        confirmDeleteDistrict(district) {
            this.form.id = district.id
            this.confirmDistrictDeletion = true
        },
        openEditDistrictModal(district) {
            this.form.id = district.id
            this.form.name = district.name
            this.form.description = district.description
            this.form.city_id = district.city_id
            this.editDistrictModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        createDistrict() {
            this.form.post(this.route('admin.districts.store'), {
                preserveScroll: true,
                onSuccess:() => {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'New district created',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => this.$refs.name.focus(),
                onFinish: () => this.form.reset(),
            })
        },
        deleteDistrict() {
            this.form.delete(this.route('admin.districts.destroy', this.form.id), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'The district has been deleted.',
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
                        title: 'Error deleting the district',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => this.form.reset(),
            })
        },
        updateDistrict() {
            this.form.put(this.route('admin.districts.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'District updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating district',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => this.form.reset(),
            })
        },
        closeModal() {
            this.createDistrictModal = false
            this.confirmDistrictDeletion = false
            this.editDistrictModal = false,
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
