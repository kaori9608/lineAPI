<?php
	require_once("base/me_staff_detailManager.php");
	require_once("staff_detailModel.php");
	
	class staff_detailManager extends me_staff_detailManager{

		//---------------------------------------------------------------------------
		//次回免許更新日をソート掛けしたリスト表示
		//---------------------------------------------------------------------------
		function findByStaffDetailId($me_staff_detail_id = null){
			$this->sql = "SELECT
							me_staff_detail.me_staff_detail_id,
							me_staff_detail.staff_id,
							staff.staff_id,
							staff.staff_name,
							staff.staff_sex,
							staff.shop_id,
							staff.staff_status,
							staff.staff_post_id,
							staff.staff_name_kana,
							staff.entry_date,
							staff.retire_date,
							staff.staff_birthday,
							me_staff_detail.attend_shop_id,
							shop.shop_name,
							staff.rank_id,
							rank.rank_name,
							me_staff_detail.work_category_id,
							work_category.work_category_name,
							me_staff_detail.license_issue,
							me_staff_detail.license_update,
							me_staff_detail.note
						FROM shop RIGHT JOIN ((rank RIGHT JOIN (me_staff_detail INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id) ON rank.rank_id = staff.rank_id)
							LEFT JOIN work_category ON me_staff_detail.work_category_id = work_category.work_category_id) ON shop.shop_id = me_staff_detail.attend_shop_id
						WHERE (((me_staff_detail.me_staff_detail_id)=" . $me_staff_detail_id . "));";
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//支店IDと職務IDを条件とした一覧
		//---------------------------------------------------------------------------
		function findByShopIdAndWorkCategory($shop_id = null,$work_category_id = null,$work_time = null){
			$this->sql = "SELECT
							me_staff_detail.me_staff_detail_id,
							me_staff_detail.staff_id,
							staff.staff_id,
							staff.staff_name,
							staff.nickname,
							staff.staff_status,
							staff.staff_post_id,
							staff.shop_id,
							staff.sort,
							me_staff_detail.attend_shop_id,
							shop.shop_name,
							me_staff_detail.work_category_id,
							work_category.work_category_name,
							work_category.work_label
						FROM shop INNER JOIN ((rank RIGHT JOIN (me_staff_detail INNER JOIN staff ON me_staff_detail.staff_id = staff.staff_id) ON rank.rank_id = staff.rank_id)
							INNER JOIN work_category ON me_staff_detail.work_category_id = work_category.work_category_id) ON shop.shop_id = me_staff_detail.attend_shop_id
						WHERE (((me_staff_detail.attend_shop_id)=" . $shop_id . " AND (me_staff_detail.work_category_id)=" . $work_category_id . " AND (staff.entry_date) BETWEEN '1980-01-01' AND '" . $work_time . "' AND (staff.staff_status) NOT LIKE 1))
						ORDER BY staff.sort ASC;";
						//echo $this->sql;exit;
			return $this->ExecuteReturnQuery(true);
		}

		//---------------------------------------------------------------------------
		//退職者を除いた名簿一覧
		//---------------------------------------------------------------------------
		function findAllNotLikeTaishok(){
			$this->sql = "SELECT me_staff_detail.me_staff_detail_id, me_staff_detail.staff_id, staff.staff_status, me_staff_detail.attend_shop_id
							FROM shop RIGHT JOIN (me_staff_detail LEFT JOIN staff ON me_staff_detail.staff_id = staff.staff_id) ON shop.shop_id = me_staff_detail.attend_shop_id
							WHERE (((staff.staff_status) NOT LIKE 1))
							ORDER BY `me_staff_detail`.`attend_shop_id` ASC;";
			return $this->ExecuteReturnQuery(true);
		}

		 //---------------------------------------------------------------------------
		 //エンティティ作成用メソッド
		 //---------------------------------------------------------------------------
		 function createObj($inputArray = array()){
		 	return new staff_detailModel();
		 }		
	}
?>