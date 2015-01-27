<?php
header('Content-type: application/xml; charset="utf-8"');
error_reporting( E_ALL );
?><?xml version="1.0" encoding="utf-8"?>
<?php
require_once 'inc/functions.php';

if(filled($_GET['email']))
	$id = User::getUserIdByMail(s($_GET['email']))[0];
else
	exit();

echo "<user id=\"$id\">\n";
$query = "CALL get_xml_data($id)";
$result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

$uid = 0;
$cid = 0;
while ($fetch = mysqli_fetch_assoc($result)){
	if($fetch['uniId'] != $uid){
		if($uid != 0) 
			echo "</university>\n";
		$uid = $fetch['uniId'];
		$uname = $fetch['uniName'];
		echo "<university id=\"$uid\" name=\"{$uname}\">\n";
	}
	if($cid != $fetch['id']){
		if($cid != 0) 
			echo "</course>\n";
		$cid = $fetch['id'];
		echo "<course id=\"{$cid}\" name=\"{$fetch['cName']}\" start=\"{$fetch['courseStart']}\" end=\"{$fetch['courseEnd']}\" link=\"{$fetch['courseAddress']}\">\n";
	}
	
	echo "<problemset deadline=\"{$fetch['deadline']}\" link=\"{$fetch['psAddress']}\">";
	echo "{$fetch['psName']}";
	echo "</problemset>\n";
	
}
echo "</course>\n";
echo "</university>\n";
echo "</user>";
mysqli_free_result($result);
mysqli_next_result($mysqli);
?>


