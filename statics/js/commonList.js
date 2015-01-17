$headerMain = $('#headerMain');
$headerClone = $('#headerClone');
function Freezeheader() {
	$headerClone.css('height',$headerMain.height());
    var thList = $headerMain.children();
    var cloneHtml = '';
    for (i = 0; i < thList.length; i++) {
        $th = $(thList[i]);
        cloneHtml += '<th style="width:' + ($th.width() + 18) + 'px;padding:8px;">' + $th.html() + '</th>';
    }
    $headerClone.html(cloneHtml);
}

$mainTop=$('#mainTop');
function UIInit() {
    $main.css('margin-top', $navTabs.height() + 1 + 'px');
    $mainTop.css('top', $navTabs.height() + $navBar.height() + 1 + 'px').css('width', $rightContent.width()+ 'px').show();
    $mainMiddle.css('margin-top', $mainTop.height()-$headerClone.height()- 2 + 'px').css('margin-bottom','100px').show();
    $mainTop.css('width', $rightContent.width()+ 'px');
    $mainBottom.css('width', $rightContent.width() + 'px');
    $pagination.css('margin-left', $mainMiddle.width() / 2 - 116 + 'px').show();
    Freezeheader();
}

$msgModalBody=$('#msgModalBody');
$msgModal=$('#msgModal');
function TipShow(data,isRefresh) {
	$msgModalBody.text(data.info);
	$msgModal.modal('show');
	if (data.url) {
		window.location.href = data.url;
		return;
	}
	if(isRefresh){
		window.setTimeout(function(){window.location.reload();},1000);
	}
}

function GetSelectIDs(){
	var ckbList = $('.ckbSelect');
	var ids='';
    for (i = 0; i < ckbList.length; i++) {
        if(ckbList[i].checked ==true){
        	ids+=$(ckbList[i]).attr('data-id')+',';
        }
    }
    return ids.substring(0,ids.length-1); ;
}

$(function () {
    NavInit();
    
    $('.iCheck').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
    UIInit();

    $(window).resize(function () {
        UIInit();
    });

    $btnSearch = $('#btn-search');
    $hidSearch = $('#hid-search');
    $('.liSearch').click(function () {
        $this = $(this);
        $btnSearch.html($this.text() + ' <span class="caret"></span>');
        $hidSearch.val($this.attr('value'));
    });

    var isSelect = true;
    $('#btnSelect').click(function () {
        var ckbList = $('.ckbSelect');
        for (i = 0; i < ckbList.length; i++) {
        	if(isSelect){
        		$(ckbList[i]).iCheck('check');
        	}
        	else{
        		$(ckbList[i]).iCheck('uncheck');
        	}
        }
        isSelect = !isSelect;
    });
});
