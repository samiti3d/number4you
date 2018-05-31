

                <!-- content -->
                <div class="col-md-12">

                    <div class="row">

                    <?php if ($_GET['pid'] == 3 && $_GET['Act'] == "editcat"){ 

                        $sql = "select * from nfy_cats where id = $cid";
                        $r = mysql_query($sql);
                        while($editCatData = mysql_fetch_array($r)){

                    ?>

                    <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Master Sim 1.0</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="addSimCat.php" method="post">
                                        <fieldset>
                                            <legend>แก้ไขหมวดหมู่เบอร์โทรศัพท์</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >หมวดหมู่</label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="ber_cats_add" id="ber_cats_add" class="form-control col-md-6" value="<?php echo $editCatData['catname']; ?>" maxlength="10" size="5">
                                                    <p class="help-block">เช่น เบอร์โทร VIP / 789 เป็นต้น</p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick="return CheckValue()">ตกลง</button>
                                            <a href="?Act=cancel" class="btn btn-default"><span>ยกเลิก</span></a>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>     
                        
                    <?php  } } else{ ?>

                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Master Sim 1.0</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal" action="addSimCat.php" method="post">
                                        <fieldset>
                                            <legend>เพิ่มหมวดหมู่เบอร์โทรศัพท์</legend>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >หมวดหมู่</label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="ber_cats_add" id="ber_cats_add" class="form-control col-md-6" maxlength="10" size="5">
                                                    <p class="help-block">เช่น เบอร์โทร VIP / 789 เป็นต้น</p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" onclick="return CheckValue()">ตกลง</button>
                                            <button type="reset" class="btn btn-default">ยกเลิก</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

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
                                                <th>ไอดี</th>
                                                <th>ชื่อหมวดหมู่</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php

                                        $sql = "select * from nfy_cats";
                                        $r = mysql_query($sql);
                                        while ($cats = mysql_fetch_array($r)) {


                                ?>
                                            <tr>
                                                <td><?php echo $cats['id']; ?></td>
                                                <td><?php echo $cats['catname']; ?></td>

                                                <td class="actions">
                                                    <a href="?Act=editcat&pid=3&cid=<?php echo $cats['id']; ?>">
                                                        <button class="btn btn-sm btn-primary">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            แก้ไข
                                                        </button>
                                                    </a>
                                                    </a>
                                                    <a href="?Act=del&pid=3&cid=<?php echo $cats['id']; ?>">
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
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                