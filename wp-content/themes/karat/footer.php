<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
</div>
<footer class="footer">
    <div class="container">
        <div class="social-links">
            <a href="https://www.facebook.com/TheKaratShop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/fb.jpg" alt=""></a>
            <a href=""><img src="<?php echo get_template_directory_uri();?>/images/icon/twit.jpg" alt=""></a>
            <a href="https://www.instagram.com/thekaratshop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/inst.jpg" alt=""></a>
        </div>
        <p>Karatshop.com</p>
        <p class="copy-right">© 2018 by Karat Shop. Proudly created with Monomer, LLC</p>
    </div>
</footer>

<div class="mfp-hide">
    <div id="login-popup" class="login-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12">
                    <p class="login-popup__title">Log in</p>
                    <div class="row">
                        <div class="col-sm-5 hidden-xs">
                            <form id="yo-login-803" action="/wp-admin/admin-ajax.php" class="yo-form login-popup__form" method="post">
                                <input name="action" value="yo_pl" type="hidden">
                                <input name="yo-pl" value="login" type="hidden">
                                <input name="yo-form-id" value="803" type="hidden">
                                <input type="text" id="yo-email" name="email" class="login-popup__form-input" placeholder="Email">
                                <input type="password" id="yo-password" name="password" class="login-popup__form-input" placeholder="Password">
                                <div class="login-popup__form-container">
                                    <input type="checkbox" class="custom-checkbox" name="remember" id="yo-remember">
                                    <label for="yo-remember" class="custom-label">Remember Me</label>
                                    <a href="" class="popup-btn forget-password-link" data-mfp-src="#forgot-password-popup">Forgot password?</a>
                                </div>
                                <button type="submit" class="login-popup__form-btn">Log In</button>
                                <p class="login-popup__form-notice">Don't have an account? <a href="" class="popup-btn forget-password-link" data-mfp-src="#sign-up-popup">Sign Up</a></p>
                            </form>
                        </div>
                        <div class="col-sm-2 hidden-xs vertical-line"></div>
                        <div class="col-sm-5 col-xs-12">
                            <div id="uLogin" data-ulogin="display=buttons;callback=myfunc">
                                <a href="#" data-uloginbutton="google" class="login-with facebook">Log in with Facebook</a>
                                <a href="#" data-uloginbutton="facebook" class="login-with google">Log in with Google+</a>
                            </div>
                        </div>
                        <div class="visible-xs-block col-xs-12">
                            <a href="" class="popup-btn login-popup__form-notice email" data-mfp-src="#login-with-email">Log in with Email</a></p>
                        </div>
                        <div class="visible-xs-block col-xs-12">
                            <p class="login-popup__form-notice">Don't have an account? <a href="" class="popup-btn forget-password-link" data-mfp-src="#sign-up-popup">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="forgot-password-popup" class="login-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <p class="login-popup__title">Reset Password</p>
                    <p class="login-popup__subtitle">Please enter your email address</p>
                    <form action="http://karat.lh/wp-login.php?action=lostpassword" method="post" class="lostpassword_form login-popup__form">
                        <input type="text" class="login-popup__form-input" name="user_login" placeholder="Email">
                        <input type="hidden" name="redirect_to" value="">
                        <button type="submit" class="login-popup__form-btn">Go</button>
                    </form>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="sign-up-popup" class="login-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12">
                    <p class="login-popup__title">Sign Up</p>
                    <div class="row">
                        <div class="col-sm-5 hidden-xs">
                            <form action="/wp-admin/admin-ajax.php" id="yo-register-834" class="login-popup__form yo-form" method="post">
                                <input name="action" value="yo_pl" type="hidden">
                                <input name="yo-pl" value="register" type="hidden">
                                <input name="yo-form-id" value="834" type="hidden">
                                <input id="yo-email" name="email" type="text" class="login-popup__form-input" placeholder="Email">
                                <input id="yo-password" name="password" type="password" class="login-popup__form-input" placeholder="Password">
                                <input id="yo-repeat-password" name="repeat-password" type="password" class="login-popup__form-input" placeholder="Retype password">
                                <button type="submit" class="login-popup__form-btn">Go</button>
                                <p class="login-popup__form-notice">Already a member? <a href="#" class="popup-btn forget-password-link" data-mfp-src="#login-popup">Log in</a></p>
                            </form>
                        </div>
                        <div class="col-sm-2 hidden-xs vertical-line"></div>
                        <div class="col-sm-5 col-xs-12">
                            <div id="uLogin" data-ulogin="display=buttons;callback=myfunc">
                                <a href="#" data-uloginbutton="facebook" class="login-with facebook">Log in with Facebook</a>
                                <a href="#" data-uloginbutton="google" class="login-with google">Log in with Google+</a>
                            </div>
                        </div>
                        <div class="visible-xs-block col-xs-12">
                            <a href="" class="popup-btn login-popup__form-notice email" data-mfp-src="#signup-with-email">Sign up with Email</a>
                        </div>
                        <div class="visible-xs-block col-xs-12">
                            <p class="login-popup__form-notice">Already a member? <a href="" class="popup-btn forget-password-link" data-mfp-src="#login-popup">Log in</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="login-with-email" class="login-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <p class="login-popup__title">Log in</p>
                    <form action="" class="login-popup__form">
                        <input type="text" class="login-popup__form-input" placeholder="Email">
                        <input type="password" class="login-popup__form-input" name=""   placeholder="Password">
                        <div class="login-popup__form-container">
                            <input type="checkbox" class="custom-checkbox" name="" id="remember-me">
                            <label for="remember-me" class="custom-label">Remember Me</label>
                        </div>
                        <button type="submit" class="login-popup__form-btn">Log in</button>
                    </form>
                    <a href="" class="popup-btn forget-password-link" data-mfp-src="#forgot-password-popup">Forgot password?</a>
                    <p class="login-popup__form-notice">Don't have an account? <a href="" class="popup-btn forget-password-link" data-mfp-src="#sign-up-popup">Sign Up</a></p>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="signup-with-email" class="login-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                    <p class="login-popup__title">Sign Up</p>
                    <form action="" class="login-popup__form">
                        <input type="text" class="login-popup__form-input" placeholder="Email">
                        <input type="password" class="login-popup__form-input" name=""   placeholder="Password">
                        <input type="password" class="login-popup__form-input" name=""   placeholder="Retype password">
                        <button type="submit" class="login-popup__form-btn">Go</button>
                    </form>
                    <p class="login-popup__form-notice">Already a member? <a href="" class="popup-btn forget-password-link" data-mfp-src="#login-popup">Log in</a></p>
                </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close"></button>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="share-popup" class="share-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 share-popup-container">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/share.png" alt="">
                    <span>Share Post</span>
                    <div class="share-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
                            <div class="social facebook">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>&via=TWITTER-HANDLE">
                            <div class="social twitter">
                                <i class="fab fa-twitter"></i>
                            </div>
                        </a>
                        <a href="https://plus.google.com/share?url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
                            <div class="social google">
                                <i class="fab fa-google-plus-g"></i>
                            </div>
                        </a>
                        <div class="social link popup-btn" data-mfp-src="#share-link-popup">
                            <i class="fas fa-link"></i>
                        </div>
                    </div>
                    <button title="Close (Esc)" type="button" class="mfp-close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="share-link-popup" class="share-link-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 share-popup-container">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/share.png" alt="">
                    <span>Share Post</span>
                    <input type="text" id='input' class="share-link-input" value="<?php global $wp; echo home_url( $wp->request ); ?>">
                    <div class="share-link-popup-btns">
                        <a href="" class="cancel popup-btn"  data-mfp-src="#share-popup">Cancel</a>
                        <a href="#" id='bCopy' class="copy">Copy Link</a>
                    </div>
                    <button title="Close (Esc)" type="button" class="mfp-close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mfp-hide">
    <div id="callback-popup" class="share-link-popup">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 share-popup-container">
                    <form class="contant-form popup-form pbz_form clear-styles" action="" data-error-title="Ошибка отправки!" data-error-message="Please add a valid email." data-success-title="Thanks! Message sent." data-success-message="Thanks! Message sent."><input class="first" name="name" type="text" placeholder="Full Name*" data-title="full name" />
                        <input class="second" name="email" type="email" placeholder="Email Address*" data-title="Email" data-validate-required="Обязательное поле" data-validate-email="Неправильный email" />
                        <input name="phone" type="tel" placeholder="Phone Number" data-title="Phone" data-validate-phone="Неправильный номер" />
                        <textarea name="request" rows="5" placeholder="Write Your Request" data-title="Request"></textarea>
                        <button class="w100 amt15 amb15" type="submit">Submit Now</button></form>
                    <button title="Close (Esc)" type="button" class="mfp-close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function(u,l,o,g,i,n){
        if(typeof l[g] === 'undefined') l[g] = [];
        l[i] = function() {
            if(l[g].length){
                for (var i = 0; i < l[g].length; i++) {
                    var f = l[g][i];
                    if(typeof f === 'function'){
                        f.call(l);
                    }
                    l[g].splice(i--,1)
                }
            }
        };
        if(typeof l[o] === 'undefined'){
            l[o] = {};
            l[o][n] = function(){
                var args = arguments;
                l[g].push(function () {
                    l[o].customInit.apply(l[o], args);
                });
            };
        }
        var s = u.createElement('script');
        s.src = '//ulogin.ru/js/ulogin.js?version=1';
        s.async = true;
        s.onload = l[i];
        u.getElementsByTagName('head')[0].appendChild(s);
    })(document,window,'uLogin','uLoginCallbacks','uLoginOnload','customInit');
</script>

<?php wp_footer(); ?>

</body>
</html>
