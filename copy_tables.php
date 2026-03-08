<?php
include_once('/home/users/sejong/gLms2/common.php');
\$tables = array('sj_edu_mail_queue', 'sj_edu_mail_log', 'sj_edu_mail_unsubscribe');

// Function to get connection to test_g
function get_test_g_conn() {
    \$conn = mysqli_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD, 'test_g');
    return \$conn;
}

foreach(\$tables as \$tbl) {
    \$row = sql_fetch("SHOW CREATE TABLE " . \$tbl);
    if (!\$row) {
        echo "Error: Table \$tbl not found in current DB.\n";
        continue;
    }
    \$create_sql = \$row['Create Table'];
    
    \$conn = get_test_g_conn();
    if (!\$conn) {
        echo "Error: Could not connect to test_g.\n";
        break;
    }
    
    mysqli_query(\$conn, "DROP TABLE IF EXISTS " . \$tbl);
    if (mysqli_query(\$conn, \$create_sql)) {
        echo "Table \$tbl copied to test_g successfully.\n";
    } else {
        echo "Error creating table \$tbl in test_g: " . mysqli_error(\$conn) . "\n";
    }
    mysqli_close(\$conn);
}
?>
