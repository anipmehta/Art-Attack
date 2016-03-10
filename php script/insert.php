<?php
$data=urldecode($_POST['data']);
$obj=json_decode($data,TRUE);

$xco = $obj['xco'];
$yco = $obj['yco'];
$shape =$obj['shape'];
$radius =$obj['radius'];
$text = $obj['text'];
mysql_connect('localhost','root','anip');
mysql_select_db("art");
$query="INSERT INTO draw (xco,yco,shape,radius,text) values ('$xco','$yco','$shape','$radius','$text')";
if($res=mysql_query($query))
print json_encode(array('message' =>'success'));
else
print mysql_error();
mysql_close();

?>
