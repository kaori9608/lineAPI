<?php
require_once (dirname(dirname(__FILE__)) . "/db/work_timeManager.php");
require_once (dirname(dirname(__FILE__)) . "/db/staff_detailManager.php");

class worktimeController {
	//------------------------------------------------------------------------------
	//コンストラクタ
	//------------------------------------------------------------------------------
	function worktimeController($request, $session) {
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
			case "gwd":
				return $this->getWorkTimeDetail();
				break;
			case "edit":
				return $this->editItems();
				break;
			case "del":
				return $this->deleteItems();
				break;
			case "alladd":
				return $this->addAllItems();
				break;
			case "attendance":
				return $this->attendance();
				break;
			case "out":
				return $this->editOut();
				break;
			case "search":
				return $this->searchItems();
				break;
				default:
				return $this->getWorkTimeList();
				break;
		}
	}

	//------------------------------------------------------------------------------
	//一覧画面表示
	//------------------------------------------------------------------------------
	function getWorkTimeList(){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		$work_time = date("Y-m-d");
		
		//リストを取得
		if(($this->session->get("permission")==0) || ($this->session->get("permission")==97)){
			$worktimeLists = $work_timeManager->findAllWorkTimeList($work_time);
		}else{
			$worktimeLists = $work_timeManager->findByShopIdWorkTimeList($work_time,$this->session->get("shop_id"));
		}
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
	}

	//------------------------------------------------------------------------------
	//当日の出勤データを取得する
	//------------------------------------------------------------------------------
	function getWorkTimeListByWorkTimeId($wo_work_time_id){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		//リストを取得
		$worktimeLists = $work_timeManager->findByWorkTimeId($wo_work_time_id);
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
	}

	//------------------------------------------------------------------------------
	//当日の出勤データを取得する
	//------------------------------------------------------------------------------
	function getWorkTimeListByStaffDetailId($me_staff_detail_id){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		$work_time = date("Y-m-d");
		//リストを取得
		$worktimeLists = $work_timeManager->findByStaffDetailIdAndWorkTime($me_staff_detail_id,$work_time);
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
	}

	//------------------------------------------------------------------------------
	//前日の出勤データを取得する
	//------------------------------------------------------------------------------
	function getBeforeWorkTimeListByStaffDetailId($me_staff_detail_id){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		$work_time = date("Y-m-d",strtotime('-1 day'));
		//リストを取得
		$worktimeLists = $work_timeManager->findByStaffDetailIdAndWorkTime($me_staff_detail_id,$work_time);
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
	}

	//------------------------------------------------------------------------------
	//検索結果
	//------------------------------------------------------------------------------
	function searchItems(){
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$input = $this->request->getAll();

		if(!$input["find_work_time"]){
			$input["find_work_time"] = date("Y-m-d");
		}

		//リストを取得
		$worktimeLists = $work_timeManager->findAllSearchList($input);
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
	}

	//------------------------------------------------------------------------------
	//一覧画面表示
	//------------------------------------------------------------------------------
	function getWorkTimeDetail(){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		//名簿IDを取得
		$wo_work_time_id = $this->request->get("wtid");

		//リストを取得
		$worktimeLists = $work_timeManager->findByWorkTimeId($wo_work_time_id);
		//DBの値をrequestオブジェクトに代入
		if ($worktimeLists){
			foreach ($worktimeLists[0] as $key => $value){
				$this->request->add($key, $value);
			}
		}
	}

	
	//------------------------------------------------------------------------------
	//編集
	//------------------------------------------------------------------------------
	function editItems(){
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$input = $this->request->getAll();

		//---------------------------------------------------------------------------
        //必要なオブジェクトを作成
		//---------------------------------------------------------------------------
		$work_timeManager = new work_timeManager();

		//---------------------------------------------------------------------------
		//テーブル更新処理
		//---------------------------------------------------------------------------
		   	$work_timeManagerResult = $work_timeManager->editItems($input);

		//---------------------------------------------------------------------------
		//終了
		//---------------------------------------------------------------------------
			//リストページに戻る
			$locationUrl = "Location:./list.php";
			header($locationUrl);
	}
	
	//------------------------------------------------------------------------------
	//編集
	//------------------------------------------------------------------------------
	function deleteItems(){
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$input = $this->request->getAll();

		//---------------------------------------------------------------------------
        //必要なオブジェクトを作成
		//---------------------------------------------------------------------------
		$work_timeManager = new work_timeManager();

		//---------------------------------------------------------------------------
		//テーブル更新処理
		//---------------------------------------------------------------------------
		   	$work_timeManagerResult = $work_timeManager->deleteItems($input);

		//---------------------------------------------------------------------------
		//終了
		//---------------------------------------------------------------------------
			//リストページに戻る
			$locationUrl = "Location:./list.php";
			header($locationUrl);
	}
	//------------------------------------------------------------------------------
	//新規登録(出勤時の処理)
	//------------------------------------------------------------------------------
	function attendance(){
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$me_staff_detail_id = $this->request->get("sdid");
			$shop_id = $this->request->get("sid");
			$wo_work_status_id = $this->request->get("wsid");
			$shop_category = $this->request->get("sc");
			$work_date = date("Y-m-d");

			$work_timeManager = new work_timeManager();
			$work_timeManager->AttendanceItems($me_staff_detail_id,$shop_id,$work_date,$wo_work_status_id);
		//---------------------------------------------------------------------------
		//終了
		//---------------------------------------------------------------------------
			//リストページに戻る
			switch ($shop_category) {
				case 's'://支店ページへ
					$locationUrl = "Location:./staff_s.php?sid=" . $shop_id;
					break;
				case 'h'://支店ページへ
					$locationUrl = "Location:./staff_h.php";
					break;
				case 'c'://CCページへ
					$locationUrl = "Location:./staff_c.php?sid=" . $shop_id;
					break;
				case 'k'://CCページへ
					$locationUrl = "Location:./staff_k.php";
					break;
				default:
					break;
			}

			header($locationUrl);
	}

	//------------------------------------------------------------------------------
	//編集(退勤処理)
	//------------------------------------------------------------------------------
	function editOut(){
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$input = $this->request->getAll();

		//---------------------------------------------------------------------------
        //必要なオブジェクトを作成　
		//---------------------------------------------------------------------------
			$work_timeManager = new work_timeManager();
			$me_staff_detail_id = $input["me_staff_detail_id"];
			$shop_id = $input["shop_id"];
			$shop_category = $input["shop_category"];
			$input["work_date"] = date("Y-m-d");
		//---------------------------------------------------------------------------
		//テーブル更新処理
		//---------------------------------------------------------------------------
		   	$work_timeManagerResult = $work_timeManager->editOutItems($input);
			
			if($input["next_wo_work_status_id"] == 2){//直行ならついでに明日のデータも登録する
				$wo_work_status_id = $input["next_wo_work_status_id"];
				$work_date = date("Y-m-d", strtotime("+1 day"));
				$work_timeManager->AttendanceItems($me_staff_detail_id,$shop_id,$work_date,$wo_work_status_id,$work_date);

			}
		//---------------------------------------------------------------------------
		//終了
		//---------------------------------------------------------------------------
			//リストページに戻る
			$locationUrl = "Location:./sen.php?sc=" . $shop_category . "&sid=" . $shop_id . "&sdid=" . $me_staff_detail_id;
			header($locationUrl);
	}
	//------------------------------------------------------------------------------
	//新規登録(ある分だけ一括)
	//------------------------------------------------------------------------------
	function addAllItems(){
		//---------------------------------------------------------------------------
		//postした値を取得
		//---------------------------------------------------------------------------
			$staff_detailManager = new staff_detailManager();

			$staff_detaillist = $staff_detailManager->findAllNotLikeTaishok();

			$work_timeManager = new work_timeManager();
			
			foreach ($staff_detaillist as $key => $value) {
				$input["me_staff_detail_id"] = $value->me_staff_detail_id;
				$input["shop_id"] = $value->shop_id;
				$input["work_date"] = date("Y-m-d");
				$work_timeManager->AdvanceAddItems($input);
			}
		//---------------------------------------------------------------------------
		//終了
		//---------------------------------------------------------------------------
			//リストページに戻る
			$locationUrl = "Location:./list.php";
			header($locationUrl);
	}

	//------------------------------------------------------------------------------
	//一覧画面表示
	//------------------------------------------------------------------------------
	function getWorkDataList($shop_id = null,$work_category_id = null){				
		//必要なインスタンス生成
		$work_timeManager = new work_timeManager();
		$work_time = date("Y-m-d");
		//リストを取得
		$worktimeLists = $work_timeManager->findByWorkCategoryAndWorkTimeList($shop_id,$work_category_id,$work_time);
		
		//DBの値をrequestオブジェクトに代入
		return $worktimeLists;
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