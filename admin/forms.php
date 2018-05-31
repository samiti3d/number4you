
                <!-- content -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Master Sim 1.0</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">

                                    <form class="form-horizontal" action="addSim.php" method="post">
                                        <fieldset>
                                            <legend>เพิ่มเบอร์โทรศัพท์</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >เบอร์โทรศัพท์ </label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="ber" id="ber" class="form-control col-md-6" maxlength="10" size="5">
                                                    <p class="help-block">เป็นตัวเลขเท่านั้น!</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >ราคา </label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="ber_price" id="ber_price" class="form-control col-md-6" maxlength="10" size="5">
                                                    <p class="help-block">กำหนดราคาสำหรับจำหน่าย</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="optionsCheckbox">แสดงในหน้าแรก</label>
                                                <div class="col-lg-10">
                                                    <label class="uniform">
                                                        <input class="uniform_on" name="ber_show" type="checkbox" id="optionsCheckbox" value="1">
                                                        คลิกเครื่องหมายถูก&mdash;เบอร์โทรดังกล่าวจะแสดงที่หน้าแรกทันที
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">เครือข่าย</label>
                                                <div class="col-lg-10">
                                                    <select name="ber_pro" id="select01" class="chzn-select" style="width: 150px">
                                                        <option value="">กรุณาเลือก</option>
                                                        <option value="1">AIS</option>
                                                        <option value="2">TRUEMOVE</option>
                                                        <option value="3">DTAC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="select01">หมวดหมู่</label>
                                                <div class="col-lg-10">
                                                    <select name="ber_cat" id="select01" class="chzn-select" style="width: 150px; color: black;">
                                                        <option>กรุณาเลือก</option>
                                                        <?php 
                                                            $sql = "SELECT * FROM nfy_cats";
                                                            $SelectCats = mysql_query($sql);
                                                            while ($catArr = mysql_fetch_array($SelectCats)) {
                                                               echo '<option value="'. $catArr['catname'].'">' . $catArr['catname'] .'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick="return CheckValue()">ตกลง</button>
                                            <a href="?Act=cancel"><span class="btn btn-default">ยกเลิก</span></a>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- table fetch array-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">รายชื่อหมวดหมู่</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table bootstrap-admin-table-with-actions">


                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>เบอร์โทร</th>
                                                <th>หมวดหมู่</th>
                                                <th>เครือข่าย</th>
                                                <th>ผลรวม</th>
                                                <th>ราคา (บาท)</th>
                                            </tr>
                                        </thead>
                                            <tbody>

                                <?php 
                                // กำหนดจำนวนหน้าที่แสดง
                                $size = 5;

                                // กำหนดตัวแปรหน้าปัจจุบัน
                                $url = $_SERVER['PHP_SELF'];

                                // ตรวจสอบการรับค่าหน้า
                                if (isset($_GET['page'])) {

                                    $page = $_GET['page'];

                                }else{

                                    $page = 1;
                                }

                                // หาข้อมูลเริ่มต้น จาก limit sql เร่ิมต้นที่ 0
                                $start = ($page - 1)*$size;

                                // หาจำนวนแถว
                                $sqlTotal = "SELECT * FROM nfy_sims";
                                $sqlrTotal = mysql_query($sqlTotal);
                                $total = mysql_num_rows($sqlrTotal);

                                // หาจำนวนแถวที่แสดงแต่ละหน้า
                                $nPage = ceil($total/$size);

                                // เลือกฐานข้อมูล
                                $sql = "SELECT * FROM nfy_sims limit $start,$size";
                                $SelectSims = mysql_query($sql);

                                while ($sims = mysql_fetch_array($SelectSims)) {
                                        // SELECT Customers.CustomerName, Orders.OrderID
                                        // FROM Customers
                                        // INNER JOIN Orders
                                        // ON Customers.CustomerID=Orders.CustomerID
                                        // ORDER BY Customers.CustomerName;
                                    $simscatid = $sims['sims_cat'];

                                    $matchsql = "SELECT nfy_sims.sims_cat, nfy_cats.catname FROM nfy_sims INNER JOIN nfy_cats ON nfy_cats.id=$simscatid";
                                    $matchr = mysql_query($matchsql);
                                        while ($matcha = mysql_fetch_array($matchr)) {
                                             $catname = $matcha['catname'];
                                         } 
                                ?>
                                            <tr>
                                                <td><?php echo $sims['sims_id']; ?></td>
                                                <td><?php echo $sims['sims_ber']; ?></td>
                                                <td><?php echo $catname; ?></td>
                                                <td><?php echo $sims['sims_provider']; ?></td>
                                                <td><?php echo $sims['sims_total']; ?></td>
                                                <td><?php echo number_format($sims['sims_price'] ); ?></td>


                                                <td class="actions">
                                                    <a href="formedit.php?id=<?php echo $sims['sims_id'];?>">
                                                        <button class="btn btn-sm btn-primary">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            แก้ไข
                                                        </button>
                                                    </a>
                                                    <a href="?Act=del&pid=2&id=<?=$sims['sims_id']?>">
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            ลบ
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>


                                    </table>

                                    <?php 

                                    if ($page <> 1){ 

                                        $back = $page - 1;
                                        echo "<a href='$url?page=$back'>ย้อนกับ</a> ";
                                        
                                     } 


                                    // echo "($page/$nPage)";

                                     for ($i=1; $i <= $nPage; $i++) { 

                                         if ($i == $page) {

                                            echo "<b>$i | </b>";

                                         }else{

                                            echo "<a href='$url?page=$i'>$i</a> | ";

                                         }
                                     }

                                    if ($page <> $nPage) {
                                        $next =  $page+1;

                                        echo "<a href='$url?page=$next'>ถัดไป</a>";
                                    }

                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
