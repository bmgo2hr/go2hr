<?php
	/**
	 * Events Trigger Class
	 *
	 * Provides methods for for each registered System Event
	 */

	class G2hr_Events_Trigger {

		/**
		 * FUnction returns the content of e-mail template based on action
		 * @param   string     $action Action name
		 * @return  object
		 */
		public function get_email_template($action) {
			$args = [
				'post_type'		=>		'go2hr_emailtemplates',
				'meta_query'	=>		array(
						array(
							'key'		=>	'template_action',
							'value'		=>	$action,
							'compare'	=>	'='
						)
					)
			];

			$res = new WP_Query($args);

			if(!$res->have_posts()) return false;

			return $res->posts[0];
		}

		/**
		 * Wraps the body into HTML boilerplate
		 * @param   string     $content HTML content
		 * @return  string
		 */
		public function pack_html($title, $content) {
			$boilerplate = file_get_contents(locate_template("dashboard/templates/layouts/email-bolierplate.php"));

			return sprintf($boilerplate, $title, $content);
		}

		/**
		 * Generic wrapper around wp_mail. Does not milk cows, obviously.
		 * @param   string     $to      To whom are we sending email
		 * @param   string     $title   Subject
		 * @param   string     $message HTML content
		 * @return  boolean
		 */
		public function send($to, $title, $message) {
			return wp_mail($to, wp_specialchars_decode( $title ), $message);
		}

		/**
		 * System event fired when user is registered and awaits activation
		 * @param   array     $args Arguments
		 * @return  boolean
		 */
		public function notify_user_activation($args) {

		    $template = $this->get_email_template(__FUNCTION__);

			//Generate User Activation URL
			$url = site_url('register/activate/?key='.$args['key']);

			//Get user info
			$user = get_user_by('ID', $args['user_id']);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->display_name, $url, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->user_email, $template->post_title, $html);

		}

		/**
		 * System event fired when user is activated. Sent to Admin.
		 * @param   array     $args Arguments
		 * @return  boolean
		 */
		public function notify_admin_user_activation($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Generate User Activation URL
			//$url = get_edit_user_link($args['user']->data->ID);
			$url = get_admin_url() . 'user-edit.php?user_id=' . $args['user']->data->ID;

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $args['user']->data->display_name, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_user_registration');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Company is registered (sent to user)
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_company_registration($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('ID', $args['user_id']);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $args['user']->data->display_name);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($args['user']->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Company is registered (sent to admin)
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_company_registration($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Generate Edit url
			$url = admin_url('post.php?post=' . $company->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $company->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_company_registration');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Company is approved (sent to user)
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_company_approved($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is addend and it is pending review
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_job_validation($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Generate Edit url
			$url = admin_url('post.php?post=' . $args['post']->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $args['post']->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_job_validation');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is republished (was active, but some changes were made and user sent it for a new review). Sent to Admin.
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-27
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_job_republished($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Generate Edit url
			$url = admin_url('post.php?post=' . $args['post']->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $args['post']->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_job_validation');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is unpublished (was active, but some changes were made and user saved it as draft). Sent to Admin.
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-27
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_job_unpublished($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Generate Edit url
			$url = admin_url('post.php?post=' . $args['post']->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $args['post']->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_job_validation');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is approved
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_job_approved($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);
			$permalink = get_permalink($args['post']->ID);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $permalink);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is set as expired (managed by cron)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_job_expired($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $args['post']->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Event is added and it is pending review
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_event_validation($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Generate Edit url
			$url = admin_url('post.php?post=' . $args['post']->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			//Fetch address of recipient
			$to = get_theme_mod('e_event_validation');

			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Event is approved and set as Active
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_event_approved($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $args['post']->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Job is set as expired (managed by cron)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_event_expired($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $args['post']->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Invoice is created (sent to user)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_invoice_created($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Get Invoice ID
      $invoice_number = $args['post']->ID;

      // Invoice Link
      $invoice_link = get_site_url() . '/dashboard/my-invoices/invoice?iid=' . $invoice_number;

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $invoice_number, $invoice_link);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Invoice is created (sent to admin)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_invoice_created($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Get Invoice ID
			$invoice_number = $args['post']->ID;

			// Invoice Link - Not required by admin at this time
      // $invoice_link = get_site_url() . '/dashboard/my-invoices/invoice?iid=' . $invoice_number;

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $invoice_number);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$to = get_theme_mod('e_purchase_information');
			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired after Invoice is paid (sent to user)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_user_invoice_paid($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Get Invoice ID
			$invoice_number = get_field('invoice_number', $args['post']->ID);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $invoice_number);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired after Invoice is paid (sent to admin)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args A list of arguments
		 */
		public function notify_admin_invoice_paid($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user_id = $args['post']->post_author;
			$user = get_user_by('ID', $user_id);

			//Get Invoice ID
			$invoice_number = get_field('invoice_number', $args['post']->ID);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $invoice_number);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$to = get_theme_mod('e_purchase_information');
			$this->send($to, $template->post_title, $html);
		}

		/**
		 * System event fired when User Invitation is sent by Company Owner
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 */
		public function notify_user_invited($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('email', $args['user_email']);

			//Get company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Generate Activation URL
			$url = site_url('dashboard/my-profile/review-invitation/?token=' . $args['token']);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $company->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired when User applies for company
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_company_applied($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('email', $args['user_email']);

			//Get Compamny Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Owner Information
			$owner = get_user_by('ID', $company->post_author);

			//Generate Activation URL
			$url = site_url('dashboard/my-profile/review-application/?token=' . $args['token']);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $owner->data->display_name, $user->data->display_name, $company->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($owner->data->user_email, $template->post_title, $html);
		}

		public function notify_company_application_user($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('email', $args['user_email']);

			//Get Compamny Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $company->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($args['user_email'], $template->post_title, $html);
		}

		public function notify_user_application_declined($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('email', $args['user_email']);

			//Get Compamny Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $company->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($args['user_email'], $template->post_title, $html);
		}

		/**
		 * System event fired when User accepts invitation
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-07
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_user_application_accepted($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('email', $args['user_email']);

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $company->post_title);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired when Company accepts application
		 * @author Igor Hrcek (igor.hrcek@mint.rs), updated by David He
		 * @date	2018-05-13
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_company_invitation_accepted($args) {
			$template = $this->get_email_template(__FUNCTION__);
			$data = stripslashes($_REQUEST['data']);
			$data = json_decode($data);
			$token = $data->token;

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			if(!empty($token)){
				$invitation = $g2hr_company->get_invitation($token);
				if(!empty($invitation)){
					$user_email = $invitation['invitation']['company_invitation_email'];
				}else{
					$user_email = '';
				}
			}else{
				$user_email = '';
			}
			//Get User Info
			$user = get_user_by('email', $user_email);

			//Owner Information
			$owner = get_user_by('ID', $company->post_author);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $owner->data->display_name, $user->data->display_name);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($owner->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired when new sub user is added
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-26
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_subuser_account_registered($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('ID', $args['user_id']);

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Owner Information
			$owner = get_user_by('ID', $company->post_author);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $user->data->display_name, $company->post_title, $owner->data->display_name, $company->post_title, home_url('login'), $company->post_title, home_url('register'));

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$this->send($user->data->user_email, $template->post_title, $html);
		}

		/**
		 * System event fired when new sub user is added (admin notification)
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-26
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_admin_subuser_account_registered($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get User Info
			$user = get_user_by('ID', $args['user_id']);

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Owner Information
			$owner = get_user_by('ID', $company->post_author);

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $company->post_title,  $user->data->display_name, $owner->data->display_name);

			//Prep the HTML
			$html = $this->pack_html(sprintf($template->post_title, $company->post_title), $content);

			$to = get_theme_mod('e_subuser_registration');
			$this->send($to, sprintf($template->post_title, $company->post_title), $html);
		}

		/**
		 * System event triggered when company updates its profile. Sent to admin.
		 * @author Igor Hrcek (igor.hrcek@mint.rs)
		 * @date    2017-08-26
		 * @version 1.0.0
		 * @param   array     $args
		 */
		public function notify_admin_company_profile_update($args) {
			$template = $this->get_email_template(__FUNCTION__);

			//Get Company Info
			$g2hr_company = new Go2hr_Companies_Core($args['company_id']);
			$company = $g2hr_company->get_company();

			//Generate Edit url
			$url = admin_url('post.php?post=' . $company->ID . '&action=edit');

			//Prep the content
			$content = sprintf(wpautop($template->post_content), $company->post_title, $url);

			//Prep the HTML
			$html = $this->pack_html($template->post_title, $content);

			$to = get_theme_mod('e_company_profile_update');

			// TODO comment out
			//$this->send($to, $template->post_title, $html);
		}

	}
