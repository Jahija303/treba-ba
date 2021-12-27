<template>
    <!-- Header Section -->
    <Header :isHomePage="false" :can-login="canLogin" :can-register="canRegister" :dashboardAccess="dashboardAccess"/>

    <div id="issue">
        <div class="container">
            <div class="row justify-content-center">
                <h5 style="color: #16df7e">{{issue.category.name}}</h5>
            </div>
            <div class="row justify-content-center">
                <h1>{{issue.title}}</h1>
            </div>
            <div class="row justify-content-md-center mt-2">
                <div class="col col-lg-2">
                    <span class="mr-2" style="color: #16df7e">
                        <i class="fas fa-user"></i>
                    </span>
                    <span>{{issue.user.username}}</span>
                </div>
                <div class="col col-md-auto">
                    <span class="mr-2" style="color: #16df7e">
                        <i class="fa fa-comments"></i>
                    </span>
                    <span>{{issue.num_comments}}</span>
                </div>
                <div class="col col-lg-2 text-right">
                    <span class="mr-2" style="color: #16df7e">
                        <i class="fas fa-clock"></i>
                    </span>
                    <span>{{formatDate(issue.created_at)}}</span>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="image">
                    <img class="img-fluid issue-img" :src="'/storage/images/'+issue.image" alt="">
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <span style="max-width: 900px !important;">{{issue.description}}</span>
                <!-- Google map location -->
            </div>
            <div class="row justify-content-center mt-5">
                <h5 v-if="issue.num_comments === 1">1 Komentar</h5>
                <h5 v-else>{{issue.num_comments}} Komentara</h5>
            </div>
            <div class="row justify-content-center">
                <div class="container" style="max-width: 700px !important;">
                    <div v-for="comment in issue.all_comments" class="row justify-content-center mt-5">
                        <div class="col">
                            <img class="rounded-full h-15 w-15 object-cover"
                                 :src="comment.user.profile_photo_url"
                                 alt="">
                        </div>
                        <div class="col-10 pl-0 pr-0">
                            <div class="comment-main pr-4">
                                <p class="mb-0"><b>{{comment.username}}</b></p>
                                <p>{{comment.comment}}</p>
                            </div>
                            <div class="row comment-footer">
                                <div class="col-1 text-right">
                                    <div class="comment-link">Like</div>
                                </div>
                                <div class="col-1 pl-0 ml-2">
                                    <div class="comment-link">Odgovori</div>
                                </div>
                                <div class="col text-left pl-0 ml-3" style="opacity: 0.8">
                                    <span>{{formatDate(comment.created_at)}}</span>
                                </div>
                                <div class="col-1 likes-column">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-thumbs-up" style="color: rgb(22, 223, 126)"></i><span>{{comment.likes}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="container mt-5" style="max-width: 700px !important;">
                    <div class="row justify-end">
                        <form style="width: 580px" @submit.prevent="submit">
                            <jet-label for="comment" value="Ostavi komentar.." />
                            <jet-input id="comment" type="text" class="mt-1 w-full" v-model="form.comment" required autofocus />

                            <jet-button class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Potvrdi
                            </jet-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <Footer class="mt-5" />
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Header from "../../Components/LandingPage/Header"
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetButton from '@/Jetstream/Button.vue'
import Footer from "../../Components/LandingPage/Footer";
import moment from "moment";
import Swal from "sweetalert2";

export default defineComponent({
    components: {
        Link,
        Header,
        JetLabel,
        JetInput,
        JetInputError,
        JetButton,
        Footer,
        Swal,
    },
    data() {
        return {
            form: this.$inertia.form({
                issue_id: this.issue.id,
                comment: '',
            })
        }
    },
    props: ['canLogin', 'canRegister', 'dashboardAccess', 'issue'],
    mounted() {
        this.init()
    },
    methods: {
        formatDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
        },
        submit() {
            this.form.post(this.route('issues.comment'), {
                preserveScroll: true,
                onSuccess:() => {
                    Swal.fire({
                        position: 'top-end',
                        toast: 'true',
                        icon: 'success',
                        title: 'Komentar uspješno objavljen!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                },
                onFinish: () => {
                    this.form.comment = ''
                },
            })
        },
        init() {
            /**
             * Easy selector helper function
             */
            const select = (el, all = false) => {
                el = el.trim()
                if (all) {
                    return [...document.querySelectorAll(el)]
                } else {
                    return document.querySelector(el)
                }
            }

            /**
             * Easy event listener function
             */
            const on = (type, el, listener, all = false) => {
                let selectEl = select(el, all)
                if (selectEl) {
                    if (all) {
                        selectEl.forEach(e => e.addEventListener(type, listener))
                    } else {
                        selectEl.addEventListener(type, listener)
                    }
                }
            }

            /**
             * Easy on scroll event listener
             */
            const onscroll = (el, listener) => {
                el.addEventListener('scroll', listener)
            }

            /**
             * Toggle .header-scrolled class to #header when page is scrolled
             */
            let selectHeader = select('#header')
            if (selectHeader) {
                const headerScrolled = () => {
                    if (window.scrollY > 100) {
                        selectHeader.classList.add('header-scrolled')
                    } else {
                        selectHeader.classList.remove('header-scrolled')
                    }
                }
                window.addEventListener('load', headerScrolled)
                onscroll(document, headerScrolled)
            }

            /**
             * Mobile nav toggle
             */
            on('click', '.mobile-nav-toggle', function(e) {
                select('#navbar').classList.toggle('navbar-mobile')
                this.classList.toggle('bi-list')
                this.classList.toggle('bi-x')
            })

            /**
             * Mobile nav dropdowns activate
             */
            on('click', '.navbar .dropdown > a', function(e) {
                if (select('#navbar').classList.contains('navbar-mobile')) {
                    e.preventDefault()
                    this.nextElementSibling.classList.toggle('dropdown-active')
                }
            }, true)
        },
    },
})
</script>

<style scoped>
#issue {
    width: 100%;
    background: #fff;
    margin-top: 100px !important;
}
#issue h1 {
    margin: 0;
    font-size: 48px;
    font-weight: 700;
    line-height: 56px;
    color: #3e4450;
}
#issue h2 {
    color: #858ea1;
    margin: 10px 0 30px 0;
    font-size: 24px;
}
@media (max-width: 768px) {
    #issue h1 {
        font-size: 28px;
        line-height: 36px;
    }
    #issue h2 {
        font-size: 18px;
        line-height: 24px;
    }
}

.img-fluid {
    max-width: 100%;
    border-radius: 6px;
}

.issue-img {
    float: left;
    max-width:  900px;
    max-height: 600px;
    object-fit: cover;
}

.comment-footer {
    font-size: 0.9rem;
}

.comment-main {
    background-color: whitesmoke;
    border-radius: 20px;
}

.comment-main p {
    padding-left: 20px;
}

.comment-main p:first-child {
    padding-top: 10px;
}

.comment-main p:last-child {
    padding-bottom: 10px;
}

.comment-footer {
    font-size: 0.9rem;
}

.comment-link {
    color: rgb(22, 223, 126);
    user-select: none;
}

.comment-link:hover {
    color: rgb(23, 154, 91);
}

.user-img {
    max-width: 55px;
    max-height: 55px;
}
</style>
