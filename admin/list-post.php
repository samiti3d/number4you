<?php  error_reporting(E_ALL); 
    session_start(); 
    include ('module/connect.php');
    include ('module/function.php');

    if(!isset($_SESSION['Admin'])){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='index.php';";
        echo "</script>";
    }

?>
<?php

$sql = "SELECT * FROM nfy_article";
if($r= mysql_query($sql)){
    $i = 0;

  while ($a = mysql_fetch_array($r)) {
    $i++;
    $articleid =  $a['article_id'] ;
    $topic = $a['topic'];
    $writer = $a['writer'];
    $date_post = $a['date_post'];
    $article_text = $a['article_text'];
    $imageid = $a['image_id'];

    $tableOutput .= '<tr>';
    $tableOutput .= '<td>' . $i .'</td>';
    $tableOutput .= '<td>' . $topic.'</td>';
    $tableOutput .= '<td>' . $date_post.'</td>';
    $tableOutput .= '<td>' . $writer .'</td>';
    $tableOutput .= '<td><a href="?del=' . $articleid .'">ลบ |</a><a href="?edit='. $articleid . '">แก้ไข</a></td>';
    $tableOutput .= '</tr>';

    }

}

$delid = $_GET['del']; //delete post
$editid = $_GET['edit'];
$reset = $_GET['reset'];
if ($reset == 1) {
   // header('Location: list-post.php');
    echo "<script language=\"javascript\">";
    echo "alert('ยกเลิกการเขียนบทความ!');";
    echo "window.location='list-post.php';";
    echo "</script>";
}

if (isset($delid) && $delid != "") {

    $checkDelete = Delete('nfy_article',"WHERE article_id = {$delid}");

    if ($checkDelete) {

        Delete('image', "WHERE image_id = {$imageid}");
        mysql_close($Connect);

    }

    echo "<script language=\"javascript\">";
    echo "alert('ลบข้อมูลโพสเรียบร้อยแล้ว!');";
    echo "window.location='list-post.php';";
    echo "</script>";

}

if (isset($editid) && $editid != "") {

    $sql = "SELECT * FROM nfy_article WHERE article_id = {$editid}";
    $r = mysql_query($sql);
    while ($a = mysql_fetch_array($r)) {
        
        $topic = $a['topic'];
        $date = date_time($a['date_post']);
        $articletext = $a['article_text'];
    }
mysql_close($Connect);
// header('Location: list-post.php');


}  


    function date_time($datetime, $include_time=false){
        $dt = explode(" ", $datetime);
        return $dt[1];
    }
?>
<?php include("elements/header.php");?>

    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
<?php include("elements/small_nav.php"); ?>

        <!-- main / large navbar -->
<?php include("elements/big_nav.php"); ?>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <?php include("admin_menu.php");?>

                        <div class="col-lg-10">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">รายชื่อบทความที่มีอยู่</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table bootstrap-admin-table-with-actions">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>หัวข้อบทความ</th>
                                                <th>เวลาบันทึก</th>
                                                <th>ผู้แต่ง</th>
                                                <th>จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <?php echo $tableOutput; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            <?php if($_GET['edit']){?>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" id="new-article" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend>แก้ไขบทความ</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="typeahead">หัวข้อเรื่อง </label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="topic" class="form-control col-md-6" id="typeahead" autocomplete="off" data-provide="typeahead" data-items="4" value="<?php echo $topic; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="date01">วันที่เขียนบทความ</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control datepicker" id="date01" value="<?php echo $date; ?>">
                                                    <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" name="allow_comment" for="optionsCheckbox">แสดงคอมเม้นหรือไม่</label>
                                                <div class="col-lg-10">
                                                    <label class="uniform">
                                                        <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                                                       เช็คเพื่อแสดงคอมมเม้นเพื่อให้ผู้อ่านแสดงความคิดเห็นได้
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">หมวดหมู่บทความ</label>
                                                <div class="col-lg-10">
                                                    <select id="select01" class="chzn-select" style="width: 150px">

                                                    </select>
                                                </div>
                                            </div>
                    
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="fileInput">อัพโหลดไฟล์</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control uniform_on" name="file" id="file" type="file">
                                                    <!-- id="fileInput" -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" name="writer" for="textarea-wysihtml5">เนื้อหา</label>
                                                <div class="col-lg-10">
                                                    <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" name="content" placeholder="<?php echo $articletext; ?>" style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">แก้ไข</button>
                                            <a class="btn btn-default" href="?reset=1">ยกเลิก
                                            </a>
                                        </fieldset>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>           
                </div>
            </div>
        </div>

<?php include("elements/footer.php"); ?>