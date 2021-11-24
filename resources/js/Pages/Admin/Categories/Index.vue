<template>
    <admin-layout title="Categories">
        <template #header>
            <div id="container" class="container mr-5">
                <div class="row w-100">
                    <div class="col">
                        <h1 class="m-0">Categories</h1>
                    </div>
                    <div class="col text-right">
                        <button @click="openCreateCategoryModal" type="button" class="btn btn-primary">
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
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.description }}</td>
                        <td>
                            <a href="#">
                                <i class="fas fa-edit" @click="openEditCategoryModal(category)" style="color: #007bff"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-trash-alt" @click="confirmCategoryDeletion(category)" style="color: #dc3545"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6 pb-4" :links="categories.links" />
            </div>

            <!-- Delete Category Confirmation Modal -->
            <jet-dialog-modal :show="confirmingCategoryDeletion" @close="closeModal">
                <template #title>
                    Delete Category
                </template>

                <template #content>
                    Are you sure you want to delete this category? Once this category is deleted, all of its resources and data will be permanently deleted.
                    Please confirm you would like to permanently delete this category.
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteCategory" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Delete Category
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>

            <!-- Create Category Modal -->
            <jet-dialog-modal :show="createCategoryModal" @close="closeModal">
                <template #title>
                    Create Category
                </template>

                <template #content>
                    Please enter the name and description of the category you'd like to create.

                    <div class="mt-4">
                        <jet-label>Category name*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Name"
                                   ref="name"
                                   v-model="form.name"/>

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>Description*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4" placeholder="Description"
                                   ref="description"
                                   v-model="form.description"/>

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Cancel
                    </jet-button>

                    <jet-secondary-button class="ml-2" @click="createCategory" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create category
                    </jet-secondary-button>
                </template>
            </jet-dialog-modal>

            <!-- Edit Category Modal -->
            <jet-dialog-modal :show="editCategoryModal" @close="closeModal">
                <template #title>
                    Edit Category
                </template>

                <template #content>
                    Enter the new category name and description.

                    <div class="mt-4">
                        <jet-label>Category name*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4"
                                   ref="name"
                                   v-model="form.name"/>

                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <jet-label>Description*</jet-label>
                        <jet-input type="text" class="mt-1 block w-3/4"
                                   ref="description"
                                   v-model="form.description"/>

                        <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Cancel
                    </jet-button>

                    <jet-secondary-button class="ml-2" @click="updateCategory" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update category
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
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
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
        Pagination,
        JetLabel,
    },
    data() {
        return {
            confirmingCategoryDeletion: false,
            createCategoryModal: false,
            editCategoryModal: false,

            form: this.$inertia.form({
                id: '',
                name: '',
                description: '',
            }),
        }
    },
    props: {
        categories: Object,
    },
    methods: {
        confirmCategoryDeletion(category) {
            this.form.id = category.id
            this.confirmingCategoryDeletion = true;
        },
        openCreateCategoryModal() {
            this.createCategoryModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        openEditCategoryModal(category) {
            this.editCategoryModal = true
            this.form.id = category.id
            this.form.name = category.name
            this.form.description = category.description
            setTimeout(() => this.$refs.name.focus(), 250)
        },
        deleteCategory() {
            this.form.delete(this.route('admin.categories.destroy', this.form.id), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'Category has been deleted.',
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
                        title: 'Error deleting category',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => this.form.reset(),
            })
        },
        createCategory() {
            this.form.post(this.route('admin.categories.store'), {
                preserveScroll: true,
                onSuccess:() => {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'New category created',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => this.$refs.name.focus(),
                onFinish: () => this.form.reset(),
            })
        },
        updateCategory() {
            this.form.put(this.route('admin.categories.update', this.form.id, this.form), {
                preserveScroll: true,
                onSuccess: ()=> {
                    this.closeModal()
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'Category updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating category',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => this.form.reset(),
            })
        },
        closeModal() {
            this.confirmingCategoryDeletion = false
            this.createCategoryModal = false
            this.editCategoryModal = false
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
