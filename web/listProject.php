<!DOCTYPE html>
<html>
<body>
 <div style="FLOAT:left;height:35px;width:200px;font-size:22;font-family:verdana;background-color:#ffffcc;"><a href='start.php'><img src=img/miniLogo.gif height=34></a></div><div style="FLOAT:left;height:35px;margin-top:0px;background-color:#ccd9ff;width:800px"><a href='start.php'>Back</a></div>
<br><br>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("db.php");
$db = new Db();    
$rows = $db -> select("SELECT * from research_project");
$rn = count($rows,COUNT_NORMAL);
?>
<p>Study cathegory:</p>
<Table>
<?php
for ($i=0; $i<$rn; $i++) {
	echo "<tr><td><a href='controller.php?action=listStudies&project=".$rows[$i]['researchID']."'>Select</a></td><td>".  $rows[$i]['description']."</td><td>(<b>".$rows[$i]['researchID']."</b>)</td></tr>";
}

?>
</table>
<br><br><br><br><br><br><br><br><br><br>
 <footer><small>©2017 Francesco Sisini </small></footer>
</body>

</html>
