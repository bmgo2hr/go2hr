<?php
    Class G2hr_Account_Setting {

        /**
         * Instance of G2HR Users class
         * @var object
         */
        private $g2hr_users;

        /**
         * Dependency Injection for Core Users Class
         */
        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_update() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-mask', get_template_directory_uri() . '/dashboard/assets/js/jquery-mask.js');
            wp_register_script('g2hr-account-setting', get_template_directory_uri() . '/dashboard/assets/js/account-setting.js', array('g2hr-validator', 'g2hr-mask'));
            wp_enqueue_script('g2hr-account-setting');

            wp_localize_script( 'g2hr-account-setting', 'g2hr_account_setting_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => site_url('dashboard/my-profile'),
                'nonce'           => wp_create_nonce('g2hr_user_profile')
            ));
        }

        /**
         * Function used for handling profile update AJAX request
         */
        public function update() {
            check_ajax_referer('g2hr_user_profile', 'nonce');

            $user_data = [
                'user_email'    => filter_var($_POST['data']['email'], FILTER_SANITIZE_STRING),
                'password'      => filter_var($_POST['data']['password'], FILTER_SANITIZE_STRING),
                'newsletter'    => is_array($_POST['data']['newsletter']) ? filter_var(implode(',', $_POST['data']['newsletter']), FILTER_SANITIZE_STRING) :  filter_var($_POST['data']['newsletter'], FILTER_SANITIZE_STRING)
            ];

            $this->set_users(new Go2hr_Users_Core());
            $this->g2hr_users->set_id(get_current_user_id());
            $this->g2hr_users->update($user_data);

            wp_send_json_success(
                array(
                    'title'        =>    __('Success!', 'go2hr'),
                    'message'    =>    __('Your account setting has been successfully updated.', 'go2hr')
                ),
                200
            );

            die;
        }
    }
