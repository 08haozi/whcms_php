$navBar = $('#navBar');
$navTabs = $('#navTabs');
$main = $('#main');
$rightContent=$('#rightContent');
$mainTop = $('#mainTop');
$mainMiddle = $('#mainMiddle');
$mainBottom = $('#mainBottom');
$pagination = $('.pagination');
$divControl=$('#divControl');

var navList = [
    ['桌面', '/Admin/index'],
    ['文章', '#'],
    ['设置', '#'],
    ['系统', '#'],
    ['帮助','#']
];
var navChildrenList = [
    null,
    [
        ['文章管理', 
         ['文章列表', '/Admin/Article/lists','glyphicon glyphicon-align-justify'], 
         ['新建文章', '/Admin/Article/Add','glyphicon glyphicon-plus'],
         ['回收站','/Admin/Article/recycle','glyphicon glyphicon-trash']
        ],
        ['分类管理', 
         ['分类列表', '/Admin/ArticleCategory/lists','glyphicon glyphicon-align-justify'], 
         ['新建分类', '/Admin/ArticleCategory/Add','glyphicon glyphicon-plus']
        ]
    ],
    [
	     ['网站设置', 
	      ['网站信息', '/Admin/Set/sites','glyphicon glyphicon-globe'],
	      ['页面SEO', '/Admin/Seo/lists','glyphicon glyphicon-search']
	     ],
	     ['个人信息', 
	      ['修改密码', '/Admin/Set/chgPassword','glyphicon glyphicon-asterisk']
	     ]
    ],
    null,
    null
];
function NavInit() {
    var navHtml = '';
    for (i = 0; i < navList.length; i++) {
        if (navChildrenList[i] == null) {
            navHtml += '<li role="presentation"><a href="' + navList[i][1] + '">' + navList[i][0] + '</a></li>';
        }
        else {
            navHtml += '<li class="dropdown" role="presentation"><a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">' + navList[i][0] + '<span class="caret"></span></a><ul role="menu" class="dropdown-menu">';
            for (j = 0; j < navChildrenList[i].length; j++) {
                navHtml += ' <li class="dropdown-header">' + navChildrenList[i][j][0] + ' <span class="caret"></span></li>';
                for (z = 1; z < navChildrenList[i][j].length; z++) {
                    navHtml += '<li><a href="' + navChildrenList[i][j][z][1] + '"><span class="'+ navChildrenList[i][j][z][2] +'"></span> '  + navChildrenList[i][j][z][0] + '</a></li>';
                }
                navHtml += '<li class="divider"></li>';
            }
            navHtml += '</ul></li>';
        }
    }
    $navTabs.html(navHtml).show();
}

function NavTabsSelect(index) {
    $($navTabs.children()[index]).addClass('active');
}

function LeftMenuSelect(index0, index1) {
    var menuHtml = '';
    var count = 0;
    if (navChildrenList[index0] != null) {
        for (i = 0; i < navChildrenList[index0].length; i++) {
            menuHtml += '<ul class="nav nav-sidebar" ><li class="dropdown-header">' + navChildrenList[index0][i][0] + '<span class="caret"></span></li>';
            for (j = 1; j < navChildrenList[index0][i].length; j++) {
                menuHtml += '<li ' + ((count == index1) ? 'class="active"' : '') + '><a href="' + navChildrenList[index0][i][j][1] + '"><span class="'+ navChildrenList[index0][i][j][2] +'"></span> ' + navChildrenList[index0][i][j][0] + '</a></li>';
                count++;
            }
            menuHtml += '</ul>';
        }
    }
    $('#leftMenu').html(menuHtml);
}