<?php 
session_start();
error_reporting(E_ALL); 
include_once('admin/module/connect.php');
include_once('admin/module/function.php');
  $errors = array();
if($_POST['usernamex']){ 
  $username = $_POST['usernamex'];
  $password = $_POST['passwordx'];

  if (empty($username)) {
    $errors[] = "username เป็นค่าว่าง! $username";
  }
  if (empty($password)) {
    $errors[] = "Password เป็นค่าว่าง";
  }

  if (empty($errors)) {

    $SelectAdmin=Select("nfy_member","WHERE m_username='".$username."' AND m_password='".$password."'");
    while($a = mysql_fetch_array($SelectAdmin)){
      $mid = $a['id'];
    }

    $checkInsert = Insert('nfy_checkin',"'','$mid',NOW()");
    if ($checkInsert) {

      $Num_Rows=Num_Rows($SelectAdmin);
      if($Num_Rows == 1){

        $_SESSION['Memberx'] = $username;
        echo "<script language=\"javascript\">";
        echo "window.location='account-home.php';";
        echo "</script>";

      }else{

        echo "<script language=\"javascript\">";
        echo "alert('".$username." นี้ไม่มีอยู่ในระบบ');";
        echo "window.location='index.php';";
        echo "</script>";
      }
    }
  }
}
?>