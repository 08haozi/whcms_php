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

        <title>后台管理-<?php echo ($typeName); ?>分类列表</title>

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
                        	<span class="glyphicon glyphicon-align-justify"></span>
                            <?php echo ($typeName); ?>分类列表 
                        </h4>
                        <ul role="tablist" class="nav nav-tabs" id="contentTabs">
                            
<li role="presentation" class="active"><a
	href="/Admin/ArticleCategory/lists">全部（<?php echo ($count); ?>）</a></li>

                        </ul>
                        <div id="contentControl">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    
	<button type="button" id="btnSelect" class="btn btn-info btn-sm">全 选</button>
	<button type="button" class="btn btn-danger btn-sm" id="btnDel">删 除</button>
	<a class="btn btn-success btn-sm" href="/Admin/ArticleCategory/add/type/<?php echo ($type); ?>">新 建</a>

                                </div>
                                <div class="col-xs-12 col-md-9">
                                    

                                </div>
                            </div>
                        </div>
                        <div id="contentHeader">
                            <table id="tableClone" class="table table-striped table-hover table-responsive">
                                <thead>
                                    <tr id="headerClone" class="btn-primary"></tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="mainMiddle">
                        <table id="tbMain" class="table table-striped table-hover table-responsive table-bordered">
                            <thead>
                            
	<tr id="headerMain">
		<th></th>
		<th>类别名称</th>
	</tr>

                            </thead>
                            <tbody>
                             
	<?php if(is_array($result)): foreach($result as $i=>$item): ?><tr>
			<td class="tdSelect"><input type="checkbox" class="ckbSelect iCheck" data-id="<?php echo ($item["id"]); ?>" /></td>
			<td><?php echo ($item["classLayer"]); ?> <a href="/Admin/ArticleCategory/edit/id/<?php echo ($item["id"]); ?>"><?php echo ($item["title"]); ?></a></td>
		</tr><?php endforeach; endif; ?> 

                            </tbody>
                        </table>
                    </div>
                    <nav id="mainBottom">
                        

                    </nav>
                </div>
            </div>
        </div>
        <ul role="tablist" class="nav nav-tabs" id="navTabs">
        </ul>
        
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">提示框</h4>
                </div>
                <div class="modal-body">确定删除？</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
                    <button type="button" class="btn btn-danger" id="btnDelConfirm">确 定</button>
                 </div>
            </div>
        </div>
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
        <script src="/statics/js/jquery.min.js"></script>
        <script src="/statics/bootstrap/js/bootstrap.min.js"></script>
        <script src="/statics/bootstrap/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/statics/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script src="/statics/js/menu.js"></script>
        <script src="/statics/iCheck/icheck.js"></script>
        <script src="/statics/js/commonList.js"></script>
       
        
	<script type="text/javascript">
		$(function(){ 
			NavTabsSelect(1);
			if(<?php echo ($type); ?>==1){
				LeftMenuSelect(1,'/Admin/ArticleCategory/lists/type/1'); 
			}
			else{
				LeftMenuSelect(1,'/Admin/ArticleCategory/lists/type/2');
			}
			
			var delIDs;
			$('#btnDel').click(function(){
				delIDs=GetSelectIDs();
				if(delIDs==''){
					var data={'info':'至少选中一项！'};
					TipShow(data);
					return;
				}
				$('#deleteModal').modal('show');
			});
			
			$('#btnDelConfirm').click(function(){
				$('#deleteModal').modal('hide');
				$.ajax({
					url : "/Admin/ArticleCategory/delete",
					data : 'ids='+delIDs,
					type : "POST",
					beforeSend : function() {
					},
					error : function(request) {
						TipShow("表单提交出错，请稍候再试");
					},
					success : function(data) {
						TipShow(data,true);
					}
				});
			});
		}); 
	</script>

    </body>
</html>