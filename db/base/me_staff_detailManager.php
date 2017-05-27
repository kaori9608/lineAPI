<?php
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/db/base/appmodel.php");
	require_once("me_staff_detailModel.php");
	
	class me_staff_detailManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM me_staff_detail ORDER BY sort";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			if($inputArray["shop_id"]==""){
				$inputArray["shop_id"] = "0";
			}

			$this->sql = "
						INSERT INTO me_staff_detail (
							staff_id,
							shop_id,
							work_kategory_id,
							license_update,
							note,
							sort,
							delete_flag,
							updated,
							created
						)
						VALUES (
							'{$inputArray["staff_id"]}',
							'{$inputArray["shop_id"]}',
							'{$inputArray["work_kategory_id"]}',
							'{$inputArray["license_update"]}',
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

			$this->sql = "UPDATE me_staff_detail
							SET 
								shop_id 			= '{$inputArray["shop_id"]}',
								license_update 		= '{$inputArray["license_update"]}',
								note 				= '{$inputArray["note"]}',
								updated 			= now()
							WHERE me_staff_detail_id = '{$inputArray["me_staff_detail_id"]}'" ;
			return $this->ExecuteNonQuery();
        }
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new me_staff_detailModel();
        }
    }
?>