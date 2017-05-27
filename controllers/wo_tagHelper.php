<?php

	require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/controllers/tagHelper.php");
	require_once (dirname(dirname(__FILE__)) . "/db/work_statusManager.php");
	require_once (dirname(dirname(__FILE__)) . "/db/holiday_categoryManager.php");

	class wo_tagHelper extends tagHelper {
	    //----------------------------------------------------------------------------------
		//支店のドロップダウンリスト(編集画面)
	    //----------------------------------------------------------------------------------
		function getWorkStatusList_edit($wo_work_status_id = null , $action = null){
			if(!$action){
				$wo_work_status_id = "";
			}
			$work_statusManager = new work_statusManager();
			$work_statusList = $work_statusManager->findAll();
			$returnValue="";
			if($work_statusList){
				foreach ($work_statusList as $key => $value) {
					if ($wo_work_status_id == $value->wo_work_status_id){
						$returnValue = $returnValue . '<option value="' . $value->wo_work_status_id . '" selected>' . $value->work_status_name . '</option>' . "\n" ;
					}else{
						$returnValue = $returnValue . '<option value="' . $value->wo_work_status_id . '">' . $value->work_status_name . '</option>' . "\n" ;
					}
				}
			}
			return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//支店のドロップダウンリスト(編集画面)
	    //----------------------------------------------------------------------------------
		function getHolidayList_edit($wo_holiday_category_id = null , $action = null){
			if(!$action){
				$wo_holiday_category_id = "";
			}
			$holiday_categoryManager = new holiday_categoryManager();
			$work_statusList = $holiday_categoryManager->findAll();
			$returnValue="";
			if($work_statusList){
				foreach ($work_statusList as $key => $value) {
					if ($wo_holiday_category_id == $value->wo_holiday_category_id){
						$returnValue = $returnValue . '<option value="' . $value->wo_holiday_category_id . '" selected>' . $value->holiday_category_name . '</option>' . "\n" ;
					}else{
						$returnValue = $returnValue . '<option value="' . $value->wo_holiday_category_id . '">' . $value->holiday_category_name . '</option>' . "\n" ;
					}
				}
			}
			return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//現在のステータス名を取得
	    //----------------------------------------------------------------------------------
		function getWorkStatus($wo_work_status_id = null){
			$work_statusManager = new work_statusManager();

			//リストを取得
			$work_statusList = $work_statusManager->findByWorkStatusId($wo_work_status_id);

			$returnValue = $work_statusList[0]->work_status_name;

			return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//ステータスによって背景を変更する
	    //----------------------------------------------------------------------------------
		function getStatusBgColor($wo_work_status_id = null){
			switch ($wo_work_status_id) {
				case '7':
					$returnValue = "F00000";
					break;
				case '8':
					$returnValue = "fff";
					break;
				
				default:
					$returnValue = "FFFE95";
					break;
			}

		return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//ステータスによって背景を変更する(役員)
	    //----------------------------------------------------------------------------------
		function getStatusBgColor_offcer($wo_work_status_id = null){
			switch ($wo_work_status_id) {
				case '7':
					$returnValue = "F00000";
					break;
				case '8':
					$returnValue = "fff";
					break;
				default:
					$returnValue = "81EAFF";
					break;
			}

		return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//ステータスによって背景を変更する
	    //----------------------------------------------------------------------------------
		function getStatusBackgroundColor($staff_post_id = null,$wo_work_status_id = null, $shop_id = null, $attend_shop_id = null){
			switch ($wo_work_status_id) {
				case '7'://休日
					$returnValue = "status2";
					break;
				case '8'://退勤
					$returnValue = "status0";
					break;
				default://出勤
					if($shop_id == $attend_shop_id){
						if($staff_post_id){//通常の出勤
							$returnValue = "status4";//役員の出勤
						}else{
							$returnValue = "status1";//一般社員の出勤
						}
					}else{//出張中スタッフの出勤
						if($staff_post_id){
							$returnValue = "status4";//役員の出勤
						}else{
							$returnValue = "status6";//一般社員の出勤
						}
					}

					break;
			}
		return $returnValue;
		}

	    //----------------------------------------------------------------------------------
		//ステータスによって背景を変更する
	    //----------------------------------------------------------------------------------
		function getHolidayStatusBackgroundColor($wo_work_status_id = null){

			switch ($wo_work_status_id) {
				case '2'://有給
					$returnValue = "status5";
					break;
				default://公休
					$returnValue = "status2";//役員の出勤
					break;
			}
		return $returnValue;
		}

	}
?>