<?php 
	/* ******************************************
	 ========================================= Databse file link===========================
	//  													******************************** */
	// if(file_exists('database.php')){
	// 	require_one('database.php');
	// }
	/* ******************************************
	 ========================================= Header footer ===========================
	 													******************************** */

	function get_header($role){
		if ($role == 'logged_in') {
			if(file_exists('admin-header.php')){
				require_once('admin-header.php');
			}else{
				require_once('header.php');
			}
		}
	}
	function get_footer(){
		if(file_exists('header.php')){
			require_once('footer.php');
		}
	}















 ?>