<?php

    class G2hr_User_List {
        /**
         * Instance of G2HR Users class
         * @var object
         */
        private $g2hr_users;

        /**
         * Dependency Injection for Core Users Class
         * @param   Go2hr_Users_Core $users
         */
        public function set_users(Go2hr_Users_Core $users) {
            $this->g2hr_users = $users;
        }

        /**
         * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_list() {

            wp_register_style('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/css/jquery-confirm.css');
            wp_register_script('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/js/jquery-confirm.min.js');
            wp_register_script('g2hr-user-list', get_template_directory_uri() . '/dashboard/assets/js/user-list.js', array('g2hr-confirm'));

            wp_enqueue_script('g2hr-user-list');
            wp_enqueue_style('g2hr-confirm');

            wp_localize_script( 'g2hr-user-list', 'g2hr_user_list_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'nonce'           => wp_create_nonce('g2hr_user_list'),
                'redirect_url'    => home_url('/dashboard/my-users')
            ));
        }

        public function delete() {
            check_ajax_referer('g2hr_user_list', 'nonce');

            $target_user_ids = $_POST['data']['target_user_ids'];

            $users = \Go2HR\Helpers\SubUsers\get_company_subusers();
            $user_ids = wp_list_pluck($users, "ID");

            foreach ($target_user_ids as $target_user_id) {
                if (in_array($target_user_id, $user_ids)) {
                    $go2hr_users_core = new Go2hr_Users_Core($target_user_id);
                    $statuses = $go2hr_users_core->get_status_terms();

                    update_user_meta($target_user_id, 'user_status', $statuses->deleted->term_id);

                } else {
                    wp_send_json_error(
                        array(
                          'title'            =>    __( 'Oops - something is wrong!', 'go2hr' ),
                          'message'        =>    __( 'Something went wrong. Please check your input and try again.', 'go2hr' ),
                        ),
                        400
                    );
                    die();
                }
            }

            wp_send_json_success(
                array(
        //          "redirect_url"    =>    $redirect_url,
                  'title'            =>    __( 'Done!', 'go2hr' ),
                  'message'        =>    __( 'Successfully deleted.', 'go2hr' ),
                ),
                200
              );

            die();
        }
    }
