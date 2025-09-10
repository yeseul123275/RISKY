


$(".sendmail").click(function(){
	var surl = $("#send_url").val();
	var ety_name = $("input[name=ety_name]").val();
	var ety_phone = $("input[name=ety_phone]").val();
	var ety_email = $("input[name=ety_email]").val();
	var ety_content = $("#ety_content").val();

	if(ety_name == '')
	{
		alert('담당자를 입력해주세요.');
		return false;
	}
	if(ety_phone == '')
	{
		alert('연락처를 입력해주세요.');
		return false;
	}
	if(ety_email == '')
	{
		alert('이메일을 입력해주세요.');
		return false;
	}
	if(ety_content == '')
	{
		alert('문의내용을 입력해주세요.');
		return false;
	}


	if($("input:checkbox[name=agree]").is(":checked") != true) {
		alert('이용약관에 동의하셔야 합니다.');
		return false;
	}

	var url = surl + "/contact.php";
	var params = "ety_name=" + ety_name + "&ety_phone=" + ety_phone + "&ety_email=" + ety_email + "&ety_content=" + ety_content;

	$.ajax({      
		type:"POST",  
		url:url,
		data:params,
		success:function(data){	
			alert('문의가 등록되었습니다. 최대한 빠르게 연락드리겠습니다.')
			location.reload();
		}
	});

});

$(window).scroll(function() {
	if ($(window).scrollTop() > 100 && $("body").height() > ($(window).height() * 1.5)) {
		$("body").addClass("scroll");
	} else {
		$("body").removeClass("scroll");
	}
});

