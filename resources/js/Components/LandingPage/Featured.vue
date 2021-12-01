<template>

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-laptop"></i></div>
                        <h4 class="title"><a href="#">Šta nudimo ?</a></h4>
                        <p class="description">Nudimo funkcionalnu platformu koja vam omogućava brzu i efikasnu prijavu bilo kakvog, primjećenog, problema u vašoj zajednici, koji se proslijeđuje zaduženim ovlastima.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-card-checklist"></i></div>
                        <h4 class="title"><a href="#">Vaša uloga</a></h4>
                        <p class="description">Vaša uloga je da, jednostavno, koristite platformu i uključite što više prijatelja i poznanika na naš sistem, kako bi osigurali konstanto rastuću zajednicu.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"><i class="bi bi-clipboard-data"></i></div>
                        <h4 class="title"><a href="#">Naš cilj</a></h4>
                        <p class="description">Naš cilj je da omogućimo brzu i efikasnu prijavu i rješavanje problema naših gradova, bilo kojeg tipa, kako bi stvorili bolje sutra.   </p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Featured Services Section -->

</template>

<style>
/*--------------------------------------------------------------
# Featured Services
--------------------------------------------------------------*/
.featured-services {
    padding: 0;
}
.featured-services .icon-box {
    padding: 20px;
    color: #5f687b;
    background: #f9f9fa;
    border-radius: 4px;
    border: 1px solid #f9f9fa;
    transition: 0.3s;
    height: 100%;
}
.featured-services .icon {
    margin: 0 0 15px 0;
}
.featured-services .icon i {
    color: #16df7e;
    font-size: 36px;
}
.featured-services .title {
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 18px;
}
.featured-services .title a {
    color: #5f687b;
    transition: 0.3s;
}
.featured-services .icon-box:hover {
    border-color: #eaecef;
}
.featured-services .icon-box:hover .title a {
    color: #16df7e;
}
.featured-services .description {
    line-height: 24px;
    font-size: 14px;
}
</style>
