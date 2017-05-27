<?php

//インクルードモジュールクラス

class include_module{

	function load( $path , $module_name ){
		$module_path = $path . "/modules/" . $module_name . '/index.php';
		if ( file_exists( $module_path )) {
			include( $module_path );
		} else {
			echo($module_path);
		}
	}
}




?>
