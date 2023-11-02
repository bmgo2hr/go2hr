<?php
    class G2hr_Company_Profile {

        /**
         * Instance of G2HR Companies class
         * @var object
         */
        private $g2hr_companies;


        /**
         * Instance of G2HR Mailer class
         * @var object
         */
        private $g2hr_mailer;

        /**
         * Dependency Injection for Core Company Class
         * @param   Go2hr_Companies_Core $companies
         */
        public function set_company(Go2hr_Companies_Core $companies) {
            $this->g2hr_companies = $companies;
        }


        /**
         * Dependency Injection for Company Mailing class
         * @param   Go2hr_Companies_Mailing $mailing
         */
        public function set_mailer(Go2hr_Companies_Mailing $mailing) {
            $this->g2hr_mailer = $mailing;
        }

        /**
         * Load the necessary scripts and dependencies for Company Registration form. Generates nonce for registration action and sets the method that is going to be used for handling the AJAX call.
         */
        public function init_ajax_update() {
            wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
            wp_register_script('g2hr-dropzone', get_template_directory_uri() . '/dashboard/assets/js/dropzone.js');
            wp_register_script('g2hr-mask', get_template_directory_uri() . '/dashboard/assets/js/jquery-mask.js');
            wp_register_script('g2hr-company-profile', get_template_directory_uri() . '/dashboard/assets/js/company-profile.js', array('g2hr-validator', 'g2hr-mask', 'g2hr-dropzone'));

            wp_enqueue_script('g2hr-company-profile');

            wp_localize_script( 'g2hr-company-profile', 'g2hr_company_profile_object', array(
                'ajax_url'        => admin_url( 'admin-ajax.php' ),
                'redirect_url'    => site_url('dashboard/my-company'),
                'nonce'           => wp_create_nonce('g2hr_company_profile')
            ));
        }

        /**
         * Function used for handling registration AJAX request
         */
        public function update() {

	    check_ajax_referer('g2hr_company_profile', 'nonce');

            $this->set_company(new Go2hr_Companies_Core());

            $company_id = $this->g2hr_companies->get_company_id_by_fid(filter_var($_POST['data']['fid'], FILTER_SANITIZE_STRING));
	    
	    if (!$company_id || is_wp_error($company_id)) {
                wp_send_json_error(
                    array(
                        'title'        =>    __( 'Oops - something is wrong!', 'go2hr' ),
                        'message'    =>    __( 'Company was not found. Please try again.', 'go2hr' ),
                    ),
                    400
                );
            }

            $company_data = [
                'company_name'      =>    filter_var($_POST['data']['company_name'], FILTER_SANITIZE_STRING),
                'sector'            =>    array_map('intval', is_array($_POST['data']['sector']) ? $_POST['data']['sector'] : array($_POST['data']['sector'])),
                'region'            =>    array_map('intval', array(filter_var($_POST['data']['region'], FILTER_SANITIZE_NUMBER_INT))),
                'size'              =>    array_map('intval', array(filter_var($_POST['data']['size'], FILTER_SANITIZE_NUMBER_INT))),
                'type'              =>    array_map('intval', array(filter_var($_POST['data']['type'], FILTER_SANITIZE_NUMBER_INT))),
                'description'       =>    trim(filter_var($_POST['data']['company_description'], FILTER_SANITIZE_STRING)),
                'address'           =>    filter_var($_POST['data']['address'], FILTER_SANITIZE_STRING),
                'city'              =>    filter_var($_POST['data']['city'], FILTER_SANITIZE_STRING),
                'postal_code'       =>    filter_var($_POST['data']['postal_code'], FILTER_SANITIZE_STRING),
                'phone'             =>    filter_var($_POST['data']['phone'], FILTER_SANITIZE_STRING),
                'website'           =>    filter_var($_POST['data']['website'], FILTER_SANITIZE_STRING),
                'facebook'          =>    filter_var($_POST['data']['facebook'], FILTER_SANITIZE_STRING),
                'twitter'           =>    filter_var($_POST['data']['twitter'], FILTER_SANITIZE_STRING),
                'linkedin'          =>    filter_var($_POST['data']['linkedin'], FILTER_SANITIZE_STRING),
                'instagram'         =>    filter_var($_POST['data']['instagram'], FILTER_SANITIZE_STRING),
                'user_id'           =>    get_current_user_id(),
                'company_id'        =>    $company_id
            ];

            $this->set_company(new Go2hr_Companies_Core());
            $update = $this->g2hr_companies->update($company_data);

            if (!$update || is_wp_error($update)) {
                wp_send_json_error(
                    array(
                        'title'        =>    __( 'Oops - something is wrong!', 'go2hr' ),
                        'message'    =>    __( 'Something went wrong. Please check your input and try again.', 'go2hr' ),
                    ),
                    400
                );
            }

            //We are done here
            wp_send_json_success(
                array(
                    'title'        =>    __( 'Success!', 'go2hr' ),
                    'message'    =>    __( 'Your company profile has been successfully updated.', 'go2hr' ),
                ),
                200
            );

            die;
        }

        /**
         * This function handles the company logo upload. Upload is triggered after the main company form is sent via POST request.
         */
	public function logo_upload() {
            //Check security code
            //check_ajax_referer('g2hr_company_registration', 'nonce');

	    if (!empty($_FILES)) {
	        
                $tmp_file = $_FILES['file'];

                //Delete current logo!

                $upload_overrides = array( 'test_form' => false );
                $movefile = wp_handle_upload($tmp_file, $upload_overrides);

                if ($movefile && !isset($movefile['error'])) {
                    $wp_upload_dir = wp_upload_dir();

                    $filetype = wp_check_filetype( basename( $movefile['file'] ), null );

                    $attachment = array(
                        'guid'           => $wp_upload_dir['url'] . '/' . basename( $movefile['file'] ),
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $movefile['file'] ) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );

                    $company_fid = $_REQUEST['company_id'];

                    $this->set_company(new Go2hr_Companies_Core());
                    $company_id = $this->g2hr_companies->get_company_id_by_fid($company_fid);

                    $attach_id = wp_insert_attachment($attachment, $movefile['file'], $company_id);

                    require_once( ABSPATH . 'wp-admin/includes/image.php' );

                    $attach_data = wp_generate_attachment_metadata( $attach_id, $movefile['file'] );
                    wp_update_attachment_metadata( $attach_id, $attach_data );

                    update_post_meta($company_id, 'company_id', $attach_id);
                    set_post_thumbnail($company_id, $attach_id);

                    update_field('company_id', $attach_id, $company_id);
                }
            }

            die;
        }

        /**
         * Used to handle Job Management Rights AJAX request.
         */
