<template>
    <admin-layout title="Roles">
        <template #mainContent>
            <div class="content-wrapper m-3">
                <div id="container" class="container mr-5 mb-6">
                    <div class="row w-100">
                        <div class="col-sm-10">
                            <h2>Roles</h2>
                        </div>
                        <div class="col-sm-2 text-center">
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
                            <td>{{ role.created_at }}</td>
                            <td>
                                <a href="#">
                                    <i class="fas fa-edit" style="color: #007bff"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    <i class="fas fa-trash-alt" style="color: #dc3545"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </admin-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AdminLayout from "../../../Layouts/AdminLayout";

    export default defineComponent({
        components: {
            AdminLayout
        },
        props: ['roles'],
        methods: {

        }
    })

</script>

<style scoped>
#container {
    max-width: 100% !important;
}
</style>
