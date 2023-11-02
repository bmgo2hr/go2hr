<?php
	use Go2HR\Helpers\UserRegistration;
	use Go2HR\Helpers\UserProfile;

	class G2hr_Subuser_Invitation {
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
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-07-05
		 * @version 1.0.0
		 * @param   Go2hr_Users_Core $users
		 */
		public function set_users(Go2hr_Users_Core $users) {
			$this->g2hr_users = $users;
		}

		/**
		 * Dependency Injection for Core CompanyyClass
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-07-05
		 * @version 1.0.0
		 * @param   Go2hr_Users_Core $users
		 */
		public function set_company(Go2hr_Companies_Core $company) {
			$this->g2hr_company = $company;
		}

		/**
		 * Load necessary scripts and dependencies for Password Reset form. Generates nonce for password reset action and sets the method that is going to be used for handling the AJAX call.
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-05
		 * @version 1.0.0
		 */
		public function init_ajax_invitation() {
//			wp_register_script('g2hr-validator', get_template_directory_uri() . '/dist/scripts/jquery-validator.js', array('sage/js') );
//			wp_register_script('g2hr-subuser-invitation', get_template_directory_uri() . '/dist/scripts/subuser-invite.js', array('sage/js', 'g2hr-validator') );
//			wp_enqueue_script('g2hr-subuser-invitation');

//			wp_localize_script( 'g2hr-subuser-invitation', 'g2hr_subuser_invitation_object', array(
//				'ajax_url'		=> admin_url( 'admin-ajax.php' ),
//				'redirect_url'	=> site_url('dashboard'),
//				'nonce'			=> wp_create_nonce('g2hr_subuser_invitation')
//			));
		}

		/**
		 * Function used for handling e-mail check AJAX request
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-05
		 * @version 1.0.0
		 */
		public function check_email() {
			//Check security code
			check_ajax_referer('g2hr_subuser_invitation', 'nonce');

			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

			//Check email again, never trust the user!
			$does_exist = email_exists($email);

			if(!$does_exist) {
				wp_send_json_error(
					array(
						'title'		=>	__( 'Can\'t do that!', 'go2hr' ),
						'message'	=>	__( 'There is no user with this email address.', 'go2hr' ),
					),
					400
				);
			}

			//Message for job seekers
			wp_send_json_success(
				__( 'Success.', 'go2hr' ),
				200
			);

			die;
		}

		/**
		 * Function used for handling invite AJAX request
		 * @author Igor Hrcek (igor.hrcek@mint.rs), updated by David He
		 * @date    2018-05-23
		 * @version 1.0.1
		 */
		public function invite() {
			//Check security code
			check_ajax_referer('g2hr_subuser_invitation', 'nonce');

			$data = json_decode(wp_unslash($_POST['data']));

			//Check email again, never trust the user!
			$does_exist = email_exists($data->user_email);
			if(!$does_exist) {
				wp_send_json_error(
					array(
						'title'		=>	__( 'Can\'t do that!', 'go2hr' ),
						'message'	=>	__( 'There is no user with such email address. Check your input and try again.', 'go2hr' ),
					),
					400
				);
			}

			//Do not allow migration of any account that is not with role of Job Seeker
			$this->set_users(new Go2hr_Users_Core());
			$user = $this->g2hr_users->get_user_by_email($data->user_email);

			$this->g2hr_users->set_id($user->data->ID);
			if(!$this->g2hr_users->is_job_seeker()) {
				wp_send_json_error(
					array(
						'title'		=>	__( 'Try Again!', 'go2hr' ),
						'message'	=>	__( 'Hmm...looks like the user you are trying to add is already associated with another company. Please try a different email or have the user update their profile.', 'go2hr' ),
					),
					400
				);
			}

			//We need the company ID of current user
			$the_id = get_field('user_company', 'user_' . get_current_user_id());
			$company_id = is_object($the_id) ? $the_id->ID : $the_id;

			//Set data
			$invite_data = array(
				'company_invitation_email'		=>	$data->user_email,
				'company_invitation_type'		=>	'invitation',
				'company_invitation_date'		=>	date('Ymd'),
				'company_invitation_token'		=>	UserRegistration\guidv4(random_bytes(16)),
				'invitation_status'				=>	'pending',
			);

			$this->set_company(new Go2hr_Companies_Core($company_id));
			$invite = $this->g2hr_company->add_invitation($invite_data);

			wp_send_json_success(
				array(
					'title'		=>	__( 'Invitation Sent!', 'go2hr' ),
					'message'	=>	__( 'Your invitation has been sent to the user. Please wait while we redirect you back to My Users page.', 'go2hr' ),
				),
				200
			);

			die;
		}

		/**
		 * This function handles the Confirm AJAX call (Invited User accepts invitation sent by the Company)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-05
		 * @version 1.0.0
		 */
		public function confirm() {
			//Check security code
			check_ajax_referer('g2hr_subuser_invitation', 'nonce');

			$data = json_decode(wp_unslash($_POST['data']));
			$this->set_company( new Go2hr_Companies_Core() );
			$invitation = $this->g2hr_company->get_invitation( $data->token );

			if($data->accept === "Accept") {

				if ( ! $invitation || $invitation['invitation']['invitation_status'] !== 'pending' ) {
					wp_send_json_error(
						array(
							'title'   => __( 'Can\'t do that!', 'go2hr' ),
							'message' => __( 'This invitation is no longer valid.', 'go2hr' ),
						),
						400
					);
				}

				$this->g2hr_company->set_id( $invitation['company']->ID );
				$this->g2hr_company->confirm_invitation( $data->token, $data->role );

				wp_send_json_success(
					array(
						'title'   => __( 'Confirmed!', 'go2hr' ),
						'message' => __( 'Thanks for your confirmation. Please wait while we redirect you back to the Dashboard.', 'go2hr' ),
					),
					200
				);
			}
			else {
				$this->set_company(new Go2hr_Companies_Core($invitation['company']->ID));
				$this->g2hr_company->decline_invitation($data->token);

				wp_send_json_success(
					array(
						'title'		=>	__( 'Done!', 'go2hr' ),
						'message'	=>	__( 'The request has been declined.', 'go2hr' ),
					),
					200
				);
			}

			die;
		}

		/**
		 * Handles the Cancel action for Invitations on Invitations Table List
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-05
		 * @version 1.0.0
		 */
		public function cancel() {
			//Check security code
			check_ajax_referer('g2hr_subuser_invitation', 'nonce');

			$token = filter_var($_POST['token'], FILTER_SANITIZE_STRING);

			//We need the company ID of current user
			$company_id = get_field('user_company', 'user_' . get_current_user_id());

			$this->set_company(new Go2hr_Companies_Core($company_id));
			$this->g2hr_company->cancel_invitation($token);

			wp_send_json_success(
				array(
					'title'		=>	__( 'Done!', 'go2hr' ),
					'message'	=>	__( 'The invitation has been declined. Please wait...', 'go2hr' ),
				),
				200
			);

			die;

		}

		/**
		 * Function used for handling Apply AJAX request (this request is made by Job Seeker)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-05
		 * @version 1.0.0
		 */
		public function apply() {
			//Check security code
			check_ajax_referer('g2hr_subuser_invitation', 'nonce');

			$data = json_decode(wp_unslash($_POST['data']));

			//Do not allow migration of any account that is not with roile of Job Seeker
			$this->set_users(new Go2hr_Users_Core(get_current_user_id()));
			$user = $this->g2hr_users->get_user();

			if(!$this->g2hr_users->is_job_seeker()) {
				wp_send_json_error(
					array(
						'title'		=>	__( 'Permission denied!', 'go2hr' ),
						'message'	=>	__( 'Your are not allowed to send application.', 'go2hr' ),
					),
					400
				);
			}

			//We need the company ID
			$company_id = filter_var($data->company, FILTER_SANITIZE_NUMBER_INT);
			$this->set_company(new Go2hr_Companies_Core($company_id));
			$company = $this->g2hr_company->get_company();

			if(!$company || count($company) == 0) {
				wp_send_json_error(
					array(
						'title'		=>	__( 'Hmmm...', 'go2hr' ),
						'message'	=>	__( 'We do not have this company in the system. Please check your request and try again.', 'go2hr' ),
					),
					400
				);
			}

			//Get information about current user
			$user = get_userdata(get_current_user_id());

			//Set data
			$invite_data = array(
				'company_invitation_email'		=>	$user->user_email,
				'company_invitation_type'		=>	'application',
				'company_invitation_date'		=>	date('Ymd'),
				'company_invitation_token'		=>	UserRegistration\guidv4(random_bytes(16)),
				'invitation_status'				=>	'pending',
			);

			$invite = $this->g2hr_company->add_invitation($invite_data);

			wp_send_json_success(
				array(
					'title'		=>	__( 'Done!', 'go2hr' ),
					'message'	=>	__( 'Your application has been sent away. Please wait while we redirect you back to Dashboard.', 'go2hr' ),
				),
				200
			);

			die;
		}
	}
