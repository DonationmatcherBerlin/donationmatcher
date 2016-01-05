<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		check_role('admin');
	}

	public function users(){
		$this->load->model('user_model');
		$this->load->view('header');
		
		if($_POST){

			$uid = $this->input->post('id');
			$user = new stdClass;
			$user->username = $this->input->post('username');
			$user->email = $this->input->post('email');
			$user->is_admin = $this->input->post('is_admin');
			$user->is_confirmed = $this->input->post('is_confirmed');
			$user->is_deleted = $this->input->post('is_deleted');

			if($this->input->post('action') == 'speichern'){
				$this->user_model->update_user($uid, $user);
				redirect('admin/users');
			}

			if($this->input->post('action') == 'su'){
				$user = $this->user_model->get_user($uid);
				$this->set_su_session($user, $_SESSION['user_id']);
				redirect('admin/users');
			}

		}

		$users = $this->user_model->get_users();
		$this->load->view('admin/users', array('users' => $users));
		$this->load->view('footer');
	}

	private function set_su_session($user, $admin_id){
		// set session user datas
		$_SESSION['user_id']      = (int)$user->id;
		$_SESSION['username']     = (string)$user->username;
		$_SESSION['logged_in']    = (bool)true;
		$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
		$_SESSION['is_admin']     = (bool)$user->is_admin;
		$_SESSION['su']     = true;
		$_SESSION['su_id']     = $admin_id;
	}

	

}