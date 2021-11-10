<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <Link :href="route('admin.dashboard.index')" class="brand-link">
            <img :src="'/storage/images/AdminLTELogo.png'" :alt="$page.props.user.firstname"
            class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-bold">Admin - Treba.ba</span>
        </Link>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <Link :href="route('admin.dashboard.index')" class="nav-link">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>
                                Dashboard
                            </p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Tables
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Issues</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cities</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Districts</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">MISCELLANEUS</li>
                    <li class="nav-item">
                        <Link :href="route('home')" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Site
                            </p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('profile.show')" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link id="customButton" :href="route('logout')" class="nav-link" as="button" method="post">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Log Out
                            </p>
                        </Link>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        Link,
    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
})
</script>

<style scoped>
    #customButton {
        background-color: transparent;
        color: #c2c7d0;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    #customButton:hover {
        background-color: rgba(255,255,255,.1);
        color: whitesmoke;
    }

    #customButton p {
        padding-left: 4px;
    }
</style>
