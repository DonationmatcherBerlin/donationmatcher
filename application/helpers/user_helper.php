<?php

if(! function_exists('check_role')){

	function check_role($role){

		if($role == 'logged_out'){

			if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['is_confirmed']==0) redirect('/user/wait_for_confirmation');
			if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) redirect('/user/profile');
			return true;
		}

		if($role == 'confirmed'){

			if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['is_confirmed']) return true;
			redirect('/user/login');

		}

		if($role == 'admin'){

			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['is_confirmed'] && $_SESSION['is_admin']) return true;
			redirect('/user/login');
		}
		
	}

}
