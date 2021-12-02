<template>

    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <img :src="'/storage/images/about.png'" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <h3>Upoznajte naš tim mladih, motivisanih i neumorljivih studenata</h3>
                    <p class="fst-italic">
                        Mi smo mladi tim studenata čija je kolektivna želja da napravimo bolju državu za sve nas
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Pružamo vam kompletiranu platformu za prijavljivanje lokalnih problema</li>
                        <li><i class="bi bi-check-circle"></i> Odobravanje svih prijava i filtriranje neprimjerenih sadržaja, ili govora mržnje</li>
                        <li><i class="bi bi-check-circle"></i> 24/7 Podrška naših administratora</li>
                    </ul>
                    <p>
                        Ukoliko smatrate da ovo sve nije dovoljno, ili ako imate nekih sugestija za poboljšavanje naše platforme, slobodno nas kontaktirajte!
                    </p>
                </div>
            </div>

        </div>
    </section>

</template>

<style>
/*--------------------------------------------------------------
# About
--------------------------------------------------------------*/
.about .content h3 {
    font-weight: 700;
    font-size: 32px;
    color: #5f687b;
}
.about .content ul {
    list-style: none;
    padding: 0;
}
.about .content ul li {
    padding-bottom: 10px;
}
.about .content ul i {
    font-size: 20px;
    padding-right: 4px;
    color: #16df7e;
}
.about .content p:last-child {
    margin-bottom: 0;
}
</style>
