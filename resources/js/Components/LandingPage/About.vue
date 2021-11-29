<template>

    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <img :src="'/storage/images/about.png'" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                        <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                        <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda</li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur.
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
