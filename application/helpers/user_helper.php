<?php

if(! function_exists('check_role')){

	function check_role($role){

		if($role == 'confirmed'){

			if ($_SESSION['logged_in'] && $_SESSION['is_confirmed']) return true;
			redirect('/user/login');

		}

		if($role == 'admin'){

			if($_SESSION['logged_in'] && $_SESSION['is_confirmed'] && $_SESSION['is_admin']) return true;
			redirect('/user/login');
		}
		
	}

}
