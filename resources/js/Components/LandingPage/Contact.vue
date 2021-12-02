<template>
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <span>Kontakt</span>
                <h2>Kontakt</h2>
                <p>Kontaktirajte nas ukoliko imate pitanja</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Lokacija:</h4>
                            <p>Školska 10, Zenica 72000</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@treba.ba</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Tel:</h4>
                            <p>+307 60 767 676</p>
                        </div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2860.1915276046425!2d17.90498291592793!3d44.20312157910626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475ee24420792afd%3A0x50e1bd38d075a9a0!2sHotel%20Dubrovnik!5e0!3m2!1sen!2sbg!4v1638403794879!5m2!1sen!2sbg" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Ime</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Predmet</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Poruka</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Pošalji</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>
</template>

<style>
/*--------------------------------------------------------------
# Contact
--------------------------------------------------------------*/
.contact .info {
    border-top: 3px solid #16df7e;
    border-bottom: 3px solid #16df7e;
    padding: 30px;
    width: 100%;
    background-color: #f9f9fa;
}
.contact .info i {
    font-size: 20px;
    color: #16df7e;
    float: left;
    width: 44px;
    height: 44px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
}
.contact .info h4 {
    padding: 0 0 0 60px;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #5f687b;
}
.contact .info p {
    padding: 0 0 10px 60px;
    margin-bottom: 20px;
    font-size: 14px;
    color: #949cac;
}
.contact .info .social-links {
    padding-left: 60px;
}
.contact .info .social-links a {
    font-size: 18px;
    display: inline-block;
    background: #333;
    color: #fff;
    line-height: 1;
    padding: 8px 0;
    border-radius: 50%;
    text-align: center;
    width: 36px;
    height: 36px;
    transition: 0.3s;
    margin-right: 10px;
}
.contact .info .social-links a:hover {
    background: #16df7e;
    color: #fff;
}
.contact .info .email:hover i, .contact .info .address:hover i, .contact .info .phone:hover i {
    background: #16df7e;
    color: #fff;
}
.contact .php-email-form {
    width: 100%;
    border-top: 3px solid #16df7e;
    border-bottom: 3px solid #16df7e;
    padding: 30px;
    background-color: #f9f9fa;
}
.contact .php-email-form .form-group {
    padding-bottom: 8px;
}
.contact .php-email-form .error-message {
    display: none;
    color: #fff;
    background: #ed3c0d;
    text-align: left;
    padding: 15px;
    font-weight: 600;
}
.contact .php-email-form .error-message br + br {
    margin-top: 25px;
}
.contact .php-email-form .sent-message {
    display: none;
    color: #fff;
    background: #18d26e;
    text-align: center;
    padding: 15px;
    font-weight: 600;
}
.contact .php-email-form .loading {
    display: none;
    background: #fff;
    text-align: center;
    padding: 15px;
}
.contact .php-email-form .loading:before {
    content: "";
    display: inline-block;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    margin: 0 10px -6px 0;
    border: 3px solid #18d26e;
    border-top-color: #eee;
    -webkit-animation: animate-loading 1s linear infinite;
    animation: animate-loading 1s linear infinite;
}
.contact .php-email-form input, .contact .php-email-form textarea {
    border-radius: 0;
    box-shadow: none;
    font-size: 14px;
    border-radius: 4px;
}
.contact .php-email-form input:focus, .contact .php-email-form textarea:focus {
    border-color: #16df7e;
}
.contact .php-email-form input {
    height: 44px;
}
.contact .php-email-form textarea {
    padding: 10px 12px;
}
.contact .php-email-form button[type=submit] {
    background: #16df7e;
    border: 0;
    padding: 10px 24px;
    color: #fff;
    transition: 0.4s;
    border-radius: 4px;
}
.contact .php-email-form button[type=submit]:hover {
    background: #206bfb;
}
@-webkit-keyframes animate-loading {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
@keyframes animate-loading {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