//        public function update_management_rights() {
//            //Check security code
//            check_ajax_referer('g2hr_company_profile', 'nonce');
//
//            $data = json_decode(wp_unslash($_POST['data']), TRUE);
//            $this->set_company(new Go2hr_Companies_Core());
//            $company_id = $this->g2hr_companies->get_company_id_by_fid(filter_var($data['fid'], FILTER_SANITIZE_STRING));
//            $hr_company_id = ($data['company'] < 0) ? -1 : $this->g2hr_companies->get_company_id_by_fid(filter_var($data['company'], FILTER_SANITIZE_STRING));
//
//            if(!$company_id || is_wp_error($company_id)) {
//                wp_send_json_error(
//                    array(
//                        'title'        =>    __( 'Oops - something is wrong!', 'go2hr' ),
//                        'message'    =>    __( 'Company was not found. Please try again.', 'go2hr' ),
//                    ),
//                    400
//                );
//            }
//
//            if(strlen( filter_var($data['fid'], FILTER_SANITIZE_STRING) > 5 ) && !is_wp_error($hr_company_id) || !$hr_company_id) {
//                wp_send_json_error(
//                    array(
//                        'title'        =>    __( 'Oops - something is wrong!', 'go2hr' ),
//                        'message'    =>    __( 'Company was not found. Please try again.', 'go2hr' ),
//                    ),
//                    400
//                );
//            }
//
//            $hrdata = [
//                'company_id'    =>    $company_id,
//                'hr_company_id'    =>    $hr_company_id,
//                'date'            =>    date('Ymd')
//            ];
//
//            $this->g2hr_companies->set_id($company_id);
//            $this->g2hr_companies->manage_job_rights($hrdata);
//
//            //We are done here
//            wp_send_json_success(
//                array(
//                    'title'        =>    __( 'Great!', 'go2hr' ),
//                    'message'    =>    __( 'Job management settings are successfully updated.', 'go2hr' ),
//                ),
//                200
//            );
//
//            die;
//        }

    }
