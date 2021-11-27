<template>
    <Head :title="title" ></Head>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" :src="'/storage/images/AdminLTELogo.png'" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <Navbar></Navbar>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <Sidebar :title="title"></Sidebar>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains Header and Main page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
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
    import { Head } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },
        components: {
            Head,
            Navbar,
            Footer,
            Sidebar,
        },
        mounted() {
            this.init()
        },
        methods: {
            init() {
                const SELECTOR_PRELOADER = ".preloader"
                let $loader = $ (SELECTOR_PRELOADER)

                if( sessionStorage.getItem('doNotShowPreloader') == null) {
                    setTimeout(() => {
                        if($loader) {
                            $loader.css('height',0)
                            setTimeout(() => {
                                $loader.children().hide()
                                sessionStorage.setItem('doNotShowPreloader', 'true')
                            }, 200)
                        }
                    }, 1500)
                } else {
                    $loader.hide()
                }
            },
        }
    })
</script>
