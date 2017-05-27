<?php
require_once (dirname(dirname(__FILE__)) . "/db/staff_detailManager.php");
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/db/staffDetailManager.php");

class staff_detailController {
	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function staff_detailController($request, $session) {
		$this->request =& $request;
		$this->session =& $session;
	}
	
	//------------------------------------------------------------------------------
	// execute
	//------------------------------------------------------------------------------
	function execute(){
		$action = $this->request->get("action");
		//actionパラメータで処理を分岐
		switch ($action){
			case "gsd":
				return $this->getStaffDetail();
				break;
				default:
				return $this->getStaffList();
				break;
		}
	}

	//------------------------------------------------------------------------------
	//一覧画面表示
	//------------------------------------------------------------------------------
	function getStaffList(){				
		//必要なインスタンス生成
		$staff_detailManager = new staff_detailManager();
		
		//リストを取得
		$staffdetailLists = $staff_detailManager->findAllStaff_detailList();
		
		//DBの値をrequestオブジェクトに代入
		return $staffdetailLists;
	}

	//------------------------------------------------------------------------------
	//一覧画面表示
	//------------------------------------------------------------------------------
	function getStaffDetail(){				
		//必要なインスタンス生成
		$staff_detailManager = new staff_detailManager();
		//名簿IDを取得
		$me_staff_detail_id = $this->request->get("sdid");

		//リストを取得
		$staffdetailLists = $staff_detailManager->findByStaffDetailId($me_staff_detail_id);
		//DBの値をrequestオブジェクトに代入
		if ($staffdetailLists){
			foreach ($staffdetailLists[0] as $key => $value){
				$this->request->add($key, $value);
			}
		}
	}
	
	//------------------------------------------------------------------------------
	//（業務・支店別に社員名簿を取得）
	//------------------------------------------------------------------------------
	function getStaffListByShopIdAndWorkcategoryId($shop_id = null,$work_category_id = null){
		//必要なインスタンス生成
		$staff_detailManager = new staff_detailManager();

		//今日の日付を定義
		$work_time = date("Y-m-d");
		//リストを取得
		$staffdetailLists = $staff_detailManager->findByShopIdAndWorkCategory($shop_id,$work_category_id,$work_time);
		
		//DBの値をrequestオブジェクトに代入
		return $staffdetailLists;
	}


	//=======共通仕様=============================================================
	
	//===========================================================================
	//システムエラーチェック
    //===========================================================================
	function systemErrorCheck($result=false, $type="etc"){
		//結果取得時にErrorの場合
		if($result === FALSE || $result === false){
			
			$errArray = array();
			
			switch ($type){
				case "disp":
					$errArray[0] = "データベースから値を取得できません。";
					break;
				case "regi":
					$errArray[0] = "データベースへ登録できません。";
					break;
				case "del":
					$errArray[0] = "データが削除できません。";
					break;
				case "img":
					$errArray[0] = "画像を登録できません。";
					break;
				case "etc":
					$errArray[0] = "データベースへ接続できません。";
					break;
			}
			
			$this->request->setErrorMsg($errArray);
			
		}else{
			return $result;
		}
	}
	
	//===========================================================================
	//バリデーションエラーチェック
	//===========================================================================
	function setValidation($input = array()){
		//入力チェック配列を作成
		$chkArray = array(	"fullname_null" => array($input["fullname"], "_v_null", "本名(氏名)")
							);
		$validation = new validation();
		$result = $validation->loadValidation($chkArray);
		
		//Errorメッセージを設定
		if(!empty($result)){
			$this->request->setErrorMsg($result);
			return $result;
		}
	}
}
?>
