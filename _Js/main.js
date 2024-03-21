(function($){
	$(document).ready(function(){
		// gnb
		var menu, menuLi, menuLink;
		menu = $("#gnb");
		menuLi = $("#gnb > li");
		menuLink = $("#gnb > li > a");

		if(menu.find("li").hasClass("active")){
			menu.find("li.active").addClass("on");
			menu.find("li.active:has(li)").parents("#gnbMenu").addClass("on");
		}

		if($("#gnb").length > 0){
			$("#gnb > li").each(function(){
				$(this).attr("id","gnbLi"+$(this).index());
			});
		};

		var closeMenu = function(){ // 메뉴 닫기
			menuLi.find(".sub").hide();
			menuLi.removeClass("on");
			if(menu.find("li").hasClass("active")){
				menu.find("li.active").addClass("on");
				$("#gnbMenu").removeClass("on");

				// 페이지 활성화
				menu.find("li.active:has(li)").parents("#gnbMenu").addClass("on");
			}else{
				$("#gnbMenu").removeClass("on");
			}
		}

		var openCurrent = function(){ // 메뉴 열기
			menuLi.not(menuCurrent.parent().next(".sub")).find(".sub").hide();
			menuLi.not(menuCurrent.parents("li")).removeClass("on");
			menuCurrent.parents("li:has(li)").find(".sub").show().css("margin-left", (menuCurrent.parents("li:has(li)").find(".sub > ul").width()/2)*-1);
			menuCurrent.parents("li:has(li)").addClass("on");
			if(menuCurrent.parents("li:has(li)").hasClass("on")){
				$("#gnbMenu").addClass("on");
			}else{
				$("#gnbMenu").removeClass("on");
			}
		}

		menuLi.eq(-1).find(".sub li:last-child a").on("focusout", function(){
			closeMenu();
		});
		menuLink.on("mouseenter focusin", function(){
			menuCurrent = $(this);
			openCurrent();
		});
		menuLi.find(".sub li a").on("mouseenter focusin", function(){
			menuCurrent = $(this);
			openCurrent();
		})

		$("#gnbMenu").on("mouseleave", function(){
			closeMenu();
		});

		// [START] fade in & out (Author: KANG HEE CHANG / http://hckang80.waplez.com)
		function fadeGallery(obj, timer){
			var $speed = 500;
			var $wrapper = "#" + obj;

			var $sel = 0;
			var flag = true

			$($wrapper).find(".gallery").children("li:gt(0)").hide();
			if($($wrapper).find(".control li").length == 0 && $($wrapper).find(".gallery").children("li").length > 1){
				for(j = 0; j < $($wrapper).find(".gallery").children("li").length; j++){
					$($wrapper).find(".control").append('<li><a href="#">go banner</a></li>\n');
				}
			};
			$($wrapper).find(".control").children("li:first-child").addClass("on");
			if($($wrapper).find(".gallery").children("li").length==1){
				$($wrapper).find(".links_stop").hide();
				$($wrapper).find(".links_play").hide();
				return false;
			}
			function goNext(){
				if(flag == true){
					flag = false;
					$sel++;
					if($sel == $($wrapper).find(".gallery").children("li").size()){
						$sel = 0;
					}
					$($wrapper).find(".control").children("li").eq($sel).addClass("on");
					$($wrapper).find(".control").children("li").not($($wrapper).find(".control").children("li").eq($sel)).removeClass("on");
					$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).css("z-index","0")
					$($wrapper).find(".gallery").children("li").eq($sel).css("z-index","1").fadeIn(function(){
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).hide();
						flag = true;
					});

				}
				return false;
			}
			$($wrapper).find(".links_next").click(goNext);

			function goPrev(){
				if(flag == true){
					flag = false;
					$sel--;
					if($sel == -1){
						$sel = $($wrapper).find(".gallery").children("li").size() - 1;
					}
					$($wrapper).find(".control").children("li").eq($sel).addClass("on");
					$($wrapper).find(".control").children("li").not($($wrapper).find(".control").children("li").eq($sel)).removeClass("on");
					$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).css("z-index","0")
					$($wrapper).find(".gallery").children("li").eq($sel).css("z-index","1").fadeIn(function(){
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).hide();
						flag = true;
					});
				}
				return false;
			}
			$($wrapper).find(".links_prev").click(goPrev);

			// 바로가기
			function goDirect(){
				if(flag == true && !$(this).hasClass("on")){
					flag = false;
					$sel = $(this).index();
					$(this).addClass("on");
					$($wrapper).find(".control").children("span").not($(this)).removeClass("on");
					$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).css("z-index","0")
					$($wrapper).find(".gallery").children("li").eq($sel).css("z-index","1").fadeIn(function(){
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li").eq($sel)).hide();
						flag = true;
					});
				}
				return false;
			}
			$($wrapper).find(".control span").click(goDirect);

			// 자동실행
			var autoPlay;
			function autoChange(){
				autoPlay = setInterval(goNext, timer);
			}
			autoChange();

			// 영역 오버시 멈춤
			$($wrapper).find(".gallery").hover(
				function(){
					clearInterval(autoPlay);
				},
				function(){
					clearInterval(autoPlay);
					autoChange();
				}
			);

			// 컨트롤러
			$($wrapper).find(".links_stop").click(function(){
				clearInterval(autoPlay);
			});
			$($wrapper).find(".links_play").click(function(){
				clearInterval(autoPlay);
				autoChange();
			});
		}

		// 호출함수(아이디, 딜레이)
		if($("#mZone").length>0){
			fadeGallery("mZone", 4000);
		}
		// [END] fade in & out

		// [START] slide loop
		loopGallery = function(obj, timer){ // 아이디, 딜레이
			var $speed = 500;
			var $wrapper = "#" + obj;

			if($($wrapper).find(".gallery").children("li").length == 1){
				$($wrapper).find(".group").hide();
				return false;
			}
			if($($wrapper).find(".control li").length == 0){
				for(j = 0; j < $($wrapper).find(".gallery").children("li").length; j++){
					$($wrapper).find(".control").append('<span></span>\n');
				}
			};
			$($wrapper).find(".gallery").children("li:first-child").addClass("on");
			$($wrapper).find(".control").children("span:first-child").addClass("on");

			var goNext = function(){
				if(!$($wrapper).find(".gallery").is(":animated")){
					if($($wrapper).find(".gallery").children("li.on").next("li").length>0){
						var viewItem = $($wrapper).find(".gallery").children("li.on").next("li");
					}else{
						var viewItem = $($wrapper).find(".gallery").children("li").eq(0);
					};
					viewItem.show().css("left","1%");
					$($wrapper).find(".control").children("span").not($($wrapper).find(".control").children("span").eq(viewItem.index())).removeClass("on");
					$($wrapper).find(".control").children("span").eq(viewItem.index()).addClass("on");
					$($wrapper).find(".gallery").animate({
						left : -100 + "%"
					},$speed,
					function(){
						viewItem.addClass("on").css("left","0");
						$($wrapper).find(".gallery").children("li").not(viewItem).removeClass("on");
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li.on")).hide();
						$(this).css('left','0');
					});
				}
				return false;
			}
			$($wrapper).find(".links_next").click(goNext);

			var goPrev = function(){
				if(!$($wrapper).find(".gallery").is(":animated")){
					if($($wrapper).find(".gallery").children("li.on").prev("li").length>0){
						var viewItem = $($wrapper).find(".gallery").children("li.on").prev("li");
					}else{
						var viewItem = $($wrapper).find(".gallery").children("li").eq(-1);
					};
					viewItem.show().css("left","-1%");
					$($wrapper).find(".control").children("span").not($($wrapper).find(".control").children("span").eq(viewItem.index())).removeClass("on");
					$($wrapper).find(".control").children("span").eq(viewItem.index()).addClass("on");
					$($wrapper).find(".gallery").animate({
						left : 100 + "%"
					},$speed,
					function(){
						viewItem.addClass("on").css("left","0");
						$($wrapper).find(".gallery").children("li").not(viewItem).removeClass("on");
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li.on")).hide();
						$(this).css('left','0');
					});
				}
				return false;
			}
			$($wrapper).find(".links_prev").click(goPrev);

			// 바로가기
			var goDirect = function(){
				if(!$(this).parents($wrapper).find(".gallery").is(":animated") && !$(this).parent().hasClass("on")){
					clearInterval(autoPlay);
					var viewItem = $($wrapper).find(".gallery").children("li").eq($(this).parent().index());
					viewItem.show().css("left","1%");
					$($wrapper).find(".control").children("span").not($($wrapper).find(".control").children("span").eq(viewItem.index())).removeClass("on");
					$($wrapper).find(".control").children("span").eq(viewItem.index()).addClass("on");
					$($wrapper).find(".gallery").animate({
						left : -100 + "%"
					},$speed,
					function(){
						viewItem.addClass("on").css("left","0");
						$($wrapper).find(".gallery").children("li").not(viewItem).removeClass("on");
						$($wrapper).find(".gallery").children("li").not($($wrapper).find(".gallery").children("li.on")).hide();
						$(this).css('left','0');
					});
					autoChange();
				}
				return false;
			}
			$($wrapper).find(".control button").click(goDirect);

			// 자동실행
			var autoPlay;
			function autoChange(){
				autoPlay = setInterval(goNext, timer);
			}
			autoChange();

			// 영역 오버시 멈춤
			/*
			$($wrapper).find(".gallery").hover(
				function(){
					clearInterval(autoPlay);
				},
				function(){
					clearInterval(autoPlay);
					autoChange();
				}
			);
			*/

			// 컨트롤러
			$($wrapper).find(".links_stop").click(function(){
				$(this).hide();
				$($wrapper).find(".links_play").show();
				clearInterval(autoPlay);
			});
			$($wrapper).find(".links_play").click(function(){
				$(this).hide();
				$($wrapper).find(".links_stop").show();
				clearInterval(autoPlay);
				autoChange();
			});
		}
		// [END] slide loop

		// language
		$('#header .language a').on("focusout", function(){
			$("#header .language").removeClass("on");
		});
		$("#header .language a").bind("focusin", function(){
			$("#header .language").addClass("on");
		})
		$("#header .language > a").bind("mouseenter", function(){
			$("#header .language").addClass("on");
		})
		$("#header .language").bind("mouseleave", function(){
			$("#header .language").removeClass("on");
		})

		// Family site
		$(".family_site button").bind("click", function(){
			$(this).parents('.family_site').addClass("on");
		});
		$(".family_site").bind("mouseleave", function(){
			//$(this).removeClass("on");
		});

		// view object control
		function nextView(obj, num){
			var $viewWrap = "#" + obj;

			if($($viewWrap).find(".control").length > 0){
				if($($viewWrap).find(".control li").length == 0 && $($viewWrap).find(".gallery").children("li").length > num){
					for(j = 0; j < $($viewWrap).find(".gallery").children("li").length/num; j++){
						$($viewWrap).find(".control").append('<li><button>view</button></li>\n');
					}
				};
				$($viewWrap).find(".control").children("li:first-child").addClass("on");
			}

			if($($viewWrap).find(".number").length > 0){
				if($($viewWrap).find(".gallery li").length > num){
					$($viewWrap).find(".number span").text(Math.floor($($viewWrap).find(".gallery li").length/num)+1)
				}
			}

			$($viewWrap).find(".gallery li").slice(num).hide();
			if($($viewWrap).find(".gallery li").length <= num){
				$($viewWrap).find(".btn_left").hide();
				$($viewWrap).find(".btn_right").hide();
			}
			$($viewWrap).find("button").bind("click", function(){
				if($(this).attr("class") == "prev"){// left button
					if($(this).parents($viewWrap).find(".gallery li:visible").eq(0).prev("li").length > 0){
						var start = $(this).parents($viewWrap).find(".gallery li:visible").eq(0).index()-num;
						var end = $(this).parents($viewWrap).find(".gallery li:visible").eq(0).index();
						$(this).parents($viewWrap).find(".gallery li:visible").hide();
						$(this).parents($viewWrap).find(".gallery li").slice(start,end).show();
					}
				}else if($(this).attr("class") == "next"){// right button
					if($(this).parents($viewWrap).find(".gallery li:visible").eq(-1).next("li").length > 0){
						var start = $(this).parents($viewWrap).find(".gallery li:visible").eq(-1).next("li").index();
						var end = $(this).parents($viewWrap).find(".gallery li:visible").eq(-1).next("li").index()+num;
						$(this).parents($viewWrap).find(".gallery li:visible").hide();
						$(this).parents($viewWrap).find(".gallery li").slice(start,end).show();
					}
				}else{// direct button
					$(this).parents($viewWrap).find(".gallery li").show();
					$(this).parents($viewWrap).find(".gallery li:visible").slice(0,num*$(this).parents("li").index()).hide();
					$(this).parents($viewWrap).find(".control").find("li").not($(this).parents("li")).removeClass("on");
					$(this).parents("li").addClass("on");
				};
				if($($viewWrap).find(".control").length > 0){
					$($viewWrap).find(".control li").removeClass("on");
					$($viewWrap).find(".control li").eq(Math.floor($($viewWrap).find(".gallery li:visible").eq(0).index()/num)).addClass("on");
				}
				if($($viewWrap).find(".number").length > 0){
					$($viewWrap).find(".number strong").text(Math.floor($($viewWrap).find(".gallery li:visible").eq(0).index()/num)+1)
				}
			});
		}
		nextView("mPart", 3);

		// location
		if($("#location").length > 0){
			$("#location a").eq(-1).addClass("current");
		};

		$(window).bind("scroll load resize", function(){
			if($(".item_wrap").length > 0){
				for(i=0;i<$('.item_wrap').length;i++){
					// Display
					//$("#count").text($(this).scrollTop() + " >= " + $('.item_wrap').eq(i).offset().top + " && " + $(window).scrollTop() + " < " + $('.item_wrap').eq(i+1).offset().top);

					// Source
					if($(window).scrollTop() == $(document).height() - $(window).height() || $(window).scrollTop() >= $('.item_wrap').eq(-1).offset().top - $("#header").outerHeight()){ //scroll end || last item offset().top
						$(".navi > li").not($(".navi > li").eq(i)).removeClass("current");
						$(".navi > li").eq(-1).addClass("current");
						$('.item_wrap').not($('.item_wrap').eq(i)).removeClass("current");
						$('.item_wrap').eq(-1).addClass("current");
						/*
						$('.item_wrap').eq(-1).find(".obj").eq(i).animate({
							opacity : 1
						},500);
						*/
						$('.item_wrap').eq(-i).find(".obj").each(function(index){
							$(this).eq(index).animate({
								opacity : 1
							},700,function(){
								$(this).next(".obj").animate({
									opacity : 1
								},700,function(){
									$(this).next(".obj").animate({
									opacity : 1
									},700);
								});
							});
						});
					}else if($(this).scrollTop() >= $('.item_wrap').eq(i).offset().top - $("#header").outerHeight() && $(window).scrollTop() < $('.item_wrap').eq(i+1).offset().top - $("#header").outerHeight()){
						$(".navi > li").not($(".navi > li").eq(i)).removeClass("current");
						$(".navi > li").eq(i).addClass("current");
						$('.item_wrap').not($('.item_wrap').eq(i)).removeClass("current");
						$('.item_wrap').eq(i).addClass("current");
						$('.item_wrap').eq(i).find(".obj").each(function(index){
							$(this).eq(index).animate({
								opacity : 1
							},700,function(){
								$(this).next(".obj").animate({
									opacity : 1
								},700,function(){
									$(this).next(".obj").animate({
									opacity : 1
									},700);
								});
							});
						});
						/*
						$('.item_wrap').eq(i).find(".obj").eq(i).animate({
							opacity : 1
						},300);
						*/
					}
				};
			};
			/*
			if($("#mNavi").length > 0){
				if($(window).scrollTop() >= $('.item_wrap').eq(0).offset().top - $("#header").outerHeight()){
					if(!$("#mNavi").is(":animated")){
						$("#mNavi").fadeIn(1000);
					}
				}else{
					if(!$("#mNavi").is(":animated")){
						$("#mNavi").fadeOut(1000);
					}
				}
			};
			*/
		});

		// Navigation
		$("a[href^=#item]").bind("click", function(){
			if(!$("html, body").is(":animated")){
				$("html, body").animate({
					scrollTop : $('.item_wrap').eq($(this).parent().index()).offset().top - $("#header").outerHeight()
				},{duration:1000,easing:'easeInOutExpo'});
			};
			return false;
		});

		$(".ko .textarea1").focusin(function(){
			if($(this).val() == "제보 내용 입력시 사실에 근거한 내용을 육하원칙 (누가, 언제, 어디서, 무엇을, 어떻게, 왜)에 따라 가급적 구체적으로 작성하여 주실 것을 부탁드립니다. 근거 없는 소문, 타인을 비방할 목적의 음해성 제보의 경우 조사를 진행하지 않을 수 있으며, 관련 자료(사진, 문서, 증빙 등) 가 있을 경우 첨부하여 주시면 조사에 많은 도움이 됩니다."){
				$(this).val("");
			}
		});
		$(".ko .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("제보 내용 입력시 사실에 근거한 내용을 육하원칙 (누가, 언제, 어디서, 무엇을, 어떻게, 왜)에 따라 가급적 구체적으로 작성하여 주실 것을 부탁드립니다. 근거 없는 소문, 타인을 비방할 목적의 음해성 제보의 경우 조사를 진행하지 않을 수 있으며, 관련 자료(사진, 문서, 증빙 등) 가 있을 경우 첨부하여 주시면 조사에 많은 도움이 됩니다.");
			}
			else{
				return false;
			}
		});
		$(".ko .textarea3").focusin(function(){
			if($(this).val() == "본 게시판의 운영 목적에 어긋나는 게시물 (타인을 비방 하거나, 미풍양속에 저해되는 욕설, 근거 없는 비판, 상업적인 광고, 본 사이트의 운영 취지와 전혀 무관한 내용, 같은 내용 반복게시, 특정인의 개인정보 유출 등)은 사전 동의 없이 삭제됩니다."){
				$(this).val("");
			}
		});
		$(".ko .textarea3").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("본 게시판의 운영 목적에 어긋나는 게시물 (타인을 비방 하거나, 미풍양속에 저해되는 욕설, 근거 없는 비판, 상업적인 광고, 본 사이트의 운영 취지와 전혀 무관한 내용, 같은 내용 반복게시, 특정인의 개인정보 유출 등)은 사전 동의 없이 삭제됩니다.");
			}
			else{
				return false;
			}
		});
		$(".en .textarea1").focusin(function(){
			if($(this).val() == "When reporting, please provide details of the incidents (who, when, where, what, how, and why). Reports that are without merits or purpose of slander will not be investigated.  Also if you have supporting documents/evidence (photo, documents, etc.) please include it when reporting. It will help with the process."){
				$(this).val("");
			}
		});
		$(".en .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("When reporting, please provide details of the incidents (who, when, where, what, how, and why). Reports that are without merits or purpose of slander will not be investigated.  Also if you have supporting documents/evidence (photo, documents, etc.) please include it when reporting. It will help with the process.");
			}
			else{
				return false;
			}
		});
		$(".cn .textarea1").focusin(function(){
			if($(this).val() == "填写举报内容时，请根据事实尽可能详细提供六要素内容（时间，地点，人物，起因，经过，结果。） 无根据的传闻、以诽谤他人为目的的举报，可能不予展开调查 如能提供相关资料（照片、文件、凭证等），将对调查起到很大帮助"){
				$(this).val("");
			}
		});
		$(".cn .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("填写举报内容时，请根据事实尽可能详细提供六要素内容（时间，地点，人物，起因，经过，结果。） 无根据的传闻、以诽谤他人为目的的举报，可能不予展开调查 如能提供相关资料（照片、文件、凭证等），将对调查起到很大帮助");
			}
			else{
				return false;
			}
		});
		$(".ru .textarea1").focusin(function(){
			if($(this).val() == "При написании заявления, пожалуйста укажите все детали инцидента (кто, когда, где, что, как, and почему). Заявления, сделанные не по существу или с целью клеветы не будут рассматриваться. Если у Вас имеются какие-либо доказательства (фото, документы и др.) пожалуйста также включите их в заявление, это очень поможет процессу расследования."){
				$(this).val("");
			}
		});
		$(".ru .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("При написании заявления, пожалуйста укажите все детали инцидента (кто, когда, где, что, как, and почему). Заявления, сделанные не по существу или с целью клеветы не будут рассматриваться. Если у Вас имеются какие-либо доказательства (фото, документы и др.) пожалуйста также включите их в заявление, это очень поможет процессу расследования.");
			}
			else{
				return false;
			}
		});
		$(".id .textarea1").focusin(function(){
			if($(this).val() == "Tolong masukan isi laporan dengan bukti nyata yang merujuk pada asas 5W1H (who,when,what,why,where,how).Pemeriksaan tidak akan dilakukan bila laporan hanya berdasarkan rumor atau dilakukan untuk menjatuhkan suatu pihak. Lampirkan dokumen terkait (foto, dokumen, bukti dll) untuk membantu proses pemeriksaan."){
				$(this).val("");
			}
		});
		$(".id .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("Tolong masukan isi laporan dengan bukti nyata yang merujuk pada asas 5W1H (who,when,what,why,where,how).Pemeriksaan tidak akan dilakukan bila laporan hanya berdasarkan rumor atau dilakukan untuk menjatuhkan suatu pihak. Lampirkan dokumen terkait (foto, dokumen, bukti dll) untuk membantu proses pemeriksaan.");
			}
			else{
				return false;
			}
		});
		$(".vn .textarea1").focusin(function(){
			if($(this).val() == "Hãy điền đầy đủ, cụ thể, trung thực các thông tin tố giác(ai, khi nào, làm gì, như thế nào, vì sao) Các thông tin không có bằng chứng cụ thể, tin đồn, hoặc được sử dụng vào mục đích hạ thấp uy tín của người khác có thể không được kiểm tra. Hãy gửi các tài liệu liên quan sẽ giúp ích được nhiều hơn"){
				$(this).val("");
			}
		});
		$(".vn .textarea1").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("Hãy điền đầy đủ, cụ thể, trung thực các thông tin tố giác(ai, khi nào, làm gì, như thế nào, vì sao) Các thông tin không có bằng chứng cụ thể, tin đồn, hoặc được sử dụng vào mục đích hạ thấp uy tín của người khác có thể không được kiểm tra. Hãy gửi các tài liệu liên quan sẽ giúp ích được nhiều hơn");
			}
			else{
				return false;
			}
		});


		$(".textarea2").focusin(function(){
			if($(this).val() == "비윤리 제보는 윤리 Hot-Line을 이용해주시기 바랍니다."){
				$(this).val("");
			}
		});
		$(".textarea2").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("비윤리 제보는 윤리 Hot-Line을 이용해주시기 바랍니다.");
			}
			else{
				return false;
			}
		});

		$(".textarea3").focusin(function(){
			if($(this).val() == "ex)123456"){
				$(this).val("");
			}
		});
		$(".textarea3").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex)123456");
			}
			else{
				return false;
			}
		});

		$(".textarea4").focusin(function(){
			if($(this).val() == "ex) 1Box/12만원"){
				$(this).val("");
			}
		});
		$(".textarea4").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex) 1Box/12만원");
			}
			else{
				return false;
			}
		});

		$(".textarea5").focusin(function(){
			if($(this).val() == "ex) 과일, 와인, 정육 등"){
				$(this).val("");
			}
		});
		$(".textarea5").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex) 과일, 와인, 정육 등");
			}
			else{
				return false;
			}
		});

		$(".textarea6").focusin(function(){
			if($(this).val() == "기부처를 입력하세요."){
				$(this).val("");
			}
		});
		$(".textarea6").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("기부처를 입력하세요.");
			}
			else{
				return false;
			}
		});

		$(".textarea7").focusin(function(){
			if($(this).val() == "반송처를 입력하세요."){
				$(this).val("");
			}
		});
		$(".textarea7").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("반송처를 입력하세요.");
			}
			else{
				return false;
			}
		});

		$(".textarea8").focusin(function(){
			if($(this).val() == "부서/직책"){
				$(this).val("");
			}
		});
		$(".textarea8").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("부서/직책");
			}
			else{
				return false;
			}
		});

		$(".textarea9").focusin(function(){
			if($(this).val() == "ex) 2018-01-01"){
				$(this).val("");
			}
		});
		$(".textarea9").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex) 2018-01-01");
			}
			else{
				return false;
			}
		});

		$(".textarea10").focusin(function(){
			if($(this).val() == "ex) 2018-01-01"){
				$(this).val("");
			}
		});
		$(".textarea10").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex) 2018-01-01");
			}
			else{
				return false;
			}
		});

		$(".textarea11").focusin(function(){
			if($(this).val() == "ex) 2018-01-01"){
				$(this).val("");
			}
		});
		$(".textarea11").focusout(function(){
			if ($(this).val() == ""){
				$(this).val("ex) 2018-01-01");
			}
			else{
				return false;
			}
		});

		// 메인 제보이용안내
		$(".iw_con1 .iw_img2 img").bind("mouseenter", function(){
			if(!$(this).is(":animated")){
				$(this).stop().animate({"width":"0","height":"304px"},{duration:300,easing:'easeInExpo',complete:function(){
					$(this).css({"margin-top":"-152px"})
					.stop().animate({width:131,height:304},{duration:300,easing:'easeOutExpo'});
				}});
			}
		});

		$(".iw_con1 .iw_img2").bind("mouseleave", function(){
			if(!$(this).is(":animated")){
				$(this).children("img").stop().animate({"width":"0","height":"304px"},{duration:300,easing:'easeInExpo',complete:function(){
					$(this).css({"margin-top":"0"})
					.stop().animate({width:131,height:304},{duration:300,easing:'easeOutExpo'});
				}});
			}
		});

		// tab
		$(".ctab1 a").bind("click", function(){
			$(".ctab1 a").removeClass("active");
			$(this).addClass("active");
			var ctabIndex = $(this).parent("li").index();
			$(".ctabcon").hide();
			$(".ctabcon").eq(ctabIndex).show();
			return false;
		});



		// 윤리가이드북
		  var ps = {
				list : $('.photo_s_list > li'),
				list_first : $('.photo_s_list > li').eq(0),
				list_seccond : $('.photo_s_list > li').eq(1),
				list_third : $('.photo_s_list > li').eq(2),
				nav : $('.photo_slide > .cont > .nav > a'),
				course : 'next',
				speed : 500,
				item_num : 0
			}

			var ps_evt = function(){
				ps.course = 'next';
				if(ps.item_num == 0){
					ps.list_first.css('z-index','1').animate({left:0},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeOut(ps.speed);
					ps.list_seccond.css('z-index','0').animate({left:100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
					ps.list_third.css('z-index','0').animate({left:-100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
				}else if(ps.item_num == 1){
					ps.list_first.css('z-index','0').animate({left:-100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
					ps.list_seccond.css('z-index','1').animate({left:0},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeOut(ps.speed);
					ps.list_third.css('z-index','0').animate({left:100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
				}else{
					ps.list_first.css('z-index','0').animate({left:100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
					ps.list_seccond.css('z-index','0').animate({left:-100+'%'},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeIn(ps.speed);
					ps.list_third.css('z-index','1').animate({left:0},{duration:ps.speed,easing:'easeOutCubic'})
					.find('.dim').fadeOut(ps.speed);
				}

			}

			var filter_ps_evt = function(){
				if(ps.course == 'next'){
					ps.item_num++;
					if(ps.item_num >= 3){
						ps.item_num = 0;
					}
				}else{
					ps.item_num--;
					if(ps.item_num <= -1){
						ps.item_num = 2;
					}
				}
				ps_evt();
			}

			ps.nav.bind('click',function(){
				if(!ps.list.is(':animated')){
					clearInterval(interval_ps);
					ps.course = $(this).attr('href').replace('#','');
					filter_ps_evt();

					auto_ps();
				}
				return false;
			});

			var interval_ps;
			var auto_ps = function(){
				interval_ps = setInterval(filter_ps_evt,5000);
			}

			auto_ps();

		// book_gallery
		var photo_list = $('.photo_list > ul > li');
		var book_pop = $('.book_pop');
		var t_nav = book_pop.find('> .nav > button');
		var t_nav1 = book_pop.find('> .nav1 > button');
		var t_course = 'next';
		var t_num = 0;
		var book_pop_list = $('.book_pop_list > li');
		var book_close = book_pop.find('.close');
		var selnum = $(".bp_contents select");

		$(".gb_page_num .sumpage").text(book_pop_list.length);

		photo_list.hover(
		function(){
		  $(this).find('> button').stop().animate({top:0},{duration:200,easing:'easeOutCubic'});
		},
		function(){
			$(this).find('> button').stop().animate({top:'-100%'},{duration:200,easing:'easeOutCubic'});
		});

/*
		var book_close_evt = function(){
			$('.mask').fadeOut(300,function(){
				$(this).remove();
			});

			book_pop.fadeOut(300);
			book_pop_list.fadeOut(300);
		}
*/
		var book_pop_evt = function(obj){
			book_pop
			.fadeIn()
			.css({
				'height':book_pop_list.eq(obj).height()+'px'
			});
			book_pop_list.eq(obj).fadeIn(500);

			$(".gb_page_num strong").text(t_num+1);
		}
		/*
		photo_list.find('> a').bind('click',function(){
			mask_evt();
			t_num = $(this).parent().index();
			book_pop_evt(t_num);
			alert(t_num);
			//$(".gb_page_num strong").text();
			return false;
		});
		*/
		$(".selgo").bind('click',function(){
			t_num = parseInt($(this).prev("select").val()-1);
			book_pop_list.hide();
			book_pop_evt(t_num);
			$(".gb_page_num strong").text(t_num+1);
		});

		t_nav.bind('click',function(){
			t_course = $(this).attr('class');
			book_pop_list.hide();

			if(t_course == 'next'){
				t_num++;
				if(t_num >= book_pop_list.length){
					t_num = 0;
				}
			}else if(t_course == 'navbtn pend'){
				t_num = book_pop_list.length-1;
			}else if(t_course == 'navbtn pfirst'){
				t_num = 0;
			}
			else{
				t_num--;
				if(t_num <= -1){
					t_num = book_pop_list.length-1;
				}
			}
			book_pop_evt(t_num);
			return false;
		});
		t_nav1.bind('click',function(){
			t_course = $(this).attr('class');
			book_pop_list.hide();

			if(t_course == 'next'){
				t_num++;
				if(t_num >= book_pop_list.length){
					t_num = 0;
				}
			}else if(t_course == 'navbtn pend'){
				t_num = book_pop_list.length-1;
			}else if(t_course == 'navbtn pfirst'){
				t_num = 0;
			}
			else{
				t_num--;
				if(t_num <= -1){
					t_num = book_pop_list.length-1;
				}
			}
			book_pop_evt(t_num);
			return false;
		});

		book_close.bind('click',function(){
			book_close_evt();

			return false;
		});
		/*
		$('.mask').bind('click',function(){
			book_close_evt();
		});
		*/

		});
})(jQuery);

function digit_check(evt){
	var code = evt.which?evt.which:event.keyCode;
	if(code < 48 || code > 57){
		return false;
	}
}
