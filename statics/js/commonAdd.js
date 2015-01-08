function UIInit() {
    $main.css('margin-top', $navTabs.height() + 1 + 'px');
    $mainTop.css('top', $navTabs.height() + $navBar.height() + 1 + 'px').css('width', $rightContent.width()+ 'px').show();
    $mainMiddle.css('margin-top', $mainTop.height()+ 'px').css('margin-bottom', $mainBottom.height() + 'px').show();
    $mainTop.css('width', $rightContent.width()+ 'px');
    $mainBottom.css('width', $rightContent.width() + 'px');
    $divControl.css('padding-left', $mainMiddle.width() / 2 - 116 + 'px');
    $mainBottom.show();
}

$msgModalBody=$('#msgModalBody');
$msgModal=$('#msgModal');
$sucMsgModalBody=$('#sucMsgModalBody');
$sucMsgModal=$('#sucMsgModal');
function TipShow(data,isRefresh) {
	if(data.status>=0){
		if(data.status==1){
			$sucMsgModalBody.text(data.info);
			$sucMsgModal.modal('show');
		}
		else{
			$msgModalBody.text(data.info);
			$msgModal.modal('show');
		}

		if (data.url) {
			window.location.href = data.url;
			return;
		}
		if(isRefresh){
			window.setTimeout(function(){window.location.reload();},1000);
		}
	}
	else{
		$msgModalBody.text(data);
		$msgModal.modal('show');
	}
}

function TipShow2(data) {
	if(data.status>=0){
		$msgModalBody.text(data.info);
		$msgModal.modal('show');
		if(data.status==1){
			window.setTimeout(function(){window.location = document.referrer;},500);
			return;
		}
	}
	else{
		$msgModalBody.text(data);
		$msgModal.modal('show');
	}
}

$(function () {
    NavInit();
    UIInit();

    $(window).resize(function () {
        UIInit();
    });
    
	$('.iCheck').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%' // optional
	});
});
