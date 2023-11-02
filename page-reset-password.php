<?php
/**
 * Template name: Password Reset
 */

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey" id="reset-password-sec">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                <?php if(!isset($_GET['key']) && !isset($_GET['login'])): ?>
                    <div class="col-12">
                        <div class="long-content D-radius">
                            <h3>Password Reset</h3>
                        </div>
                        <form action="<?php echo wp_lostpassword_url(); ?>" class="form-dashboard" id="g2hr-user-psw-reset-form">

                                <div class="form-group">
                                    <label for="user_email" class="control-label"><?php _e( 'Enter your e-mail address', 'go2hr' ); ?></label>
                                    <input type="text" name="user_email" class="form-control" required aria-required="true" >
                                </div>

                                <div class="alert alert-danger g2hr-error-message-box"></div>
                                <a href="#" id="g2hr-password-reset-start" class="btn green-btn mt-5" style="padding: 0px 20px;" data-loading-text="<?php _e( 'Please Wait', 'go2hr' ); ?>"><?php _e( 'Request new password', 'go2hr' ); ?></a>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="col-12">
                        <div class="long-content D-radius">
                            <h3>Password Reset</h3>
                        </div>
                        <form method="post" action="<?php echo wp_lostpassword_url(); ?>" class="form-dashboard" role="form"  id="g2hr-user-psw-change-form">
                            <div class="">
                                <div class="form-group">
                                    <label for="pass1" class="control-label"><?php _e( 'Password', 'go2hr' ); ?></label>
                                    <input type="password" name="pass1" id="pass1" required aria-required="true" class="form-control">
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <label for="pass2" class="control-label"><?php _e( 'Password (again)', 'go2hr' ); ?></label>
                                    <input type="password" name="pass2" id="pass2" required aria-required="true" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <span class="hint-password"><?php echo wp_get_password_hint(); ?></span>
                            </div>

                            <div class="col-xs-12">
                                <div class="alert alert-danger g2hr-error-message-box"></div>
                            </div>
                            <div class="col-xs-12">
                            <a href="#" id="g2hr-password-reset-end" class="btn green-btn mt-5" style="padding: 0px 20px;"><?php _e( 'Reset Password', 'go2hr' ); ?></a>
                            <input type="hidden" name="user_email" value="<?php echo $_REQUEST['login']; ?>">
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<?php  get_footer(); ?>
