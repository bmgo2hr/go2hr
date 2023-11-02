<?php

$job = $args['job'] ?? null;
$repost = $args['repost'] ?? 0;

$editFlag = $job !== null;

$company_core = new Go2hr_Companies_Core();
$company_id = $company_core->get_company_by_owner(get_current_user_id());
$company_core->set_id($company_id[0]);

$company = $company_core->get_company();

$company_location = $company->locations[0];

?>

<form action="" name="g2hr-add-job-form" id="g2hr-add-job-form">
    <div class="row no-gutters">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Job Title <span>*</span></label>
                <input class="form-control" placeholder="" name="title" value="<?php echo $job->post_title ?? "";?>">
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label>Job Level <span>*</span></label>
                <?php $levels = \Go2HR\Helpers\Jobs\get_job_levels(); ?>
                <select class="form-control" name="level">
                    <option value="-1">-----</option>
                    <?php foreach ($levels as $level) : ?>
                        <?php $selected = ''; ?>
                        <?php if ($level->term_id == $job->level[0]->term_id) $selected = " selected='selected'"; ?>
                        <option value="<?php echo $level->term_id; ?>" <?php echo $selected; ?>><?php echo $level->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label>Job Type <span>*</span></label>
                <?php $types = \Go2HR\Helpers\Jobs\get_job_types(); ?>
                <div class="RegionField small-box">
                    <?php foreach ($types as $type) : ?>
                    <?php
                        $checked = "";
                        if (!empty($job->type)) {
                            foreach ($job->type as $savedType) {
                                if ($savedType->term_taxonomy_id == $type->term_id) $checked = " checked";
                            }
                        }
                    ?>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" id="type_<?php echo $type->term_id; ?>" name="type[]" value="<?php echo $type->term_id; ?>" data-slug="<?php echo $type->term_id; ?>" <?php echo $checked; ?>>
                        <label for="type_<?php echo $type->term_id; ?>"><?php echo $type->name; ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <label class="validation-error type-validation-error hidden">Please select at least one Job Type.</label>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label>Job Status <span>*</span></label>
                <?php $statuses = \Go2HR\Helpers\Jobs\get_job_statuses(); ?>
                <div class="RegionField small-box">
                    <?php foreach ($statuses as $status) : ?>
                    <?php
                        $checked = "";
                        if (!empty($job->status)) {
                            foreach ($job->status as $savedStatus) {
                                if ($savedStatus->term_taxonomy_id == $status->term_id) $checked = " checked";
                            }
                        }
                    ?>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" id="status_<?php echo $status->term_id; ?>" name="employment_status[]" value="<?php echo $status->term_id; ?>" data-slug="<?php echo $status->term_id; ?>" <?php echo $checked; ?>>
                        <label for="status_<?php echo $status->term_id; ?>"><?php echo $status->name; ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <label class="validation-error status-validation-error hidden">Please select at least one Status.</label>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label># of Positions Available</label>
                <input class="form-control" placeholder="" name="positions" value="<?php echo $job->job_positions[0] ?? "";?>">
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label> Accessible Employer
                    <span>*</span>
                    <span tooltip="Being an accessible employer means that you have removed barriers within your workspaces,&#10;employment practices and workplace culture,&#10; and are inclusive and accommodating of all employees and candidates with disabilities."> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/el.svg"> </span></label>
                <select class="form-control" name="assessible_employer">
                    <option value="-1">-----</option>
                    <option value="1" <?php if (($job->assessible_employer[0] ?? "") == 1) echo " selected"; ?>>Yes</option>
                    <option value="2" <?php if (($job->assessible_employer[0] ?? "") == 2) echo " selected"; ?>>No</option>
                </select>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Open to International applicants with valid Canadian Work permits <span>*</span></label>
                <div class="row">
                    <div class="col-lg-7">
                        <select class="form-control" name="is_open_work_permit">
                            <option value="-1">-----</option>
                            <option value="1" <?php if (($job->is_open_work_permit[0] ?? "") == 1) echo " selected"; ?>>Yes</option>
                            <option value="2" <?php if (($job->is_open_work_permit[0] ?? "") == 2) echo " selected"; ?>>No</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label>Sectors <span>*</span></label>
                <?php $sectors = \Go2HR\Helpers\Jobs\get_job_sectors(); ?>
                <div class="RegionField small-box">
                    <?php foreach ($sectors as $sector) : ?>
                    <?php
                        $checked = "";
                        if (!empty($job->sector)) {
                            foreach ($job->sector as $savedSector) {
                                if ($savedSector->term_taxonomy_id == $sector->term_id) $checked = " checked";
                            }
                        }
                    ?>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" id="status_<?php echo $sector->term_id; ?>" name="sector[]" value="<?php echo $sector->term_id; ?>" data-slug="<?php echo $sector->term_id; ?>" <?php echo $checked; ?>>
                        <label for="status_<?php echo $sector->term_id; ?>"><?php echo $sector->name; ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <label class="validation-error sector-validation-error hidden">Please select at least one Sector.</label>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-group">
                <label>Region <span>*</span></label>
                <?php $regions = \Go2HR\Helpers\Jobs\get_job_regions(); ?>
                <select class="form-control" name="region">
                    <option value="-1">-----</option>
                    <?php foreach ($regions as $region) : ?>
                        <?php $selected = ''; ?>
                        <?php if ($region->term_id == $job->region[0]->term_id) $selected = " selected='selected'"; ?>
                        <option value="<?php echo $region->term_id; ?>" <?php echo $selected; ?>><?php echo $region->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Job Address <span>*</span></label>

