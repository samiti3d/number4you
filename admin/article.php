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
<script>
$(function() {
    $(document).on('change', '#file', function() {
        if(this.files[0].size > 512000) {
            alert('ไฟล์ภาพมีขนาดใหญ่เกินกำหนด (500 KB) อาจมีปัญหาในการอัปโหลด กรุณาเปลี่ยนใหม่');
            //$(this).replaceWith($(this).clone());
            $('input:file').clearInputs();  //อยู่ในไลบรารี form.js
        }
    });
});
</script>
<?php
if ($_POST) {

    //ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
    //เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป (รายละเอียดอยู่ในบทที่ 14)
    $image_id = "";
    if(is_uploaded_file($_FILES['file']['tmp_name']))  {
        if($_FILES['file']['error'] == 0) {
            include "module/pmj/lib/IMager/imager.php";
            $img = image_upload('file');
            $img = image_to_jpg($img);
            $img = image_resize_max($img, 300, 300); //ให้ภาพกว้างไม่เกิน 600px สูงไม่เกิน 300px
            $f = image_store_db($img, "image/jpg");
            // $image = addslashes($_FILES['file']['tmp_name']);
            // $name = addslashes($_FILES['file']['name']);
            // $image = file_get_contents($image);
            // $f = base64_encode($image);
            
            $sql = "INSERT INTO image VALUES('', '$f')";
            mysql_query($sql);
            $image_id = mysql_insert_id($Connect);


        }
    }

    $t = $_POST['topic'];
    $c = $_POST['content'];
    $w = $_SESSION['Admin'];
    $ac = "yes";
    if($_POST['allow_comment']) {
        $ac = "no";
    }

    $sql = "REPLACE INTO nfy_article VALUES(0, '$t', '$c', '$w', '$ac', NOW(), 0, '$image_id')";
    if(mysql_query($sql) or die (mysql_error())) {
        echo '<row><h3 class="normal">บันทึกข้อมูลเรียบร้อยแล้ว'.$image_id. '</h3></row>';
    }else {
        echo '<row><h3 class="waringing">เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่</h3></row>';
    }
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
                                    <div class="text-muted bootstrap-admin-box-title">ฟอร์มเขียนบทความ</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" id="new-article" method="post" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend>เขียนบทความใหม่</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="typeahead">หัวข้อเรื่อง </label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="topic" class="form-control col-md-6" id="typeahead" autocomplete="off" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                                    <p class="help-block">Start typing to activate auto complete!</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="date01">วันที่เขียนบทความ</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control datepicker" id="date01" value="<?php echo date("Y/m/d"); ?>">
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
                                                    <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" name="content" placeholder="เขียนข้อความตรงนี้..." style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">ตกลง</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>                
                </div>
            </div>
        </div>

<?php include("elements/footer.php"); ?>