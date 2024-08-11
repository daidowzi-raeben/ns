<?php
include_once('./_common.php');

$edu = get_edu($edu_id);

$wr_time = sprintf("%02d", $edu['wr_3']);
$wr_time .= ":" . sprintf("%02d", $edu['wr_4']);
$wr_time .= "~" . sprintf("%02d", $edu['wr_5']);
$wr_time .= ":" . sprintf("%02d", $edu['wr_6']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>NS홈쇼핑</title>
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/common.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/styleDefault.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/layout.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/content.css" />
</head>

<body>
<div id="plan">  
  <div class="board-write-wrap">
  <p class="txt_title"><?php echo $edu['wr_subject']?></p>
			<span class="bd-line"></span>
	<table>
				  <colgroup>
					  <col width="15%">
					  <col width="*">
				  </colgroup>
				  <tbody>
					 
					  <tr>
						  <th><span>내&nbsp;&nbsp;&nbsp;용</span></th>
						  <td><?php echo conv_content($edu['wr_content'])?></td>
					  </tr>
					  <tr>
						  <th><span>시&nbsp;&nbsp;&nbsp;간</span></th>
						  <td><?php echo $wr_time?></td>
					  </tr>
					  <tr>
						  <th><span>회&nbsp;&nbsp;&nbsp;차</span></th>
						  <td><?php echo $edu['wr_7']?>회</td>
					  </tr>
					  <tr>
						  <th><span>대&nbsp;&nbsp;&nbsp;상</span></th>
						  <td><?php echo $edu['wr_10']?></td>
					  </tr>
					  <tr>
						  <th><span>장&nbsp;&nbsp;&nbsp;소</span></th>
						  <td><?php echo $edu['wr_2']?></td>
					  </tr>	
					  <tr>
						  <th><span>담&nbsp;&nbsp;&nbsp;당</span></th>
						  <td><?php echo $edu['wr_9']?></td>
					  </tr>	
                      
				  </tbody>
			</table>
  </div>
		<div class="btn_r">
        <a href="javascript:window.close()" class="bp-btn"><span>확인</span></a>		
		</div>
</div>
<div class="gap"></div>
</body>
</html>
