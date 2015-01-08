/**
 * 后台登陆页面
 */
$msgModal = $('#msgModal');
$msgModalBody = $('#msgModalBody');
function TipShow(data) {
	$msgModalBody.text(data.info);
	$msgModal.modal('show');
	if (data.url) {
		window.setTimeout(function(){window.location.href = data.url;},1000);
	}
}

$btnConfirm = $("#btnConfirm");
$loginForm = $('#loginForm');
function Login() {
	$btnConfirm.attr('disabled',true);
	if ($loginForm.valid()) {
		$.ajax({
			url : "/admin/login/dologin",
			data : $loginForm.serialize(),
			type : "POST",
			beforeSend : function() {
			},
			error : function(request) {
				alert("表单提交出错，请稍候再试");
				$btnConfirm.attr('disabled',false);
			},
			success : function(data) {
				TipShow(data);
				$btnConfirm.attr('disabled',false);
			}
		});
	}
	else{
		$btnConfirm.attr('disabled',false);
	}
	return false;
}
		
$validateMsg = $('#validateMsg');
$(function() {
	$loginForm.validate({
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
			username : 'required',
			password : 'required'
		},
		messages : {
			username : '请填写账号',
			password : '请填写密码',
		}
	});

	$btnConfirm.click(function() {
		Login();
	});

	$('#txbPassword').keydown(function(e) {
		if (e.keyCode == 13) {
			Login();
		}
	});
});