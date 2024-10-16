<?php require("connect.php")?>
<script>
    //عمل كائن ليحتوي على معلومات الفئات
    let object = {
        id_cat:[],
        name_cat:[],
        imgs:[]
    }
</script>
<?php
$sql = "SELECT * from category";
$rows = $con->query($sql);
$lastCate = 0;
$firstCate = 0;
while($row = $rows->fetch_assoc())
{
    $firstCate = 1;
    $lastCate = $row['id_cat'];
?>
<script>
    //اضافة الفئات
    object.id_cat.push(<?php echo $row['id_cat']?>);
    object.name_cat.push("<?php echo $row['name_cat']?>");
</script>
<?php
}
//هنا ارجاع صورة الفئة من جدول المنتجات
$sql = "SELECT sourc_img from prudocts group by id_cat";
$rows = $con->query($sql);
while($row = $rows->fetch_assoc())
{
?>
<script>
     object.imgs.push("<?php echo $row['sourc_img']?>");
</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="project.css" />
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>js and php</title>
</head>

<body>
    <section class="title" id="title">
        <div>
            <h3>امازون</h3>
        </div>
        <div>
            <ul>
                <li><a href="#" target="_blank">الاكثر مبيعاً</a></li>
                <li><a href="#" target="_blank">عروض اليوم</a></li>
                <li><a href="#" target="_blank">الجوالات</a></li>
                <li><a href="#" target="_blank">الالكترونيات</a></li>
                <li><a href="#" target="_blank">الالعاب</a></li>
            </ul>
        </div>
        <div class="sign" id="sign">
            <span>تسجيل الدخول</span>
 <?php
 if(isset($_COOKIE["user"]))//هنا يفحص الكوكيز عشان يعرف انو في احد مسجل بالموقع
{
    ?>
    <script>
    document.getElementById('sign').firstElementChild.textContent =  '<?php echo $_COOKIE["user"]["name"][0]?>';
    document.getElementById('sign').style.borderRadius = "5px";
     document.getElementById('sign').style.pointerEvents = "none";
    document.getElementById('sign').classList.add("prof");
    </script>
    <?php
}
?>
        </div>
        <a href="card.php" class="nav-link icon"><i class="fa fa-shopping-bag"></i></a>
    </section>
    <section class="almost">
        <div class="shows">
            <div class="shows1">
                <span class="befor"><svg width="20" height="40" fill="none">
                        <path d="M0,0 0,40 20,20Z" fill="#BD4B4B" />
                    </svg></span>
                <h1>الفئات</h1>
                <div class="containerNewsShow">
                    <div class="newShows">
                        <div class="mon">
                            <div><img src="images/eimi1.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi2.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi3.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi4.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi5.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi6.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi7.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                        <div class="mon">
                            <div><img src="images/eimi3.jpg" alt=""></div>
                            <div>
                                <span>
                                    سماعات
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="after"><svg width="20" height="40" fill="none">
                        <path d="M0,20 20,0 20,40Z" fill="#BD4B4B" />
                    </svg></span>
            </div>
            <div class="shows2">
                <div>
                    <img src="images/logoP1.jpg" alt="">
                </div>
            </div>
            <div class="shows3">
                <h2>عروض لفترة محدودة</h2>
                <div class="shows3-container">
                    <div class="shows3-1">
                        <div class="img"><img src="images/labtop3-1.jpg" alt=""></div>
                        <div>
                            <div>
                                <span>5,545.45 ريال</span>
                                <span>صفقة</span>
                            </div>
                            <p>وفر على لينوفو</p>
                        </div>
                    </div>
                    <div class="shows3-2">
                        <div class="img"><img src="images/LG,-65-Inch,-LED-TV,-4K-HDR,-Smart-TV.jpeg" alt=""></div>
                        <div>
                            <div>
                                <span>5,545.45 ريال</span>
                                <span>صفقة</span>
                            </div>
                            <p>وفر على لينوفو</p>
                        </div>
                    </div>
                    <div class="shows3-2">
                        <div class="img"><img src="images/Apple-iPhone-11,-4G,-128GB,-White,-New-Edition.jpeg" alt=""></div>
                        <div>
                            <div>
                                <span>5,545.45 ريال</span>
                                <span>صفقة</span>
                            </div>
                            <p>وفر على لينوفو</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shows4">
                <section>
                    <div class="prodect3">
                        <?php
                        $sql = "SELECT * from prudocts order by rand() limit 3";
                        $rows = $con->query($sql);
                        while($row = $rows->fetch_assoc())
                            {

                        ?>
                     <a href='prudoct.php?id="<?php echo $row["id_prud"]?>"' style='color:black;'>
                        <div class="pr2">
                            <div class="im2">
                                <img src="<?php echo $row['sourc_img']?>">
                            </div>
                            <div class="prmo">
                                    <p><?php echo $row['name_prud']?></p>
                                    <h1><?php echo $row['price_prud']?>$ ريال</h1>
                            </div>
                        </div>
                     </a>
                        <?php
                            }
                        ?>
                    </div>
                </section>
            </div>
            <div class="shows5">
                <h1>وصلت حديثاً</h1>
                <div class="shows5-container">
                    <?php
                    //هنا يتم ارجاع المنتجات الحديثة
                 $today = date("Y-m-d");
                 $threedate = date("Y-m-d" , strtotime("-3 days" , strtotime($today)));
                  $sql = "SELECT * from prudocts where date_prud between '$threedate' and '$today' order by rand() limit 3";
                  $rows = $con->query($sql);
                  if($rows->num_rows > 0)
                  {
                    while($row = $rows->fetch_assoc())
                    {
                  ?>
                   <script>
                     document.querySelector(".shows5-container").innerHTML += `
                     <a href="prudoct.php?id=<?php echo $row['id_prud']?>" style="color:black">
                        <div class="shows5-img">
                            <div><img src="<?php echo $row['sourc_img']?>" alt=""></div>
                            <div>
                                <p><?php echo $row['name_prud']?></p>
                                <span> <?php echo $row['price_prud']?>$</span>
                            </div>
                        </div>
                   </a>`;
                   </script>
                   <?php
                    }
                  }
                  else
                  {
                    echo "<h1>لا يوجد منتجات حديثة</h1>";
                  }
                   ?>
                </div>
            </div>
            <div class="shows6">
                <div><img src="images/sid1.jpg" alt=""></div>
                <div><img src="images/sid2.gif" alt=""></div>
                <div><img src="images/sid3.jpg" alt=""></div>
            </div>
            <div class="shows7">
                <h1>الكترونيات</h1>
                <div class="shows7-container">
                    <?php
                    if($lastCate != 0)
                    {
                        $sql = "SELECT * from prudocts where id_cat = $lastCate order by rand() limit 4";
                        $rows = $con->query($sql);
                        while($row = $rows->fetch_assoc())
                            {

                        ?>
                  <a href='prudoct.php?id="<?php echo $row["id_prud"]?>"' style='color:black'>
                    <div class="shows7-img">
                        <div><img src="<?php echo $row['sourc_img']?>" alt=""></div>
                        <div>
                            <h4><?php echo $row['name_prud']?></h4>
                            <span><?php echo $row['price_prud']?>$ ريال</span>
                        </div>
                    </div>
                  </a>
                  <?php
                    }
                }
                  ?>
                </div>
            </div>
            <div class="btsh7-8">
                <p>الكترونيات مطلوبة</p>
            </div>
            <div class="shows8">
                <?php
                if($firstCate != 0)
                    {
                        $sql = "SELECT * from prudocts where id_cat = $firstCate order by rand() limit 4";
                        $rows = $con->query($sql);
                        while($row = $rows->fetch_assoc())
                            {

                 ?>
            <a href='prudoct.php?id="<?php echo $row["id_prud"]?>"' style='color:black'>
                <div class="shows8-img">
                    <div class="menu-img">
                        <img src="<?php echo $row['sourc_img']?>" alt="">
                    </div>
                    <div class="menu-text">
                        <div class="price">
                            <div><p>
                                <?php echo $row['name_prud']?>
                            </p></div>
                           <div><span><?php echo $row['price_prud']?>$</span></div>
                        </div>
                    </div>
                </div>
             </a>
                <?php
                     }
                   }
                ?>
            </div>
        </div>
        <div class="desc">
            <div>
                <ul>
                    <li>جوالات وشاشات</li>
                    <li>كمبيوترات وشواحن</li>
                    <li>مودمات وشبكات</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="toTop">
        <h4><a href="#title">الرجوع للاعلى</a></h4>
    </section>
    <section class="footer">
        <div>
            <h2>اعرف المزيد عنا</h2>
            <ul>
                <li><a href="">معلومات عن امازون</a></li>
                <li><a href="">وظائف</a></li>
                <li><a href="">امازون ساينس</a></li>
            </ul>
        </div>
        <div>
            <h2>تسوق معنا</h2>
            <ul>
                <li><a href="">حسابك</a></li>
                <li><a href="">مشتريات</a></li>
                <li><a href="">عناوينك</a></li>
                <li><a href="">قوائمك</a></li>
            </ul>
        </div>
        <div>
            <h2>دعنا نساعدك</h2>
            <ul>
                <li><a href="">سياسات واسعار الشحن</a></li>
                <li><a href="">طلبات الارجاع والاستبدال</a></li>
                <li><a href="">تحميل تطبيق امازون</a></li>
            </ul>
        </div>
    </section>
</body>
<script src="jquery-3.5.1.js"></script>
<script src="project.js"></script>
<!--هنا يتم عرض المنتجات حسب الفئة المختارة-->
                    <script>
                        document.querySelector('.shows3-container').innerHTML = '';
                    </script>
                    <?php
                        $id = 1;
                        if(isset($_GET['id']))
                        {
                        $id = $_GET['id'];
                        }
                        $sql = "SELECT * from prudocts where id_cat = $id";
                        $rows = $con->query($sql);
                        echo $rows->num_rows;
                        while($row = $rows->fetch_assoc())
                        {
                    ?>
                    <script>
                        var currentContent = document.querySelector('.shows3-container').innerHTML;
                        var newContent = currentContent +  
                        `<div class="shows3-1">
                            <a href='prudoct.php?id="<?php echo $row["id_prud"]?>"'>
                                <div class="img"><img src="<?php echo $row['sourc_img']?>" alt=""></div>
                                <div>
                                    <div>
                                        <span><?php echo $row["price_prud"]?> $</span>
                                    </div>
                                    <p>وفر مع لينوفو</p>
                                </div>
                            </a>
                         </div>`;
                        document.querySelector(".shows3-container").innerHTML = newContent;
                    </script>
                    <?php
                     }
                    ?>
</html>