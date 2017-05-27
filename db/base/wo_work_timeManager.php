<?php
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/db/base/appmodel.php");
	require_once("wo_work_timeModel.php");
	class wo_work_timeManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM wo_work_time";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO wo_work_time (
							work_time,
							out_time,
							me_staff_detail_id,
							shop_id,
							wo_work_status_id,
							wo_holiday_category_id,
							next_wo_work_status_id,
							note,
							sort,
							delete_flag,
							updated,
							created
							)
						VALUES (
							'{$inputArray["work_time"]}',
							'{$inputArray["out_time"]}',
							'{$inputArray["me_staff_detail_id"]}',
							'{$inputArray["shop_id"]}',
							'{$inputArray["wo_work_status_id"]}',
							'{$inputArray["wo_holiday_category_id"]}',
							'{$inputArray["next_wo_work_status_id"]}',
							'{$inputArray["note"]}',
							'0',
							'0',
							now(),
							now()
							)";
			
			return $this->ExecuteNonQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){

			$this->sql = "UPDATE wo_work_time
							SET 
							work_time					='{$inputArray["work_time"]}',
							out_time					='{$inputArray["out_time"]}',
							me_staff_detail_id			='{$inputArray["me_staff_detail_id"]}',
							shop_id						='{$inputArray["shop_id"]}',
							wo_work_status_id			='{$inputArray["wo_work_status_id"]}',
							wo_holiday_category_id		='{$inputArray["wo_holiday_category_id"]}',
							next_wo_work_status_id		='{$inputArray["next_wo_work_status_id"]}',
							note						='{$inputArray["note"]}',
							updated					 = now()
							WHERE wo_work_time_id = {$inputArray["wo_work_time_id"]};" ;

			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function deleteItems($inputArray =array()){

			$this->sql = "DELETE FROM wo_work_time WHERE wo_work_time_id = {$inputArray["wo_work_time_id"]};" ;

			return $this->ExecuteNonQuery();
        }
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new wo_work_timeModel();
        }
    }
		
?>