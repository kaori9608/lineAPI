<?php
	require_once("base/wo_work_timeManager.php");
	require_once("work_timeModel.php");
	
	class work_timeManager extends wo_work_timeManager{
		//---------------------------------------------------------------------------
		//一覧表示
		//---------------------------------------------------------------------------
		function findAllWorkTimeList($work_time = null){
			$this->sql = "SELECT
							staff.staff_name,
							staff.staff_name_kana,
							me_staff_detail.attend_shop_id,
							shop_1.shop_name,
							work_category.work_category_name,
							wo_work_time.wo_work_time_id,
							wo_work_status.wo_work_status_id,
							wo_work_time.work_date,
							wo_work_time.work_time,
							wo_work_time.out_time,
							wo_work_time.me_staff_detail_id,
							wo_work_status.work_status_name,
							wo_work_time.wo_holiday_category_id,
							wo_holiday_category.holiday_category_name,
							wo_work_time.next_wo_work_status_id,
							wo_work_time.note,
							wo_work_time.updated,
							wo_work_time.delete_flag,
							wo_work_time.created
						FROM wo_work_status AS wo_work_status_1 RIGHT JOIN (shop AS shop_1 RIGHT JOIN (shop RIGHT JOIN (((work_category RIGHT JOIN ((wo_holiday_category RIGHT JOIN wo_work_time ON wo_holiday_category.wo_holiday_category_id = wo_work_time.wo_holiday_category_id)
						 INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id) ON work_category.work_category_id = me_staff_detail.work_category_id)
						  INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id)
						   LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id) ON shop.shop_id = wo_work_time.shop_id) ON shop_1.shop_id = me_staff_detail.attend_shop_id)
						    ON wo_work_status_1.wo_work_status_id = wo_work_time.next_wo_work_status_id
						WHERE `work_date` LIKE '%" . $work_time . "%';";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//一覧表示
		//---------------------------------------------------------------------------
		function findByShopIdWorkTimeList($work_time = null, $shop_id = null){
			$this->sql = "SELECT
							staff.staff_name,
							staff.staff_name_kana,
							me_staff_detail.attend_shop_id,
							shop_1.shop_name,
							work_category.work_category_name,
							wo_work_time.wo_work_time_id,
							wo_work_status.wo_work_status_id,
							wo_work_time.work_date,
							wo_work_time.work_time,
							wo_work_time.out_time,
							wo_work_time.me_staff_detail_id,
							wo_work_status.work_status_name,
							wo_work_time.wo_holiday_category_id,
							wo_holiday_category.holiday_category_name,
							wo_work_time.next_wo_work_status_id,
							wo_work_time.note,
							wo_work_time.updated,
							wo_work_time.delete_flag,
							wo_work_time.created
						FROM wo_work_status AS wo_work_status_1 RIGHT JOIN (shop AS shop_1 RIGHT JOIN (shop RIGHT JOIN (((work_category RIGHT JOIN ((wo_holiday_category RIGHT JOIN wo_work_time ON wo_holiday_category.wo_holiday_category_id = wo_work_time.wo_holiday_category_id)
						 INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id) ON work_category.work_category_id = me_staff_detail.work_category_id)
						  INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id)
						   LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id) ON shop.shop_id = wo_work_time.shop_id) ON shop_1.shop_id = me_staff_detail.attend_shop_id)
						    ON wo_work_status_1.wo_work_status_id = wo_work_time.next_wo_work_status_id
						WHERE `work_date` LIKE '%" . $work_time . "%'AND wo_work_time.shop_id = " . $shop_id . ";";

			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//一覧表示
		//---------------------------------------------------------------------------
		function findByStaffDetailIdAndWorkTime($me_staff_detail_id = null,$work_time = null){
			$this->sql = "SELECT
							staff.staff_name,
							staff.staff_name_kana,
							me_staff_detail.attend_shop_id,
							work_category.work_category_name,
							work_category.work_label,
							wo_work_time.wo_work_time_id,
							wo_work_status.wo_work_status_id,
							wo_work_time.work_date,
							wo_work_time.work_time,
							wo_work_time.out_time,
							wo_work_time.me_staff_detail_id,
							wo_work_status.work_status_name,
							wo_work_time.wo_holiday_category_id,
							wo_holiday_category.holiday_category_name,
							wo_work_time.next_wo_work_status_id,
							wo_work_time.note,
							wo_work_time.updated,
							wo_work_time.delete_flag,
							wo_work_time.created
						FROM shop RIGHT JOIN (((work_category RIGHT JOIN ((wo_holiday_category RIGHT JOIN wo_work_time ON wo_holiday_category.wo_holiday_category_id = wo_work_time.wo_holiday_category_id)
							INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id) ON work_category.work_category_id = me_staff_detail.work_category_id)
							INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id) LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id) ON shop.shop_id = wo_work_time.shop_id
							WHERE (((wo_work_time.work_date) LIKE '%" . $work_time . "%') AND ((wo_work_time.me_staff_detail_id)=" . $me_staff_detail_id . "));";

			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//詳細画面表示
		//---------------------------------------------------------------------------
		function findByWorkTimeId($wo_work_time_id = null){
			$this->sql = "SELECT
							staff.staff_name,
							staff.staff_name_kana,
							me_staff_detail.attend_shop_id,
							work_category.work_category_name,
							wo_work_time.wo_work_time_id,
							wo_work_status.wo_work_status_id,
							wo_work_time.work_date,
							wo_work_time.work_time,
							wo_work_time.out_time,
							wo_work_time.me_staff_detail_id,
							wo_work_status.work_status_name,
							wo_work_time.wo_holiday_category_id,
							wo_holiday_category.holiday_category_name,
							wo_work_time.next_wo_work_status_id,
							wo_work_time.note,
							wo_work_time.updated,
							wo_work_time.delete_flag,
							wo_work_time.created
						FROM shop RIGHT JOIN (((work_category RIGHT JOIN ((wo_holiday_category RIGHT JOIN wo_work_time ON wo_holiday_category.wo_holiday_category_id = wo_work_time.wo_holiday_category_id)
							INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id) ON work_category.work_category_id = me_staff_detail.work_category_id)
							INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id) LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id) ON shop.shop_id = wo_work_time.shop_id
						WHERE `wo_work_time_id` = '" . $wo_work_time_id . "';";

			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//検索結果表示
		//---------------------------------------------------------------------------
		function findAllSearchList($inputArray = array()){
			$serchsql = "";
			if($inputArray["find_shop_id"]){
				$serchsql = $serchsql . " AND (wo_work_time.shop_id)=" . $inputArray["find_shop_id"];
			}

			if($inputArray["find_wo_work_status_id"]){
				$serchsql = $serchsql . " AND (wo_work_time.wo_work_status_id)=" . $inputArray["find_wo_work_status_id"];
			}

			if($inputArray["find_next_wo_work_status_id"]){
				$serchsql = $serchsql . " AND (wo_work_time.next_wo_work_status_id)=" . $inputArray["find_next_wo_work_status_id"];
			}

			if($inputArray["find_work_time"]){
				$serchsql = $serchsql . " AND (wo_work_time.work_time) LIKE '%" . $inputArray["find_work_time"] . "%'";
			}
			$this->sql = "SELECT
							staff.staff_name,
							staff.staff_name_kana,
							me_staff_detail.attend_shop_id,
							shop_1.shop_name,
							work_category.work_category_name,
							wo_work_time.wo_work_time_id,
							wo_work_status.wo_work_status_id,
							wo_work_time.work_date,
							wo_work_time.work_time,
							wo_work_time.out_time,
							wo_work_time.me_staff_detail_id,
							wo_work_status.work_status_name,
							wo_work_time.wo_holiday_category_id,
							wo_holiday_category.holiday_category_name,
							wo_work_time.next_wo_work_status_id,
							wo_work_time.note,
							wo_work_time.updated,
							wo_work_time.delete_flag,
							wo_work_time.created
						FROM wo_work_status AS wo_work_status_1 RIGHT JOIN (shop AS shop_1 RIGHT JOIN (shop RIGHT JOIN (((work_category RIGHT JOIN ((wo_holiday_category RIGHT JOIN wo_work_time ON wo_holiday_category.wo_holiday_category_id = wo_work_time.wo_holiday_category_id)
						 INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id) ON work_category.work_category_id = me_staff_detail.work_category_id)
						  INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id)
						   LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id) ON shop.shop_id = wo_work_time.shop_id) ON shop_1.shop_id = me_staff_detail.attend_shop_id)
						    ON wo_work_status_1.wo_work_status_id = wo_work_time.next_wo_work_status_id
							WHERE (
									(
										(wo_work_time.delete_flag)=0 " . $serchsql . "

									)
								);";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//ディスプレイ画面
		//---------------------------------------------------------------------------
		function findByWorkCategoryAndWorkTimeList($shop_id = null,$work_category_id = null,$work_time = null){
			$this->sql = "SELECT
							wo_work_time.wo_work_time_id,
							me_staff_detail.me_staff_detail_id,
							staff.staff_name,
							staff.nick_name,
							work_category.work_category_id,
							work_category.work_category_name,
							work_category.work_label,
							wo_work_time.shop_id,
							wo_work_time.wo_work_status_id
						FROM ((work_category RIGHT JOIN (wo_work_time INNER JOIN me_staff_detail ON wo_work_time.me_staff_detail_id = me_staff_detail.me_staff_detail_id)
						 ON work_category.work_category_id = me_staff_detail.work_category_id) INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id)
						  LEFT JOIN wo_work_status ON wo_work_time.wo_work_status_id = wo_work_status.wo_work_status_id
						WHERE (
								(
									(work_category.work_category_id)=" . $work_category_id . " AND (wo_work_time.shop_id) = " . $shop_id . " AND (wo_work_time.work_date) LIKE '%" . $work_time . "%'
								)
							);";

			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//データを登録する処理(出勤処理)
		//---------------------------------------------------------------------------
		function AttendanceItems($me_staff_detail_id = null,$shop_id = null,$work_date = null,$wo_work_status_id = null,$work_date_time = null){
			if($work_date_time){
				$work_time = $work_date_time . " 09:00";
			}else{
				$work_time = "now()";
			}
			$this->sql = "
						INSERT INTO wo_work_time (
							me_staff_detail_id,
							shop_id,
							work_date,
							work_time,
							wo_work_status_id,
							next_wo_work_status_id,
							sort,
							delete_flag,
							updated,
							created
							)
						VALUES (
							'{$me_staff_detail_id}',
							'{$shop_id}',
							'{$work_date}',
							'" . $work_time . "',
							'{$wo_work_status_id}',
							'1',
							'0',
							'0',
							now(),
							now()
							)";
			return $this->ExecuteNonQuery(true);
		}


		//---------------------------------------------------------------------------
		//データを更新する処理（退勤処理）
		//---------------------------------------------------------------------------
		function editOutItems($inputArray =array()){

			$this->sql = "UPDATE wo_work_time
							SET 
							next_wo_work_status_id		='{$inputArray["next_wo_work_status_id"]}',
							next_wo_holiday_category_id	='{$inputArray["next_wo_holiday_category_id"]}',
							out_time					= now(),
							wo_work_status_id			= '8',
							updated					 	= now()
							WHERE wo_work_time_id = {$inputArray["wo_work_time_id"]};" ;

			return $this->ExecuteNonQuery();
        }

		 //---------------------------------------------------------------------------
		 //エンティティ作成用メソッド
		 //---------------------------------------------------------------------------
		 function createObj($inputArray = array()){
		 	return new work_timeModel();
		 }		
	}
?>