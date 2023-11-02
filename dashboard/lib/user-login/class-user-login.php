<?php
    class G2hr_User_Login {

        /**
         * Instance of G2HR Users class
         * @var object
         */
        private $g2hr_users;

        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        public function init_ajax_login() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js' );
            wp_register_script('g2hr-user-login', get_template_directory_uri() . '/dashboard/assets/js/user-login.js', array('jquery-file', 'g2hr-validator'));
            wp_enqueue_script('g2hr-user-login');

            wp_localize_script( 'g2hr-user-login', 'g2hr_user_login_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => site_url('dashboard'),
                'nonce'            => wp_create_nonce('g2hr_user_login')
            ));
        }

        /**
         * Handle login AJAX call
         */
        public function login() {
            //Check security code
            check_ajax_referer('g2hr_user_login', 'nonce');

            $user_email = $_POST['data']['user_email'];
            $user_pass = $_POST['data']['user_pass'];
            $redirect_to = $_POST['data']['redirect_to'];

            //Check if such user does exist
            if (is_email($user_email)){
                $user = get_user_by('email', $user_email);
            } else {
                $user = get_user_by('login', $user_email);
            }

            if (!$user) {
                wp_send_json_error(
                    __( 'Invalid Username or Password. Check your input and try again.', 'go2hr' ),
                    400
                );
            }

            // Check the user status
            // If user has not activated his/her account or that account is currently disabled,
            // We need to prevent them from signing in.
            $this->set_users(new Go2hr_Users_Core($user->data->ID));

            if (!$this->g2hr_users->is_active()) {
                wp_send_json_error(
                    __( 'Your Account has not been activated. Please check your email and click on the activation link.', 'go2hr' ),
                    400
                );
            }

            if ($this->g2hr_users->is_disabled() || $this->g2hr_users->is_deleted()) {
                wp_send_json_error(
                    __( 'Your Account has been disabled. Please contact our support for more information.', 'go2hr' ),
                    400
                );
            }

            //Everything is fine, let us finish the log in processy
            $tmp = [
                'user_login'    =>    $user_email,
                'user_password'    =>    $user_pass,
                'remember'        =>    TRUE
            ];
//
//            var_dump($user);
//            exit;

            $signon = wp_signon($tmp, FALSE);

            if (is_wp_error($signon)) {
                wp_send_json_error(
                    __( 'Invalid Username or Password. Check your input and try again.', 'go2hr' ),
                    400
                );
            }

            /**
             * We set this each time user logs in because we need it for the Dashboard and reports
             */
            update_user_meta(get_current_user_id(), 'user_last_login', time());

            wp_send_json_success(
                array(
                    "message"        =>    __( 'Login success, please wait...', 'go2hr' ),
                    "redirect_url"    =>    (strlen($redirect_to) > 0) ? site_url($redirect_to) : home_url('dashboard')
                ),
                200
            );
            die;
        }
    }
