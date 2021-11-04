<template>
    <div class="wrapper">

        <!-- Preloader -->
        <!--<div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>-->

        <!-- Navbar -->
        <Navbar></Navbar>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <Sidebar></Sidebar>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains Header and Main page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <slot name="header"></slot>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <slot name="mainContent"></slot>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <Footer />
        <!-- /.footer -->

    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import Footer from "../Components/Footer"
    import Navbar from "../Components/Navbar"
    import Sidebar from "../Components/Sidebar"

    export default defineComponent({
        components: {
            Navbar,
            Footer,
            Sidebar,
        },
    })
</script>
