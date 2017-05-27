<?php
	require_once("appmodel.php");
	require_once("staffModel.php");

	class staffManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM staff";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE staff
							SET staff_name = '{$inputArray["staff_name"]}',
								staff_name_kana = '{$inputArray["staff_name_kana"]}',
								shop_id = '{$inputArray["shop_id"]}',
								rank_id = '{$inputArray["rank_id"]}',
								staff_post = '{$inputArray["staff_post"]}',
								staff_sex = '{$inputArray["staff_sex"]}',
								staff_status = '{$inputArray["staff_status"]}',
								entry_date = '{$inputArray["entry_date"]}',
								retire_date = '{$inputArray["retire_date"]}',
								sort = '0',
								updated = now()
							WHERE staff_id = '{$inputArray["staff_id"]}'" ;

				return $this->ExecuteNonQuery();
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
				if($inputArray["staff_status"]==""){
					$inputArray["staff_status"] = "0";
				}
				if($inputArray["rank_id"]=="0"){
					$inputArray["rank_id"] = "0";
				}
				if($inputArray["staff_sex"]==""){
					$inputArray["staff_sex"] = "0";
				}
				if($inputArray["entry_date"]==""){
					$inputArray["entry_date"] = "null";
				}
				if($inputArray["retire_date"]==""){
					$inputArray["retire_date"] = "null";
				}
				if($inputArray["staff_birthday"]==""){
					$inputArray["staff_birthday"] = "null";
				}

			$this->sql = "INSERT INTO staff (
							staff_name,
							staff_name_kana,
							shop_id, 
							rank_id, 
							staff_status,
							staff_sex,
							staff_post,
							staff_birthday,
							entry_date,
							retire_date,
							sort,
							delete_flag, 
							created,
							updated)
						VALUES (
							'{$inputArray["staff_name"]}',
							'{$inputArray["staff_name_kana"]}',
							{$inputArray["shop_id"]},
							{$inputArray["rank_id"]},
							{$inputArray["staff_status"]},
							{$inputArray["staff_sex"]},
							'{$inputArray["staff_post"]}',
							'{$inputArray["staff_birthday"]}',
							'{$inputArray["entry_date"]}',
							'{$inputArray["retire_date"]}',
							'0',
							'0',
							now(),
							now()
							);";

			return $this->ExecuteNonQuery(true);
		}
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new staffModel();
        }
    }
?>
