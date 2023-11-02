<?php
/**
 * Template name: My Company
 */

use Go2HR\Helpers\CompanyProfile;

get_header();

$company = CompanyProfile\get_company_profile();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey <?php if (is_user_logged_in() && current_user_can('administrator')) echo "signed-in"; ?>" id="ContactUs">
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
                                                <h4>My Company Information</h4>
                                            </div>
                                            <form action="" id="g2hr-company-profile-form">
                                                <div class="row no-gutters">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Company Name <span>*</span></label>
                                                            <input class="form-control" placeholder="" name="company_name" value="<?php echo $company->post_title; ?>">
                                                        </div>
                                                    </div>
                                                <div class="col-lg-7 g2hr-sector-container <?php if ($company->type[0]->slug !== "tourism-operator") : ?> hidden <?php endif; ?>">
                                                    <div class="form-group">
                                                        <?php $sectors = \Go2HR\Helpers\CompanyRegistration\get_company_sectors(); ?>
                                                        <label>Sector <span>*</span></label>
                                                        <div class="RegionField small-box">
                                                            <?php foreach ($sectors as $sector) : ?>
                                                            <?php
                                                                $checked = '';
                                                                $search = array_values(array_filter($company->sector, function ($savedSector) use (&$sector) {
                                                                    return $savedSector->term_id == $sector->term_id;
                                                                }));
                                                                if (isset($search[0]) && $search[0]->term_id > 0) $checked = ' checked="checked"';
                                                            ?>
                                                            <div class="checkbox-item custom-input">
                                                                <input type="checkbox" id="sector_<?php echo $sector->term_id; ?>" name="sector[]" value="<?php echo $sector->term_id; ?>" data-slug="<?php echo $sector->term_id; ?>" <?php echo $checked; ?>>
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
                                                        <select class="form-control" name="region">
                                                            <?php foreach ($regions as $region): ?>
                                                            <?php $selected = ''; ?>
                                                            <?php if ($region->term_id == $company->region[0]->term_id) $selected = ' selected="selected"'; ?>
                                                                <option value="<?php echo $region->term_id; ?>" <?php echo $selected; ?>><?php echo $region->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Size <span>*</span></label>
                                                        <?php $sizes = \Go2HR\Helpers\CompanyRegistration\get_company_sizes(); ?>
                                                        <select class="form-control" name="size">
                                                            <?php foreach ($sizes as $size): ?>
                                                            <?php $selected = ''; ?>
                                                            <?php if ($size->term_id == $company->size[0]->term_id) $selected = ' selected="selected"'; ?>
                                                                <option value="<?php echo $size->term_id; ?>" <?php echo $selected; ?>><?php echo $size->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Type <span>*</span></label>
                                                        <?php $types = \Go2HR\Helpers\CompanyRegistration\get_company_types(); ?>
                                                        <select class="form-control" name="type">
                                                            <?php foreach ($types as $type): ?>
                                                            <?php $selected = ''; ?>
                                                            <?php if ($type->term_id == $company->type[0]->term_id) $selected = ' selected="selected"'; ?>
                                                                <option value="<?php echo $type->term_id; ?>" <?php echo $selected; ?> data-slug="<?php echo $type->slug; ?>"><?php echo $type->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Description <span>*</span></label>
                                                        <textarea class="form-control" rows="12" name="company_description" maxlength="300"><?php echo trim($company->post_content); ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Company Logo</label>
                                                        <div class="company-logo-box g2hr-dropcompany_namezone dropzone" id="file_dropzone">
                                                            <?php $logo = get_field('company_id', $company->ID); ?>
                                                            <i class="fa fa-times-circle <?php if ($logo == false) echo "hidden"; ?>" aria-hidden="true"></i>
                                                            <?php if ($logo !== false) : ?>
                                                            <div class="dz-current-image">
                                                                <img class="company--logo" src="<?php echo $logo; ?>" alt="<?php echo $company->post_title; ?>">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <p class="company-logo-heading">Files must be less than 2MB. Allowed file types: png, jpg</p>
<!--                                                        <div class="company-logo-box">-->
<!--                                                            <input class="form-control" placeholder="" name="" type="file">-->
<!--                                                            <img src="--><?php //echo get_template_directory_uri(); ?><!--/assets/images/account/drag.png">-->
<!--                                                        </div>-->
<!--                                                        <p class="company-logo-heading">Files must be less than 2MB. Allowed file types: png, jpg</p>-->
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address <span>*</span></label>
                                                        <input class="form-control" placeholder="" name="address" value="<?php echo $company->locations[0]['company_address']; ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>City <span>*</span></label>
                                                        <input class="form-control" placeholder="" name="city" value="<?php echo $company->locations[0]['company_city']; ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Postal Code <span>*</span></label>
                                                        <input class="form-control" placeholder="" name="postal_code" value="<?php echo $company->locations[0]['company_postal_code']; ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Telephone <span>*</span></label>
                                                        <input class="form-control" placeholder="" name="phone" value="<?php echo $company->company_phone[0]; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input class="form-control" placeholder="" name="website" value="<?php echo $company->company_website[0]; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Social Media</label>
                                                        <div class="step-social">
                                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="facebook" value="<?php echo $company->company_facebook[0]; ?>">
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="twitter" value="<?php echo $company->company_twitter[0]; ?>">
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="linkedin" value="<?php echo $company->company_linkedin[0]; ?>">
                                                        </div>
                                                        <div class="step-social">
                                                            <i class="fa fa-instagram" aria-hidden="true"></i>
                                                            <input class="form-control" placeholder="" name="instagram" value="<?php echo $company->company_instagram[0]; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-4 mb-5 " >
                                                    <a href="#" class="green-btn" id="g2hr-update-company">Update Information  </a>
                                                </div>

                                                <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>
                                                <input type="hidden" name="fid" value="<?php echo $company->company_fid[0]; ?>">
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

<?php get_footer(); ?>
