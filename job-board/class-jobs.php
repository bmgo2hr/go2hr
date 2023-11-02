<?php
use Go2HR\Helpers\UserRegistration;

class G2hr_Jobs {

  /**
   * Instance of G2HR Jobs class
   * @var object
   */
  private $g2hr_jobs;

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
   * Dependency Injection for Core Jobs Class
   * @param   Go2hr_Jobs_Core $jobs
   */
  public function set_job(Go2hr_Jobs_Core $jobs) {
    $this->g2hr_jobs = $jobs;
  }

  /**
   * Load necessary scripts and dependencies for add job form. Generates nonce for add job action and sets the method that is going to be used for handling the AJAX call.
   */
  public function init_ajax_add() {
        wp_register_script('g2hr-validator', get_template_directory_uri() . '/dashboard/assets/js/jquery-validator.js');

        wp_register_style('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/css/jquery-confirm.css');
        wp_register_script('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/js/jquery-confirm.min.js');
        wp_register_script('g2hr-jobs', get_template_directory_uri() . '/dashboard/assets/js/job-add.js', array('g2hr-validator', 'g2hr-confirm'));

        wp_enqueue_script('g2hr-jobs');
        wp_enqueue_style('g2hr-confirm');

        wp_localize_script( 'g2hr-jobs', 'g2hr_jobs_object', array(
          'ajax_url'        => admin_url( 'admin-ajax.php'),
          'redirect_url'    => site_url('my-jobs'),
          'nonce'           => wp_create_nonce('g2hr_jobs')
        ));
  }


  /**
   * Load necessary scripts and dependencies for update job form. Generates nonce for update job action and sets the method that is going to be used for handling the AJAX call.
   */
  public function init_ajax_update() {
    wp_register_script('g2hr-validator', get_template_directory_uri() . '/dist/scripts/jquery-validator.js', array('sage/js') );
    wp_register_script('g2hr-jobs', get_template_directory_uri() . '/dist/scripts/job-add.js', array('sage/js', 'g2hr-validator') );
    wp_enqueue_script('g2hr-jobs');

    wp_localize_script( 'g2hr-jobs', 'g2hr_jobs_object', array(
      'ajax_url'        => admin_url( 'admin-ajax.php' ),
      'redirect_url'    => site_url('my-jobs'),
      'nonce'            => wp_create_nonce('g2hr_jobs')
    ));
  }

    public function delete() {

        check_ajax_referer('g2hr_jobs', 'nonce');

        $target_job_ids = $_POST['data']['target_job_ids'];

        // Get the id of the company the user belongs to
        $user_company = get_field('user_company', 'user_' . get_current_user_id());
        $company_id = is_object($user_company) ? $user_company->ID : $user_company;

        $args = array(
            'post_type'             =>  'go2hr_jobs',
            'post_status'           =>  'any',
            'ignore_sticky_posts'   =>  true,
            'meta_query'            =>  array(
                array(
                    'key'           =>  'job_company',
                    'value'         =>  $company_id,
                )
            )
        );
        $query = new WP_Query( $args );
        $post_ids = wp_list_pluck( $query->posts, 'ID' );

        foreach ($target_job_ids as $target_id) {
            if (in_array($target_id, $post_ids)) {
                $post = get_post($target_id);
                if (!empty($post)) {
                    if (!empty($post->post_status)) {
                        $post->post_status = "job_deleted";
                        wp_update_post($post);
                    }
                }
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
              'title'            =>    __( 'Done!', 'go2hr' ),
              'message'        =>    __( 'Job has been successfully added.', 'go2hr' ),
            ),
            200
        );

    die();
  }


