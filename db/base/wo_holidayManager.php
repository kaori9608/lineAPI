<?php
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/db/base/appmodel.php");
	require_once("wo_holidayModel.php");
	class wo_holidayManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM wo_holiday";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//スタッフIDをから休日データを取得する処理
		//---------------------------------------------------------------------------
		function findHolidayByStaffID($staff_id = null , $holiday = null){
		$this->sql = "SELECT 
							wo_holiday.wo_holiday_id,
							wo_holiday.staff_id,
							wo_holiday_category_id,
							wo_holiday.holiday FROM wo_holiday 
							WHERE wo_holiday.staff_id = " . $staff_id . " AND wo_holiday.holiday = '" . $holiday . "'";

			return $this->ExecuteReturnQuery(true);
	
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			$this->sql = "
						INSERT INTO wo_holiday (
							staff_id,
							holiday,
							wo_holiday_category_id,
							sort,
							delete_flag,
							updated,
							created
							)
						VALUES (
							'{$inputArray["staff_id"]}',
							'{$inputArray["holiday"]}',
							'{$inputArray["wo_holiday_category_id"]}',
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
			$this->sql = "UPDATE wo_holiday
							SET 
							staff_id				='{$inputArray["staff_id"]}',
							holiday					='{$inputArray["holiday"]}',
							wo_holiday_category_id	='{$inputArray["wo_holiday_category_id"]}',
							updated					= now()
							WHERE wo_holiday_id 	= {$inputArray["wo_holiday_id"]};" ;

			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//データを削除する処理
		//---------------------------------------------------------------------------
		function delItems($inputArray =array()){
			$this->sql = "DELETE 
							FROM wo_holiday  
							WHERE wo_holiday_id 	= {$inputArray["wo_holiday_id"]};" ;

			return $this->ExecuteNonQuery();
        }
		
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new wo_holidayModel();
        }
    }
		
?>