<?php
    //セッションクラス
	class Session {
        //セッション情報設定
		function add($name, $data) {
	        $_SESSION[$name] = $data;
        }

        //セッション情報取得
		function get($name) {
            if(isset($_SESSION[$name])){
                return $_SESSION[$name];
            }
		}

		//フォームの値をセッションに保存
        function setFormValue($name=null){
            if($_POST){
                $_SESSION[$name] = $_POST;
            }
        }

        //セッションに保持したフォームの値を取得
        function getFormValue($name=null){
            if(isset($_SESSION[$name])){
                return $_SESSION[$name];
            }
        }
        
        //セッション情報全て破棄
        function delAll(){  
            $_SESSION = array();
        }
        
        //セッション情報一部破棄
        function del($name){
            if($name){
                unset($_SESSION[$name]);
            }   
        }
	}

	session_start(); 

?>