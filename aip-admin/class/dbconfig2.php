<?php
define('WHATSAPP', '+918667569358');
define('SCONTENT', 'Hi, I would like to join ');
define('ECONTENT', ' of your publications');
define('COMPANY_NAME','International Publications');

define('MSG1', 'Hello I would like to order ');
define('MSG2', ' Let me know more details, and current market price.');

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'u260965545_alpha');
define('ADMIN', 'admin');

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
/*if ($db->connect_error) {
   echo "Not connected, error: " . $db->connect_error;
}
else {
   echo "Connected.";
}*/

// SQL - LFI - RFI - XSS BASIC Web Application Firewall
$gelenveriler='';
foreach($_REQUEST as $key => $value) {
$gelenveriler=$gelenveriler.' '.strtolower(htmlspecialchars($key)).' '.strtolower(htmlspecialchars($value));
}
$yasaklikelimeler = array("group_concat(","concat_ws(","concat(","BENCHMARK","information_schema","))","schema_name","couNT(","/*","--","*/","nulL,","1,2","extractvalue","/script","')","&#",");","/.","./","/etc/","/home/","/var/","/proc/","/usr/","..%2f","expect://","php://input","php://filter","zip://","data://");
foreach($yasaklikelimeler as $gelenveri){
if (strstr(mb_strtolower($gelenveriler),urldecode($gelenveri))) {
echo 'Hacking attempt!';
exit;
}}

?>