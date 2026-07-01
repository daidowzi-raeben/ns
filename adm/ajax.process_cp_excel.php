<?php
include_once('./_common.php');
include_once(G5_PATH . '/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

// Access control check
auth_check($auth[$sub_menu], 'w');

header('Content-Type: application/json');

if (!isset($_FILES['cp_excel_file']) || $_FILES['cp_excel_file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(array('error' => '파일 업로드에 실패했습니다.'));
    exit;
}

$file_path = $_FILES['cp_excel_file']['tmp_name'];

try {
    $spreadsheet = IOFactory::load($file_path);
    $sheet = $spreadsheet->getActiveSheet();
    $highestRow = $sheet->getHighestRow();
    
    $list = array();
    $target_ids = array();
    
    // Loop through data rows starting from row 3
    for ($row = 3; $row <= $highestRow; $row++) {
        $excel_id = $sheet->getCellByColumnAndRow(6, $row)->getValue(); // Column F is 6
        $excel_name = $sheet->getCellByColumnAndRow(5, $row)->getValue(); // Column E is 5
        $status = $sheet->getCellByColumnAndRow(9, $row)->getValue(); // Column I is 9
        
        $excel_id = trim($excel_id);
        if (!$excel_id) {
            continue;
        }
        
        $status = trim($status);
        if ($status !== '미수료') {
            continue;
        }
        
        // Remove first 2 characters (e.g. 'ns') and trim
        $cleaned_id = trim(substr($excel_id, 2));
        
        // Search in member table
        $sql = " select mb_id, mb_name, mb_email from {$g5['member_table']} 
                 where mb_id = '" . sql_real_escape_string($cleaned_id) . "' 
                    or mb_id = '0" . sql_real_escape_string($cleaned_id) . "'
                    or mb_id = '" . sql_real_escape_string($excel_id) . "' ";
        $mb = sql_fetch($sql);
        
        $matched = false;
        $db_id = '';
        $db_name = '';
        $db_email = '';
        
        if ($mb && $mb['mb_id']) {
            $matched = true;
            $db_id = $mb['mb_id'];
            $db_name = $mb['mb_name'];
            $db_email = $mb['mb_email'];
            $target_ids[] = $db_id;
        }
        
        $list[] = array(
            'excel_id' => $excel_id,
            'excel_name' => $excel_name,
            'cleaned_id' => $cleaned_id,
            'matched' => $matched,
            'db_id' => $db_id,
            'db_name' => $db_name,
            'db_email' => $db_email,
            'status' => $status
        );
    }
    
    echo json_encode(array(
        'success' => true,
        'list' => $list,
        'target_ids' => implode(',', $target_ids)
    ));
    
} catch (Exception $e) {
    echo json_encode(array('error' => '엑셀 파일 파싱 오류: ' . $e->getMessage()));
}
?>
