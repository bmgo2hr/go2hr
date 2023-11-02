<?php
    class G2hr_User_Psw_Reset {

        /**
         * Instance of G2HR Users class
         * @var object
         */
        private $g2hr_users;

        /**
         * @param   Go2hr_Users_Core $users
         */
        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_psw_reset() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-user-psw-reset', get_template_directory_uri() . '/dashboard/assets/js/user-password-reset.js', array('g2hr-validator') );
            wp_enqueue_script('g2hr-user-psw-reset');

            wp_localize_script( 'g2hr-user-psw-reset', 'g2hr_user_psw_reset_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => home_url('password-reset/started'),
                'nonce'            => wp_create_nonce('g2hr_user_psw_reset')
            ));
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_psw_change() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-user-psw-change', get_template_directory_uri() . '/dashboard/assets/js/user-password-reset.js', array('g2hr-validator'));

            wp_enqueue_script('g2hr-user-psw-change');

            wp_localize_script( 'g2hr-user-psw-change', 'g2hr_user_psw_change_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => home_url('password-reset/success'),
                'nonce'            => wp_create_nonce('g2hr_user_psw_change')
            ));
        }

        /**
         * Function called by filter which overrides default password reset message
         */
        public function retrieve_password_message($key, $user_email, $name) {
            // Create new message
            $msg  = sprintf( __( 'Hello %s', 'personalize-login' ), $name) . "\r\n\r\n";
            $msg .= sprintf( __( 'You asked us to reset your password for your account at %s. Click below to do so now:', 'personalize-login' ), $user_email ) . "\r\n\r\n";
            $msg .= home_url( "password-reset?key=$key&login=" . rawurlencode( $user_email ), 'login' ) . "\r\n\r\n";
            $msg .= __( "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'personalize-login' ) . "\r\n\r\n";
            $msg .= __( 'Thanks!', 'personalize-login' ) . "\r\n";

            return $msg;
        }

        /**
         * Method that accepts e-mail address from user and starts the whole password reset process. We do not fail even if such e-mail address does not exist.
         */
        public function reset() {

            //Check security code
            check_ajax_referer('g2hr_user_psw_reset', 'nonce');

            $user = get_user_by('email', filter_var($_POST['user_login'], FILTER_SANITIZE_EMAIL));

            if ($user) {
                $key = get_password_reset_key($user);

                if(!is_wp_error($key)) {
                    $message = $this->retrieve_password_message($key, $user->data->user_email, $user->data->display_name);
                    wp_mail($user->data->user_email, wp_specialchars_decode( __('Oops! Forgot your password?') ), $message);
                }
            } else {
                wp_send_json_error(
					__( 'The email address provided is not registered. Check your input and try again.', 'go2hr' ),
					400
				);
            }

            wp_send_json_success(
                __( 'Action success, please wait...', 'go2hr' ),
                200
            );

            die;
        }

        /**
         * Method used to handle password change form. We accept two password inputs and user email which is then checked
         * against WP databse. If such user does exist, the password is then changed.
         */
        public function change() {
            //Check security code
            check_ajax_referer('g2hr_user_psw_change', 'nonce');

            $pass1 = $_POST['data']['pass1'];
            $pass2 = $_POST['data']['pass2'];
            $email = $_POST['data']['user_login'];

            if($pass1 !== $pass2) {
                wp_send_json_error(
                    __( 'The password do not match. Please check your input and try again', 'go2hr' ),
                    400
                );
            }

            $user = get_user_by('email', filter_var($email, FILTER_SANITIZE_EMAIL));

            if(!$user || is_wp_error($user)) {
                wp_send_json_error(
                    __( 'Somthing went wrong :( Please try again.', 'go2hr' ),
                    400
                );
            }

            reset_password($user, $pass1);

            wp_send_json_success(
                __( 'Action success, please wait...', 'go2hr' ),
                200
            );

            die;
        }


        /**
         * A simple action that is used on our custom Password Reset page. Instead of having custom business logic stored in a view file, the process of key & login check is moved to this function.
         */
        public function check_password_reset_tokens() {
            $user = check_password_reset_key( $_REQUEST['key'], $_REQUEST['login'] );
            if (!$user || is_wp_error($user)) {
                if($user && $user->get_error_code() === 'expired_key') {
                    wp_redirect(home_url('password-reset/error/?login=expiredkey'));
                } else {
                    wp_redirect(home_url('password-reset/error/?login=invalidkey'));
                }
                exit;
            }
        }
    }
