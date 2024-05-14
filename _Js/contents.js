var lesson = 0;
var chapter = 0;
var contents = 0;
var controlbar_enable = "No";

/*
function check_contents_wbt(  lesson, chapter, c_no, page, ended ){
				var datas = "lesson=" + lesson + "&chapter=" + chapter + "&c_no=" + c_no + "&p_time=" + p_time + "&f_time=" + f_time + "&ended=" + ended;
				$.ajax({
					type: "POST",
					url: "/module/contents/contents_wbt_check_json.php",
					data: datas,
					success: function(res){
							alert(res);
							res_data = jQuery.parseJSON(res);
							if( res_data.res == true ) {
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
*/
function check_contents_wbt(page) {
  var datas =
    "lesson=" + lesson + "&chapter=" + chapter + "&contents=" + contents;

  if (page == "end") datas = datas + "&page=end";
  else datas = datas + "&page=" + page;
  //else  datas = datas + "&page=" + (page-1);
  console.log("????????????????????22", page, lesson);

  $.ajax({
    type: "POST",
    url: "/Edu/contents_wbt_check_json2.php",
    data: datas,
    success: function (res) {
      res_data = jQuery.parseJSON(res);
      if (res_data.res == true) {
        //alert( res_data.cc + '/' + res_data.ca );
        //alert( res_data.msg );
      } else if (res_data.res == false) {
        alert(res_data.msg);
      } else {
        alert(res);
      }
    },
    error: function (err) {},
  });
}

function check_contents_wbt2(page, lesson) {
  var datas =
    "lesson=" + lesson + "&chapter=" + chapter + "&contents=" + contents;

  if (page == "end") datas = datas + "&page=end";
  else datas = datas + "&page=" + page;
  //else  datas = datas + "&page=" + (page-1);
  console.log("????????????????????", page, lesson);

  $.ajax({
    type: "POST",
    url: "/Edu/contents_wbt_check_json2.php",
    data: datas,
    success: function (res) {
      res_data = jQuery.parseJSON(res);
      if (res_data.res == true) {
        //alert( res_data.cc + '/' + res_data.ca );
        //alert( res_data.msg );
      } else if (res_data.res == false) {
        alert(res_data.msg);
      } else {
        alert(res);
      }
    },
    error: function (err) {},
  });
}

function setClass(l_no, c_no, c) {
  console.log("SET");
  lesson = l_no;
  chapter = c_no;
  contents = c;
  //alert(lesson + "/" + chapter + "/" + contents);
}

function setClassUrl(c_url) {
  //alert("modal");
  console.log(c_url);
  $("#frm").attr("src", c_url);
}

function pageCheck(p) {
  //alert(lesson + "/" + chapter + "/" + contents);
  check_contents_wbt(p);
}

function pageCheck2(p, lssn_no) {
  //alert(p + "/" + lssn_no);
  check_contents_wbt2(p, lssn_no);
}

function endCheck() {
  check_contents_wbt("end");
}

function closeClass() {
  //out_class();
  document.location.reload();
}
