<?php
$konek=mysql_connect("localhost:3307","root","mmsPNMonl1n3");
if (!$konek)
{
echo "database tidak ada";

}
else{$a=mysql_select_db("jayakerti");}//mtechbmt_mitrasejahtera
$req = "SELECT no_rekening  "
	."FROM tabung "
	."WHERE no_rekening LIKE '%".$_REQUEST['term']."%' "; 

$query = mysql_query($req);

while($row = mysql_fetch_array($query))
{
	$results[] = array('label' => $row['no_rekening']);
}

echo json_encode($results);
?>