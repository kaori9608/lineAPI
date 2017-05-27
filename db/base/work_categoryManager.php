<?php
	require_once("appmodel.php");
	require_once("work_categoryModel.php");

	class work_categoryManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM work_category WHERE work_category_id NOT LIKE 0";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE work_category
							SET work_category_name = '{$inputArray["work_category_name"]}',
								work_category_name_kana = '{$inputArray["work_category_name_kana"]}',
								shop_id = '{$inputArray["shop_id"]}',
								rank_id = '{$inputArray["rank_id"]}',
								work_category_post = '{$inputArray["work_category_post"]}',
								work_category_sex = '{$inputArray["work_category_sex"]}',
								work_category_status = '{$inputArray["work_category_status"]}',
								entry_date = '{$inputArray["entry_date"]}',
								retire_date = '{$inputArray["retire_date"]}',
								sort = '0',
								updated = now()
							WHERE work_category_id = '{$inputArray["work_category_id"]}'" ;

				return $this->ExecuteNonQuery();
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
				if($inputArray["work_category_status"]==""){
					$inputArray["work_category_status"] = "0";
				}
				if($inputArray["rank_id"]=="0"){
					$inputArray["rank_id"] = "0";
				}
				if($inputArray["work_category_sex"]==""){
					$inputArray["work_category_sex"] = "0";
				}
				if($inputArray["entry_date"]==""){
					$inputArray["entry_date"] = "null";
				}
				if($inputArray["retire_date"]==""){
					$inputArray["retire_date"] = "null";
				}
				if($inputArray["work_category_birthday"]==""){
					$inputArray["work_category_birthday"] = "null";
				}

			$this->sql = "INSERT INTO work_category (
							work_category_name,
							work_category_name_kana,
							shop_id, 
							rank_id, 
							work_category_status,
							work_category_sex,
							work_category_post,
							work_category_birthday,
							entry_date,
							retire_date,
							sort,
							delete_flag, 
							created,
							updated)
						VALUES (
							'{$inputArray["work_category_name"]}',
							'{$inputArray["work_category_name_kana"]}',
							{$inputArray["shop_id"]},
							{$inputArray["rank_id"]},
							{$inputArray["work_category_status"]},
							{$inputArray["work_category_sex"]},
							'{$inputArray["work_category_post"]}',
							'{$inputArray["work_category_birthday"]}',
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
            return new work_categoryModel();
        }
    }
?>
