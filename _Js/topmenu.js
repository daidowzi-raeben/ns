var mnOvNum = [];
var mainNavi_W = {
		mnObj : null,Timer:null,subTimer:null,isOver:false,initNum:[],
	_getMenu:function(){return $("#mainNavi");	},
	_init:function(){
		var this_s = this;
		
		this.mnObj = this._getMenu();

		$("li",$(this.mnObj)).each(function(){
			if($("ul",$(this)).length>0 && !$(this).hasClass("has-sub")) $(this).addClass("has-sub");
		});
	
		this._initOvNum();
		this.setOvBar();
		this.setEvt();
	},
	_set:function(){},
	_unset:function(){

	},

	_retset:function(){
		this.setEvt();
		this.resetMenuStyle();
		this.resetMenuBar();
	},
	isOpen:function(){
		return this.mnObj.hasClass("mn-h-open");
	},
	setOvBar:function(){

		$(".ovbar",this.mnObj.parent()).remove();
		this.ovbar = $('<div class="ovbar"></div>').prependTo(this.mnObj.parent());
		this.ovbar.css({"width":"0"});
	},
	resetMenuStyle:function(){

		var chkW = $("#header.div-cont").eq(0).width();
		if(chkW > 1000) chkW = 1000;
		var tmpItems = $(".mn_l1",$(this.mnObj)) ;

		var totalW =parseInt($("#mainNavi").css("max-width"));
		if($("#mainNavi").css("max-width")=="none" || totalW < chkW) totalW = chkW;
		tmpItems.css({"width":"auto"});

		var mnW = Math.floor(totalW/tmpItems.length);
		var tmpW = 0;

		$(tmpItems).each(function(){

			if($(this).index()==(tmpItems.length-1)){
			}else{
			}
			tmpW = tmpW + mnW;
		});

	},
	setSubMenuStyle:function(smn){
		var maxWidth = 1000;
		

		if(smn.length>0){
			var subMn = smn.get(0);

		var thisSubOpt = 	{"width":"auto","left":"auto","right":"auto"};
		$(subMn).stop().show().css({"left":"auto","right":"auto","visibility":"visible","width":"auto","height":"auto"});


		var tmpSubItem = $(".depth2 > li > a",$(subMn));
  
		var depth2_w = 0,depth2_left = 0;
		tmpSubItem.each(function(){
			depth2_w = depth2_w +$(this).outerWidth();
		});

		if(depth2_w >0) depth2_w = depth2_w +2 ;

		if(depth2_w>maxWidth){
			depth2_w = maxWidth;
		}
	
		var left_s = $(subMn).offset().left -  $("#header").offset().left;
		if((left_s + depth2_w)>maxWidth){ 	thisSubOpt.right = "0px";	thisSubOpt.left = "";	}

		thisSubOpt.width = depth2_w;

		$(subMn).css(thisSubOpt);			
		}

	},
	initDefaultStyle:function(){
	
		this.resetMenuStyle();
		$(".depth2-wrap" ,this.mnObj).each(function(){
			$(this).stop().css({"height":"auto","visibility":"visible","opacity":1}).show();
			$(this).prop("sHeight",$(this).outerHeight()).css({"overflow":"hidden"});
		});
		$(".mn-bar").css({"height":0}).hide();
	},
	clearEvt:function(){
		if(wsize.win.w > 999){
			$("a",$(this.mnObj)).unbind("mousedown mouseover  click mouseout blur");
			$(".depth2-wrap",$(this.mnObj)).unbind("mousedown mouseover click  mouseout blur");
			$("> li > .depth2-wrap",$(this.mnObj)).unbind("mousedown mouseover click  mouseout blur");
		}

		if(wsize.win.w < 999){
			$("a",$(this.mnObj)).unbind("mousedown mouseover focus click mouseout blur");
			$(".depth2-wrap",$(this.mnObj)).unbind("mousedown mouseover click focus mouseout blur");
			$("> li > .depth2-wrap",$(this.mnObj)).unbind("mousedown mouseover click focus mouseout blur");
		}
	},
	
	setEvt:function(){
		var this_s = this;
		this.clearEvt();


		$(".depth2-wrap",$(this.mnObj)).bind("mouseover focus", function(){	clearTimeout(this_s.subTimer ); this_s.isSubOver = true;	});
		$(".depth2-wrap",$(this.mnObj)).bind("mouseout blur", function(){	clearTimeout(this_s.subTimer ); this_s.isSubOver = false;this_s.setSubMenuOutSet(500);	});

		$("a",$(this.mnObj)).bind("mouseover focus", function(){	 clearTimeout(this_s.subTimer ); this_s.isOver = true;	});
		$("> li > .depth2-wrap",$(this.mnObj)).bind("mouseover focus", function(){	clearTimeout(this_s.subTimer );  this_s.isOver = true;	});

		$("a",$(this.mnObj)).bind("mouseout blur", function(){	clearTimeout(this_s.subTimer ); this_s.isSubOver = false;this_s.setSubMenuOutSet(500); this_s.setMenuOut();	});
		$("> li > .depth2-wrap",$(this.mnObj)).bind("mouseout blur", function(){	this_s.setMenuOut();	});
		
		var tmpItems = $(".mn_l1",$(this.mnObj)) ;
		for (i=0;i<tmpItems.length ;i++ )
		{
			var thisSubObj = $(".depth2-wrap" ,$(tmpItems[i]));
			var subH = $(thisSubObj).stop().show().css({"visibility":"visible","height":"auto"}).outerHeight();
		}
		$(".depth2-wrap",$(this.mnObj)).each(function(){
			if($(this).has(".mn-stit").length<1){
			}		

		});
		this.initDefaultStyle();
		$(".mn_a1",$(this.mnObj)).bind("mouseover focus", function(){	
			this_s.isOver = true;
			var selLI = $(this).parent();			var selUL = $(this).parent().parent();
			this_s.setMenuOn(selLI.index()+1);
			
		});

		$(".mn_a2",$(this.mnObj)).bind("mouseover focus", function(){	
			this_s.isSubOver = true;	

			var selLI = $(this).parent();			var selMN1 = $(this).parents(".mn_l1").eq(0).index();
			this_s.setMenuOn(selMN1+1 ,selLI.index()+1);
			
		});

		var chkMn =  (this.initNum[0]>0)? $(".mn_l1", this.mnObj).eq(this.initNum[0]-1) : null;
		if(chkMn!=null && chkMn.length>0){
			 this.isFirstOpen = true;
		}else{
			this.isFirstOpen = false;
		}

		if(this.initNum[0]<1) { 

		}else{
			this.setMenuOn(this.initNum[0],this.initNum[1],this.initNum[2]);
		}



	},
	resetMenuBar:function(){
		if(this.currentSeq==undefined){
			var toNum = this.initNum[0];
		}else{
			var toNum = this.currentSeq;
		}


		this.setMenuBar(toNum);
	},
	setMenuBar:function(n){
		var thisMenu = (n>0)? $(".mn_l1:eq(" + ( n-1 ) +")", this.mnObj):null;
		var otherMenu = $(".mn_l1", this.mnObj).not(thisMenu);
		if(this.ovbar!=undefined){
			var toLeft =   (thisMenu!=null)? thisMenu.offset().left  - $(this.mnObj).offset().left : 0 ;

			this.ovbar.stop().animate({

				width: (thisMenu!=null)? thisMenu.width()  - 0 : 0,
				left:toLeft
			},300); 
		}
		
		
	},
	
	setSubMenuDepthOn:function(d,li){
		clearTimeout(this.subTimer ); var this_s = this;
		var mns = $(".mn_l"+d+"", this.mnObj);
		var mnNum = $(li).index() + 1;
		

		$(li).addClass("is-open");	
		$(li).removeClass("is-close");	

		mns.not(li).addClass("is-cloose");
		mns.not(li).removeClass("is-open");

		this_s.isSubClose = false;

		switch (d)
		{
			case 1 :	

					var subMenu = $(".depth2-wrap",li);
					if(subMenu.length>0){
						subMenu.stop().css({"visibility":"visible","opacity":0}).show();
						var mnH = $(".depth2",subMenu).outerHeight();
						subMenu.stop().animate({"opacity":1,"height":mnH},300);
						$("#mainNavi-wrap").stop().animate({height:mnH + this_s.getMenuBarHeight()},0,function(){})
						$(".mn-bar").stop().show().animate({"height":mnH},300,function(){});
						$("#header-quick").stop().show().animate({"height":mnH},300,function(){});
						$('#header-wrap').addClass('isOver');
						$(".depth2-wrap",this.mnObj).not(subMenu).each(function(){					$(this).stop().css({"height":0});				});
					}else{
						this.subMenuBarClose();
					}
					
					this.setMenuBar(mnNum);
					this.setSubMenuOutSet(4000);
				break;
		}
		this.isFirstOpen = false;
	},
	
	setMenuOn:function(){
		clearTimeout(this.Timer );	var this_s = this;
		var s  = new Array();
		for(var i=0; i<arguments.length;i++){
			s[i] = arguments[i];	
		}

		if(parseInt(s[1])<1 || s[1]==undefined) s[1] = 0;
		if(parseInt(s[2])<1 || s[2]==undefined) s[2] = 0;

		var thisMenu = $(".mn_l1", this.mnObj).eq(s[0]-1);
		
	
		if(this.currentSeq !=s[0]  || this.isSubClose){
			this.setSubMenuOut(this.currentSeq);

			thisMenu.addClass("is-over");
			
			if(!this.isFirstOpen) this.setSubMenuDepthOn(1,thisMenu);
	
		}

		$(".mn_l1", this.mnObj).not(thisMenu).removeClass("is-over");

		if(!this.isFirstOpen) this.currentSeq = s[0];
		this.isFirstOpen = false;

		this.setMenuBar(s[0]);	

		


		
	},
	getSubMenuHeight:function(subMn){

		var tmpItems = $(".mn_l1",$(this.mnObj)) ;
		var maxSubHeight = 0;
		for (i=0;i<tmpItems.length ;i++ )
		{
			var thisSubObj = $(".depth2-wrap" ,$(tmpItems[i]));
			var subH = $(thisSubObj).stop().show().css({"visibility":"visible","height":"auto"}).outerHeight();//"height":"auto",

			if(maxSubHeight <=subH) maxSubHeight = subH;
		}

		return maxSubHeight;
	},
	getMenuBarHeight:function(){
		var h = _getLayoutHeaderHeight() - parseInt($("#mainNavi-wrap").css("top"));
		return h;

	},

	
	subMenuBarClose:function(){
		// $("#mainNavi-wrap").stop().animate({height: this.getMenuBarHeight()},300,function(){});
		$("#mainNavi-wrap").stop().animate({height: 45},300,function(){});
		$(".mn-bar").stop().animate({"height":0},300,function(){$(this).hide();});
		$("#header-quick").stop().animate({"height":0},300,function(){$(this).hide();});
		$('#header-wrap').removeClass('isOver');
		$(".topmenu").find(".mn_l1").removeClass('is-over');
		$(".depth2-wrap").css({"height":0}).hide();
	},
	setSubMenuOut:function(seq){
		clearTimeout(this.subTimer );	var this_s = this;
		this.subMenuBarClose();
	},
	setSubMenuOutSet:function(time){
		var this_s = this;
		this.subTimer = setTimeout(function(){
			if(!this_s.isSubOver){
				this_s.isSubClose = true;
				this_s.subMenuBarClose();
				var thisMn =  (this_s.initNum[0]>0)? $("> li",this_s.mnObj).eq( this_s.initNum[0]-1 ) :null;
				if(thisMn!=null) thisMn.addClass("is-over");
				$("> li", this_s.mnObj).not(thisMn).removeClass("is-over");

				this_s.setMenuBar(this_s.initNum[0]);

			}else{
			}
				
		},time);
	},
	setMenuOut:function(){

		clearTimeout(this.Timer );		var this_s = this;
		this.isOver = false;	
		this.Timer = setTimeout(function(){
			
			if(this_s.isOver==false) {
			}
		},400);
	},
	_initOvNum:function(initNum){
		
		if(initNum!=undefined) this.initNum = initNum;
		else{
			this.initNum[0] =( $(".mn_l1.over",this.mnObj).length> 0)? $(".mn_l1.over",this.mnObj).index() + 1 : 0;
			this.initNum[1] =( $(".mn_l2.over",this.mnObj).length> 0)? $(".mn_l2.over",this.mnObj).index() + 1 : 0;
			this.initNum[2] =( $(".mn_l3.over",this.mnObj).length> 0)? $(".mn_l3.over",this.mnObj).index() + 1 : 0;
		}
	}
}