    /**
    * Function used for handling add job form via AJAX call
    */
    public function add($data = false, $draft = false, $preview = false) {

        check_ajax_referer('g2hr_jobs', 'nonce');

        //Check if we are actually updating this job?
        if (isset($_POST['data']['fid']) && strlen($_POST['data']['fid']) > 0) {
            $this->update($_POST['data'], $draft, $preview);
        }

      $job_data = [
        'title'                     =>    filter_var($_POST['data']['title'], FILTER_SANITIZE_STRING),
        'level'                     =>    intval(filter_var($_POST['data']['level'], FILTER_SANITIZE_NUMBER_INT)),
        'type'                      =>    array_map('intval', is_array($_POST['data']['type']) ? $_POST['data']['type'] : array($_POST['data']['type'])),
        'status'                    =>    array_map('intval', is_array($_POST['data']['employment_status']) ? $_POST['data']['employment_status'] : array($data->employment_status)),
        'positions'                 =>    ($_POST['data']['positions']) ? filter_var($_POST['data']['positions'], FILTER_SANITIZE_STRING): '',
        'assessible_employer'       =>    filter_var($_POST['data']['assessible_employer'], FILTER_SANITIZE_NUMBER_INT),
        'is_open_work_permit'       =>    filter_var($_POST['data']['is_open_work_permit'], FILTER_SANITIZE_NUMBER_INT),
        'sector'                    =>    array_map('intval', is_array($_POST['data']['sector']) ? $_POST['data']['sector'] : array($_POST['data']['sector'])),
        'region'                    =>    array_map('intval', array(filter_var($_POST['data']['region'], FILTER_SANITIZE_NUMBER_INT))),
        'address1'                  =>    filter_var($_POST['data']['address1'], FILTER_SANITIZE_STRING),
        'description'               =>    $_POST['data']['description'],
        'qualifications'            =>    $_POST['data']['qualifications'],
        'salary'                    =>    filter_var($_POST['data']['salary'], FILTER_SANITIZE_STRING),
        "benefits"                  =>    $_POST['data']['benefits'],
        'application_action'        =>    filter_var($_POST['data']['application_action'], FILTER_SANITIZE_STRING),
        'suggested_training'        =>    (!empty($_POST['data']['suggested_training'])) ? implode( ', ', $_POST['data']['suggested_training']) : "",
        'application_process'       =>    $_POST['data']['application_process'],
        'fid'                       =>    UserRegistration\guidv4(random_bytes(16)),
        'publish'                   =>    'publish',
      ];

      //Determine who is posting this job - the HR company or just any other company?
      $this->set_company(new Go2hr_Companies_Core());

      $user_company = get_field('user_company', 'user_' . get_current_user_id());
      $company_id = is_object($user_company) ? $user_company->ID : $user_company;

      //Get Owner
      $this->g2hr_company->set_id($company_id);
      $owner_id = $this->g2hr_company->get_owner();

      $job_data['author'] = $owner_id;
      $job_data['company'] = $company_id;

      //Add/Update the job
      $this->set_job(new Go2hr_Jobs_Core());
      $job_id = $this->g2hr_jobs->add($job_data);

      if(!$job_id || is_wp_error($job_id)) {
        wp_send_json_error(
          array(
            'title'        =>    __( 'Something is not right.', 'go2hr' ),
            'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
          ),
          400
        );
      }

      $redirect_url = site_url('dashboard/my-jobs');

      wp_send_json_success(
        array(
          "redirect_url"    =>    $redirect_url,
          'title'            =>    __( 'Done!', 'go2hr' ),
          'message'        =>    __( 'Job has been successfully added.', 'go2hr' ),
        ),
        200
      );
      die;
//    }
  }

