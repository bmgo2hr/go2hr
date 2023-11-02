<main class="inr-page Training-page bg-grey" id="user-registration-form-step2">
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
                                        <p>To post a job, finish setting up your profile and company information.</p>
                                    </div>
                                    <ol class="steps">
                                        <li class="step is-complete" data-step=""></li>
                                        <li class="step  is-active" data-step="2">Step</li>
                                    </ol>

                                    <div class="newsletter-box">
                                        <div class="heading-pnel">
                                            <h4>Step 2: Company Information</h4>
                                        </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Name <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" id="company_name" name="company_name" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 g2hr-sector-container">
                                                    <div class="form-group">
                                                        <?php $sectors = \Go2HR\Helpers\CompanyRegistration\get_company_sectors(); ?>
                                                        <label>Sector <span>*</span></label>
                                                        <div class="RegionField small-box">
                                                            <?php foreach ($sectors as $sector) : ?>
                                                                <div class="checkbox-item custom-input">
                                                                    <input type="checkbox" id="sector_<?php echo $sector->term_id; ?>" name="sector[]" value="<?php echo $sector->term_id; ?>">
                                                                    <label for="sector_<?php echo $sector->term_id; ?>"><?php echo $sector->name; ?></label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <label class="sector-validation-error hidden">Please select at least one sector.</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <?php $regions = \Go2HR\Helpers\CompanyRegistration\get_company_regions(); ?>
                                                        <label>Region <span>*</span></label>
                                                        <select class="form-control ignore" name="region" id="region">
                                                            <option value="-1">-----</option>
                                                            <?php foreach($regions as $region) : ?>
                                                                <option value="<?php echo $region->term_id; ?>"><?php echo $region->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $sizes = \Go2HR\Helpers\CompanyRegistration\get_company_sizes(); ?>
                                                        <label>Size <span>*</span></label>
                                                        <select class="form-control ignore" name="size" id="size" style="max-width: 150px;">
                                                            <option value="-1">-----</option>
                                                            <?php foreach($sizes as $size) : ?>
                                                                <option value="<?php echo $size->term_id; ?>"><?php echo $size->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php $types = \Go2HR\Helpers\CompanyRegistration\get_company_types(); ?>
                                                        <label>Company Type <span>*</span></label>
                                                        <select class="form-control ignore" name="type" id="type">
                                                            <option value="-1">-----</option>
                                                            <?php foreach($types as $type) : ?>
                                                                <option value="<?php echo $type->term_id; ?>" data-slug="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Description <span>*</span></label>
                                                        <textarea class="form-control ignore" rows="5" name="company_description" id="company_description" maxlength="300"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Logo</label>
                                                        <div class="company-logo-box g2hr-dropcompany_namezone dropzone" id="file_dropzone">
                                                            <i class="fa fa-times-circle hidden" aria-hidden="true"></i>
                                                        </div>
                                                        <p class="company-logo-heading">Files must be less than 2MB. Allowed file types: png, jpg</p>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" name="address" id="address" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>City <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" name="company_city" id="company_city" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Postal Code <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" name="company_postal_code" id="company_postal_code" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Telephone <span>*</span></label>
                                                        <input class="form-control ignore" placeholder="" name="phone" id="phone" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input class="form-control" placeholder="" name="website" id="website" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Social Media</label>
                                                        <div class="step-social">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="facebook" id="facebook" />
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="twitter" id="twitter" />
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="linkedin" id="linkedin" />
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="instagram" id="instagram" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 mb-5 text-right d-flex justify-content-between">
                                                 <a href="#" class="green-btn2" id="g2hr-step2-back-btn"><i class="fa fa-angle-left" aria-hidden="true"></i> Back  </a>
                                                <a href="#" class="green-btn" id="g2hr-step2-finalize-btn">Finalize and Go to Dashboard  </a>
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
<!-- TODO: google recaptcha -->


