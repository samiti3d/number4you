<?php 
error_reporting(E_ALL); 
    session_start(); 
    include ('admin/module/connect.php');
    include ('admin/module/function.php');

?>
<meta charset="utf-8">


<form method="post" enctype="multipart/form-data">
	<input type="file" name="image">
	<input type="submit" name="submit" value="submit">
</form>
<?php 

if (isset($_POST["submit"])) {

	if (getimagesize($_FILES['image']['tmp_name']) == false) {
		echo "Please select image";

	}else{
		$image = addslashes($_FILES['image']['tmp_name']);
		$name = addslashes($_FILES['image']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);
		saveimage($name,$image);
	}
}

	displayimage();


function saveimage($name, $image){

    $sql = "INSERT INTO `images` VALUES(0, '$name','$image')";
    $r = mysql_query($sql);
    if ($r) {

    	echo "<br/>Image Upload!";
    }else{
    	echo "<br/>Image Not Upload!";

   	}

}

function displayimage(){

	$sql = "select * from images";
	$r = mysql_query($sql);
	while ($row = mysql_fetch_array($r)) {

		echo '<img height="300" width="300" src="data:image;base64,'. $row['image'].'">';
	}
}

?>