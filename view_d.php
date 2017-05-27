<!DOCTYPE html>
<html lang="ja">
<head>
<title>社員管理 | NessieTaLina Database System Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/worktime.css" media="all" />                          <!-- CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

</head>
<body style="overflow-y: hidden; display:none;" id="feadbox">
<SCRIPT Language="JavaScript">
    window.onload = firstscript;
    function firstscript() {
        $("#feadbox").removeClass("hidden"); 
    }
</SCRIPT>
<SCRIPT Language="JavaScript">
$(function(){
    $('#feadbox').hide();
    $('#feadbox').fadeIn(2000);
    // サイトアクセス時にbodyを非表示にしてから、フェードインさせる
});
<!--
//一分経ったらリロードする
setTimeout("Rld()",60000);
function Rld()
{
    location.href = "../workoff/view_d.html";
}

//ctlキーを押したらフェードアウトしてリンクする
window.onload = function(){
    window.document.onkeydown = function(evt){
        if (evt){
            var kc = evt.keyCode;
        }else{
            var kc = event.keyCode;
        }
        var chr = String.fromCharCode(kc);

        if(kc == 17){
            feed();
        }

    }
}
function feed()
{
    $('#feadbox').fadeOut(2000);
    setTimeout("rink()",3000);
}
function rink()
{
    location.href = "../workoff/view_d.html";
}
// -->
</SCRIPT>

<div id="wrap" class="">
<!-- Menu Horizontal -->
<?php
    require_once (dirname(dirname(dirname(__FILE__))) . "/misaki_framework/core/request.php");
    require_once (dirname(dirname(dirname(__FILE__))) . "/misaki_framework/core/session.php");
    require_once ("controllers/worktimeController.php");
    require_once ("controllers/staff_detailController.php");
    require_once ("controllers/staff_work_offController.php");
    require_once ("controllers/wo_tagHelper.php");

    //必要なインスタンス生成
    $request = new Request();
    $session = new Session();

    $staff_detailrequest = new Request();
    $staff_detailsession = new Session();

    $work_offrequest = new Request();
    $work_offsession = new Session();

    $wo_tagHelper = new wo_tagHelper();
    $worktimeController = new worktimeController($request, $session);
    $staff_detailController = new staff_detailController($staff_detailrequest, $staff_detailsession);
    $staff_work_offController = new staff_work_offController($work_offrequest, $work_offsession);


    //本社
    //総務部
    $honsya_somu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(10,15);//支店、部署の順番
    //経理課
    $honsya_keiri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(10,16);//支店、部署の順番
    //人事課
    $honsya_jinji_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(10,14);//支店、部署の順番

    //営業オークション
    $honsya_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(10,11);//支店、部署の順番
    //営業システム
    $honsya_system_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(10,12);//支店、部署の順番



    //東北支店
    //管理
    $tohoku_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(1,2);//支店、部署の順番

    //営業
    $tohoku_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(1,1);//支店、部署の順番

    //事務
    $tohoku_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(1,8);//支店、部署の順番

    //北関東
    //管理
    $kitakanto_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(2,2);//支店、部署の順番

    //営業
    $kitakanto_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(2,1);//支店、部署の順番

    //事務
    $kitakanto_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(2,8);//支店、部署の順番

    //関東
    //管理
    $kanto_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(3,2);//支店、部署の順番

    //営業
    $kanto_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(3,1);//支店、部署の順番

    //事務
    $kanto_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(3,8);//支店、部署の順番

    //東海
    //管理
    $tokai_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(4,2);//支店、部署の順番

    //営業
    $tokai_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(4,1);//支店、部署の順番

    //事務
    $tokai_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(4,8);//支店、部署の順番

    //関西
    //管理
    $kansai_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(5,2);//支店、部署の順番

    //営業
    $kansai_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(5,1);//支店、部署の順番

    //事務
    $kansai_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(5,8);//支店、部署の順番

    //九州
    //管理
    $kyusyu_kanri_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(6,2);//支店、部署の順番

    //営業
    $kyusyu_eigyo_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(6,1);//支店、部署の順番

    //事務
    $kyusyu_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(6,8);//支店、部署の順番

    //回送センター
    //管理
    $kaiso_driver_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(11,10);//支店、部署の順番

    //事務
    $kaiso_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(11,8);//支店、部署の順番

    //札幌CC
    //管理
    $sapporo_trainer_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(7,19);//支店、部署の順番

    //事務
    $sapporo_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(7,8);//支店、部署の順番

    //仙台CC
    //管理
    $sendai_trainer_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(8,19);//支店、部署の順番

    //事務
    $sendai_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(8,8);//支店、部署の順番

    //福岡CC
    //管理
    $fukuoka_trainer_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(9,19);//支店、部署の順番

    //事務
    $fukuoka_jimu_list = $staff_detailController->getStaffListByShopIdAndWorkcategoryId(9,8);//支店、部署の順番
