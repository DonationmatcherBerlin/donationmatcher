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
			$this->load->view('header');
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
				$this->send_email_confirmation($email,$username,'confirm');

				// user creation ok
				$this->load->view('header');
				$this->load->view('user/register/progressbar', array('step' => 2));
				$this->load->view('user/register/step2', array('user' => $user, 'facility' => $facility));
				$this->load->view('footer');

			}else{

				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';

				// send error to the view
				$this->load->view('header');
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


			$user_id = $this->user_model->get_user_id_from_username($username);
			$user = $this->user_model->get_user($user_id);

			if($confirmation_key == $user->confirmation_key){
				$data = new stdClass;
				$data->is_confirmed = 1;
				$this->user_model->update_user($user_id, $data);

				$user->is_confirmed = 1;
				$user->logged_in = 1;
				$this->set_session($user);
				redirect('/user/step3');
			}else{ // @TODO: Handle also already confirmed users.
				$data = new stdClass;
				$data->error = 'Ungültiger Confirmation Code';
				print_r($data); // @TODO: Load error view
			}

	}


	public function step3(){
		check_role('confirmed');
		$show_progress_bar = true;
		$this->profile($show_progress_bar);
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
            if (in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'], true)) {
                $this->load->view('user/login/login');
            } else {
                $this->load->view('under_construction_view');
            }
		} else {

			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($this->user_model->resolve_user_login($username, $password)) {

				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);

				$this->set_session($user);

				// user login ok
				redirect('/user/profile');

			} else {

				// login failed
				$data->error = 'Wrong username or password.';

				// send error to the view

				$this->load->view('user/login/login', $data);


			}

		}

	}


	/**
	 * profile edit function.
	 *
	 * @access public
	 * @return void
	 */
	public function profile($show_progress_bar = false){

		check_role('confirmed');

		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user = $this->user_model->get_user($_SESSION['user_id']);
		$facility = $this->facility_model->get_facility_by_user_id($_SESSION['user_id']);



		$this->load->view('header');
		if($show_progress_bar) $this->load->view('user/register/progressbar', array('step' => 3));
		$this->load->view('user/register/step3', array('user' => $user, 'facility' => $facility));
		$this->load->view('footer');



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

				$this->send_email_confirmation($user->email,$username,'passwordreset');

				$this->user_model->update_user($user_id, $data);
				$this->load->view('/user/login/passwordreset_success');
			}
		}

	}



	private function send_email_confirmation($email,$username,$template){



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
