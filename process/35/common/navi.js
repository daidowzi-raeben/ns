pageinfo=new Array(5);

pageinfo[1]=new Array();
pageinfo[2]=new Array();
pageinfo[3]=new Array();
pageinfo[4]=new Array();
pageinfo[5]=new Array();


//01
pageinfo[1][1]=new Array("010101","001","01/01_01.html");
pageinfo[1][2]=new Array("010201","002","01/01_02.html");
pageinfo[1][3]=new Array("010301","003","01/01_03.html");
pageinfo[1][4]=new Array("010401","004","01/01_04.html");
pageinfo[1][5]=new Array("010501","005","01/01_05.html");
pageinfo[1][6]=new Array("010601","006","01/01_06.html");
pageinfo[1][7]=new Array("010701","007","01/01_07.html");
pageinfo[1][8]=new Array("010801","008","01/01_08.html");
pageinfo[1][9]=new Array("010901","009","01/01_09.html");
pageinfo[1][10]=new Array("011001","010","01/01_10.html");

//02
pageinfo[2][1]=new Array("020101","001","02/02_01.html");
pageinfo[2][2]=new Array("020201","002","02/02_02.html");
pageinfo[2][3]=new Array("020301","003","02/02_03.html");
pageinfo[2][4]=new Array("020401","004","02/02_04.html");
pageinfo[2][5]=new Array("020501","005","02/02_05.html");
pageinfo[2][6]=new Array("020601","006","02/02_06.html");
pageinfo[2][7]=new Array("020701","007","02/02_07.html");
pageinfo[2][8]=new Array("020801","008","02/02_08.html");
pageinfo[2][9]=new Array("020901","009","02/02_09.html");
pageinfo[2][10]=new Array("021001","010","02/02_10.html");

//03
pageinfo[3][1]=new Array("030101","001","03/03_01.html");
pageinfo[3][2]=new Array("030201","002","03/03_02.html");
pageinfo[3][3]=new Array("030301","003","03/03_03.html");
pageinfo[3][4]=new Array("030401","004","03/03_04.html");
pageinfo[3][5]=new Array("030501","005","03/03_05.html");
pageinfo[3][6]=new Array("030601","006","03/03_06.html");
pageinfo[3][7]=new Array("030701","007","03/03_07.html");
pageinfo[3][8]=new Array("030801","008","03/03_08.html");
pageinfo[3][9]=new Array("030901","009","03/03_09.html");
pageinfo[3][10]=new Array("031001","010","03/03_10.html");

//04
pageinfo[4][1]=new Array("040101","001","04/04_01.html");
pageinfo[4][2]=new Array("040201","002","04/04_02.html");
pageinfo[4][3]=new Array("040301","003","04/04_03.html");
pageinfo[4][4]=new Array("040401","004","04/04_04.html");
pageinfo[4][5]=new Array("040501","005","04/04_05.html");
pageinfo[4][6]=new Array("040601","006","04/04_06.html");
pageinfo[4][7]=new Array("040701","007","04/04_07.html");
pageinfo[4][8]=new Array("040801","008","04/04_08.html");
pageinfo[4][9]=new Array("040901","009","04/04_09.html");
pageinfo[4][10]=new Array("041001","010","04/04_10.html");

//05
pageinfo[5][1]=new Array("050101","001","05/05_01.html");
pageinfo[5][2]=new Array("050201","002","05/05_02.html");
pageinfo[5][3]=new Array("050301","003","05/05_03.html");
pageinfo[5][4]=new Array("050401","004","05/05_04.html");
pageinfo[5][5]=new Array("050501","005","05/05_05.html");
pageinfo[5][6]=new Array("050601","006","05/05_06.html");
pageinfo[5][7]=new Array("050701","007","05/05_07.html");
pageinfo[5][8]=new Array("050801","008","05/05_08.html");
pageinfo[5][9]=new Array("050901","009","05/05_09.html");
pageinfo[5][10]=new Array("051001","010","05/05_10.html");

/*************************************************************************************************/ 
// 이동 함수
/*************************************************************************************************/ 

var makeName = ".html";
var nowIndex = document.URL.split(makeName)[0];
var Dirnumber = Number(nowIndex.substring(nowIndex.length-8,nowIndex.length-6));
var hpage = Number(nowIndex.substring(nowIndex.length-2,nowIndex.length));

function movepage(c,p) {
    c = Number(Dirnumber);
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
	if ( p >= ( pageinfo[c].length-1)  ) {
		if ( c >= ( pageinfo.length - 1 ) ) {
			alert("모든 과정을 마치셨습니다");
		}
		else {
			if (typeof parent.goNextChapter === "function") {
				try {
					parent.goNextChapter();
				} catch(e) {
					console.error("parent.goNextChapter call failed, falling back to local redirect:", e);
					location.href="../"+pageinfo[(c+1)][1][2];
				}
			} else {
				alert("이번 차시의 학습이 끝났습니다. 다음 차시로 진행합니다.");
				location.href="../"+pageinfo[(c+1)][1][2];
			}
		}
	}
	else {	
		location.href="../"+pageinfo[c][(p+1)][2];
	}
}

function prevpage(c,p) {
  c = Number(Dirnumber);
  p = Number(hpage);
	if ( ( p-1)  <= 0 ) {
		if (c==1) {
			alert("첫 페이지 입니다.");
		}
		else {
			alert("이전 차시로 이동합니다.");
			location.href="../"+pageinfo[(c-1)][ (pageinfo[c-1].length-1)][2];
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


function on_opinionlist (opinionNo){		
	alert("DB연동부분입니다~");
}

function on_opinion (opinionNo, title, contents){ 
	alert("DB연동부분입니다~");
}         


/*************************************************************************************************/ 