<?php
	require_once(dirname(__FILE__) . "/appmodel.php");
	require_once(dirname(__FILE__) . "/kanri_site_dataModel.php");
	
	class kanri_site_dataManager extends appmodel{

		//---------------------------------------------------------------------------
		//テーブルからデータを取得する処理
		//---------------------------------------------------------------------------
		function findAll(){
			$this->sql = "SELECT * FROM kanri_site_data ORDER BY sort";
			return $this->ExecuteReturnQuery(true);
		}
		
		//---------------------------------------------------------------------------
		//データを登録する処理
		//---------------------------------------------------------------------------
		function addItems($inputArray = array()){
			switch ($inputArray["import_category"]){
				case 1:
					$this->sql = "
							INSERT INTO kanri_site_data (
								import_category,
								car_id,
								car_status,
								shop_name,
								annken_date,
								ap_category,
								ap_staff,
								cliant_name,
								car_name,
								driver_staff,
								updated,
								created)
							VALUES (
								1,
								'{$inputArray["car_id"]}',
								'{$inputArray["car_status"]}',
								'{$inputArray["shop_name"]}',
								'{$inputArray["annken_date"]}',
								'{$inputArray["ap_category"]}',
								'{$inputArray["ap_staff"]}',
								'{$inputArray["cliant_name"]}',
								'{$inputArray["car_name"]}',
								'{$inputArray["driver_staff"]}',
								now(),
								now()
								)";
				
					break;
				case 2:
					$this->sql = "
							INSERT INTO kanri_site_data (
								import_category,
								car_id,
								car_status,
								shop_name,
								annken_date,
								ap_category,
								ap_staff,
								visit_ap_date,
								visit_ap_category,
								visit_ap_staff,
								cliant_name,
								car_name,
								driver_staff,
								updated,
								created)
							VALUES (
								2,
								'{$inputArray["car_id"]}',
								'{$inputArray["car_status"]}',
								'{$inputArray["shop_name"]}',
								'{$inputArray["annken_date"]}',
								'{$inputArray["ap_category"]}',
								'{$inputArray["ap_staff"]}',
								'{$inputArray["visit_ap_date"]}',
								'{$inputArray["visit_ap_category"]}',
								'{$inputArray["visit_ap_staff"]}',
								'{$inputArray["cliant_name"]}',
								'{$inputArray["car_name"]}',
								'{$inputArray["driver_staff"]}',
								now(),
								now()
								)";
				
					break;
				case 3:
					$this->sql = "
							INSERT INTO kanri_site_data (
								import_category,
								car_id,
								car_status,
								shop_name,
								annken_date,
								ap_category,
								ap_staff,
								visit_ap_date,
								visit_ap_category,
								visit_ap_staff,
								buy_date,
								buyer_staff,
								buy_price,
								sall_date,
								sell_price,
								cliant_name,
								car_name,
								driver_staff,
								updated,
								created)
							VALUES (
								3,
								'{$inputArray["car_id"]}',
								'{$inputArray["car_status"]}',
								'{$inputArray["shop_name"]}',
								'{$inputArray["annken_date"]}',
								'{$inputArray["ap_category"]}',
								'{$inputArray["ap_staff"]}',
								'{$inputArray["visit_ap_date"]}',
								'{$inputArray["visit_ap_category"]}',
								'{$inputArray["visit_ap_staff"]}',
								'{$inputArray["buy_date"]}',
								'{$inputArray["buyer_staff"]}',
								'{$inputArray["buy_price"]}',
								'{$inputArray["sall_date"]}',
								'{$inputArray["sell_price"]}',
								'{$inputArray["cliant_name"]}',
								'{$inputArray["car_name"]}',
								'{$inputArray["driver_staff"]}',
								now(),
								now()
								)";
				
					break;
				default:
					break;
			}
			
			
			
			$this->sql=str_replace('"','',$this->sql);
			
			return $this->ExecuteNonQuery(true);
		}

		//---------------------------------------------------------------------------
		//データを更新する処理
		//---------------------------------------------------------------------------
		function editItems($inputArray =array()){
			$this->sql = "UPDATE kanri_site_data
							SET 
								import_category		= '{$inputArray["import_category"]}',
								car_id				= '{$inputArray["staffcar_id_id"]}',
								car_status			= '{$inputArray["car_status"]}',
								shop_name			= '{$inputArray["shop_name"]}',
								annken_date			= '{$inputArray["annken_date"]}',
								ap_category			= '{$inputArray["ap_category"]}',
								ap_staff			= '{$inputArray["ap_staff"]}',
								visit_ap_date		= '{$inputArray["visit_ap_date"]}',
								visit_ap_category	= '{$inputArray["visit_ap_category"]}',
								visit_ap_staff		= '{$inputArray["visit_ap_staff"]}',
								buy_date			= '{$inputArray["buy_date"]}',
								buyer_staff			= '{$inputArray["buyer_staff"]}',
								buy_price			= '{$inputArray["buy_price"]}',
								sall_date			= '{$inputArray["sall_date"]}',
								sell_price			= '{$inputArray["sell_price"]}',
								cliant_name			= '{$inputArray["cliant_name"]}',
								car_name			= '{$inputArray["car_name"]}',
								driver_staff		= '{$inputArray["driver_staff"]}',
								updated				=  now()
							WHERE tarm_id = '{$inputArray["kanri_site_data_id"]}'" ;
			return $this->ExecuteNonQuery();
        }
		
		//---------------------------------------------------------------------------
		//import_categoryで指定したデータを削除する処理
		//---------------------------------------------------------------------------
		function delAllItemByImportCategory($import_category = null){
			if(is_numeric($import_category)){
				$this->sql = "DELETE FROM kanri_site_data WHERE import_category = {$import_category}";
				return $this->ExecuteNonQuery();
			}
		}
		
		
        //---------------------------------------------------------------------------
        //エンティティ作成用メソッド
        //---------------------------------------------------------------------------
        function createObj($inputArray = array()){
            return new kanri_site_dataModel();
        }
    }
?>