<template>
    <admin-layout title="Cities">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Cities</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreateCityModal" type="button" class="btn btn-primary">
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
                        <th scope="col">Description</th>
                        <th scope="col">Population</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="city in cities.data">
                        <td class="font-weight-bold">{{ city.id }}</td>
                        <td>{{ city.name }}</td>
                        <td>{{ city.description }}</td>
                        <td>{{ city.population }}</td>
                            <td v-if="city.status === 1"><h5><span class="badge badge-success">active</span></h5></td>
                            <td v-else-if="city.status === 0"><h5><span class="badge badge-danger">inactive</span></h5></td>
                        <td class="max-w-0xl">
                            <a class="mr-4" href="#">
                                <i class="fas fa-edit fa-lg" @click="openEditCityModal(city)" style="color: #007bff"></i>
                            </a>
                            <a href="#">
                                <i class="fas fa-trash-alt fa-lg" @click="confirmDeleteCity(city)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="cities.links" />
            </div>

            <!-- Create City Modal -->
            <jet-dialog-modal :show="createCityModal" @close="closeModal">
                <template #title>
                    Create City
                </template>

                <template #content>
                    Please enter the data in all of the required fields.

                    <div class="mt-4">
                        <jet-label>City name*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                   ref="name"
                                   v-model="form.name"/>

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>A short description of the city, something it is known for*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Description"
                                   ref="description"
                                   v-model="form.description"/>

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>Population*</jet-label>
                        <jet-input type="number" class="mt-1 block w-3/4" placeholder="012345"
                                   ref="population"
                                   v-model.number="form.population"
                                   @keypress="isNumber($event)"/>

                        <jet-input-error :message="form.errors.population" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="createCity" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create city
                    </jet-button>
                </template>
            </jet-dialog-modal>

            <!-- Delete City Confirmation Modal -->
            <jet-dialog-modal :show="confirmCityDeletion" @close="closeModal">
                <template #title>
                    Delete City
                </template>

                <template #content>
                    Are you sure you want to delete this city? Once this city is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this city.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteCity" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete City
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Edit City Modal -->
            <jet-dialog-modal :show="editCityModal" @close="closeModal">
                <template #title>
                    Edit City
                </template>

                <template #content>
                    <div class="mt-4">
                        <jet-label>City Name</jet-label>
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
                        <jet-label>Population</jet-label>
                        <jet-input type="number" class="mt-1 block w-3/4"
                                   ref="population"
                                   v-model.number="form.population"
                                   @keypress="isNumber($event)"/>

                        <jet-input-error :message="form.errors.population" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="updateCity" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update City
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
            createCityModal: false,
            confirmCityDeletion: false,
            editCityModal: false,

            form: this.$inertia.form({
                id: '',
                name: '',
                description: '',
                status: '',
                population: '',
            }),
        }
    },
    props: ['cities'],
    methods: {
        formatDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
        },
        isNumber : function (evt) {
            const keysAllowed = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
            const keyPressed = evt.key;
            if (!keysAllowed.includes(keyPressed)) {
                evt.preventDefault()
            }
        },
        openCreateCityModal() {
            this.createCityModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        confirmDeleteCity(city) {
            this.form.id = city.id
            this.confirmCityDeletion = true
        },
        openEditCityModal(city) {
            this.editCityModal = true
            this.form.id = city.id
            this.form.name = city.name
            this.form.description = city.description
            this.form.population = city.population
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        createCity() {
            this.form.post(this.route('admin.cities.store'), {
                preserveScroll: true,
                onSuccess:() => {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'New city created',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => this.$refs.name.focus(),
                onFinish: () => this.form.reset(),
            })
        },
        deleteCity() {
            this.form.delete(this.route('admin.cities.destroy', this.form.id), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'The city has been deleted.',
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
                        title: 'Error deleting city',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => this.form.reset(),
            })
        },
        updateCity() {
            this.form.put(this.route('admin.cities.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'City updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating city',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    if(!this.editCityModal) {
                        this.form.reset()
                    }
                }
            })
        },
        closeModal() {
            this.createCityModal = false
            this.confirmCityDeletion = false
            this.editCityModal = false,
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
