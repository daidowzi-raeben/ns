
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
<input type="hidden" name="type" value="<?php echo $type ?>">
<table>
<caption><?php echo $g5['title']; ?> 검색</caption>
<colgroup>
	<col class="grid_4">
	<col>
	<col class="grid_4">
	<col>
</colgroup>
<tbody>
<tr>
	<th scope="row"><label for="mb_year">년도</label></th>
	<td colspan="3">
		<?php echo get_blYear_select("bl_year", $bl_year) ?>
	</td>
</tr>
<tr>
	<th scope="row"><label for="">소속</label></th>
	<td>
		<?php echo get_blName_select("bl_name") ?>
	</td>
	<th scope="row"><label for="mb_4">부서3</label></th>
	<td>
		<input type="text" name="mb_4" id="mb_4" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" value="<?php echo $mb_4; ?>" />
	</td>
</tr>
<tr>
	<th scope="row"><label for="mb_id">사번</label></th>
	<td>
		<input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id ?>" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" />
	</td>
	<th scope="row"><label for="mb_name">이름</label></th>
	<td>
		<input type="text" name="mb_name" id="mb_name" value="<?php echo $mb_name ?>" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20" />
	</td>
</tr>
</tbody>
</table>
<br/>
<input type="submit" name="act_button" value="검색" class="btn btn_02">
</form>
