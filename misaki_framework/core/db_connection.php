<?php
	include (dirname(dirname(dirname(__FILE__))) . "/config/setting.php");
	
	class db_connection{
		
		function connect(){
			
			//接続
			$dbcon = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
			
			if(!$dbcon){
				return false;	
			}
			
			//MySQLのクライアントの文字コードをutf-8に設定
			mysql_query("SET NAMES utf8") or die("can not SET NAMES utf8");

			//DB選択
			mysql_select_db( DB_NAME, $dbcon );

			return $dbcon;

		}
		
	}


?>