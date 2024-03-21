<?php
$menu['menu900'] = array (
    array('900000', '환경설정', G5_ADMIN_URL.'/newwinlist.php',   'config'),
    array('900100', '팝업관리', G5_ADMIN_URL.'/newwinlist.php', 'scf_poplayer'),
	#array('900110', '기본환경설정', G5_ADMIN_URL.'/config_form.php',   'cf_basic'),
    #array('900200', '관리권한설정', G5_ADMIN_URL.'/auth_list.php',     'cf_auth'),
    #array('900280', '테마설정', G5_ADMIN_URL.'/theme.php',     'cf_theme', 1),
    #array('900290', '메뉴설정', G5_ADMIN_URL.'/menu_list.php',     'cf_menu', 1),
	#array('900300', '메일 테스트', G5_ADMIN_URL.'/sendmail_test.php', 'cf_mailtest'),
	#array('900300', '게시판관리', ''.G5_ADMIN_URL.'/board_list.php', 'board'),
	#array('900310', '게시판그룹관리', ''.G5_ADMIN_URL.'/boardgroup_list.php', 'bbs_group'),
    #array('900320', '팝업레이어관리', G5_ADMIN_URL.'/newwinlist.php', 'scf_poplayer'),
    #array('900800', '세션파일 일괄삭제',G5_ADMIN_URL.'/session_file_delete.php', 'cf_session', 1),
    #array('900900', '캐시파일 일괄삭제',G5_ADMIN_URL.'/cache_file_delete.php',   'cf_cache', 1),
    #array('900910', '캡챠파일 일괄삭제',G5_ADMIN_URL.'/captcha_file_delete.php',   'cf_captcha', 1),
    #array('900920', '썸네일파일 일괄삭제',G5_ADMIN_URL.'/thumbnail_file_delete.php',   'cf_thumbnail', 1),
    #array('900500', 'phpinfo()',        G5_ADMIN_URL.'/phpinfo.php',       'cf_phpinfo')
);
/*
if(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
    $menu['menu900'][] = array('900510', 'Browscap 업데이트', G5_ADMIN_URL.'/browscap.php', 'cf_browscap');
    $menu['menu900'][] = array('900520', '접속로그 변환', G5_ADMIN_URL.'/browscap_convert.php', 'cf_visit_cnvrt');
}

$menu['menu900'][] = array('900410', 'DB업그레이드', G5_ADMIN_URL.'/dbupgrade.php', 'db_upgrade');
$menu['menu900'][] = array('900400', '부가서비스', G5_ADMIN_URL.'/service.php', 'cf_service');
*/
?>