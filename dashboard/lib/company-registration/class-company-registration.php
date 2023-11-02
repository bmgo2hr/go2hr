<?php
use Go2HR\Helpers\UserRegistration;

class G2hr_Company_Registration {

    /**
    * Instance of G2HR Companies class
    * @var object
    */
    private $g2hr_companies;

    /**
    * Dependency Injection for Core Company Class
    * @param   Go2hr_Companies_Core $companies
    */
    public function set_company(Go2hr_Companies_Core $companies) {
    $this->g2hr_companies = $companies;
    }

    /**
    * Load necessary scripts and dependencies for Company Registration form. Generates nonce for registration action and sets the method that is going to be used for handling the AJAX call.
    */
    public function init_ajax_registration() {

        wp_register_script('g2hr-validator', get_template_directory_uri() . '/assets/js/jquery-validator.js');
        wp_register_script('g2hr-mask', get_template_directory_uri() . '/assets/js/jquery-mask.js');
        wp_register_script('g2hr-company-registration', get_template_directory_uri() . '/assets/js/dashboard/company-registration.js', array('g2hr-validator', 'g2hr-mask'));
        wp_enqueue_script('g2hr-company-registration');

        wp_localize_script( 'g2hr-company-registration', 'g2hr_company_registration_object', array(
            'ajax_url'		=> admin_url( 'admin-ajax.php' ),
            'redirect_url'	=> site_url('register-company/success'),
            'nonce'			=> wp_create_nonce('g2hr_company_registration')
        ));
    }

    /**
    * Logo uploader for Company
    */
    public function logo_upload() {
        //Check security code
        //check_ajax_referer('g2hr_company_registration', 'nonce');

        if(!empty($_FILES)) {
          $tmp_file = $_FILES['file'];

          $upload_overrides = array( 'test_form' => false );
          $movefile = wp_handle_upload($tmp_file, $upload_overrides);

          if ($movefile && !isset($movefile['error'])) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );

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

            $attach_data = wp_generate_attachment_metadata( $attach_id, $movefile['file'] );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            //set_post_thumbnail($company_id, $attach_id);

            update_field('company_id', $attach_id, $company_id);
          }
        }

        die;
    }

}
