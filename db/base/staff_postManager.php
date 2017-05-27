<?php
	require_once("appmodel.php");
	require_once("staff_postModel.php");

	class staff_postManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM staff_post WHERE staff_post_id NOT LIKE 0";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE staff_post
							SET staff_post_name = '{$inputArray["staff_post_name"]}',
								staff_post_name_kana = '{$inputArray["staff_post_name_kana"]}',
								shop_id = '{$inputArray["shop_id"]}',
								rank_id = '{$inputArray["rank_id"]}',
								staff_post_post = '{$inputArray["staff_post_post"]}',
								staff_post_sex = '{$inputArray["staff_post_sex"]}',
								staff_post_status = '{$inputArray["staff_post_status"]}',
								entry_date = '{$inputArray["entry_date"]}',
								retire_date = '{$inputArray["retire_date"]}',
								sort = '0',
								updated = now()
							WHERE staff_post_id = '{$inputArray["staff_post_id"]}'" ;

				return $this->ExecuteNonQuery();
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
				if($inputArray["staff_post_status"]==""){
					$inputArray["staff_post_status"] = "0";
				}
				if($inputArray["rank_id"]=="0"){
					$inputArray["rank_id"] = "0";
				}
				if($inputArray["staff_post_sex"]==""){
					$inputArray["staff_post_sex"] = "0";
				}
				if($inputArray["entry_date"]==""){
					$inputArray["entry_date"] = "null";
				}
				if($inputArray["retire_date"]==""){
					$inputArray["retire_date"] = "null";
				}
				if($inputArray["staff_post_birthday"]==""){
					$inputArray["staff_post_birthday"] = "null";
				}

			$this->sql = "INSERT INTO staff_post (
							staff_post_name,
							staff_post_name_kana,
							shop_id, 
							rank_id, 
							staff_post_status,
							staff_post_sex,
							staff_post_post,
							staff_post_birthday,
							entry_date,
							retire_date,
							sort,
							delete_flag, 
							created,
							updated)
						VALUES (
							'{$inputArray["staff_post_name"]}',
							'{$inputArray["staff_post_name_kana"]}',
							{$inputArray["shop_id"]},
							{$inputArray["rank_id"]},
							{$inputArray["staff_post_status"]},
							{$inputArray["staff_post_sex"]},
							'{$inputArray["staff_post_post"]}',
							'{$inputArray["staff_post_birthday"]}',
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
            return new staff_postModel();
        }
    }
?>
