<?php
include_once('./_common.php');
	
	$sql = "select * from sj_member";
	//$result = sql_query($sql);
	
	for ($i=0; $row=sql_fetch_array($result); $i++)
	{
		//$sql1 = "SELECT count(po_id) as cnt FROM test_g.sj_point where mb_id = '{$row['mb_id']}' and po_rel_table = 'e_story'";
		//$row1 = sql_fetch($sql1);
		//
		//$sql2 = "SELECT count(po_id) as cnt FROM test_g.sj_point where mb_id = '{$row['mb_id']}' and po_rel_table = 'e_campaign'";
		//$row2 = sql_fetch($sql2);
		
		
		$sql0 = " update sj_member set 
					mb_point = point_1 + point_2 + point_3 + point_4 + point_5 + point_6 + point_7 + point_8 + point_9 + point_10 + point_11 + point_12 + point_13 + point_14 + point_15
				where mb_id = '{$row['mb_id']}' ";
		//sql_query($sql0);
		
		//echo $row['mb_id'];
		//echo "<br />";
	}
	
	echo "완료";
?>