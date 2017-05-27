<?php
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/db/base/appmodel.php");
	require_once("wo_work_statusModel.php");
	class wo_work_statusManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM wo_work_status";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO wo_work_status (
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

			$this->sql = "UPDATE wo_work_status
							SET 
							work_category_name					='{$inutArray["work_category_name"]}',
							updated					 = now()
							WHERE wo_work_status_id = {$inputArray["wo_work_status_id"]};" ;

			return $this->ExecuteNonQuery();
        }
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new wo_work_statusModel();
        }
    }
?>