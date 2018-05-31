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

    if ($_POST) {

        $berku = trim($_POST['berku']);
        $bertumnai = trim($_POST['bertumnai']);

        if ($berku && $bertumnai == "") {
            $error[] = "เป็นค่าว่างทั้ง 2 ฟอร์มที่ไม่ได้กรอก";
        }

        $sql = "SELECT * FROM nfy_tamnai WHERE tamnai_ber = $berku";
        $r = mysql_query($sql);

        if ($numrow = mysql_num_rows($r) > 1) {

            echo "<script language=\"javascript\">";
            echo "alert('คุณใส่ข้อมูลซ้ำ!');";
            echo "window.location='numberpredict.php';";
            echo "</script>";

        }else{

            $checkInsert = Insert('nfy_tamnai',"0,'$berku','$bertumnai'");

            if ($checkInsert) {

            echo "<script language=\"javascript\">";
            echo "alert('บันทึกในฐานข้อมูลเรียบร้อย!');";
            echo "window.location='numberpredict.php';";
            echo "</script>";

            }

        }

    }

    function showNumsDatabase(){

        $sql = "SELECT * FROM nfy_tamnai";
        $r = mysql_query($sql);
        while ($a = mysql_fetch_array($r)) {
            echo '<a href="?edit='. $a['id'] .'">' . $a['tamnai_ber'] . '</a>' . ' | ';
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

                        <div class="col-lg-12">
                        <?php if (isset($error)) {
                            echo explode("", $error);
                        }?>
                            <div class="panel panel-default bootstrap-admin-no-table-panel">

                                        <?php showNumsDatabase(); ?>
                            </div>
                                        
                        <!-- ขั้น -->
                            <?php if(isset($_GET['edit']) && $_GET['edit'] != ""){?>

                         <?php    
                            $editid = $_GET['edit'];
                            $sql="SELECT * FROM nfy_tamnai WHERE id = $editid";
                            $r = mysql_query($sql);
                            while ($a = mysql_fetch_array($r)) {
                         ?>
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">ระบบจัดการคำทำนายเบอร์โทรศัพท์</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" method="post" action="saveedit_predict.php">
                                        <fieldset>
                                            <legend>แก้ไขคำทำนายใหม่</legend>
                                            <div class="form-group has-success">
                                                <label class="col-lg-2 control-label" for="selectError">คู่หมายเลขที่กำลังแก้ไข</label>
                                                <div class="col-lg-10">
                                                    <select id="selectError" name="eberku" class="form-control">

            
                                   <?php echo '<option value="'. $a['tamnai_ber'] .'"">'. $a['tamnai_ber'] .'</option>'; ?>
         
                                                    
                                                    </select>
                                                    <span class="help-block">ระบบคำทำนายเป็นคู่เท่านั่น</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">กรอกคำทำนาย</label>
                                                <div class="col-lg-10">
                                                <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" name="ebertumnai" placeholder="" style="width: 100%; height: 200px">
                                                <?php echo $a['tamnai_text'] ?>
                                                </textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">บันทึก</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>


                            <?php } }else{ ?>

                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">ระบบจัดการคำทำนายเบอร์โทรศัพท์</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" method="post">
                                        <fieldset>
                                            <legend>เพิ่มคำทำนาย</legend>
                                            <div class="form-group has-success">
                                                <label class="col-lg-2 control-label" for="selectError">กรุณาเลือกคู่คำทำนาย</label>
                                                <div class="col-lg-10">
                                                    <select id="selectError" name="berku" class="form-control">

                                                    <?php 

                                                    for ($i=0; $i < 100 ; $i++) { 

                                                        if ($i < 10) {
                                                            echo '<option value="'. '0'.$i .'"">'. '0'.$i .'</option>';
         
                                                        }else{

                                                            echo '<option value="'. $i .'">'. $i .'</option>';

                                                        }
                                                    

                                                    }?>
                                               
                                                    </select>
                                                    <span class="help-block">ระบบคำทำนายเป็นคู่เท่านั่น</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">กรอกคำทำนาย</label>
                                                <div class="col-lg-10">
                                                    <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" name="bertumnai" placeholder="ใส่คำทำนายตรงนี้..." style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">แก้ไข</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>

                            <?php } ?>

                        </div>    
                        <!-- ขั้น col-lg-10      -->
                </div>
            </div>
        </div>

<?php include("elements/footer.php"); ?>