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

        <title>后台管理-修改文章</title>

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
        <nav id="navBar" class="navbar navbar-inverse navbar-fixed-top"
	role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar" aria-expanded="false"
				aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">后台管理</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">桌面</a></li>
				<li><a href="/" target="_blank">前台</a></li>
				<li><a href="#">设置</a></li>
				<li><a href="#">帮助</a></li>
				<li><a href="/admin/login/doLoginOut">注销</a></li>
			</ul>
			<form class="navbar-form navbar-right">
				<input type="text" class="form-control" placeholder="Search...">
			</form>
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
                        	<span class="glyphicon glyphicon-edit"></span>
                            修改文章
                        </h4>
                        
	<ul class="nav nav-tabs" role="tablist">
	  <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">基本信息</a></li>
	  <li role="presentation"><a href="#content" role="tab" data-toggle="tab">内容详情</a></li>
	</ul>

                    </div>
                    <div id="mainMiddle">
                    	
	<!-- Tab panes -->
	<form class="tab-content form-horizontal" role="form" id="contentForm">
	  <div role="tabpanel" class="tab-pane active" id="home">
	  	  <div class="form-group"></div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">分类</label>
		    <div class="col-sm-4">
		    	<?php echo D('ArticleCategory')->getSelectHtml('categoryID',$result['categoryID']);?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span> 标题</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="title" value="<?php echo ($result["title"]); ?>" placeholder="标题长度为1-255个字符">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="outerLink" class="col-sm-2 control-label">图片</label>
		    <?php if(strlen($result['imgLink']) > 0): ?><div class="col-sm-2"><img src="<?php echo ($result["imgLink"]); ?>" class="imgTitle"></div>
				<div class="col-sm-2"><input type="file" name="imgLink" value="<?php echo ($result["imgLink"]); ?>"></div>
			<?php else: ?>
				<div class="col-sm-4"><input type="file" name="imgLink"></div><?php endif; ?> 
		  </div>
		  <div class="form-group">
		    <label for="outerLink" class="col-sm-2 control-label">网址</label>
		    <div class="col-sm-4">
		      <input type="text" class="form-control" name="outerLink" value="<?php echo ($result["outerLink"]); ?>" placeholder="网址长度为0-255个字符">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="summary" class="col-sm-2 control-label">摘要</label>
		    <div class="col-sm-4">
		      <textarea class="form-control" rows="3" placeholder="摘要" name="summary"><?php echo ($result["summary"]); ?></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="createTime" class="col-sm-2 control-label">发布时间</label>
		    <div class="col-sm-2">
		      <input type="text" class="form-control" name="createtime" placeholder="时间" value="<?php echo ($result["createtime"]); ?>"
		      onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:ss:mm',skin:'blueFresh',readOnly:true,isShowClear:false})">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">审核状态</label>
		    <div class="col-sm-4">
		    <table class="rdlTable">
			    <tr>
				    <td>
				    	<input type="radio" class="iCheck" name="isAudit" id="isAudit0" value="0" <?php echo ($result['isAudit']=='0'?'checked':''); ?>/><label for="isAudit0">不通过</label>
				    </td>
				    <td>
				    	<input type="radio" class="iCheck" name="isAudit" id="isAudit1" value="1"  <?php echo ($result['isAudit']=='1'?'checked':''); ?>/><label for="isAudit1">通过</label>
				    </td>
				    <td>
				    	<input type="radio" class="iCheck" name="isAudit" id="isAudit2" value="2" <?php echo ($result['isAudit']=='2'?'checked':''); ?>/><label for="isAudit2">未审核</label>		    
				    </td>
			    </tr>
		    </table>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="sortID" class="col-sm-2 control-label"><span style="color:red;">*</span> 排序</label>
		    <div class="col-sm-1">
		      <input type="text" class="form-control" name="sortID" placeholder="数值越小越靠前" value="<?php echo ($result["sortID"]); ?>">
		    </div>
		  </div>
	  </div>
	  <div role="tabpanel" class="tab-pane" id="content">
	  	<div class="form-group"></div>
	    <div class="form-group">
		    <label class="col-sm-2 control-label">内容</label>
		    <div class="col-sm-8">
		      <script id="container" name="contents" type="text/plain">
				<?php echo (htmlspecialchars_decode($result["contents"])); ?>
    		  </script>
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
        <script src="/statics/js/jquery.min.js"></script>
        <script src="/statics/js/jquery.form.js"></script>
        <script src="/statics/bootstrap/js/bootstrap.min.js"></script>
        <script src="/statics/bootstrap/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/statics/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script src="/statics/js/menu.js"></script>
        <script src="/statics/iCheck/icheck.js"></script>
        <script src="/statics/js/commonAdd.js"></script>
        <script type="text/javascript" src="/statics/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/statics/bootstrap/js/messages_cn.js"></script>
        
	<script type="text/javascript" src="/statics/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" src="/statics/ueditor143/ueditor.config.js"></script>
    <script type="text/javascript" src="/statics/ueditor143/ueditor.all.js"></script>   
	<script type="text/javascript">
	$(function(){ 
		NavTabsSelect(1);
		LeftMenuSelect(1);
		TipSet(TipShow2);
		 
		<!-- 实例化编辑器 -->
		var ue = UE.getEditor('container');
		
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
				outerLink:{
					maxlength:255
					},
				sortID:{
					required: true,
					digits:true
				}
			},
			messages : {
				title : '标题长度为1-255个字符',
				outerLink : '网址长度为1-255个字符',
				sortID:'排序为整数'
			}
		});
	});
	</script>

    </body>
</html>