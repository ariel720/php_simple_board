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
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, user-scalable=yes">
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
            </div>
            <h3>Welcome to <?= APPLICATION_NAME ?></h3>

            <form class="m-t" role="form" >
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="button" onclick="$.submit()" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"></a>
                <p class="text-muted text-center"></p>
                
            </form>
            <p class="m-t"> <small>we app framework base on Bootstrap 3 © 2014</small> </p>
        </div>
    </div>

<!-- Mainly scripts -->
<script type="text/javascript">
$.submit = function(){
	var email = $('input[name=email]').val();
	var passwd = $('input[name=password]').val();
	console.log(email);
			
	App1000.post("/admin/admins/ajax_login", {"email":email, "passwd":passwd}, 
		function(response) {
			if (response.r == "ok") {
				document.location.href = "/admin/admins/main";
			}
			else {
				alert(response.m + "("+response.c+")");
			}
		});
}
</script>
</body>
</html>