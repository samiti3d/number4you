
                <!-- left, vertical navbar -->
                <div class="col-md-2 bootstrap-admin-col-left" id="menu">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <li <?=echoActiveClassIfRequestMatches("about")?>><a href="about.php"><i class="glyphicon glyphicon-chevron-right"></i>เกี่ยวกับระบบ</a></li>
                        <li <?=echoActiveClassIfRequestMatches("simmanagement")?>><a href="simmanagement.php"><i class="glyphicon glyphicon-chevron-right"></i> จัดการระบบซิม</a></li>
                        <li <?=echoActiveClassIfRequestMatches("simcat")?>><a href="simcat.php"><i class="glyphicon glyphicon-chevron-right"></i>หมวดหมู่เบอร์โทร</a></li>
                        <li <?=echoActiveClassIfRequestMatches("article")?>><a href="article.php"><i class="glyphicon glyphicon-chevron-right"></i>เขียนโพส</a></li>
                        <li <?=echoActiveClassIfRequestMatches("list-post")?>><a href="list-post.php"><i class="glyphicon glyphicon-chevron-right"></i>จัดการรายชื่อโพส</a></li>
                        <li <?=echoActiveClassIfRequestMatches("numberpredict")?>><a href="numberpredict.php"><i class="glyphicon glyphicon-chevron-right"></i>จัดคำทำนาย</a></li>
                        <!-- <li <?=echoActiveClassIfRequestMatches("customer")?>><a href="customer.php"><i class="glyphicon glyphicon-chevron-right"></i>รายชื่อลูกค้า</a></li> -->
                        <li <?=echoActiveClassIfRequestMatches("order")?>><a href="order.php"><i class="glyphicon glyphicon-chevron-right"></i>รายการสั่งซื้อ</a></li>
                   </ul>
                </div><br/>

