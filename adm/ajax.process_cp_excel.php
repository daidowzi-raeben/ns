<?php
include_once('./_common.php');

// Access control check
auth_check($auth[$sub_menu], 'w');

header('Content-Type: application/json');

if (!isset($_FILES['cp_excel_file']) || $_FILES['cp_excel_file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(array('error' => '파일 업로드에 실패했습니다.'));
    exit;
}

$file_path = $_FILES['cp_excel_file']['tmp_name'];

// Lightweight XML-based XLSX parser to support old PHP versions (PHP 5.3.3+)
function parse_xlsx_lightweight($file_path) {
    if (!class_exists('ZipArchive')) {
        return false;
    }
    
    $zip = new ZipArchive();
    if ($zip->open($file_path) !== TRUE) {
        return false;
    }

    // 1. Read shared strings
    $shared_strings = array();
    $shared_strings_xml_data = $zip->getFromName('xl/sharedStrings.xml');
    if ($shared_strings_xml_data) {
        $xml = simplexml_load_string($shared_strings_xml_data);
        if ($xml) {
            foreach ($xml->si as $si) {
                if (isset($si->t)) {
                    $shared_strings[] = (string)$si->t;
                } else if (isset($si->r)) {
                    $text = '';
                    foreach ($si->r as $r) {
                        $text .= (string)$r->t;
                    }
                    $shared_strings[] = $text;
                } else {
                    $shared_strings[] = '';
                }
            }
        }
    }

    // 2. Read sheet1
    $sheet_xml_data = $zip->getFromName('xl/worksheets/sheet1.xml');
    if (!$sheet_xml_data) {
        $zip->close();
        return false;
    }

    $xml = simplexml_load_string($sheet_xml_data);
    $zip->close();
    
    if (!$xml) {
        return false;
    }

    $rows = array();
    foreach ($xml->sheetData->row as $row) {
        $row_index = (int)$row['r'];
        $row_cells = array();
        
        foreach ($row->c as $c) {
            $cell_ref = (string)$c['r']; // e.g. "F3"
            
            // Extract column letters (A, B, C...) from reference
            preg_match('/^[A-Z]+/i', $cell_ref, $matches);
            if (!empty($matches)) {
                $col_letter = $matches[0];
                
                $val = isset($c->v) ? (string)$c->v : '';
                $type = isset($c['t']) ? (string)$c['t'] : '';
                
                if ($type === 's' && $val !== '') {
                    $idx = (int)$val;
                    $val = isset($shared_strings[$idx]) ? $shared_strings[$idx] : '';
                }
                
                $row_cells[$col_letter] = $val;
            }
        }
        
        $rows[$row_index] = $row_cells;
    }

    return $rows;
}

try {
    $rows = parse_xlsx_lightweight($file_path);
    if ($rows === false) {
        echo json_encode(array('error' => '엑셀 파일의 압축을 풀거나 XML을 로드하는 데 실패했습니다.'));
        exit;
    }
    
    $list = array();
    $target_ids = array();
    
    // Loop through parsed rows
    foreach ($rows as $row_index => $row_cells) {
        // Skip header rows (1 and 2)
        if ($row_index < 3) {
            continue;
        }
        
        $excel_id = isset($row_cells['F']) ? trim($row_cells['F']) : '';
        $excel_name = isset($row_cells['E']) ? trim($row_cells['E']) : '';
        $status = isset($row_cells['I']) ? trim($row_cells['I']) : '';
        
        if (!$excel_id) {
            continue;
        }
        
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
