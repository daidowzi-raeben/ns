<?php
include_once('./_common.php');

//echo "TEST";
if(!$is_member) {
	alert(NS_LOGIN_MSG);
}

if( !$l_no ) {
	alert("과정을 선택해주세요.");
	exit;
}

$LESSON = get_lesson2($l_no);
$CHAPTER = get_chapter($c_no);

$sql_next = "select cpt_no from {$g5['chapter_table']} where cpt_lesson='{$l_no}' and cpt_seq > '{$CHAPTER['cpt_seq']}' order by cpt_seq asc limit 1";
$next_cpt = sql_fetch($sql_next);
$next_c_no = $next_cpt ? $next_cpt['cpt_no'] : '';

$next_cpt_url = '';
$next_contents_no = '';
if ($next_cpt) {
    $next_cpt_info = sql_fetch(" SELECT cpt_contents FROM {$g5['chapter_table']} WHERE cpt_no = '{$next_cpt['cpt_no']}' ");
    if ($next_cpt_info) {
        $next_contents_no = $next_cpt_info['cpt_contents'];
        $next_cn_info = sql_fetch(" SELECT c_url FROM {$g5['contents_table']} WHERE c_no = '{$next_contents_no}' ");
        $next_cpt_url = $next_cn_info ? $next_cn_info['c_url'] : '';
    }
}

$all_chapters = array();
$sql_all = "select c.cpt_no, c.cpt_seq, c.cpt_contents, cn.c_url, cn.c_page 
            from {$g5['chapter_table']} as c 
            left join {$g5['contents_table']} as cn on (cn.c_no = c.cpt_contents) 
            where c.cpt_lesson = '{$l_no}' 
            order by c.cpt_seq asc";
$res_all = sql_query($sql_all);
while ($row_all = sql_fetch_array($res_all)) {
    $all_chapters[] = array(
        'cpt_no' => (int)$row_all['cpt_no'],
        'cpt_seq' => (int)$row_all['cpt_seq'],
        'cpt_contents' => (int)$row_all['cpt_contents'],
        'c_url' => $row_all['c_url'],
        'c_page' => (int)$row_all['c_page']
    );
}

