<?php
/**
 * Subser List Helper
 *
 * Hooks, helper functions
 */

namespace Go2HR\Helpers\SubUsers;
use Go2HR\Helpers\CompanyProfile;

function get_company_subusers() {
    $g2hr_users = new \Go2hr_Users_Core();
    $company = CompanyProfile\get_company_profile();

    return $g2hr_users->get_company_subusers($company->ID);
}
