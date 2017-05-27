<?php
require_once (dirname(dirname(__FILE__)) . "/db/base/wo_holidayManager.php");


class staff_work_offController {
	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function staff_work_offController($request, $session) {
		$this->request =& $request;
		$this->session =& $session;
	}
	
	//------------------------------------------------------------------------------
	// execute
	//------------------------------------------------------------------------------
	function execute(){
		$action = $this->request->get("action");
		switch ($action){
			default:
				break;
		}
	}
	
	//------------------------------------------------------------------------------
	//休暇種類を取得
	//------------------------------------------------------------------------------
	function getHolidayCategory($wo_holiday_category_id = null){
		//必要なインスタンス生成
		$wo_holiday_categoryManager = new wo_holiday_categoryManager();
		
		//リストを取得
		$wo_holiday_categoryLists = $wo_holiday_categoryManager->findByHolidayCategoryId($wo_holiday_category_id);
		
		return $wo_holiday_categoryLists[0]->holiday_category_name;
	}
	
	//------------------------------------------------------------------------------
	//休暇種類を取得
	//------------------------------------------------------------------------------
	function getBeforeHoliday($staff_id = null){				
		
		$holiday = date("Y-m-d");
		//必要なインスタンス生成
		$wo_holidayManager = new wo_holidayManager();
		

		//リストを取得
		$holiday_Lists = $wo_holidayManager->findHolidayByStaffID($staff_id,$holiday);
		
		return $holiday_Lists;
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
