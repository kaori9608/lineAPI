<?php
	class staffModel{
		var	$staff_id			=	null;
		var	$staff_name			=	null;
		var	$staff_name_kana	=	null;
		var	$nickname			=	null;
		var	$shop_id			=	null;
		var	$rank_id			=	null;
		var	$staff_status		=	null;//在籍状況　0＝在籍、1＝退職者
		var	$staff_post			=	null;//職級
		var	$staff_birthday		=	null;//誕生日
		var	$staff_sex			=	null;//性別　0=未選択、1＝男性、2＝女性
		var $entry_date			=	null;//入社日
		var $retire_date		=	null;//退職日
		var $sort				=	null;
		var	$delete_flag 		=	null;
		var	$updated			=	null;
		var	$created			=	null;
	}
?>