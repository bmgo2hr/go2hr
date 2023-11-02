<?php
/**
 * Template name: Login Page
 */

if (get_current_user_id() > 0) { wp_redirect(home_url('dashboard')); }

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey" id="ContactUs">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 col-12 mx-auto">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="long-content D-radius">
                                    <h3>Post Jobs</h3>
                                    <p>Access the leading free job board for Tourism & Hospitality industry jobs in British Columbia and the Yukon.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="newsletter-box">
                                    <div class="heading-pnel">
                                        <h4>Sign In to Post Jobs</h4>
                                    </div>
                                    <form action="POST" id="g2hr-user-login-form">
                                        <div class="form-group">
                                            <label>Email <span>*</span></label>
                                            <input class="form-control" placeholder="" name="user_email" id="user_email" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span>*</span></label>
                                            <input class="form-control" placeholder="" name="user_password" id="user_password" type="Password" />
                                        </div>
                                        <div class="form-group forgot-password">
                                            <a href="/password-reset">Forgot your password?</a>
                                        </div>

                                        <div class="form-group mt-4 mb-5">
                                            <a href="#" class="green-btn" id="btn-g2hr-user-login">Access Job Board <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>

                                        <div class="alert alert-danger g2hr-error-message-box"></div>

                                        <div class="form-group create-account-link">
                                            <a href="/register">New Here? Create An Account</a>
                                        </div>

                                        <?php
                                            if(isset($_REQUEST['redirect_to'])) {
                                                $redirect = strip_tags($_REQUEST['redirect_to']);
                                            }
                                            else {
                                                $redirect = '/';
                                            }
                                        ?>
                                        <input type="hidden" name="redirected_to" value="<?php echo $redirect; ?>">
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="contact-detail">
                                    <div class="heading-pnel ">
                                        <h4>Why post on the go2HR job board?</h4>
                                    </div>
                                    <ul>
                                       <li>It’s free and only for tourism and hospitality jobs in BC and the Yukon </li>
                                       <li>It receives close to <span class="theme-color">4K</span> monthly visits from qualified candidates looking for frontline, supervisory, management and executive positions </li>
                                       <li>It reaches close to <span class="theme-color">20K</span> job seekers through our monthly e-newsletter and social media</li>
                                        <li>
                                           Trusted by:<br>
                                           <span class="theme-color">17,000</span> Companies <span class="line-space">|</span> <span class="theme-color">500</span> Jobs <span class="line-space">|</span> <span class="theme-color">18,000</span> Job seekers
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php  get_footer(); ?>
