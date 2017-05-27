<?php
	require_once(dirname(__FILE__) . "/appmodel.php");
	require_once(dirname(__FILE__) . "/shopModel.php");
	
	class shopManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM shop ORDER BY sort WHERE shop_id NOT LIKE 0";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE shop
							SET name = '{$inputArray["name"]}',
								entry = '{$inputArray["entry"]}',
								sort = '{$inputArray["sort"]}',
								updated = now()
							WHERE shop_id = '{$inputArray["shop_id"]}'" ;
			
			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO shop (
							name,
							entry, 
							sort, 
							section_id,
							created, 
							updated)
						VALUES (
							'{$inputArray["name"]}', 
							'{$inputArray["entry"]}', 
							'{$inputArray["sort"]}', 
							'{$inputArray["section_id"]}', 
							now(),
							now()
							)";
			
			return $this->ExecuteNonQuery(true);
		}
		
		
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new shopModel();
        }
    }
?>