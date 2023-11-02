<?php
/**
 * Template name: Password Reset Success
 */

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey" id="ContactUs">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <section class="g2hr-password-reset-alert g2hr-password-reset-step-start">
                            <h2>Success! Your password has been reset!</h2>
                            <p>
                                Please click the button below to sign in to your account.
                            </p>

                            <a href="<?php echo home_url('login');?>" class="btn green-btn mt-5" style="padding: 0px 20px;"><?php _e( 'Sign In', 'go2hr' ); ?></a>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php  get_footer(); ?>
