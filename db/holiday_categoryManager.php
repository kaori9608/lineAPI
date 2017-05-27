<?php
	require_once("base/wo_holiday_categoryManager.php");
	require_once("holiday_categoryModel.php");
	
	class holiday_categoryManager extends wo_holiday_categoryManager{

		 //---------------------------------------------------------------------------
		 //エンティティ作成用メソッド
		 //---------------------------------------------------------------------------
		 function createObj($inputArray = array()){
		 	return new holiday_categoryModel();
		 }		
	}
?>