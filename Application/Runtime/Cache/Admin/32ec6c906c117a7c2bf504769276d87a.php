<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">

<title>登陆页面</title>

<!-- Bootstrap core CSS -->
<link href="/statics/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="/statics/css/signin.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="/statics/bootstrap/js/html5shiv.min.js"></script>
    <script src="/statics/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">
		<form class="form-signin" role="form" action="login/dologin" method="post" id="loginForm">
			<h2 class="form-signin-heading">欢迎您！</h2>
			<input type="text" class="form-control" placeholder="账号" name="username" check-type="required" autofocus> 
			<input type="password" class="form-control" placeholder="密码" name="password" check-type="required" id="txbPassword">
			<input type="button" class="btn btn-lg btn-primary btn-block" id="btnConfirm" value="登 陆" /> 
			<span id="validateMsg" class="is-error"></span>
		</form>
	</div>
	<!--msg tip-->
	<div class="modal fade" id="msgModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">提示框</h4>
				</div>
				<div class="modal-body" id="msgModalBody"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
				</div>
			</div>
		</div>
	</div>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script type="text/javascript" src="/statics/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
	<script type="text/javascript" src="/statics/js/jquery.min.js"></script>
	<script type="text/javascript" src="/statics/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/statics/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/statics/bootstrap/js/messages_cn.js"></script>
	<script type="text/javascript" src="/statics/js/signin.js"></script>
</body>
</html>