<?php
    /**
     * Template name: Password Reset Error
     */
?>

<main class="inr-page Training-page bg-grey" id="ContactUs">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                <?php if(isset($_REQUEST['login'])): ?>
                    <?php if($_REQUEST['login'] == 'expiredkey'): ?>
                        <h2>Sorry! The link you clicked has expired!</h2>

                        <p>
                            Click the button below to start the process of resetting your password again.
                        </p>

                        <a href="<?php echo site_url('password-reset');?>" class="btn btn-process-go"><?php _e( 'Reset Password', 'go2hr' ); ?></a>

                    <?php else: ?>
                        <h2>Sorry! Your key is invalid!</h2>

                        <p>
                            Click the button below to start the process of resetting your password again.
                        </p>

                        <a href="<?php echo site_url('password-reset');?>" class="btn btn-process-go"><?php _e( 'Reset Password', 'go2hr' ); ?></a>
                    <?php endif;  ?>
                <?php endif;  ?>
                </div>
            </div>
        </section>
    </div>
</main>
