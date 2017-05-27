<?php
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/db/base/appmodel.php");
	require_once("wo_holiday_categoryModel.php");
	class wo_holiday_categoryManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM wo_holiday_category";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO wo_holiday_category (
							work_category_name,
							sort,
							delete_flag,
							updated,
							created
							)
						VALUES (
							'{$inputArray["work_category_name"]}',
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

			$this->sql = "UPDATE wo_holiday_category
							SET 
							work_category_name					='{$inutArray["work_category_name"]}',
							updated					 = now()
							WHERE wo_holiday_category_id = {$inputArray["wo_holiday_category_id"]};" ;

			return $this->ExecuteNonQuery();
        }
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new wo_holiday_categoryModel();
        }
    }
?>