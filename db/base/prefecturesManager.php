<?php
	require_once(dirname(__FILE__) . "/appmodel.php");
	require_once(dirname(__FILE__) . "/prefecturesModel.php");
	
	class prefecturesManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM prefectures ORDER BY sort";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE prefectures
							SET name = '{$inputArray["name"]}',
								entry = '{$inputArray["entry"]}',
								sort = '{$inputArray["sort"]}',
								updated = now()
							WHERE prefectures_id = '{$inputArray["prefectures_id"]}'" ;
			
			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO prefectures (
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
            return new prefecturesModel();
        }
    }
?>