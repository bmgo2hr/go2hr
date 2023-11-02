<?php

$user = $args['user'] ?? null;

$users_core = (new Go2hr_Users_Core($user->ID ?? 0));

$statuses = $users_core->get_status_terms(); ?>

<form action="" id="g2hr-subuser-profile-form">
    <div class="row no-gutters">
        <div class="col-lg-12">
           <div class="form-group">
               <label>Username <span>*</span></label>
               <input class="form-control ignore" placeholder="" name="username" value="<?php echo $user->data->user_login ?? ""; ?>">
               <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" style="visibility: hidden;"></i>
           </div>
        </div>
        <div class="col-lg-12">
           <div class="form-group">
               <label>Email Address <span>*</span></label>
               <input class="form-control ignore" placeholder="" name="user_email" value="<?php echo $user->data->user_email ?? ""; ?>">
               <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" style="visibility: hidden;"></i>
           </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Status <span>*</span></label>
                <div class="RegionField d-flex align-items-center">
                    <div class="checkbox-item mr-5 custom-input radio-custom">
                        <input type="radio" class="ignore" id="status-active" name="user-status[]" value="<?php echo $statuses->active->term_id ?? ""; ?>" <?php if ($user->user_status[0] == $statuses->active->term_id) echo "checked"; ?>>
                        <label for="status-active"> Active</label>
                    </div>

                    <div class="checkbox-item custom-input radio-custom">
                        <input type="radio" class="ignore" id="status-inactive" name="user-status[]" value="<?php echo $statuses->disabled->term_id ?? ""; ?>" <?php if ($user->user_status[0] == $statuses->disabled->term_id) echo "checked"; ?>>
                        <label for="status-inactive">  Inactive</label>
                    </div>
               </div>
               <label class="status-validation-error hidden">Please select at least one Status.</label>
           </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Password <span>*</span></label>
                <input class="form-control" placeholder="**********" type="Password" name="password" value="">
            </div>
        </div>
    </div>
    <div class="form-group mt-4 mb-5 " >
        <a href="#" class="green-btn" id="g2hr-modify-subuser-account">Update Information</a>
    </div>

    <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>

    <input type="hidden" name="fid"  value="<?php echo $user->user_fid[0]; ?>">
    <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
</form>
