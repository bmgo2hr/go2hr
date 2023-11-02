<?php
use Go2HR\Helpers\CompanyProfile;

$users = \Go2HR\Helpers\SubUsers\get_company_subusers();

?>

<div class="col-lg-9 col-md-12">
    <div class="space">
        <div class="dashboard-card">
            <div class="card-heading pl-5 pr-5 d-flex align-items-center justify-content-between">
                <h3>My Users</h3>
                <div class="dashboard-action">
                    <a href="" class="delete-action"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/remove.svg"></a>
                     <a href="/dashboard/my-jobs/add-sub-user"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/plus1.svg"></a>
                </div>
            </div>
            <div class="card-content p-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="title-img">Name</th>
                                <th class="text-left">Email Address</th>
                                <th class="text-left">Roles</th>
                                <th class="text-left">Status</th>
                                <th class="text-right">Edit/Repost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                            <?php
                                $g2hr_users_core = new Go2hr_Users_Core($user->data->ID);
                                $status = $g2hr_users_core->get_status();

                                $statuses = $g2hr_users_core->get_status_terms();
                                if (in_array('company_owner', $user->roles) || $status == $statuses->deleted->term_id) continue;
                            ?>
                            <tr>
                                <td class="title-img"><div class="d-flex"><input type="checkbox" class="delete_checkbox" value="<?php echo $user->ID; ?>"><?php echo $user->data->user_login; ?></div></td>
                                <td class="text-left"><?php echo $user->data->user_email; ?></td>
                                <td class="text-left">Company Employee (Can add and edit jobs)</td>
                                <td class="text-left">
                                    <?php if ($g2hr_users_core->is_disabled() || $g2hr_users_core->is_deleted()) : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/inactive.svg"> Inactive
                                    <?php else : ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/active.svg"> Active
                                    <?php endif; ?>
                                </td>
                                <td class="text-right Edit-td"><a href="/dashboard/my-users/modify-sub-user?id=<?php echo get_field('user_fid', 'user_' . $user->data->ID); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/edit.svg"> </a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>
    </div>
</div>
