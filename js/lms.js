function pop_lesson_pay_close_ajax(){
	$("#myApplyModal").modal("hide");
	$("#myApplyModal2").modal("hide");
}

function enter_class(l_no, c_no){
	//alert("modal");
	//alert(l_no + "/" + c_no);

	$("#popup_win").bPopup({
		modalClose : false,
		//closeClass:'closePop',
		contentContainer:'.popup_container',
		loadUrl:'/Edu/popClass.php?l_no='+l_no+'&c_no='+c_no,
		//loadUrl:'/Class/test.php',
		onClose: function() {
			location.reload();
		}
	});
	
	//alert("end modal");
}

function out_class(){
	$("#popup_win").bPopup.close();
}

function closePop() {
	alert("close");
	$("#popup_win").bPopup.close();
	location.reload();
}

function enter_evaluation( l_no ){
		var url =  "/Class/pop01.php?l_no="+l_no;
		var width = 1050;
		var height = 750;
		var tops = (window.screen.height - height) / 2;
		var lefts = (window.screen.width - width) / 2;

		var strFeature;
		strFeature = 'height=' + height + ',width=' + width + ',menubar=no,toolbar=no,location=no,resizable=no,status=no,scrollbars=no,top=' + tops + ', left=' + lefts
		
		window.open( url, "evaluation", strFeature);
}

$(function(){
  	$(".enterClass").on("click",function(){
		$('body').css('overflow', 'hidden');
		enter_class( $(this).attr("lno"), $(this).attr("cno") );
  	});

  	$(".enterClass2").on("click",function(){
	  //enter_class2( $(this).attr("lno"), $(this).attr("cno") );
		$('body').css('overflow', 'hidden');
		enter_class( $(this).attr("lno"), $(this).attr("cno") );
  	});
});