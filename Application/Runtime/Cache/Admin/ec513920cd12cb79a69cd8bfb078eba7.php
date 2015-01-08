<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="renderer" content="webkit">
        <!--<link rel="icon" href="../../favicon.ico">-->

        <title>后台管理-修改文章分类</title>

        <!-- Bootstrap core CSS -->
        <link href="/statics/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/statics/css/dashboard.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/statics/bootstrap/js/html5shiv.min.js"></script>
        <script src="/statics/bootstrap/js/respond.min.js"></script>
        <![endif]-->
        
        <link href="/statics/iCheck/skins/flat/green.css" rel="stylesheet">
        <link href="/statics/iCheck/skins/square/green.css" rel="stylesheet">
    </head>
    <body>
        <nav id="navBar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">后台管理</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">桌面</a>
                        </li>
                        <li>
                            <a href="#">设置</a>
                        </li>
                        <li>
                            <a href="#">帮助</a>
                        </li>
                        <li>
                            <a href="/admin/login/doLoginOut">注销</a>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search..."></form>
                </div>
            </div>
        </nav>
        <div class="container-fluid"  id="main">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" id="leftMenu">
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" id="rightContent">
                    <div id="mainTop">
                        <h4 id="contentTitle">
                            修改文章分类
                        </h4>
                        
	<ul class="nav nav-tabs" role="tablist">
	  <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">基本信息</a></li>
	</ul>

                    </div>
                    <div id="mainMiddle">
                    	
	<!-- Tab panes -->
	<form class="tab-content form-horizontal" role="form" id="contentForm">
	  <div role="tabpanel" class="tab-pane active" id="home">
	  	  <div class="form-group"></div>
		  <div class="form-group">
		    <label for="parentID" class="col-sm-2 control-label">上级分类</label>
		    <div class="col-sm-4">
		    <?php echo (d('articlecategory')->getselecthtml($result["parentID"])); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span> 标题</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="title" placeholder="标题长度为1-255个字符" value="<?php echo ($result["title"]); ?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="sortID" class="col-sm-2 control-label"><span style="color:red;">*</span> 排序</label>
		    <div class="col-sm-1">
		      <input type="text" class="form-control" name="sortID" placeholder="数值越小越靠前" value="<?php echo ($result["sortID"]); ?>">
		    </div>
		  </div>
	  </div>
	</form>

                    </div>
                    <div id="mainBottom">
                        
	<div id="divControl">
		<button type="submit" class="btn btn-success btn-lg" id="btnSave">保 存</button>
		<span id="validateMsg" class="is-error"></span>
	</div>

                    </div>
                </div>
            </div>
        </div>
        <ul role="tablist" class="nav nav-tabs" id="navTabs">
        </ul>
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
		<div class="modal fade" id="sucMsgModal" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">提示框</h4>
					</div>
					<div class="modal-body" id="sucMsgModalBody"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">添加相似</button>
						<a class="btn btn-warning" href="lists">返回列表</a>
						<a class="btn btn-success" href="add">继续添加</a>
					</div>
				</div>
			</div>
		</div>
        <script src="/statics/js/jquery.min.js"></script>
        <script src="/statics/bootstrap/js/bootstrap.min.js"></script>
        <script src="/statics/bootstrap/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/statics/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script src="/statics/js/menu.js"></script>
        <script src="/statics/iCheck/icheck.js"></script>
        <script src="/statics/js/commonAdd.js"></script>
        <script type="text/javascript" src="/statics/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/statics/bootstrap/js/messages_cn.js"></script>
        
	<script type="text/javascript">
	$(function(){ 
		NavTabsSelect(1);
		LeftMenuSelect(1,4);
		
		<!-- 验证初始化 -->
		$contentForm=$('#contentForm');//表单
		$validateMsg=$('#validateMsg');
		$contentForm.validate({
			ignore: [],
			errorClass : 'is-error',
			showErrors : function(errorMap, errorList) {
				if (this.numberOfInvalids() > 0) {
					$validateMsg.html(this.numberOfInvalids() + '处信息填写有误！')
							.show();
					this.defaultShowErrors();
				} else {
					$validateMsg.hide();
				}
			},
			rules : {
				title :{
					    required: true,
					    maxlength:255
				    },
				sortID:{
					required: true,
					digits:true
				}
			},
			messages : {
				title : '标题长度为1-255个字符',
				sortID:'排序为整数'
			}
		});
		
		$btnSave=$('#btnSave');
		$btnSave.click(function(){
			$btnSave.attr('disabled',true);
			if ($contentForm.valid()) {
				$.ajax({
					data : $contentForm.serialize(),
					type : "POST",
					beforeSend : function() {
					},
					error : function(request) {
						var data={'info':request.responseText};
						TipShow2(data);
						$btnSave.attr('disabled',false);
					},
					success : function(data) {
						TipShow2(data);
						$btnSave.attr('disabled',false);
					}
				});
			}
			else{
				$btnSave.attr('disabled',false);
			}
			return false;
		});
	});
	</script>

    </body>
</html>