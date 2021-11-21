<template>
    <admin-layout title="Edit Role">
        <template #header>
            <h1 class="ml-2">Edit Role</h1>
        </template>
        <template #mainContent>
            <div class="content-wrapper ml-4 mr-3 mt-0 w-75">
                <!-- card start -->
                <div class="card card-primary">
                    <!-- header start -->
                    <div class="card-header">
                        <h3 class="card-title">Edit Role Permissions & Name</h3>
                    </div>
                    <!-- /.header-end -->

                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <jet-label for="roleName" value="Role Name" />
                            <jet-input id="roleName" type="text"
                                       class="mt-1 block w-full"
                                       ref="roleName"
                                       v-model="form.name"/>
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>
                        <jet-label value="Permissions" />
                        <jet-input-error :message="form.errors.permissions" class="mt-2" />
                        <div class="container">
                            <div v-for="permissions in groupedPermissions" class="row">
                                <div v-for="permission in permissions" class="col-md-3">
                                    <div>
                                        <jet-checkbox   @update:unchecked="removePermission(permission)"
                                                        @update:checked="addPermission(permission)"
                                                        class="form-check-input"
                                                        :value="this.rolePermissions.includes(permission)"
                                                        :checked="this.rolePermissions.includes(permission)"/>
                                        <label class="form-check-label">{{ permission }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.form-end -->

                    <!-- footer start -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" @click="updateRole">Submit</button>
                    </div>
                    <!-- /.footer-end -->
                </div>
                <!-- /.card-end -->
            </div>
        </template>
    </admin-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AdminLayout from "../../../Layouts/AdminLayout";
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import _ from "lodash";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        AdminLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetCheckbox,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.role.name,
                permissions: this.rolePermissions,
            })
        }
    },
    props: ['role', 'permissions', 'rolePermissions'],
    methods: {
        addPermission(permission) {
            this.form.permissions.push(permission)
        },
        removePermission(permission) {
            this.form.permissions.splice(this.form.permissions.indexOf(permission), 1)
        },
        updateRole() {
            this.form.put(this.route('admin.roles.update', this.role.id, this.form), {
                onSuccess: ()=> {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'Role updated.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onError: () => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'error',
                        title: 'Error updating role',
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            })
        },
    },
    computed:{
        groupedPermissions() {
            return _.chunk(this.permissions, 4)
        },
    }
})

</script>

<style scoped>
label {
    font-weight: bold;
}


</style>
