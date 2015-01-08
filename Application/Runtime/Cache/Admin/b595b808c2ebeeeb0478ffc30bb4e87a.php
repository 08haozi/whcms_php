<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="renderer" content="webkit">
        <link rel="icon" href="../../favicon.ico">

        <title>后台管理</title>

        <!-- Bootstrap core CSS -->
        <link href="/statics/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/statics/bootstrap/css/dashboard.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="/statics/bootstrap/js/html5shiv.min.js"></script>
        <script src="/statics/bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <nav id="nav-bar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="dropdown-header">
                            内容管理
                            <span class="caret"></span>
                        </li>
                        <li class="active">
                            <a href="#">内容列表</a>
                        </li>
                        <li>
                            <a href="#">内容添加</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li class="dropdown-header">
                            分类管理
                            <span class="caret"></span>
                        </li>
                        <li>
                            <a href="#">分类列表</a>
                        </li>
                        <li>
                            <a href="#">分类添加</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
                    <div id="main-top">
                        <h4 id="content-title">内容列表 （总共108条）</h4>
                        <ul role="tablist" class="nav nav-tabs" id="content-tabs">
                            <li role="presentation" class="active">
                                <a href="#">全部（108）</a>
                            </li>
                            <li>
                                <a href="#">热卖</a>
                            </li>
                        </ul>
                        <div id="content-control">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-8">
                                    <button type="button" id="btn-select" class="btn btn-default btn-sm ">全选</button>
                                    <button type="button" class="btn btn-primary btn-sm">Primary</button>
                                    <button type="button" class="btn btn-success btn-sm">Success</button>
                                    <button type="button" class="btn btn-info btn-sm">Info</button>
                                    <button type="button" class="btn btn-warning btn-sm">Warning</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">删除</button>
                                    <button type="button" class="btn btn-link btn-sm">Link</button>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <form class="form-inline" role="form" action="index.html">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="btn-search">
                                                        标题
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li class="li-search" value="1">
                                                            <a href="#">标题</a>
                                                        </li>
                                                        <li class="li-search" value="2">
                                                            <a href="#">内容</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /btn-group -->
                                                <input id="txb-keyword" type="text" class="form-control" placeholder="输入后按回车">
                                                <input id="hid-search" type="hidden" value="1"/>
                                            </div>
                                            <!-- /input-group --> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="content-header">
                            <table id="table-clone">
                                <thead>
                                    <tr id="header-clone"></tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="main-middle">
                        <table id="tb-main" class="table table-striped table-hover table-responsive">
                            <thead>
                                <tr id="header-main">
                                    <th></th>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><input type="checkbox" class="ckb-select"/></th>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav id="main-bottom">
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="#">«</a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">»</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <ul role="tablist" class="nav nav-tabs" id="nav-tabs">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-danger">确定</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
          ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/statics/bootstrap/js/jquery.min.js"></script>
        <script src="/statics/bootstrap/js/bootstrap.min.js"></script>
        <script src="/statics/bootstrap/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/statics/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript">
            $headerMain = $('#header-main');
            $headerClone = $('#header-clone');
            function Freezeheader() {
                var thList = $headerMain.children();
                var cloneHtml = '';
                for (i = 0; i < thList.length; i++) {
                    $th = $(thList[i]);
                    cloneHtml += '<th style="width:' + ($th.width() + 16) + 'px;padding:8px;">' + $th.html() + '</th>';
                }
                $headerClone.html(cloneHtml);
            }

            $navBar = $('#nav-bar');
            $navTabs = $('#nav-tabs');
            $main = $('#main');
            $mainTop = $('#main-top');
            $mainMiddle = $('#main-middle');
            $mainBottom = $('#main-bottom');
            $headerMain = $('#header-main');
            $pagination = $('.pagination');
            function UIInit() {
                Freezeheader();
                $main.css('margin-top', $navTabs.height() + 1 + 'px');
                $mainTop.css('width', $mainMiddle.width() + 'px').css('top', $navTabs.height() + $navBar.height() + 1 + 'px');
                $mainMiddle.css('margin-top', $mainTop.height() - $headerMain.height() - 2 + 'px').css('margin-bottom', $mainBottom.height() + 'px');
                $mainBottom.css('width', $mainMiddle.width() + 'px');
                $pagination.css('margin-left', $mainMiddle.width() / 2 - 116 + 'px');
            }
            
            var navList=[
                ['首页','#'],
                ['文章','#'],
                ['系统','#']
            ];
            var navChildrenList=[
              null,
              [
                  ['文章管理',['文章列表','/Admin/Article/lists'],['添加文章','/Admin/Article/Add']],
                  ['分类管理',['分类列表','/Admin/ArticleCategory/lists'],['添加分类','/Admin/ArticleCategory/Add']]
              ],
              null
            ];
            function NavInit(){
                var navHtml='';
                for(i=0;i<navList.length;i++){
                    if(navChildrenList[i]==null){
                        navHtml+='<li role="presentation"><a href="'+navList[i][1]+'">'+navList[i][0]+'</a></li>';
                    }
                    else{
                        navHtml+='<li class="dropdown" role="presentation"><a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">'+navList[i][0]+'<span class="caret"></span></a><ul role="menu" class="dropdown-menu">';
                        for(j=0;j<navChildrenList[i].length;j++){
                            navHtml+=' <li class="dropdown-header">'+navChildrenList[i][j][0]+' <span class="caret"></span></li>';
                            for(z=1;z<navChildrenList[i][j].length;z++){
                                navHtml+='<li><a href="'+navChildrenList[i][j][z][1]+'">'+navChildrenList[i][j][z][0]+'</a></li>';
                            }
                            navHtml+='<li class="divider"></li>';
                        }
                        navHtml+='</ul></li>';
                    }
                }
                $navTabs.html(navHtml);
            }

            $(function () {
                NavInit();
                UIInit();
                
                $(window).resize(function () {
                    UIInit();
                });

                $btnSearch = $('#btn-search');
                $hidSearch = $('#hid-search');
                $('.li-search').click(function () {
                    $this = $(this);
                    $btnSearch.html($this.text() + ' <span class="caret"></span>');
                    $hidSearch.val($this.attr('value'));
                });

                var isSelect = true;
                $('#btn-select').click(function () {
                    var ckbList = $('.ckb-select');
                    for (i = 0; i < ckbList.length; i++) {
                        ckbList[i].checked = isSelect;
                    }
                    isSelect = !isSelect;
                });
            });
        </script>
    </body>
</html>