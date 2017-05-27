<!DOCTYPE html>
<html lang="ja">
<head>
<title>社員管理 | NessieTaLina Database System Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="../../css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="../../css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="css/worktime.css" media="all" />                          <!-- CUSTOM STYLES -->

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/kickstart.js"></script>                                  <!-- KICKSTART -->

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link rel="shortcut icon" href="images/logo_icon.ico" type="images/vnd.logo_icon.ico"/>

<script type="text/javascript" src="../../js/datepicker/jquery-ui-1.10.0.js"></script>
<script type="text/javascript" src="../../js/datepicker/jquery.ui.datepicker-ja.js"></script>

<link rel="icon" href="images/logo_icon_icon.png" type="image/png"/>
<?php 
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/config/setting.php"); 
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/misaki_framework/core/include_module.php"); 
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/misaki_framework/core/authentication_db_connection.php"); 
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/misaki_framework/core/session.php"); 
require_once (dirname(dirname(dirname(dirname(__FILE__)))) . "/misaki_framework/core/request.php"); 
$module = new include_module;
$request = new Request();
$session = new Session();
$authentication_db_connection = new authentication_db_connection($request, $session);
$authentication_db_connection->auth();
	

?>
</head>
<body>
<div id="wrap">
<!-- Menu Horizontal -->
<ul class="menu">
	<li class="current"><a href="http://10.38.0.222/ntl/"><img src="../../images/logo_icon.png" >&nbsp;NessieTaLina Database System Project</a></li>
    <li><a>社員管理システム</a></li>
    <li class="col_4 right">
    	<a href="../../logout.php"><i class="fa fa-chain-broken"></i> LOGOUT</a>
    </li>
</ul>

