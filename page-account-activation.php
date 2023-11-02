<?php
/**
 * Template name: User Registration Activation
 */

use Go2HR\Helpers\UserRegistration;

get_header();
?>

<main class="inr-page Training-page bg-grey" id="ContactUs">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                <?php if(isset($_REQUEST['key']) && UserRegistration\check_registration_activation_tokens($_REQUEST['key'])): ?>

                    <h2>...AND WE’RE DONE!</h2>

                    <p>
                        Your account has been activated, so you’re all set to go. Click the link below to sign in to your account and start exploring go2HR!
                        <a href="<?php echo home_url('login');?>" class="btn btn-process-go" style="color: #014f9a;"><?php _e( 'Sign In', 'go2hr' ); ?></a>
                    </p>

                <?php else: ?>

                    <h2>Sorry! Your activation key is invalid!</h2>

                    <p>
                        It looks like you're using the wrong activation link. Please try again or contact our support.
                    </p>
                <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php  get_footer(); ?>
