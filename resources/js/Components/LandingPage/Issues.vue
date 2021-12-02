<template>
    <section id="issues" class="portfolio">
        <div class="container">

            <div class="section-title">
                <span>Aktuelni Problemi</span>
                <h2>Aktuelni Problemi</h2>
                <p>Pregled problema sa najvećom podrškom korisnika kroz zadnjih 30 dana</p>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div v-for="issue in orderedIssues">
                        <div class="card">
                            <div class="card-image">
                                <img :src="'/storage/images/error.jpg'" :alt="'/storage/images/error.jpg'">
                            </div>
                            <div class="card-text">
                                <span class="date"><b>{{ this.formatDate(issue.created_at) }}</b></span>
                                <h2>{{ issue.title }}</h2>
                                <p>{{ issue.description }}</p>
                            </div>
                            <div class="card-stats">
                                <div class="stat">
                                    <div class="value">{{ issue.numLikes }}</div>
                                    <div class="type">Likes</div>
                                </div>
                                <div class="stat custom-border">
                                    <div class="value">5123</div>
                                    <div class="type">views</div>
                                </div>
                                <div class="stat">
                                    <div class="value">{{ issue.numComments }}</div>
                                    <div class="type">comments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
import { defineComponent } from 'vue'
import moment from "moment"
import VanillaTilt from 'vanilla-tilt'

export default defineComponent({
    props: ['issues'],
    methods: {
        formatDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD-MM-YYYY');
        },
    },
    mounted() {
        const element = document.querySelectorAll(".card");
        VanillaTilt.init(element, {
            max: 15,
            speed: 3000,
        });
    },
    computed: {
        orderedIssues: function () {
            return _.orderBy(this.issues, 'numLikes', 'desc')
        }
    },
})
</script>

<style scoped>
.container {
    max-width: 1500px !important;
}
.card {
    display: grid;
    grid-template-columns: 300px;
    grid-template-rows: 210px 220px 80px;
    grid-template-areas: "image" "text" "stats";

    border-radius: 18px;
    background: white;
    box-shadow: 2px 2px 17px rgba(0,0,0,0.3);
    font-family: "Open Sans", sans-serif !important;
    text-align: center;

    transition: 0.5s ease;
    cursor: pointer;
    margin:30px;

    transform-style: preserve-3d;
    transform: translateZ(20px);
}
.card-image {
    grid-area: image;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.card-image img {
    position: relative;
    object-fit:fill;
    width: 300px;
    height: 210px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.card-text {
    grid-area: text;
    margin: 25px;
}
.card-text .date {
    color: #16df7e;
    font-size: 14px;
}
.card-text p {
    color: grey;
    font-size:15px;
    font-weight: 400;
}
.card-text h2 {
    margin-top: 0px;
    font-size: 26px;
}
.card-stats {
    grid-area: stats;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 1fr;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    background: #16df7e;
}
.card-stats .stat {
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    color: white;
}
.card-stats .custom-border {
    border-left: 1px solid #11c472;
    border-right: 1px solid #11c472;
}
.card-stats .value{
    font-size: 22px;
    font-weight: 600;
}

.card-stats .type{
    font-size: 14px;
    font-weight: 400;
    text-transform: uppercase;
}

</style>