  /**
   * Function used for handling add job form via AJAX call
   */
  public function update($data, $draft, $preview) {

    $job_data = [
        'title'                     =>    filter_var($_POST['data']['title'], FILTER_SANITIZE_STRING),
        'level'                     =>    intval(filter_var($_POST['data']['level'], FILTER_SANITIZE_NUMBER_INT)),
        'type'                      =>    array_map('intval', is_array($_POST['data']['type']) ? $_POST['data']['type'] : array($_POST['data']['type'])),
        'status'                    =>    array_map('intval', is_array($_POST['data']['employment_status']) ? $_POST['data']['employment_status'] : array($data->employment_status)),
        'positions'                 =>    ($_POST['data']['positions']) ? filter_var($_POST['data']['positions'], FILTER_SANITIZE_STRING): '',
        'assessible_employer'       =>    filter_var($_POST['data']['assessible_employer'], FILTER_SANITIZE_NUMBER_INT),
        'is_open_work_permit'       =>    filter_var($_POST['data']['is_open_work_permit'], FILTER_SANITIZE_NUMBER_INT),
        'sector'                    =>    array_map('intval', is_array($_POST['data']['sector']) ? $_POST['data']['sector'] : array($_POST['data']['sector'])),
        'region'                    =>    array_map('intval', array(filter_var($_POST['data']['region'], FILTER_SANITIZE_NUMBER_INT))),
        'address1'                  =>    filter_var($_POST['data']['address1'], FILTER_SANITIZE_STRING),
        'description'               =>    $_POST['data']['description'],
        'qualifications'            =>    $_POST['data']['qualifications'],
        'salary'                    =>    filter_var($_POST['data']['salary'], FILTER_SANITIZE_STRING),
        "benefits"                  =>    $_POST['data']['benefits'],
        'application_action'        =>    filter_var($_POST['data']['application_action'], FILTER_SANITIZE_STRING),
        'suggested_training'        =>    (!empty($_POST['data']['suggested_training'])) ? implode( ', ', $_POST['data']['suggested_training']) : "",
        'application_process'       =>    $_POST['data']['application_process'],
        'fid'                       =>    filter_var($_POST['data']['fid'], FILTER_SANITIZE_STRING),
        'publish'                   =>    'publish',
//      'publish'                      =>    $draft,
//      'managed_company'          =>    filter_var($data->managed_company, FILTER_SANITIZE_STRING),
//      'application_action'    =>    filter_var($data->application_action, FILTER_SANITIZE_STRING),
//    'start_date'                  =>    filter_var($data->start_date, FILTER_SANITIZE_STRING),
//      'end_date'                    =>    filter_var($data->end_date, FILTER_SANITIZE_STRING)
    ];

    //We really need to check all of this, because someone might fiddle with out form
    //Check Terms

    //Check if currently logged in user can manage this job
    //Especially if we are updating job, not add it
    //
    //

    //Determine the initial status of the job
    //If it is a featured, then we set pending for payment
    //If it is a draft, then draft is set, otherwise we set pending for
      // TODO to check this process if it is necessary?
//    if($draft) $job_data['publish'] = 'job_draft';
//    elseif($preview) $job_data['publish'] = 'job_draft';
//    elseif(!$draft && $data->is_featured == 'on') $job_data['publish'] = 'job_unpaid';
//    elseif(!$draft && $data->is_featured !== 'on') $job_data['publish'] = 'publish';

    //Determine who is posting this job - the HR company or just any other company?
    $this->set_company(new Go2hr_Companies_Core());

    // TODO to check this process if it is necessary?
//    if(strlen($job_data['managed_company']) > 0) { //It is the HR Company
//      if(strlen($job_data['managed_company']) < 36 || strpos($job_data['managed_company'], '-') == 0) {
//        //Not valid UUIDv4
//        wp_send_json_error(
//          array(
//            'title'        =>    __( 'Something is not right.', 'go2hr' ),
//            'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
//          ),
//          400
//        );
//      }

//      $company_id = $this->g2hr_company->get_company_id_by_fid($job_data['managed_company']);
//      $hr_company_id = get_field('user_company', 'user_' . get_current_user_id());
//      $job_data['hr_company_id'] = $hr_company_id->ID;
//    } else {
//      $user_company = get_field('user_company', 'user_' . get_current_user_id());
//      $company_id = is_object($user_company) ? $user_company->ID : $user_company;
//    }

    /////////// TODO check
    $user_company = get_field('user_company', 'user_' . get_current_user_id());
    $company_id = is_object($user_company) ? $user_company->ID : $user_company;
    ///////////

    //Get Owner
    $this->g2hr_company->set_id($company_id);
    $owner_id = $this->g2hr_company->get_owner();

    $job_data['author'] = $owner_id;
    $job_data['company'] = $company_id;

    //Add/Update the job
    $this->set_job(new Go2hr_Jobs_Core());

    $job_data['job_id'] = $this->g2hr_jobs->get_job_id_by_fid($job_data['fid']);
    $job_id = $this->g2hr_jobs->update($job_data);


    if (!$job_id || is_wp_error($job_id)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    //If Featured is set we should generate Invoice here
//    if($job_data['is_featured'] == 'on') {
//      $go2hr_purchase = new Go2hr_Payments_Core($job_data['fid']);
//      $purchase = $go2hr_purchase->generate_purchase();
//    }

    $redirect_url = site_url('dashboard/my-jobs');
//    if($data->is_featured == 'on') {
//      $redirect_url = site_url('dashboard/my-invoices/invoice/?iid=' . $purchase['meta']['invoice_number'][0]);
//    }

//    if($preview) {
//      $redirect_url = get_permalink($job_id);
//    }

    wp_send_json_success(
      array(
        'redirect_url'    =>    $redirect_url,
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'Job has been successfully updated.', 'go2hr' ),
      ),
      200
    );

    die;
  }

