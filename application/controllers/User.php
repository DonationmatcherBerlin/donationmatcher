<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class User extends CI_Controller {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model(array('user_model', 'facility_model'));

	}


	public function index() {
		if($_SESSION['logged_in']) redirect('/user/profile');
		redirect('/user/register');
	}

	/**
	 * register function.
	 *
	 * @access public
	 * @return void
	 */
	public function register() {

		check_role('logged_out');

		// create the data object
		$data = new stdClass();

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

		$this->form_validation->set_rules('facility_person_in_charge', 'Verantwortliche Person', 'trim|required');
		$this->form_validation->set_rules('facility_phone', 'Telefon', 'trim');
		$this->form_validation->set_rules('facility_name', 'Facility Name', 'trim|required');

		if ($this->form_validation->run() === false) {

			// validation not ok, send validation errors to the view
			$this->load->view('header', array('current_view' => 'register'));
			$this->load->view('user/register/progressbar', array('step' => 1));
			$this->load->view('user/register/step1', $data);
			$this->load->view('footer');

		} else {

			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');

			$facility = new stdClass;
			$facility->person_in_charge = $this->input->post('facility_person_in_charge');
			$facility->phone = $this->input->post('facility_phone');
			$facility->name = $this->input->post('facility_name');

			$user = new stdClass;
			$user->username   = $username;
			$user->email      = $email;
			$user->password   = $password;
			// set unique key for confirmation email
			$user->confirmation_key = hash('sha256',rand().uniqid().$password); // @TODO: Is this secure or stupid?

			if($user_id = $this->user_model->create_user($user)){

				$facility->User = $user_id;
				$this->facility_model->create_facility($facility); // @TODO: error handling
				$this->send_email($email,$username,'confirm',array('confirmation_key' => $user->confirmation_key));

				// user creation ok
				$this->load->view('header', array('current_view' => 'register'));
				$this->load->view('user/register/progressbar', array('step' => 2));
				$this->load->view('user/register/step2', array('user' => $user, 'facility' => $facility));
				$this->load->view('footer');

			}else{

				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';

				// send error to the view
				$this->load->view('header', array('current_view' => 'register'));
				$this->load->view('user/register/progressbar', array('step' => 1));
				$this->load->view('user/register/step1', array('user' => $user, 'facility' => $facility));
				$this->load->view('footer');

			}

		}

	}

	/**
	 * login function.
	 *
	 * @access public
	 * @return void
	 */
	public function confirm($confirmation_key,$username){

			$this->load->model(array('stock_list_entry_model','stock_list_model'));
			$user_id = $this->user_model->get_user_id_from_username($username);
			$user = $this->user_model->get_user($user_id);

			if($user->is_confirmed == 1) redirect('/user/profile');

			if($confirmation_key == $user->confirmation_key){
				$data = new stdClass;
				$data->is_confirmed = 1;
				$this->user_model->update_user($user_id, $data);

				$facility = $this->facility_model->get_facility_by_user_id($user_id);
				
				// create initial stocklist entries
				$this->stock_list_model->createStockList($facility->facility_id);
				$this->stock_list_entry_model->insert_empty_stocklist_entries($facility->facility_id);

				$user->is_confirmed = 1;
				$user->logged_in = 1;
				$this->set_session($user);
				redirect('/user/step3');
			}else{ // @TODO: Handle also already confirmed users.
				$data = new stdClass;
				$data->error = 'Ungültiger Confirmation Code';
				//print_r($data); // @TODO: Load error view
			}

	}


	/**
	 * login function.
	 *
	 * @access public
	 * @return void
	 */
	public function login() {

		check_role('logged_out');

		// create the data object
		$data = new stdClass();

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {

			// validation not ok, send validation errors to the view

			$this->load->view('user/login/login');

		} else {

			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->user_model->resolve_user_login($username, $password)) {

				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);

				$this->set_session($user);

				// user login ok
				redirect('/stocklist');

			} else {

				// login failed
				$data->error = 'Wrong username or password.';

				// send error to the view
				$this->load->view('user/login/login', $data);


			}

		}

	}

	public function step3($is_signup = false){
		$this->profile(true);
	}

	/**
	 * profile edit function.
	 *
	 * @access public
	 * @return void
	 */
	public function profile($is_signup = false){

		check_role('confirmed');

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->user_model->get_user($_SESSION['user_id']);
		$username = $user->username;
		$facility = $this->facility_model->get_facility_by_user_id($_SESSION['user_id']);

		// password required by sign up or by changing it
		if($this->input->post('password') != ''){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
			$password = $this->input->post('password');
		}

		$this->form_validation->set_rules('facility_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('facility_person_in_charge', 'Verantwortliche Person', 'trim');
		$this->form_validation->set_rules('facility_phone', 'Telefon', 'trim');
		$this->form_validation->set_rules('facility_name', 'Facility Name', 'trim|required');

		$this->form_validation->set_rules('facility_organisation', 'Facility Organisation', 'trim');
		$this->form_validation->set_rules('facility_address', 'Facility Address', 'trim|required');
		$this->form_validation->set_rules('facility_zip', 'Facility ZIP', 'trim|required');
		$this->form_validation->set_rules('facility_city', 'Facility City', 'trim|required');
		$this->form_validation->set_rules('facility_country', 'Facility Country', 'trim|required');
		$this->form_validation->set_rules('businesshours', 'Öffnungszeiten', 'trim');

		if ($this->form_validation->run() != false) {

			$facility->person_in_charge = $this->input->post('facility_person_in_charge');
			$facility->phone = $this->input->post('facility_phone');
			$facility->name = $this->input->post('facility_name');
			$facility->organisation = $this->input->post('facility_organisation');
			$facility->address = $this->input->post('facility_address');
			$facility->zip = $this->input->post('facility_zip');
			$facility->city = $this->input->post('facility_city');
			$facility->country = $this->input->post('facility_country');
            $facility->email = $this->input->post('facility_email');
			$facility->opening_hours = $this->input->post('businesshours');

            if($this->input->post('password') != '') {
                $user_update = new stdClass;
                $user_update->password = $password;
                $this->user_model->update_user($user->id, $user_update);
            }

			$this->facility_model->update_facility($facility);

			
			$this->load->view('header');
			
			if($is_signup) $this->load->view('user/register/progressbar', array('step' => 3));
			
			$this->load->view('user/register/step3', array('user' => $user, 'facility' => $facility));
			$this->load->view('footer');

		}else{
			$this->load->view('header');
			if($is_signup) $this->load->view('user/register/progressbar', array('step' => 3));
			$this->load->view('user/register/step3', array('user' => $user, 'facility' => $facility));
			$this->load->view('footer');
		}

	}

	/**
	 * logout function.
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {

		// create the data object
		$data = new stdClass();

		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}

			// user logout ok
			redirect('/user/login');

		} else {

			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/user/login');

		}

	}

	public function passwordreset($confirmation_key=false, $username=false){

		if($confirmation_key && $username){

			$user_id = $this->user_model->get_user_id_from_username($username);
			$user = $this->user_model->get_user($user_id);

			if($confirmation_key == $user->confirmation_key){

				$user->logged_in = 1;
				$this->set_session($user);
				redirect('/user/profile');

			}else{
				redirect('/user/login');
			}

		}else{

			check_role('logged_out');

			// create the data object
			$data = new stdClass();

			// load form helper and validation library
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric');

			if ($this->form_validation->run() === false) {
				$this->load->view('/user/login/passwordreset');
			}else{
				$this->load->model('user_model');

				$username = $this->input->post('username');
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);

				$data = new stdClass;
				$data->confirmation_key = hash('sha256',rand().uniqid()); // @TODO: Is this secure or stupid?
				$this->user_model->update_user($user_id, $data);

				$this->send_email($user->email,$username,'passwordreset');

				$this->user_model->update_user($user_id, $data);
				$this->load->view('/user/login/passwordreset_success');
			}
		}

	}

	public function wait_for_confirmation(){
		$this->load->view('header');
		$this->load->view('user/register/wait_for_confirmation');
		$this->load->view('footer');
	}


	private function send_email($email,$username,$template,$data=false){

		$this->config->load('email',true);
		$this->load->library('email', NULL, 'ci_email');

		$email_config['protocol']  = 'smtp';
		$email_config['charset']   = 'utf-8';
		$email_config['mailtype']  = 'html';
		$email_config['smtp_host'] = $this->config->item('SMTP_HOST', 'email');
		$email_config['smtp_user'] = $this->config->item('SMTP_USER', 'email');
		$email_config['smtp_pass'] = $this->config->item('SMTP_PASS', 'email');
		$email_config['smtp_port'] = $this->config->item('SMTP_PORT', 'email');

		$this->ci_email->initialize($email_config);
		$this->ci_email->set_newline("\r\n");
		$this->ci_email->from('noreply@bedarfsplaner.org', 'Bedarfsplaner');
		$this->ci_email->to($email);

		$this->ci_email->subject('Bedarfplaner Bestätigungsemail');

		switch ($template) {
			case 'confirmation':
				$this->ci_email->message('Bitte Email-Adresse mit folgendem Link bestätigen: '.$data->confirmation_key);
				break;

			case 'passwordreset':
				$this->ci_email->message('');
				break;
			
			default:
				$this->ci_email->message('');
				break;
		}
		

		$this->ci_email->send();


	}

	private function set_session($user){
		// set session user datas
		$_SESSION['user_id']      = (int)$user->id;
		$_SESSION['username']     = (string)$user->username;
		$_SESSION['logged_in']    = (bool)true;
		$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
		$_SESSION['is_admin']     = (bool)$user->is_admin;
	}

}
