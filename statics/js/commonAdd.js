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
//新建页面提示框
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

//修改页面提示框，修改后返回上一页
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
		if(data.info){
			$msgModalBody.text(data.info);
		}
		else{
			$msgModalBody.text(data);
		}	
		$msgModal.modal('show');
	}
}

//修改页面提示框，修改后不返回
function TipShow3(data) {
	if(data.status>=0){
		$msgModalBody.text(data.info);
		$msgModal.modal('show');
		if(data.status==1){
			window.setTimeout(function(){window.location.reload();},500);
			return;
		}
	}
	else{
		if(data.info){
			$msgModalBody.text(data.info);
		}
		else{
			$msgModalBody.text(data);
		}		
		$msgModal.modal('show');
	}
}

var TipS;//当前使用的提示框
function TipSet(fuc){
	TipS=fuc;
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
	
	<!-- 验证初始化 -->
	$contentForm=$('#contentForm');//表单
	$validateMsg=$('#validateMsg');
	
	$btnSave=$('#btnSave');//保存按钮
	$loading=$('.loading');//加载动画
	//加载中
	function Loading(){
		$btnSave.attr('disabled',true);
		$loading.show();
	}
	
	//停止加载
	function LoadingStop(){
		$btnSave.attr('disabled',false);
		$loading.hide();
	}
	
	//新建或保存
	$btnSave.click(function(){
		Loading();
		if ($contentForm.valid()) {
			$contentForm.ajaxSubmit({
                type:'POST',
                dataType:'json',
                beforeSend: function() {	                    
                },
                success: function(data) {
                	TipS(data);
                	LoadingStop();
                },
                error : function(request) {
					var data={'info':request.responseText};
					TipS(data);
					LoadingStop();
				},
            });				
		}
		else{
			LoadingStop();
		}
		return false;
	});
});
