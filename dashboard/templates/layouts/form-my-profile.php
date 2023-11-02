<?php

use Go2HR\Helpers\UserRegistration;

$user = $args['user']; ?>

<main class="inr-page Training-page <?php if (is_user_logged_in() && current_user_can('administrator')) echo "signed-in"; ?>" id="ContactUs">
    <div class="my-account-pages">
        <?php get_template_part('dashboard/templates/global/dashboard-topbar'); ?>
        <section class="My-job-dashboard">
            <div class="container">
                <div class="row">
                    <?php get_template_part('dashboard/templates/global/dashboard-sidebar'); ?>
                    <div class="col-lg-9 col-md-12">
                        <div class="space mx-450 Post-a-job">
                             <div class="row">
                                 <div class="col-lg-12 col-md-12">
                                     <div class="step-box">
                                        <div class="newsletter-box">
                                            <div class="heading-pnel">
                                                <h4>My Profile Information</h4>
                                            </div>
                                            <form action="" id="g2hr-user-profile-form">
                                                <div class="row no-gutters">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>First Name<span>*</span></label>
                                                            <input class="form-control" placeholder="" name="first_name" value="<?php echo $user->first_name[0]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Last Name<span>*</span></label>
                                                            <input class="form-control" placeholder="" name="last_name" value="<?php echo $user->last_name[0]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <?php $occupations = UserRegistration\get_user_occupations(); ?>
                                                        <div class="form-group">
                                                            <label>Job Title<span>*</span></label>
                                                            <select class="form-control" placeholder="" id="occupation" name="occupation" />
                                                            <option value="-1">-----</option>
                                                            <?php foreach ($occupations as $occupation): ?>
                                                                <?php $selected = ''; ?>
                                                                <?php if ($occupation->term_id == $user->user_occupation[0]) $selected = ' selected="selected"'; ?>
                                                                    <option value="<?php echo $occupation->term_id; ?>" <?php echo $selected; ?>><?php echo $occupation->name; ?></option>
                                                            <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Telephone<span>*</span></label>
                                                            <input class="form-control" placeholder="" name="user_phone" value="<?php echo $user->user_phone[0]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>City<span>*</span></label>
                                                            <input class="form-control" placeholder="" name="city" value="<?php echo $user->user_city[0]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Postal Code<span>*</span></label>
                                                            <input class="form-control" placeholder="" name="postal_code" value="<?php echo $user->postal_code[0]; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-4 mb-5 " >
                                                    <a href="#" id="g2hr-update-account" class="green-btn "  >Update Information  </a>
                                                </div>

                                                <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>
                                            </form>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
