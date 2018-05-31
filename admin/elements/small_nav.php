    <?php 
                
        $Act = $_GET['Act'];
        switch ($Act) {
            case 'logoutnav':
                session_destroy();
                echo "<script language=\"javascript\">";
                echo "alert('คุณลงชื่ออกจากระบบเรียบร้อยแล้ว');";
                echo "window.location='index.php';";
                echo "</script>";
                exit();

                break;

            case 'view':
                // Redirect to the home page
                $string = dirname($_SERVER['PHP_SELF']) . '<br/>';
                $dirarray = explode('/', $string);
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $dirarray[1];
                echo "<script language=\"javascript\">";
                echo "alert('ดูหน้าแรก');";
                echo "window.location='$home_url';";
                echo "</script>";

                break;
            
            default:
                
                break;
        }

    ?>
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size">
                                <li class="text">เปลี่ยนขนาดจอ:</li>
                                <li><a class="size-changer small">เล็ก</a></li>
                                <li><a class="size-changer large active">ใหญ่</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="?Act=view">ดูเว็บไซต์ <i class="glyphicon glyphicon-share-alt"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['Admin']; ?> <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="divider"></li>
                                        <li><a href="?Act=logoutnav">ลงชื่อออก</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>