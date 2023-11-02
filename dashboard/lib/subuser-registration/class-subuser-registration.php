<?php
    class G2hr_Subuser_Registration {

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
         * Instance of G2HR Mailer class
         * @var object
         */
        private $g2hr_mailer;

        /**
         * Dependency Injection for Core Users Class
         * @param   Go2hr_Users_Core $users
         */
        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        /**
         * Dependency Injection for Core CompanyyClass
         * @param   Go2hr_Users_Core $users
         */
        public function set_company(Go2hr_Companies_Core $company) {
            $this->g2hr_company = $company;
        }

        /**
         * Dependency Injection for Core Users Class
         * @param   Go2hr_Users_Mailing $mailing
         */
        public function set_mailer(Go2hr_Users_Mailing $mailing) {
            $this->g2hr_mailer = $mailing;
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_registration() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-subuser-registration', get_template_directory_uri() . '/dashboard/assets/js/subuser-registration.js', array('g2hr-validator') );
            wp_enqueue_script('g2hr-subuser-registration');

            wp_localize_script( 'g2hr-subuser-registration', 'g2hr_subuser_registration_object', array(
                'ajax_url'      => admin_url( 'admin-ajax.php' ),
                'redirect_url'  => home_url('dashboard/my-users'),
                'nonce'         => wp_create_nonce('g2hr_subuser_registration')
            ));
        }

        /**
         * Function used for handling registration AJAX request
         */
        public function register() {
            check_ajax_referer('g2hr_subuser_registration', 'nonce');

            //Check email again, never trust the user!
            $does_exist = email_exists($_POST['data']['user_email']);
            if ($does_exist) {
                wp_send_json_error(
                    array(
                        'title'        =>    __( 'We already have that one!', 'go2hr' ),
                        'message'    =>    __( 'That e-mail address is already taken.', 'go2hr' ),
                    ),
                    400
                );
            }

            //Check username again, never trust the user!
            $does_exist = username_exists($_POST['data']['username']);
            if ($does_exist) {
                wp_send_json_error(
                    array(
                        'title'        =>    __( 'We already have that one!', 'go2hr' ),
                        'message'    =>    __( 'That username is already taken.', 'go2hr' ),
                    ),
                    400
                );
            }

            $this->set_company(new Go2hr_Companies_Core());
            $company_id = $this->g2hr_company->get_company_by_owner(get_current_user_id());

            $userdata = [
                'email'         => $_POST['data']['user_email'],
                'username'      => $_POST['data']['username'],
                'password'      => $_POST['data']['password'],
                'first_name'    => filter_var("", FILTER_SANITIZE_STRING),
                'last_name'     => filter_var("", FILTER_SANITIZE_STRING),
                'status'        => $_POST['data']['status'],
                'company_id'    => $company_id[0]
            ];

            $this->set_users(new Go2hr_Users_Core());
            $user_id = $this->g2hr_users->add_subuser($userdata);

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
                    'title'        =>    __( 'Great!', 'go2hr' ),
                    'message'    =>    __( 'Your new sub user has been added and the notification email is on route.', 'go2hr' ),
                ),
                200
            );

            die;
        }

        /**
         * Function used to check whether the email address is already taken or not.
         */
        public function check_email() {
            check_ajax_referer('g2hr_subuser_registration', 'nonce');

            $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);

            $does_exist = email_exists($email);
            if ($does_exist) {
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
            //Check security code
            check_ajax_referer('g2hr_subuser_registration', 'nonce');

            $username = filter_var($_REQUEST['username'], FILTER_SANITIZE_EMAIL);

            //Check if such user does exist
            $does_exist = username_exists($username);
            if($does_exist) {
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
