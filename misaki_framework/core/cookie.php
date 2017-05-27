<?php
	include (dirname(dirname(dirname(__FILE__))) . "/config/setting.php");

class Cookie {

	//Cookie情報設定
	function add($name, $data) {
		$time=time()+COOKIE_TERM_OF_VALIDITY;
		setcookie($name,$data,$time);
	}
	
	//Cookie情報取得
	function get($name) {
		if(isset($_COOKIE[$name])){
			return $_COOKIE[$name];
		}
	}

	//Cookie情報一部破棄
	function del($name){
		if($name){
			 setcookie($name,'',time() - 86400);
		}   
	}

}
	
?>