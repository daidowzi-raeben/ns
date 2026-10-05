

pageinfo=new Array(8);

pageinfo[1]=new Array();
pageinfo[2]=new Array();
pageinfo[3]=new Array();
pageinfo[4]=new Array();
pageinfo[5]=new Array();
pageinfo[6]=new Array();
pageinfo[7]=new Array();
pageinfo[8]=new Array();



//01
pageinfo[1][1]=new Array("010101","001","01/01_01.html");

//02
pageinfo[2][1]=new Array("020101","001","02/02_01.html");


//03
pageinfo[3][1]=new Array("030101","001","03/03_01.html");

//04
pageinfo[4][1]=new Array("040101","001","04/04_01.html");

//05
pageinfo[5][1]=new Array("050101","001","05/05_01.html");

//06
pageinfo[6][1]=new Array("060101","001","06/06_01.html");

//07
pageinfo[7][1]=new Array("070101","001","07/07_01.html");

//08
pageinfo[8][1]=new Array("080101","001","08/08_01.html");




/*************************************************************************************************/ 
// 이동 함수
/*************************************************************************************************/ 

var makeName = ".html";
var nowIndex = document.URL.split(makeName)[0];
var Dirnumber = Number(nowIndex.substring(nowIndex.length-8,nowIndex.length-6));
var hpage = Number(nowIndex.substring(nowIndex.length-2,nowIndex.length));

function movepage(c,p) {
  c = Number(Dirnumber);
//  p = Number(hpage);
	if (!pageinfo[c][p][2]) {
		alert("존재하지 않는 페이지입니다.");
	}
	else {
		location.href="../"+pageinfo[c][p][2];
	}
	
}

function nextpage(c,p) {
  c = Number(Dirnumber);
  p = Number(hpage);
//  alert("nextpage   c : "+c+"   p : "+p);   
	if ( p >= ( pageinfo[c].length-1)  ) {
		// LMS 연동: 부모 창의 완료 처리 및 다음 차시 이동 함수 호출
		if (window.parent && typeof window.parent.endCheck === "function") {
			window.parent.endCheck();
		}
		if (window.parent && typeof window.parent.goNextChapter === "function") {
			window.parent.goNextChapter();
			return;
		}

		if ( c >= 8 ) {
			// 8차시(마지막) 다음 버튼: 과정 종료 안내 후 확인 시 창 닫기
			alert("모든 과정을 마치셨습니다");
			window.close(); // 확인을 누르면 현재 페이지 창을 닫음
		}
		else {
			alert("이번 차시의 학습이 끝났습니다.");
			location.href="../"+pageinfo[(c+1)][1][2];
		}
	}
	else {	
		location.href="../"+pageinfo[c][(p+1)][2];
	}
}

function prevpage(c,p) {
  c = Number(Dirnumber);
  p = Number(hpage);
  //alert("prevpage   c : "+c+"   p : "+p); 
	if ( ( p-1)  <= 0 ) {
		if (c==1) {
			alert("첫 페이지 입니다.");
		}
		else {
			alert("첫 페이지 입니다.");
			//location.href="../"+pageinfo[(c-1)][ (pageinfo[c-1].length-1)][2];
		}
	}
	else {
		location.href="../"+pageinfo[c][(p-1)][2];
	}
}
/*************************************************************************************************/ 


/*************************************************************************************************/ 
// 의견쓰기 함수
///////////////////////////////////////////////////////////////////////////////////////


function on_opinionlist (opinionNo)
{		
	viewOpinion(opinionNo); 
	//alert("DB연동부분입니다~") 	
}

function on_opinion (opinionNo, title, contents)
{ 
	writeOpinion(opinionNo, contents);
}         


/*************************************************************************************************/ 