var mainNavi = {
	mnObj : null,
	initNum:Array(),	currNum:Array(), Timer:null, mnType:"",
	_init:function(mn,initNum){
		var this_s = this;
		this.mnObj = $("#mainNavi");

		/*if($(".doc-pg").find(".body-slide-wr").length<1){
			$(".doc-pg").wrapInner("<div class='body-slide-wr'><div class='body-slide'></div></div>");
		}*/
			
		$(".body-slide-wr").css({"overflow":"hidden"});	

		this.checkMenuType();
		this.setMenu();

		var mnToggleBtn = $("#mn-ctrs-btns");

		$(".mn-close-btn").off("click").click(function(){
			if(this_s.mnType!="H") return;
			mainNavi_H.closeMenu();
		});

		//버튼 초기화
		mnToggleBtn.off("click").on("click",function(){

			if(this_s.mnType!="H") return true;
			mainNavi_H.toggleMenu();
			return false;
		
		});

		$(".bt-mnclose").off("click").on("click",function(){

			if(this_s.mnType!="H") return;
			mainNavi_H.closeMenu();
			return false;
		
		});

	
		
	},
	_resize:function(){
		if(this.mnType!="H"){
			mainNavi_W.resetMenuStyle();
			mainNavi_W.resetMenuBar();
		}
	},
	_reset:function(){

		this.resetMenu();

	},
	setMenu:function(){
		if(this.mnType=="W"){
			mainNavi_W._init();
		}else{
			mainNavi_W._unset();	
		}
		
		
		
	},
	resetMenu:function(){
		var orgMnType = this.mnType;

		this.checkMenuType();	

		this._resize();
		
		if(orgMnType!=this.mnType){
			this.setMenu();
		}
	},
	checkMenuType:function(){

		getWindowSize();

		var chkWinW = wsize.win.w;
		var chkContW = $("body").width();

		if(chkContW >= 1025){
			this.mnType = "W";
		}else{
			this.mnType = "H";
		}


	},
	clearTimer:function(){
		
	}

}


function initNavigation() {
	$(document).ready(function(){	
		mainNavi._init(); 
	});
}


$(document).ready(function(){	 
	$(".topmenu").find(".mn_l2 > a.mn_a2").hover(function(){
	    $(this).parent('li').addClass('is-over');
		//$(this).parent('li').find('.depth3').show();
		$(this).parent('li').siblings('li').removeClass('is-over');
		//$(this).parent('li').siblings('li').find('.depth3').hide();
	})
	$(".topmenu").find(".mn_l2 > a.mn_a2").focus(function(){
	    $(this).parent('li').addClass('is-over');
		$(this).parent('li').siblings('li').removeClass('is-over');
	})
});

