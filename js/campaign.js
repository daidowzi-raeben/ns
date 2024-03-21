var lesson = 0;
var chapter = 0;
var contents = 0;
var controlbar_enable = "No";


function check_contents_wbt( page ){
	var datas = "lesson=" + lesson + "&chapter=" + chapter + "&contents=" + contents;
	
	if( page == "end" ) datas = datas + "&page=end";
	else  datas = datas + "&page=" + page;
	//else  datas = datas + "&page=" + (page-1); 
	
	
	$.ajax({
		type: "POST",
		url: "/Edu/contents_wbt_check_json.php",
		data: datas,
		success: function(res){
				res_data = jQuery.parseJSON(res);
				if( res_data.res == true ) {
					//alert( res_data.cc + '/' + res_data.ca );
					//alert( res_data.msg );
				} else if( res_data.res == false )  {
					alert( res_data.msg );
				} else {
					alert( res );
				}
		},
		error: function(err){}
	});
}

function setClass(  c ){
	//lesson = l_no;
	//chapter = c_no;
	contents = c;
	//alert(lesson + "/" + chapter + "/" + contents);
}

function setClassUrl( c_url ){
	$('#frm').attr("src", c_url);
}

function pageCheck( p ){
	//alert(p);
	check_contents_wbt( p );
}

function endCheck(){		
	check_contents_wbt("end");
}

function closeClass(){	
	//out_class();
	document.location.reload();
}
