<?php
	class loginModel{
		var	$login_id		=	null;
		var	$password		=	null;
		var	$staff_id 		=	null;
		var	$shop_id		=	null;
		var	$permission		=	null;
		var	$delete_flag	=	null;
		var	$updated		=	null;
		var	$created		=	null;
		
		
		//=========================================================================================
		
		//★ permission ==========================================
		function getPermissionName($number) {
			switch ($number){
				case 0:
					return "一般";
					break;
				case 1:
					return "一般管理";
					break;
				case 2:
					return "システム管理";
					break;
				case 3:
					return "Administrator";
					break;
				case 99:
					return "禁止";
					break;
			}
		}	
									
	}
?>