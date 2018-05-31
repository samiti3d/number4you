<?
	//========= Function Insert Data ========= 

	function Insert($Table,$Value){
		$Insert=mysql_query("INSERT INTO $Table VALUES ($Value)") or die (mysql_error());
		return $Insert;
	}
	
	//========= Function Select Data (WHERE) ========= 
	function Select($Table,$Condition){
		$Select=mysql_query("SELECT * FROM $Table $Condition ") or die (mysql_error());
		return $Select;
	}
	
		//========= Function Delete Data (WHERE) ========= 
	function Delete($Table,$Condition){
		$Delete=mysql_query("DELETE FROM $Table $Condition ") or die (mysql_error());
		return $Delete;
	}
	
		//========= Function Update Data (WHERE) ========= 
	function Update($Table,$Condition){
		$Updaate=mysql_query("UPDATE $Table SET $Condition") or die (mysql_error());
		return $Updaate;
	}

	//========= Function Num_Rows (WHERE) =========
	function Num_Rows($Condition){
		$Num_Rows=mysql_num_rows($Condition);
		return $Num_Rows;	
	}
	
	//========= Function ResizePicture) =========
	function ResizePicture($Picture_Tmp,$Rename,$Height,$Path){
		$Size=getimagesize($Picture_Tmp);
		$SizeX=$Size[0];
		$SizeY=$Size[1];
		$Weight=ceil($SizeX*$Height)/$SizeY;
		$Image_Fin=imagecreatetruecolor($Weight,$Height);
		
		$Image_Ori=imagecreatefrompng($Picture_Tmp);
		$ImageX=imagesx($Image_Ori);
		$ImageY=imagesy($Image_Ori);
		
		imagecopyresampled($Image_Fin,$Image_Ori,0,0,0,0,$Weight,$Height,$ImageX,$ImageY);
		imagepng($Image_Fin,$Path.$Rename);
		
		imagedestroy($Image_Fin);
		imagedestroy($Image_Ori);
		
		$Complate="Complate";
		return $Complate;
	}	

	//========= Function Add Class Active on Bootstrap =========
	function echoActiveClassIfRequestMatches($requestUri){

    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
	}
	
	//========= Function Show CATEGORIES =========
	function showCatBer(){

		$sql = "SELECT * FROM nfy_cats";
		$r = mysql_query($sql);
		if ($r) {
			while ($a = mysql_fetch_array($r)) {

			$sqltwo = 'SELECT * FROM nfy_sims WHERE sims_cat = "'. $a['catname'] .'"';
			$rtwo = mysql_query($sqltwo);
			$num_row = mysql_num_rows($rtwo);

			echo '<li><a href="viewcat.php?cid='. $a['id'].'"><span class="title">'. $a['catname'] .'</span><span class="count">&nbsp;'. $num_row .'</span></a> </li>';
			}
		}
	}
	//========= Function Count All Numbers =========
	function countBer(){

		$sql = "SELECT * FROM nfy_sims";
		$r = mysql_query($sql);
		if ($r) {
			$total_sims = mysql_num_rows($r);
			echo $total_sims;
		}
	}
?>