<?php
	require_once(dirname(__FILE__) . "/appmodel.php");
	require_once(dirname(__FILE__) . "/loginModel.php");

	class loginManager extends appmodel{

		//---------------------------------------------------------------------------
		//loginテーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM login";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//login_idからデータを取得する処理
		//---------------------------------------------------------------------------
		function findById($login_id = null){
			$this->sql = "SELECT * FROM login WHERE login_id = '{$login_id}'";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//staff_idからデータを取得する処理
		//---------------------------------------------------------------------------
		function findByStaffId($staff_id = null){
			$this->sql = "SELECT * FROM login WHERE staff_id = '{$staff_id}'";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//login_id＋passwordから値を取得
		//---------------------------------------------------------------------------
		function findByLoginIdAndPassword($loginid = null , $password =null){
            if($loginid && $password){
            	$this->sql = "SELECT * FROM login WHERE login_id = '{$loginid}' AND password = '{$password}';";
                return $this->ExecuteReturnQuery(true);
            }   
        }
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			
			$this->sql = "
						INSERT INTO login (
							login_id,
							password, 
							staff_id,
							permission, 
							delete_flag, 
							created, 
							updated)
						VALUES (
							'{$inputArray["login_id"]}', 
							'{$inputArray["password"]}', 
							'{$inputArray["staff_id"]}', 
							'{$inputArray["permission"]}', 
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
			$this->sql = "UPDATE login
							SET login.password = '{$inputArray["password"]}',
								login.staff_id = '{$inputArray["staff_id"]}',
								login.permission = '{$inputArray["permission"]}',
								login.updated = now()
							WHERE login.login_id = '{$inputArray["login_id"]}'" ;
			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new loginModel();
        }
    }
?>