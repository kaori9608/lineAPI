<?php
	
	//------------------------------------------------------------------------------
	//ルートパス
    //------------------------------------------------------------------------------
		if(!defined('SERVER_ROOT_PATH')){
			define("SERVER_ROOT_PATH", "/home/www/ntl/");
		}
	
	//------------------------------------------------------------------------------
	//DB設定
    //------------------------------------------------------------------------------
		//Server
		$server_db = array("db_server" => "us-cdbr-iron-east-03.cleardb.net" , "db_username" => "b230e075a82da6", "db_password" => "36098907", "db_name" => "heroku_e84ff0594615ec5" );
	
	//------------------------------------------------------------------------------
	//ログイン設定
    //------------------------------------------------------------------------------
		//Default Page
			if(!defined('DEFAULT_PAGE')){
				define("DEFAULT_PAGE", "menu.php");
			}
		
		//ログインの有効期限 60*60*24 = 1日
			if(!defined('COOKIE_TERM_OF_VALIDITY') ){
				define("COOKIE_TERM_OF_VALIDITY", "60*60*168");
			}
	
	
	//------------------------------------------------------------------------------
	//アップロード設定
    //------------------------------------------------------------------------------
		//UPLOAD_DIRECTORY
			if(!defined('UPLOAD_DIRECTORY')){
				define("UPLOAD_DIRECTORY",SERVER_ROOT_PATH . "userfiles/uploads/");
			}

	//------------------------------------------------------------------------------
	//各コンポーネントのサイトパス
    //------------------------------------------------------------------------------
		//Site URL
		if(!defined('SITE_URL')){
			define("SITE_URL", "http://ntl.truck-kaitori.co/");
		}
		//Upload URL
		if(!defined('UPLOAD_URL')){
			define("UPLOAD_URL", "http://ntl.truck-kaitori.co/userfiles/uploads/");
		}
		//Package URL
		if(!defined('PACKAGE_URL')){
			define("PACKAGE_URL", "http://ntl.truck-kaitori.co/packages/");
		}
		//Module URL
		if(!defined('MODULE_URL')){
			define("MODULE_URL", "ntl.truck-kaitori.co/modules/");
		}
		


//------------------------------------------------------------------------------------------------------------------------------------------------------
//ここから先は処理を書く
//------------------------------------------------------------------------------------------------------------------------------------------------------


	//------------------------------------------------------------------------------
	//接続テスト
	//------------------------------------------------------------------------------
		//WEBサーバー環境
		$dbcon = mysql_connect($server_db["db_server"], $server_db["db_username"],$server_db["db_password"]);
	
		if($dbcon){
			$db = $server_db;
			$root_path = SERVER_ROOT_PATH;
		}
	
		if($db){
			//DB設定
			//DB_SERVER 
			if(!defined('DB_SERVER') ){
				define("DB_SERVER", $db["db_server"]);
			}
			//DB_USERNAME
			if(!defined('DB_USERNAME')){
				define("DB_USERNAME", $db["db_username"]);
			}
			//DB_PASSWORD
			if(!defined('DB_PASSWORD')){
				define("DB_PASSWORD", $db["db_password"]);
			}
			//DB_NAME
			if(!defined('DB_NAME')){
				define("DB_NAME", $db["db_name"]);
			}
	
		}else{
			echo("DB Connect Error -- setting");
			return false;
		}


?>