?>
    <div class="box">
        <div class="box50">
            <h3>在籍者一覧</h3>
        </div>
        <div class="box50">
            <h3><?php echo date("Y/m/d(D)"); ?></h3>
        </div>
    </div>
    <div class="">
        <div class="global_box">
    		<div class="shop_box">
    		    <div class="shop_left_box shop_left_box_4">本社</div>
    			<div class="shop_right_box">
        				<div class="group_box">
        					<div class="group_name_box group_name_box_job">経理部</div>
        					<div class="staff_box">

                                <?php if($honsya_keiri_list): ?>
                                    <?php foreach($honsya_keiri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>
                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>
                                            
                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>

                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "経理課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "経理課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "経理課";}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

        					</div>
        				</div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">総務部</div>
                            <div class="staff_box">
                                <?php if($honsya_somu_list): ?>
                                    <?php foreach($honsya_somu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "総務課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "総務課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "総務課";}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if($honsya_jinji_list): ?>
                                    <?php foreach($honsya_jinji_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "人事課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "人事課";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "人事課";}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                                       
                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業部</div>
                            <div class="staff_box">
                                <?php if($honsya_eigyo_list): ?>
                                    <?php foreach($honsya_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if($honsya_system_list): ?>
                                    <?php foreach($honsya_system_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo "営業部";}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>

    			</div>

    		</div>

<!-- 東北支店 -->
    		<div class="shop_box">
    		    <div class="shop_left_box shop_left_box_3">東北支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($tohoku_kanri_list): ?>
                                    <?php foreach($tohoku_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($tohoku_eigyo_list): ?>
                                    <?php foreach($tohoku_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>
                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($tohoku_jimu_list): ?>
                                    <?php foreach($tohoku_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
    		</div>
<!-- 北関東支店 -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_3">北関東支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($kitakanto_kanri_list): ?>
                                    <?php foreach($kitakanto_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($kitakanto_eigyo_list): ?>
                                    <?php foreach($kitakanto_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($kitakanto_jimu_list): ?>
                                    <?php foreach($kitakanto_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 関東支店 -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_3">関東支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($kanto_kanri_list): ?>
                                    <?php foreach($kanto_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($kanto_eigyo_list): ?>
                                    <?php foreach($kanto_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($kanto_jimu_list): ?>
                                    <?php foreach($kanto_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 東海支店 -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_3">東海支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($tokai_kanri_list): ?>
                                    <?php foreach($tokai_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($tokai_eigyo_list): ?>
                                    <?php foreach($tokai_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($tokai_jimu_list): ?>
                                    <?php foreach($tokai_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 関西支店 -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_3">関西支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($kansai_kanri_list): ?>
                                    <?php foreach($kansai_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($kansai_eigyo_list): ?>
                                    <?php foreach($kansai_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($kansai_jimu_list): ?>
                                    <?php foreach($kansai_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 九州支店 -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_3">九州支店</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($kyusyu_kanri_list): ?>
                                    <?php foreach($kyusyu_kanri_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job_head">営業</div>
                            <div class="staff_box">

                                <?php if($kyusyu_eigyo_list): ?>
                                    <?php foreach($kyusyu_eigyo_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0 bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?> bottom_border">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?> bottom_border">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($kyusyu_jimu_list): ?>
                                    <?php foreach($kyusyu_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 回送センター -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_1">回送センター</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">管理</div>
                            <div class="staff_box">

                                <?php if($kaiso_driver_list): ?>
                                    <?php foreach($kaiso_driver_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($kaiso_jimu_list): ?>
                                    <?php foreach($kaiso_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 札幌CC -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_1">札幌CC</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">トレーナー</div>
                            <div class="staff_box">

                                <?php if($sapporo_trainer_list): ?>
                                    <?php foreach($sapporo_trainer_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($sapporo_jimu_list): ?>
                                    <?php foreach($sapporo_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 仙台CC -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_1">仙台CC</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">トレーナー</div>
                            <div class="staff_box">

                                <?php if($sendai_trainer_list): ?>
                                    <?php foreach($sendai_trainer_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($sendai_jimu_list): ?>
                                    <?php foreach($sendai_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
<!-- 福岡CC -->
            <div class="shop_box">
                <div class="shop_left_box shop_left_box_1">福岡CC</div>
                <div class="shop_right_box">
                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">トレーナー</div>
                            <div class="staff_box">

                                <?php if($fukuoka_trainer_list): ?>
                                    <?php foreach($fukuoka_trainer_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>
                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="group_box">
                            <div class="group_name_box group_name_box_job">事務</div>
                            <div class="staff_box">
                                <?php if($fukuoka_jimu_list): ?>
                                    <?php foreach($fukuoka_jimu_list as $key => $value): ?>
                                        <?php $work_timelist = $worktimeController->getWorkTimeListByStaffDetailId($value->me_staff_detail_id); ?>

                                        <?php if($work_timelist==array()){//今日の出勤データが未入力の場合?>

                                            <?php $horidayList = $staff_work_offController->getBeforeHoliday($value->staff_id);//前日の休暇データを取得 ?>
                                            <?php if($horidayList==array()){//前日の休暇データがなく、今日の出勤データもない場合?>
                                                <div class="staff_detail_box status0">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }else{//前日の休暇データがある場合?>
                                                <div class="staff_detail_box <?php echo $wo_tagHelper->getHolidayStatusBackgroundColor($horidayList[0]->wo_holiday_category_id); ?>">
                                                    <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                    <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                                </div>
                                            <?php }?>

                                        <?php }else{//今日の出勤データがある場合の処理?>
                                            <div class="staff_detail_box <?php echo $wo_tagHelper->getStatusBackgroundColor($value->staff_post_id,$work_timelist[0]->wo_work_status_id,$value->shop_id,$value->attend_shop_id);?>">
                                                <div class="staff_job_box"><?php if($value->staff_post_id){echo $wo_tagHelper->getStaffPost_name($value->staff_post_id);}else{echo $value->work_label;}?></div>
                                                <div class="staff_name_box"><?php echo $value->nickname; ?></div>
                                            </div>
                                        <?php }?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
</body>
</html>
