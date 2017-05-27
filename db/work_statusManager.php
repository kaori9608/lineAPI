<?php
	require_once("base/wo_work_statusManager.php");
	require_once("work_statusModel.php");
	
	class work_statusManager extends wo_work_statusManager{

		//---------------------------------------------------------------------------
		//次回免許更新日をソート掛けしたリスト表示
		//---------------------------------------------------------------------------
		function findByWorkStatusId($wo_work_status_id = null){
			$this->sql = "SELECT *
							FROM wo_work_status
							WHERE wo_work_status_id =" . $wo_work_status_id . ";";
			return $this->ExecuteReturnQuery(true);
		}

		 //---------------------------------------------------------------------------
		 //エンティティ作成用メソッド
		 //---------------------------------------------------------------------------
		 function createObj($inputArray = array()){
		 	return new work_statusModel();
		 }		
	}
?>