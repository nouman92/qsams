<?php include 'header.php';
if (!isset($_SESSION['email']))
{
 header("Location: index.php");
 die();
}
?>
<img width="1200px" src="./static/images/main-layout.jpg"/>
<img width="1200px" src="./static/images/block.jpg"/>
<img width="1200px" src="./static/images/row.jpg"/>
<img width="1200px" src="./static/images/table.jpg"/>
<img width="1200px" src="./static/images/table-layout.jpg"/>

<?php include 'footer.php';?>