<!--                <input class="form-control" placeholder="" name="address1" value="--><?php //echo $company_location['company_address'] . ' ' . $company_location['company_city']; ?><!--" style="cursor: not-allowed" disabled style="--><?php //if ($job->use_different_address[0]) echo "display: none;" ?><!--">-->
<!---->
<!--                <input class="form-control" placeholder="" name="address1" value="--><?php //echo $job->job_address_1[0] ?? ""; ?><!--" style="--><?php //if (!$job->use_different_address[0]) echo "display: none;" ?><!--">-->

                <div class="checkbox-item custom-input mt-3">
                    <input type="checkbox" id="use_company_address" name="address1" value="<?php echo $company_location['company_address'] . ' ' . $company_location['company_city']; ?>" <?php if (!is_null($job->use_different_address[0] ?? null) && $job->use_different_address[0] == 0 || $job == null) echo " checked"; ?>>
                    <label for="use_company_address"><?php echo $company_location['company_address'] . ' ' . $company_location['company_city']; ?></label>
                </div>

                <div class="checkbox-item custom-input mt-3">
                    <input type="checkbox" name="use_different_address" id="use_different_address" <?php if ($job->use_different_address[0] == 1 || (($job->use_different_address[0] ?? null) === null && !empty($job->job_address_1[0]))) echo " checked"; ?> value="1">
                    <label for="use_different_address">Use a location different than the location above</label>
                </div>

                <input class="form-control <?php if ($job->use_different_address[0] == 1 || (($job->use_different_address[0] ?? null) === null && !empty($job->job_address_1[0]))) { echo ""; } else { echo "ignore"; } ?>" name="different_address1" value="<?php echo $job->job_address_1[0] ?? ""; ?>" style="<?php if ($job->use_different_address[0] == 1 || (($job->use_different_address[0] ?? null) === null && !empty($job->job_address_1[0]))) { echo "display: block;"; } else { echo "display: none;"; } ?>">

            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Job Description <span>*</span></label>
                <textarea class="form-control" rows="5" name="description"><?php echo $job->post_content ?? ""; ?></textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Responsibilities & Qualifications <span>*</span></label>
                <textarea class="form-control" rows="5" name="qualifications"><?php echo $job->job_qualifications[0] ?? ""; ?></textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Salary/Wage <span></span></label>
                <div class="Salary/Wage-box">
                    <div class="Salary/Wage-input">
                        <input class="form-control" placeholder="" name="salary" value="<?php echo $job->job_salary[0] ?? ""; ?>">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Other Perks/Benefits</label>
                <textarea class="form-control" rows="5" class="benefits" name="benefits"><?php echo $job->benefits[0] ?? ""; ?></textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <?php //$trainings = \Go2HR\Helpers\Jobs\get_job_training(); ?>
                <label>Recommended Training </label>
                <div class="RegionField SuggestedTrainingField small-box">
                    <?php
                        $saved_training_ids = array();
                        if (isset($job->suggested_training[0])) {
                            $saved_training_ids = explode(', ', $job->suggested_training[0]);
                        }
                    ?>

                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" id="suggested_training_zs4t" value="zs4t" <?php if (in_array("zs4t", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_zs4t"><a target="_blank" href="https://train.go2hr.ca/products/7494-bsafe-bc-safety-assured-for-everyone">BSAFE - BC Safety Assured For Everyone</a></label>

                    </div>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" id="suggested_training_65krb" value="65krb" <?php if (in_array("65krb", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_65krb"><a target="_blank" href="https://train.go2hr.ca/products/6308-superhost-foundations-of-service-quality">SuperHost Foundations of Service Quality</a></label>

                    </div>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" id="suggested_training_qrxud" value="qrxud" <?php if (in_array("qrxud", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_qrxud"><a target="_blank" href="https://train.go2hr.ca/products/6304-superhost-service-for-all-foundations-of-inclusive-service">SuperHost Service For All</a></label>

                    </div>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" id="suggested_training_kvdrq" value="kvdrq" <?php if (in_array("kvdrq", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_kvdrq"><a target="_blank" href="https://train.go2hr.ca/products/6305-foundations-of-workplace-safety">Foundations of Workplace Safety (includes WHMIS)</a></label>

                    </div>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" id="suggested_training_xjld8" value="xjld8" <?php if (in_array("xjld8", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_xjld8"><a target="_blank" href="">FOODSAFE Level 1 by Distance Education</a></label>

                    </div>
                    <div class="checkbox-item custom-input">
                        <input type="checkbox" name="suggested_training" value="hml25" id="suggested_training_hml25" <?php if (in_array("hml25", $saved_training_ids)) echo " checked"; ?>>
                        <label for="suggested_training_hml25">Serving It Right</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Job Application Process </label>
                <input class="form-control" placeholder="" name="application_process" value="<?php echo $job->job_application_process[0] ?? ""; ?>">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Apply Now Button: URL (include http:// or https://) or Email Address <span>*</span></label>
                <input class="form-control" placeholder="" name="application_action" value="<?php echo $job->job_application_action_address[0] ?? ""; ?>">
            </div>
        </div>
    </div>


    <div class="form-group mt-4 mb-5 " >
        <a href="#" class="green-btn" id="g2hr-add-job" style="width: 162px;">
            <?php
                $buttonText = $editFlag ? "Update Job" : "Post Job";
                if ($repost == 1) {
                    $buttonText = "Repost Job";
                }
            ?>
            <?php echo $buttonText; ?>
        </a>
    </div>

    <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>

    <input type="hidden" name="fid" value="<?php echo $job->job_fid[0] ?? ""; ?>">
    <input type="hidden" name="repost" value="<?php echo $repost; ?>">
</form>
