<main class="inr-page Training-page bg-grey" id="user-registration-form-step1">
    <div class="my-account-pages bg-grey">
        <section class="contactUs-sec space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="step-box">
                                    <div class="long-content D-radius pb-0">
                                        <h3>Welcome to Your New Account</h3>
                                        <p>To post a job, finish setting up your profile and <br> company information.</p>
                                    </div>
                                    <ol class="steps">
                                        <li class="step is-active" data-step="1">
                                            Step
                                        </li>
                                        <li class="step" data-step="2">
                                            Step
                                        </li>
                                    </ol>
                                    <div class="newsletter-box">
                                        <div class="heading-pnel">
                                            <h4>Step 1: Your Profile</h4>
                                        </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>First Name <span>*</span></label>
                                                        <input class="form-control ignore" id="first_name" placeholder="" name="first_name" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Last Name <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" id="last_name" name="last_name" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $occupations = \Go2HR\Helpers\UserRegistration\get_user_occupations(); ?>
                                                        <label>Job Title <span>*</span></label>
                                                        <select class="form-control ignore" placeholder="" id="occupation" name="occupation" />
                                                            <option value="-1">-----</option>
                                                            <?php foreach($occupations as $occupation) : ?>
                                                                <option value="<?php echo $occupation->term_id; ?>"><?php echo $occupation->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Telephone <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" id="user_phone" name="user_phone" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>City <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" id="city" name="city" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Postal Code <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" id="postal_code" name="postal_code" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 mb-5 text-right">
                                                <a href="#" id="g2hr-step1-btn" class="green-btn">Next <i class="fa fa-angle-right" style=" float: none; width: unset;   border: none; margin-left: 10px;" aria-hidden="true"></i></i></a>

                                            </div>
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


