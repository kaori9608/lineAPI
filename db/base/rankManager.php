<?php
	require_once(dirname(__FILE__) . "/appmodel.php");
	require_once(dirname(__FILE__) . "/rankModel.php");
	
	class rankManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM rank ORDER BY sort";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAllByRankId($rank_id = null){
			$this->sql = "SELECT * FROM rank WHERE rank_id = " . $rank_id . " ORDER BY sort";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE rank
							SET name = '{$inputArray["name"]}',
								entry = '{$inputArray["entry"]}',
								sort = '{$inputArray["sort"]}',
								updated = now()
							WHERE rank_id = '{$inputArray["rank_id"]}'" ;
			echo $this->sql;exit;
			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO rank (
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
            return new rankModel();
        }
    }
?>