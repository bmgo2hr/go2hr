<?php
    class G2hr_Subuser_Profile {

        /**
         * Instance of G2HR Users class
         * @var object
         */
        private $g2hr_users;

        /**
         * Instance of G2HR Company class
         * @var object
         */
        private $g2hr_company;


        /**
         * Dependency Injection for Core Users Class
         * @param   Go2hr_Users_Core $users
         */
        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        /**
         * Dependency Injection for Core Company Class
         * @param   Go2hr_Users_Core $users
         */
        public function set_company(Go2hr_Companies_Core $company) {
            $this->g2hr_company = $company;
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_profile() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-subuser-profile', get_template_directory_uri() . '/dashboard/assets/js/subuser-profile.js', array('g2hr-validator'));

            wp_enqueue_script('g2hr-subuser-profile');

            wp_localize_script( 'g2hr-subuser-profile', 'g2hr_subuser_profile_object', array(
                'ajax_url'      => admin_url( 'admin-ajax.php' ),
                'redirect_url'  => site_url('my-users'),
                'nonce'         => wp_create_nonce('g2hr_subuser_profile')
            ));
        }

        /**
         * Function used for handling update AJAX request
         */
        public function update() {
            check_ajax_referer('g2hr_subuser_profile', 'nonce');

            $userdata = [
                'user_email'    =>    $_POST['data']['user_email'],
                'user_name'     =>    $_POST['data']['user_name'],
                'password'      =>    $_POST['data']['password'],
                'role'          =>    $_POST['data']['role'],
                'first_name'    =>    filter_var("", FILTER_SANITIZE_STRING),
                'last_name'     =>    filter_var("", FILTER_SANITIZE_STRING),
                'fid'           =>    filter_var($_POST['data']['fid'], FILTER_SANITIZE_STRING),
                'status'        =>    filter_var($_POST['data']['status'], FILTER_SANITIZE_NUMBER_INT)
            ];

            $this->set_users(new Go2hr_Users_Core());
            $user_id = $this->g2hr_users->update_subuser($userdata);

//            if(!empty($user_id ) && $userdata['role']=='job_seeker'){
//                delete_user_meta($user_id,'user_company');
//            }

            if (!$user_id || is_wp_error($user_id)) {
                wp_send_json_error(
                    array(
                        'title'        =>    __( 'Oops - something is wrong!', 'go2hr' ),
                        'message'    =>    __( 'Something went wrong. Please check your input and try again.', 'go2hr' ),
                    ),
                    400
                );
            }

            wp_send_json_success(
                array(
                    'title'        =>    __( 'Success!', 'go2hr' ),
                    'message'    =>    __( 'User profile has been successfully updated.', 'go2hr' ),
                ),
                200
            );

            die;
        }

        /**
         * Function used to check whether the email address is already taken or not.
         */
        public function check_email() {
            check_ajax_referer('g2hr_subuser_profile', 'nonce');

            $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);

            $user_id = email_exists($email);

            if ($user_id && $_REQUEST['user_id'] != $user_id) {
                wp_send_json_error(
                    __( 'We\'re sorry, that email is taken.', 'go2hr' ),
                    400
                );
            }

            wp_send_json_success(
                __( 'E-mail address has not been taken.', 'go2hr' ),
                200
            );

            die;
        }

        public function check_username() {
            check_ajax_referer('g2hr_subuser_profile', 'nonce');

            $username = filter_var($_REQUEST['username'], FILTER_SANITIZE_EMAIL);

            $user_id = username_exists($username);

            if ($user_id && $_REQUEST['user_id'] != $user_id) {
              wp_send_json_error(
                __( 'We\'re sorry, that username is taken.', 'go2hr' ),
                400
              );
            }

            wp_send_json_success(
              __( 'Username has not been taken.', 'go2hr' ),
              200
            );

            die;
        }

    }