  /**
   * Handles AJAX request for Job Duplication
   * @author Igor Hrcek (igor.hrcek@mint.rs)
   * @date    2017-08-02
   * @version 1.0.0
   */
  public function duplicate() {
    //Check security code
    check_ajax_referer('g2hr_jobs', 'nonce');

    $fid = filter_var($_POST['fid'], FILTER_SANITIZE_STRING);

    $this->set_job(new Go2hr_Jobs_Core());
    $job_id = $this->g2hr_jobs->get_job_id_by_fid($fid);

    if(!$job_id || is_wp_error($job_id)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    //We need to check if this job can be managed by this user
    //
    //

    //Duplicate the post
    //We send the original Job ID and the new FID
    $new_fid = UserRegistration\guidv4(random_bytes(16));
    $duplicate = $this->g2hr_jobs->duplicate_job($job_id, $new_fid);

    if(!$duplicate || is_wp_error($duplicate)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    wp_send_json_success(
      array(
        'redirect_url'    =>    site_url('dashboard/my-jobs/modify-job/?fid=' . $new_fid),
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'Job has been successfully duplicated. Please wait while we redirect you to that job.', 'go2hr' ),
      ),
      200
    );

    die;
  }
  /**
   * Handles AJAX request for Job Deactivation
   * @author David He
   * @date    2018-05-13
   * @version 1.0.0
   */
  public function deactivate() {
    //Check security code
    check_ajax_referer('g2hr_jobs', 'nonce');

    $fid = filter_var($_POST['fid'], FILTER_SANITIZE_STRING);

    $this->set_job(new Go2hr_Jobs_Core());
    $job_id = $this->g2hr_jobs->get_job_id_by_fid($fid);

    if(!$job_id || is_wp_error($job_id)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot deactivate this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    $post = get_post($job_id);
    if(!empty($post)){
      if(!empty($post->post_status)){
        $post->post_status = "job_expired";
      }
    }
    wp_update_post($post);

    wp_send_json_success(
      array(
        'redirect_url'    =>    site_url('dashboard/my-jobs'),
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'This job posting has been deactivated.', 'go2hr' ),
      ),
      200
    );

    die;
  }

  /**
   * Handles AJAX request for Job Renewal
   * @author Craig Vanderlinden
   * @date    2018-04-26
   * @version 1.0.0
   */
  public function renew() {
    //Check security code
    check_ajax_referer('g2hr_jobs', 'nonce');

    $fid = filter_var($_POST['fid'], FILTER_SANITIZE_STRING);

    $this->set_job(new Go2hr_Jobs_Core());
    $job_id = $this->g2hr_jobs->get_job_id_by_fid($fid);

    if(!$job_id || is_wp_error($job_id)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    $post = get_post($job_id);

    wp_update_post($post);

    wp_send_json_success(
      array(
        'redirect_url'    =>    site_url('dashboard/my-jobs'),
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'This job posting has been renewed for another 30 days.', 'go2hr' ),
      ),
      200
    );

    die;
  }

  /**
   * Publishes a job via single click
   * @author Craig Vanderlinden
   * @date 2019-01-05
   *
   */

  public function publish() {
    $job_id = $_POST['job_id'];

    $post = get_post($job_id);
    if(!empty($post)){
      if(!empty($post->post_status)){
        $post->post_status = "publish";
      }
    }
    wp_update_post($post);

    wp_send_json_success(
      array(
        'redirect_url'    =>    site_url('dashboard/my-jobs'),
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'This job phas been successfully posted.', 'go2hr' ),
      ),
      200
    );
  }

  /**
   * Handles AJAX request for Job Archival
   * @author Craig Vanderlinden
   * @date    2018-04-26
   * @version 1.0.0
   */
  public function archive() {
    //Check security code
    check_ajax_referer('g2hr_jobs', 'nonce');

    $fid = filter_var($_POST['fid'], FILTER_SANITIZE_STRING);

    $this->set_job(new Go2hr_Jobs_Core());
    $job_id = $this->g2hr_jobs->get_job_id_by_fid($fid);

    if(!$job_id || is_wp_error($job_id)) {
      wp_send_json_error(
        array(
          'title'        =>    __( 'Something is not right.', 'go2hr' ),
          'message'    =>    __( 'We cannot update this job. Please check your input and try again.', 'go2hr' ),
        ),
        400
      );
    }

    $post = get_post($job_id);
    if(!empty($post)){
      if(!empty($post->post_status)){
        $post->post_status = "job_archived";
      }
    }
    wp_update_post($post);

    wp_send_json_success(
      array(
        'redirect_url'    =>    site_url('dashboard/my-jobs'),
        'title'            =>    __( 'Done!', 'go2hr' ),
        'message'        =>    __( 'This job posting has been archived.', 'go2hr' ),
      ),
      200
    );

    die;
  }




}
