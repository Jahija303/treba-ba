<template>
    <footer id="footer">

        <div class="footer-top">

            <div class="container">

                <div class="row  justify-content-center">
                    <div class="col-lg-6">
                        <h3>treba.ba</h3>
                        <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
                    </div>
                </div>

                <div class="row footer-newsletter justify-content-center">
                    <div class="col-lg-6">
                        <form action="" method="post">
                            <input type="email" name="email" placeholder="Unesite vaš Email"><input type="submit" value="Pretplati se">
                        </form>
                    </div>
                </div>

                <div class="social-links">
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="fab fa-skype"></i></a>
                    <a href="#" class="linkedin"><i class="fab fa-linkedin"></i></a>
                </div>

            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright <strong><span>treba.ba</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
</template>

<style>
/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
#footer {
    background-color: #f3f4f6;
    color: #5f687b;
    font-size: 14px;
    position: relative;
}
#footer .footer-top {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 80px 0;
}
#footer .footer-top h3 {
    font-size: 36px;
    font-weight: 700;
    color: #5f687b;
    position: relative;
    font-family: "Poppins", sans-serif;
    padding-bottom: 0;
    margin-bottom: 0;
}
#footer .footer-top p {
    font-size: 15px;
    font-style: italic;
    margin: 30px 0 0 0;
    padding: 0;
}
#footer .footer-top .footer-newsletter {
    text-align: center;
    font-size: 15px;
    margin-top: 30px;
}
#footer .footer-top .footer-newsletter form {
    background: #fff;
    padding: 6px 10px;
    position: relative;
    border-radius: 4px;
    text-align: left;
    border: 1px solid #e4e6ea;
}
#footer .footer-top .footer-newsletter form input[type=email] {
    border: 0;
    padding: 4px 8px;
    width: calc(100% - 100px);
}
#footer .footer-top .footer-newsletter form input[type=submit] {
    position: absolute;
    top: -1px;
    right: -1px;
    bottom: -1px;
    border: 0;
    background: none;
    font-size: 16px;
    padding: 0 20px;
    background: #16df7e;
    color: #fff;
    transition: 0.3s;
    border-radius: 0 4px 4px 0;
    box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
}
#footer .footer-top .footer-newsletter form input[type=submit]:hover {
    background: #206bfb;
}
#footer .footer-top .social-links {
    margin-top: 30px;
}
#footer .footer-top .social-links a {
    font-size: 18px;
    display: inline-block;
    background: #eaecef;
    color: #5f687b;
    line-height: 1;
    padding: 8px 0;
    margin-right: 4px;
    border-radius: 4px;
    text-align: center;
    width: 36px;
    height: 36px;
    transition: 0.3s;
}
#footer .footer-top .social-links a:hover {
    background: #16df7e;
    color: #fff;
    text-decoration: none;
}
#footer .footer-bottom {
    border-top: 1px solid #d9dce2;
    z-index: 2;
    position: relative;
    padding-top: 40px;
    padding-bottom: 40px;
}
#footer .copyright {
    float: left;
}
#footer .credits {
    float: right;
    font-size: 13px;
}
@media (max-width: 992px) {
    #footer .copyright, #footer .credits {
        float: none;
        -moz-text-align-last: center;
        text-align-last: center;
    }
}
</style>
