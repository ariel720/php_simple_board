<?php
	$uri1 = $this->uri->segment(1);
	$uri2 = $this->uri->segment(2);
	$uri3 = $this->uri->segment(3);
		
	$uri = '/'.$uri1.'/'.$uri2.'/'.$uri3;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>CMS</title>
	
	<link rel="stylesheet" href="/resources/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/resources/plugins/font-awesome/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="/resources/plugins/datepicker/bootstrap-datepicker3.css">
	<link rel="stylesheet" href="/resources/plugins/clockpicker/bootstrap-clockpicker.min.css">
	<link rel="stylesheet" href="/resources/plugins/clockpicker/jquery-clockpicker.min.css">
	
	<link rel="stylesheet" href="/resources/plugins/summernote/summernote.css">
	<link rel="stylesheet" href="/resources/plugins/summernote/summernote-bs3.css">
    <link rel="stylesheet" href="/resources/css/style_admin.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<script src="/resources/js/inspinia.js"></script>
	<script src="/resources/plugins/summernote/summernote.min.js"></script>
	<script src="/resources/plugins/typeahead/bootstrap3-typeahead.min.js"></script>
	<script src="/resources/plugins/form/jquery.form.js"></script>
	<script src="/resources/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/resources/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="/resources/plugins/datepicker/bootstrap-datepicker.min.js"></script>
	<script src="/resources/plugins/clockpicker/bootstrap-clockpicker.min.js"></script>
	<script src="/resources/plugins/clockpicker/jquery-clockpicker.min.js"></script>
	<script src="/resources/js/application_admin.js"></script>
	
	<!-- 서클 게이지 추가 -->
	<script src="/resources/js/jquery.easypiechart.min.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, user-scalable=yes">
</head>

<body class="pace-done">

<div id="wrapper">
	<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu" style="display: block;">
                <li class="<? match_uri($uri, '/admin/main') ?>">
                	<a href="/admin/admins/main"><i class="fa fa-th-large"></i>
                    	<span class="nav-label">대쉬보드</span></a>
                </li>
                
                <li >
                    <a href="/admin/admins/lists"><i class="fa fa-music"></i>
                        <span class="nav-label">BOARD</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
	                	 <li class="<? match_uri($uri, '/index.php/member/board/') ?>"><a href="/index.php/member/board/">목록</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
	
</div>

<div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 405px;">
	
	<!-- 상단바 -->
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
            </a>
        </div>
        </nav>
    </div>
    
    <!-- 서브 패널 -->
    <div class="row wrapper border-bottom white-bg page-heading">
	    <div class="col-lg-10">
	        <h2><?= $title ?></h2>
	        <ol class="breadcrumb">
	            <li><?= $title ?></li>
	            <li class="active"><strong><?= $location ?></strong></li>
	        </ol>
	    </div>
	    
	    <div class="col-lg-2">
	    </div>
	</div>
	
    <!-- 본문 -->
    <div class="wrapper wrapper-content animated fadeIn">
