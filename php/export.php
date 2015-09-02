<?php
include "../config.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');    // 0 or 1 set 1 if unable to download database it will show all possible errors
ini_set('max_execution_time', 0);  // setting 0 for no time limit
session_start();

#####################
//CONFIGURATIONS
#####################

/*
Define the filename for the sql file
If you plan to upload the  file to Amazon's S3 service , use only lower-case letters
*/
$fileName = 'backup--' . date('d-m-Y') . '@'.date('h.i.s').'.sql' ;
// Set execution time limit
if(function_exists('max_execution_time')) {
if( ini_get('max_execution_time') > 0 ) 	set_time_limit(0) ;
}

$mysqli = new mysqli($GLOBALS['db_host'] , $GLOBALS['username'] , $GLOBALS['password'] , $GLOBALS['db_name']) ;
if (mysqli_connect_errno())
{
   printf("Connect failed: %s", mysqli_connect_error());
   exit();
}
 // Introduction information
$return='';
 $return .= "--\n";
$return .= "-- A Mysql Backup System \n";
$return .= "--\n";
$return .= '-- Export created: ' . date("Y/m/d") . ' on ' . date("h:i") . "\n\n\n";
$return = "--\n";
$return .= "-- Database : " . $GLOBALS['db_name'] . "\n";
$return .= "--\n";
$return .= "-- --------------------------------------------------\n";
$return .= "-- ---------------------------------------------------\n";
$return .= 'SET AUTOCOMMIT = 0 ;' ."\n" ;
$return .= 'SET FOREIGN_KEY_CHECKS=0 ;' ."\n" ;
$tables = array() ;
// Exploring what tables this database has
$result = $mysqli->query('SHOW TABLES' ) ;
// Cycle through "$result" and put content into an array
while ($row = $result->fetch_row())
{
    $tables[] = $row[0] ;
}
// Cycle through each  table
foreach($tables as $table)
{
    // Get content of each table
    $result = $mysqli->query('SELECT * FROM '. $table) ;
    // Get number of fields (columns) of each table
    $num_fields = $mysqli->field_count  ;
    // Add table information
    $return .= "--\n" ;
    $return .= '-- Tabel structure for table `' . $table . '`' . "\n" ;
    $return .= "--\n" ;
    $return.= 'DROP TABLE  IF EXISTS `'.$table.'`;' . "\n" ;
    // Get the table-shema
    $shema = $mysqli->query('SHOW CREATE TABLE '.$table) ;
    // Extract table shema
    $tableshema = $shema->fetch_row() ;
    // Append table-shema into code
    $return.= $tableshema[1].";" . "\n\n" ;
    // Cycle through each table-row
    while($rowdata = $result->fetch_row())
    {
        // Prepare code that will insert data into table
        $return .= 'INSERT INTO `'.$table .'`  VALUES ( '  ;
        // Extract data of each row
        for($i=0; $i<$num_fields; $i++)
        {
        $return .= '"'.$mysqli->real_escape_string($rowdata[$i]) . "\"," ;
        }
        // Let's remove the last comma
        $return = substr("$return", 0, -1) ;
        $return .= ");" ."\n" ;
    }
 $return .= "\n\n" ;
}
// Close the connection
$mysqli->close() ;
$return .= 'SET FOREIGN_KEY_CHECKS = 1 ; '  . "\n" ;
$return .= 'COMMIT ; '  . "\n" ;
$return .= 'SET AUTOCOMMIT = 1 ; ' . "\n"  ;
//$file = file_put_contents($fileName , $return) ;

header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
header("Cache-Control: public"); // needed for i.e.
header("Content-Type: application/sql");
header("Content-Transfer-Encoding: Binary");
header("Content-Length:".strlen($return));
header("Content-Disposition: attachment; filename=".$fileName);
echo $return;
function get_file_size_unit($file_size){
switch (true) {
    case ($file_size/1024 < 1) :
        return intval($file_size ) ." Bytes" ;
        break;
    case ($file_size/1024 >= 1 && $file_size/(1024*1024) < 1)  :
        return intval($file_size/1024) ." KB" ;
        break;
	default:
	return intval($file_size/(1024*1024)) ." MB" ;
}
}
?>
