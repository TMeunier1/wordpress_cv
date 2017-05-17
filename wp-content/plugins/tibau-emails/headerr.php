<?php
$path = $_SERVER['DOCUMENT_ROOT']."/wordpress_cv";
define( 'SHORTINIT', true );
require( $path.'/wp-load.php' );
$results = $wpdb->get_results("SELECT * FROM email");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename='lelelelel'.csv");
if(count($results) > 0){
    foreach($results as $result){
        $csv_output .= $result->email."\n";
    }
}
print $csv_output;
?>