$userLessData = get_lessonApply2($member['mb_id'], $l_no);
//�н� ������ ���ٸ�, ���� ����
if( !$userLessData ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '{$l_no}',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

if($l_no == 10)
	$foldName = "acnt";
else if($l_no == 12)
	$foldName = "12";
else if($l_no == 13)
	$foldName = "13";
else if($l_no == 14)
	$foldName = "14";
else if($l_no == 16)
	$foldName = "16";
else if($l_no == 17)
	$foldName = "17";
else if($l_no == 18)
	$foldName = "18";
else if($l_no == 19)
	$foldName = "19";
else if($l_no == 32)
	$foldName = "20";
else if($l_no == 33)
	$foldName = "21";
else if($l_no == 34)
	$foldName = "22";
else if($l_no == 35)
	$foldName = "35";
else if($l_no == 36)
	$foldName = "ethics/11";
else if($l_no != 6)
	$foldName = "cyber";
else
	$foldName = "cyber2";

if( !$CHAPTER ){
		$rtn[res] = false;
		$rtn[msg] = "차시정보가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}

## 신청기간 확인
if( !($LESSON['lssn_sdate'] <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($LESSON['lssn_edate']."+1 day"))) {
	alert("학습기간이 아닙니다.");
	exit;
}

##학습기록 오픈 확인
if( !get_lessonApply2($member['mb_id'], $l_no) ) {


	alert("학습가능한 교육이 없습니다.");
}

$CONTENTS = get_contents($CHAPTER['cpt_contents']);

if( !$CONTENTS['c_url'] ) {
	alert("해당컨텐츠가 존재하지 않습니다.");
	exit;
}

############################## 기존 진행상태 확인 ###############################
$my_info = array();
$my_info["uid"] = $member['mb_id'];
$my_info["lesson"] = $l_no;
$my_info["chapter"] = $c_no;
$my_info["contents"] = $CHAPTER['cpt_contents'];

$attend_info = chapter_attend_exist($my_info);

if( $attend_info ) { 
	if( $attend_info['att_study_page'] == 0 ) $open_page = 1;
	elseif( $attend_info['att_study_page'] >= $CONTENTS['c_page'] ) $open_page = 1;
	else $open_page = $attend_info['att_study_page'];
}
else $open_page = 1;
if($l_no == 10 || $l_no == 14)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/" . sprintf("%02d",$open_page) . ".html";
else if($l_no == 19)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/{$CONTENTS['c_url']}_" . sprintf("%02d",$open_page) . ".html";
else if($l_no == 34 || $l_no == 35 || $l_no == 36)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/{$CONTENTS['c_url']}_" . sprintf("%02d",$open_page) . ".html";
else if($l_no == 32)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/" . sprintf("%03d",$open_page) . ".htm";
	// $page_url = "http://nas.sonhojun.com:11000/2024/sejong/02/003.htm";
else if($l_no == 16)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/" . sprintf("%03d",$open_page) . ".html";
else if($l_no == 33)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/01/" . sprintf("%03d",$open_page) . ".htm";
else if($l_no == 17)
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}.html";
else if($l_no == 18) {
	if($c_no == 47)
		$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/" . sprintf("%02d",$open_page) . ".html";
	else
		$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/01/" . sprintf("%02d",$open_page) . ".html";
}
else
	$page_url = G5_URL . "/process/{$foldName}/{$CONTENTS['c_url']}/" . sprintf("%02d",$open_page) . ".htm";
//$page_url = G5_URL . "/process/NS/{$CONTENTS['c_url']}/" . sprintf("%02d",$open_page) . ".htm";
//$page_url = G5_URL . "/contents/cp/00/" . sprintf("%02d",$open_page) . ".htm";

## 컨트롤바 상태
if( $LESSON['lssn_controlbar'] == "Y" ) {
	$controlbar_enable = "yes";
} else {
	$controlbar_enable = "No";
}

?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $config['cf_title']; ?></title>
    <link type="text/css" rel="stylesheet" media="all" href=" ../_Css/common.css" />
    <link type="text/css" rel="stylesheet" media="all" href=" ../_Css/styleDefault.css" />
    <link type="text/css" rel="stylesheet" media="all" href=" ../_Css/content.css" />
    <script type="text/javascript" src="../_Js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../_Js/jquery/jquery.easing.1.3.js"></script>
    <script>
    var urls = 'pop02.php'
    var width = 1080;
    var height = 625;
    var tops = (window.screen.height - height) / 2;
    var lefts = (window.screen.width - width) / 2;

    var strFeature;
    strFeature = 'height=' + height + ',width=' + width +
        ',menubar=no,toolbar=no,location=no,resizable=no,status=no,scrollbars=no,top=' + tops + ', left=' + lefts

    $(function() {
        $('.class-regist').click(function() {
            self.close();
        });
    });

    function endProc() {
        location.reload();
    }
    </script>
    <script src="/js/contents.js?v2212" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $(".con03 dt").click(function() {
            $(".con03 dt").show();
            $(".con03 dd").slideUp();
            $(this).hide();
            $(this).next("dd").slideDown();
        });
    });

    controlbar_enable = "<?=$controlbar_enable?>";
    </script>
    <script type="text/javascript">
    var pp = 0;
    var control_enable = '';
    var allChapters = <?php echo json_encode($all_chapters); ?>;
    var current_chapter_no = <?php echo (int)$CHAPTER['cpt_no']; ?>;
    var current_contents_no = <?php echo (int)$CONTENTS['c_no']; ?>;
    var current_chasi_folder = '<?php echo $CONTENTS['c_url']; ?>';
    var current_open_page = <?php echo (int)$open_page; ?>;
    var foldName = '<?php echo $foldName; ?>';
    var lessonNo = <?php echo (int)$l_no; ?>;
    var isMovingChapter = false;

    setClass(lessonNo, current_chapter_no, current_contents_no);
    setClassUrl("<?=$page_url?>");

    function getContentUrl(c_url, pageNum) {
        var p2 = (pageNum < 10 ? '0' : '') + pageNum;
        var p3 = (pageNum < 10 ? '00' : (pageNum < 100 ? '0' : '')) + pageNum;
        var base = "<?php echo G5_URL; ?>/process/" + foldName + "/" + c_url + "/";

        if (lessonNo == 10 || lessonNo == 14) {
            return base + p2 + ".html";
        } else if (lessonNo == 19 || lessonNo == 34 || lessonNo == 35 || lessonNo == 36) {
            return base + c_url + "_" + p2 + ".html";
        } else if (lessonNo == 32) {
            return base + p3 + ".htm";
        } else if (lessonNo == 16) {
            return base + p3 + ".html";
        } else if (lessonNo == 33) {
            return base + "01/" + p3 + ".htm";
        } else if (lessonNo == 17) {
            return "<?php echo G5_URL; ?>/process/" + foldName + "/" + c_url + ".html";
        } else {
            return base + p2 + ".htm";
        }
    }

    function getNextChapterInfo() {
        var currentIndex = -1;
        for (var i = 0; i < allChapters.length; i++) {
            if (allChapters[i].cpt_no == current_chapter_no || allChapters[i].c_url == current_chasi_folder) {
                currentIndex = i;
                break;
            }
        }
        if (currentIndex !== -1 && currentIndex + 1 < allChapters.length) {
            return allChapters[currentIndex + 1];
        }
        return null;
    }

    function saveCurrentChapterComplete(callback) {
        var datas = "lesson=" + lessonNo + "&chapter=" + current_chapter_no + "&contents=" + current_contents_no + "&page=end";
        $.ajax({
            type: "POST",
            url: "/Edu/contents_wbt_check_json.php",
            data: datas,
            complete: function() {
                if (typeof callback === "function") {
                    callback();
                }
            }
        });
    }

    function goNextChapter() {
        if (isMovingChapter) return;
        isMovingChapter = true;

        const n = document.getElementById('pop-dim');
        if (n) n.style.display = "block";

        var nextChapter = getNextChapterInfo();

        if (nextChapter) {
            // 방금 본 차시 학습완료(100%) 저장 후 다음 차시로 이동
            saveCurrentChapterComplete(function() {
                var next_url = getContentUrl(nextChapter.c_url, 1);

                current_chapter_no = nextChapter.cpt_no;
                current_contents_no = nextChapter.cpt_contents;
                current_chasi_folder = nextChapter.c_url;
                current_open_page = 1;
                pp = 0;

                setClass(lessonNo, nextChapter.cpt_no, nextChapter.cpt_contents);
                setClassUrl(next_url);

                setTimeout(function() {
                    isMovingChapter = false;
                    if (n) n.style.display = "none";
                }, 1000);
            });
        } else {
            // 모든 차시 완료
            saveCurrentChapterComplete(function() {
                alert("모든 과정을 마치셨습니다.");
                isMovingChapter = false;
                if (n) n.style.display = "none";

                if (window.parent && window.parent.$ && window.parent.$("#popup_win").length) {
                    try {
                        window.parent.$("#popup_win").bPopup().close();
                    } catch(e) {}
                }
                if (window.opener) {
                    try { window.opener.location.reload(); } catch(e) {}
                    window.close();
                } else {
                    location.reload();
                }
            });
        }
    }

    function isPage(v) {
        var iframeUrl = "";
        try {
            if (v && v.contentWindow && v.contentWindow.location && v.contentWindow.location.href) {
                iframeUrl = v.contentWindow.location.href;
            }
        } catch (e) {
            console.error("Cannot access iframe contentWindow location:", e);
        }
        if (!iframeUrl || iframeUrl === "about:blank") {
            iframeUrl = (v && v.src) ? v.src : "";
        }

        if (!iframeUrl) return;

        // 1. Extract folder name to ensure it's a valid content URL
        var foldNameStr = '<?php echo $foldName; ?>';
        var regex = new RegExp("/process/" + foldNameStr + "/([a-zA-Z0-9_-]+)/");
        var matches = iframeUrl.match(regex);
        var folder = matches ? matches[1] : '';
        if (!folder) {
            return;
        }

        // 2. Parse actual page number from the iframe URL
        var filename = iframeUrl.substring(iframeUrl.lastIndexOf('/') + 1);
        var nameWithoutExt = filename.split('.')[0];
        var pageMatches = nameWithoutExt.match(/\d+$/);
        var actualPage = pageMatches ? parseInt(pageMatches[0], 10) : 1;

        // Dim background to prevent rapid double clicking
        const n = document.getElementById('pop-dim');
        if (n) {
            n.style.display = "block";
            setTimeout(() => {
                n.style.display = "none";
            }, 1000);
        }

        // 3. Handle folder/chapter transition
        if (folder !== current_chasi_folder) {
            var found = null;
            for (var i = 0; i < allChapters.length; i++) {
                if (allChapters[i].c_url === folder) {
                    found = allChapters[i];
                    break;
                }
            }
            if (found) {
                current_chapter_no = found.cpt_no;
                current_contents_no = found.cpt_contents;
                current_chasi_folder = found.c_url;
                current_open_page = actualPage;
                pp = 0;
                setClass(lessonNo, found.cpt_no, found.cpt_contents);
                check_contents_wbt(actualPage);
                return;
            }
        }

        // 4. Update progress for the current chapter
        check_contents_wbt(actualPage);
    }
    </script>
</head>

<body id="pop">
    <style>
    #pop-dim {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
    }
    </style>
    <div id="pop-dim" style="display:none"></div>
    <div style="width:100%;height:100%;position:absolute;left:0;top:0;">

        <iframe src="" name="frm" id="frm" style="width:100%;height:100%;border:0px;" onLoad="isPage(this)"></iframe>

        <?php
		if( $open_page >= 2 ) {
		?>
        <script type="text/javascript">
        //index_move(<?=$open_page?>);
        </script>
        <?php
		}?>
    </div>
</body>

</html>