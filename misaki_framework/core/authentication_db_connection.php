<?php
require_once (dirname(dirname(dirname(__FILE__))) . "/config/setting.php");
require_once (dirname(dirname(dirname(__FILE__))) . "/db/base/loginManager.php");
require_once (dirname(dirname(__FILE__)) . "/core/cookie.php");


//----------------------------------------------------------------------------------
//認証クラス(ゲストバージョン)
//----------------------------------------------------------------------------------
class authentication_db_connection{
   
    var $request = null;
    var $session = null;

    //----------------------------------------------------------------------------------
    //コンストラクタ
    //----------------------------------------------------------------------------------
    function authentication_db_connection($request, $session){
		$this->request =& $request;
        $this->session =& $session;
    }

    //----------------------------------------------------------------------------------
    //ログイン処理
    //----------------------------------------------------------------------------------
    function login(){
        
        //requestパラメータを取得
        $action = $this->request->get("action");
        $loginId = $this->request->get("login_id");
        $password = $this->request->get("password");
	    $remember = $this->request->get("remember");
		
		//---------------------------------------------------------------------------
		//クッキー
		//---------------------------------------------------------------------------
		$cookie = new Cookie();
		
		//----------------------------------------------------------------------------------
        //認証処理
    	//----------------------------------------------------------------------------------
        if($loginId && $password){
            
			$loginuserCheckResult = $this->loginuserCheck( $loginId , $password );
			
			if($loginuserCheckResult){
             	foreach ($loginuserCheckResult as $loginuserKey => $loginuserValue){
					if($loginuserValue -> permission != 99){
							//セッションに認証情報を保存
							$this->session->add("loginId", $loginId);
							$this->session->add("password", $password);
							$this->session->add("staff_id", $loginuserValue -> staff_id);
							$this->session->add("shop_id", $loginuserValue -> shop_id);
							$this->session->add("permission", $loginuserValue -> permission);
		
							
							//rememberを確認する
							if($remember){
								//クッキーにログイン情報を保存する
								$cookie->add("loginId", $loginId);
								$cookie->add("password", $password);
								$cookie->add("remember", $remember);
							}else{
								//クッキーを削除
								//ここでエラー
								$cookie->del("loginId");
								$cookie->del("password");
								$cookie->del("remember");
							}
							
							header("Location:" . DEFAULT_PAGE );
					
					}else{
						//認証ErrorMsg
						$errArray[] = "現在、観覧できない状態になっております。<br />詳しくは、管理担当者までご連絡ください。";
						$this->request->setErrorMsg($errArray);

						//セッション情報を破棄
						$this->session->delAll();
						
						//クッキーを削除
							$cookie->del("loginId");
							$cookie->del("password");
							$cookie->del("remember");
					}
				}
			}else{
                //認証ErrorMsg
                $errArray[] = "ユーザーIDもしくはパスワードが違います。";
                $this->request->setErrorMsg($errArray);

				//セッション情報を破棄
                $this->session->delAll();
				
				//クッキーを削除
				$cookie->del("loginId");
				$cookie->del("password");
				$cookie->del("remember");
													
            }
        }else{
            if($action=="login"){
                //入力ErrorMsgSET
                $errArray[] = "ユーザーIDもしくはパスワードが未入力です。";
                $this->request->setErrorMsg($errArray);
                
				//セッション情報を破棄
                $this->session->delAll();
				
				//クッキーを削除
				$cookie->del("loginId");
				$cookie->del("password");
				$cookie->del("remember");
											
            }
        }
    }
   
    //----------------------------------------------------------------------------------
    //ログアウト処理
    //----------------------------------------------------------------------------------
    function logout(){
        //セッション情報を破棄
        $this->session->delAll();
        
        //Index画面強制的に繊維
        header("Location:./index.php");
    }

    //----------------------------------------------------------------------------------
    //認証処理
    //----------------------------------------------------------------------------------
    function auth(){

        $loginId = $this->session->get("loginId");
        $password = $this->session->get("password");
        
		$loginuserCheckResult = $this->loginuserCheck( $loginId , $password );
		
		if(!$loginuserCheckResult){
            //ログイン画面に強制的に遷移
		   header("Location: " . SITE_URL . "login.php"); 
        }
    }

	//=======共通仕様==================================================================================================
	
	//===========================================================================
	//ユーザーチェック
    //===========================================================================
	
	function loginuserCheck( $loginId = null , $password = null ){
		if($loginId && $password){
			//必要なインスタンス生成
			$loginManager = new loginManager();
			$loginuserResult = $loginManager->findByLoginIdAndPassword($loginId , $password);
			
			if($loginuserResult){
				return $loginuserResult;
			}else{
				return false;
			}
		}
		return $result; 
    }
}
?>