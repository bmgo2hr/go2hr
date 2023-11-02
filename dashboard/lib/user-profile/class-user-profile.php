<?php
    Class G2hr_User_Profile {

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
            wp_register_script('g2hr-user-profile', get_template_directory_uri() . '/dashboard/assets/js/user-profile.js', array('g2hr-validator', 'g2hr-mask'));
            wp_enqueue_script('g2hr-user-profile');

            wp_localize_script( 'g2hr-user-profile', 'g2hr_user_profile_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => site_url('dashboard/my-profile'),
                'nonce'            => wp_create_nonce('g2hr_user_profile')
            ));
        }

        /**
         * Function used for handling profile update AJAX request
         */
        public function update() {
            check_ajax_referer('g2hr_user_profile', 'nonce');

            $user_data = [
                'first_name'    =>    filter_var($_POST['data']['first_name'], FILTER_SANITIZE_STRING),
                'last_name'        =>    filter_var($_POST['data']['last_name'], FILTER_SANITIZE_STRING),
                'occupation'    =>    filter_var($_POST['data']['occupation'], FILTER_SANITIZE_NUMBER_INT),
                'country'        =>    filter_var($_POST['data']['country'], FILTER_SANITIZE_NUMBER_INT),
                'user_phone'    =>  filter_var($_POST['data']['user_phone'], FILTER_SANITIZE_STRING),
                'sector'        =>    filter_var($_POST['data']['sector'], FILTER_SANITIZE_NUMBER_INT),
                'city'    =>  filter_var($_POST['data']['city'], FILTER_SANITIZE_STRING),
                'postal_code'    =>    filter_var($_POST['data']['postal_code'], FILTER_SANITIZE_STRING),
                'user_email'        =>    filter_var($_POST['data']['email'], FILTER_SANITIZE_STRING),
                'password'        =>    filter_var($_POST['data']['password'], FILTER_SANITIZE_STRING)
            ];

            $this->set_users(new Go2hr_Users_Core());
            $this->g2hr_users->set_id(get_current_user_id());
            $this->g2hr_users->update($user_data);

            wp_send_json_success(
                array(
                    'title'        =>    __('Success!', 'go2hr'),
                    'message'    =>    __('Your profile has been successfully updated.', 'go2hr')
                ),
                200
            );

            die;
        }
    }
