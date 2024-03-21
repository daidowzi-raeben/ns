$(function() {
	$('.layer-wrap').find('.close, .btn-wrap a').click(function(){
		$('.layer-wrap').hide();
		bghide();
	});

	$('.regist-pop').click(function(){
		$('.layer-wrap.guide').show();
		bgshow();
	});
	

	$('.regist-movie').click(function(){
		$('.layer-wrap.movie').show();
		bgshow();
	});
	/*$('.regist-print').click(function(){
		$('.layer-wrap.print').show();
		bgshow();
	});*/

	$('.layer-wrap.guide').find('.class-regist').click(function(){
		$('.layer-wrap.question').show();
		bgshow();
	});

	/*$('.layer-wrap.movie').find('.prev, .next').click(function(){
		$('.layer-wrap.question').show();
	});*/

	$('.layer-wrap.question').find('.class-submit').click(function(){
		$('.layer-wrap.csend.failed').show();
		bgshow();
	});
	$('.layer-wrap.csend.failed').find('.class-close').click(function(){
		$('.layer-wrap.csend.success').show();
		bgshow();
	});


	function bgshow(){
		$(".layer-slider-ovclick").show();
		$('#header-wrap, #footer-wrap').css({'z-index':'2001'});
		$('body').css({'overflow':'hidden'});
	}

	function bghide(){
		$(".layer-slider-ovclick").hide();
		$('#header-wrap, #footer-wrap').css({'z-index':'2009'});
		$('body').css({'overflow':'visible'});
	}
});	