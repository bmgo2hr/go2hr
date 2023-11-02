<?php

class G2hr_User_Registration {

  /**
   * Instance of G2HR Users class
   * @var object
   */
  private $g2hr_users;

  /**
   * Instance of G2HR Mailer class
   * @var object
   */
  private $g2hr_mailer;

  public function set_users(Go2hr_Users_Core $users) {
    $this->g2hr_users = $users;
  }

  public function set_mailer(Go2hr_Users_Mailing $mailing) {
    $this->g2hr_mailer = $mailing;
  }

  public function init_ajax_registration() {
    wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');
    wp_register_script('g2hr-mask', get_template_directory_uri() . '/dashboard/assets/js/jquery-mask.js');

    wp_register_script('g2hr-dropzone', get_template_directory_uri() . '/dashboard/assets/js/dropzone.js');
    wp_register_script('g2hr-user-registration', get_template_directory_uri() . '/dashboard/assets/js/user-registration.js', array('jquery-file', 'g2hr-validator', 'g2hr-dropzone', 'g2hr-mask'));
    wp_enqueue_script('g2hr-user-registration');

    wp_localize_script( 'g2hr-user-registration', 'g2hr_user_registration_object', array(
        'ajax_url'      => admin_url( 'admin-ajax.php' ),
        'redirect_url'  => site_url('company-registration-success'),
        'nonce'         => wp_create_nonce('g2hr_user_registration')
    ));
  }

  public function register() {

      check_ajax_referer('g2hr_user_registration', 'nonce');

      $user_data = $this->register_user($_POST);
      $company_data = $this->register_company($_POST, $user_data['id']);

      wp_send_json_success(
        array(
          "company_id"  =>  $company_data['fid']
        ),
        200
      );
      die;
  }

  private function register_user($data) {
      $userdata = array(
          "email"           => $data['data']['user_email'],
          "username"        => $data['data']['username'],
          "password"        => $data['data']['user_password'],
          "first_name"      => filter_var($data['data']['first_name'], FILTER_SANITIZE_STRING),
          "last_name"       => filter_var($data['data']['last_name'], FILTER_SANITIZE_STRING),
          "user_phone"      => filter_var($data['data']['user_phone'], FILTER_SANITIZE_STRING),
          "occupation"      => filter_var($data['data']['occupation'], FILTER_SANITIZE_NUMBER_INT),
          "city"            => filter_var($data['data']['city'], FILTER_SANITIZE_STRING),
          "postal_code"     => filter_var($data['data']['postal_code'], FILTER_SANITIZE_STRING),
          "newsletter"      => filter_var($data['data']['newsletter'], FILTER_SANITIZE_STRING),
      );

      $this->set_users(new Go2hr_Users_Core());
      $user_id = $this->g2hr_users->register($userdata);

      if (!$user_id || is_wp_error($user_id)) {
        echo "BAD USERID ERROR...";
            wp_send_json_error(
                __( 'Something went wrong. Please check your input and try again.', 'go2hr' ),
                400
            );
      }

      $key = uniqid('act_', TRUE);
      $this->g2hr_users->add_meta($user_id, 'activation_key', $key);

      $args = [
        'user_id' => $user_id,
        'key' => $key
      ];

      G2hr_System_Events::getInstance()->trigger('user_activation', $args);

      $userdata['id'] = $user_id;

      return $userdata;
  }

  private function register_company($data, $user_id) {

        $company_data = [
            'company_name'      => filter_var($data['data']['company_name'], FILTER_SANITIZE_STRING),
            'description'       => filter_var($data['data']['description'], FILTER_SANITIZE_STRING),
            'address'           => filter_var($data['data']['address'], FILTER_SANITIZE_STRING),
            'city'              => filter_var($data['data']['company_city'], FILTER_SANITIZE_STRING),
            'postal_code'       => filter_var($data['data']['company_postal_code'], FILTER_SANITIZE_STRING),
            'phone'             => filter_var($data['data']['phone'], FILTER_SANITIZE_STRING),
            'website'           => filter_var($data['data']['website'], FILTER_SANITIZE_STRING),
            'facebook'          => filter_var($data['data']['facebook'], FILTER_SANITIZE_STRING),
            'twitter'           => filter_var($data['data']['twitter'], FILTER_SANITIZE_STRING),
            'linkedin'          => filter_var($data['data']['linkedin'], FILTER_SANITIZE_STRING),
            'instagram'         => filter_var($data['data']['instagram'], FILTER_SANITIZE_STRING),
            'region'            => array_map('intval', array(filter_var($data['data']['region'], FILTER_SANITIZE_NUMBER_INT))),
            'size'              => array_map('intval', array(filter_var($data['data']['size'], FILTER_SANITIZE_NUMBER_INT))),
            'type'              => array_map('intval', array(filter_var($data['data']['type'], FILTER_SANITIZE_NUMBER_INT))),
            'sector'            => array_map('intval', is_array($data['data']['sector']) ? $data['data']['sector'] : array($data['data']['sector'])),
            'user_id'           => $user_id,
            'fid'               => \Go2HR\Helpers\UserRegistration\guidv4(random_bytes(16))
        ];

        $company_core = new Go2hr_Companies_Core();

        $company_id = $company_core->register($company_data);

        if (!$company_id || is_wp_error($company_id)) {
            wp_send_json_error(
                __( 'Something went wrong. Please check your input and try again.', 'go2hr' ),
                400
            );
        }

        //Send mail to new owner and administrator
        //\G2hr_System_Events::getInstance()->trigger("company_registration", array('user_id' => get_current_user_id())); // It will be shown on the page, so we don't need it?
        \G2hr_System_Events::getInstance()->trigger("company_registration_admin", array('company_id' => $company_id));

        return $company_data;

  }

  public function check_email() {
      check_ajax_referer('g2hr_user_registration', 'nonce');
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
        check_ajax_referer('g2hr_user_registration', 'nonce');

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

