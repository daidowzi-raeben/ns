function select_etc(sel, val, fd, sp){
	if( sel == val ) {
	$("#"+sp).show();
	$("#"+fd).focus();
	} else {
	$("#"+sp).hide();
	$("#"+fd).val("");
	}
}
function view_question(q_no) {
	$("div[id^='question_tab_']").hide();
	$("#question_tab_"+q_no).show();
}
function check_answer_custom(){
	var ck_ex = false;
	for( var qi=1; qi<=co_quiz; qi++ ){
		var co_ex = $("input[type=radio][id^='qa_answer_"+qi+"_']").length;
		ck_ex = false;
		for(var ex_i=1; ex_i <= co_ex; ex_i++){
			var ck_ex = $("input[type=radio][id^='qa_answer_"+qi+"_'][value='"+ex_i+"']").is(":checked");
			if( ck_ex == true ) {
				break;
			}
		}
		if( ck_ex == false ) {
			alert(qi+"번 답안이 없습니다.");
			current_quiz = qi;
			view_question(qi);
			return false;
		}
	}
	return true;
}