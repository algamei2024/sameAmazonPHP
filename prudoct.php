<?php
require("connect.php");
$id_cat = 0;
if(isset($_GET["id"]))
{
    $id = $_GET['id'];
    $sql = "SELECT * from prudocts where id_prud = $id";
    $rows = $con->query($sql);
    $row = $rows->fetch_assoc();
    $id_cat = $row['id_cat'];
    $desc = explode("," , $row["desc_prud"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="prudoct.css">
</head>
<body>
    <div class="container">
        <section class="prud">
            <div class="prod-img">
                <div class="column-img">
                    <div><img src="images/31IdhWn+GzL._AC_UF452,452_FMjpg_.jpg" alt=""></div>
                </div>
                <img src="<?php echo $row['sourc_img']?>" alt="">
            </div>
            <div>
                <div class="prud-desc">
                    <span>اسم المنتج:</span>
                    <span><?php echo $row['name_prud']?></span>
                    <?php
                     for($i=0; $i<count($desc); $i+=2)
                     {
                        echo "<span>$desc[$i]</span>";
                        $ii = $i + 1;
                        echo "<span>$desc[$ii]</span>";
                     }
                     echo "<span>السعر</span>";
                     echo "<span>".$row['price_prud']."$"."</span>";
                    ?>
                </div>  
            </div>
            <div class="box-shopping">
                <div>
                    <div>
                        <input checked type="checkbox" name="add-box-shopping" id="check-delivery">
                        <span>نعم اريد توصيل</span>
                    </div>
                    <div style="text-align:center;">
                        <p>استمتع بتوصيل مجاني وسريع مع </p>
                        <p>امازون برايم</p>
                        <img src="images/amazonprime_hybridMidnightBlue_SA._CB658272880_.png" alt="" style="width:50%;margin-top:15px;">
                    </div>
                </div>
                <div>
                    <div><span>239 ريال</span></div>
                    <p>ارجاع مجاني</p>
                    <p><span>توصيل مجاني</span>غداً 21 سبتمبر قم بالطلب خلال 7 ساعات</p>
                    <h2>متوفر</h2>
                    <div>
                        <span>الكمية:</span>
                         <input type="number" list="mylist" name="quantity" id="quantity" value="1" min="1">
                    </div>
                    <div>
                        <button id="addToBox">اضف الي العربة</button>
                    </div>
                    <div><button id="payment">اشتري الان</button></div>
                    <div class="infopy">
                        <span>الدفع</span>
                        <span>معاملتك امنه</span>
                        <span>يشحن من</span>
                        <span>Amazon.sa</span>
                        <span>يباع من</span>
                        <span>Amazon.sa</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="sec-prud">
            <h2>منتجات ذات صلة</h2>
            <div class="same-prud">
                <div class="card">
                    <!-- <div><img src="images/31tyUh1todL._AC_UF452,452_FMjpg_.jpg" alt=""></div> -->
                    <div class="about-card">
                        <span>شاشات</span>
                        <p>مع شحن</p>
                        <span>25.00 ريال</span>
                    </div>
                </div>
                <div class="card">
                    <div><img src="images/71vI1L26RcL._AC_UF452,452_FMjpg_.jpg" alt=""></div>
                    <div class="about-card">
                        <span>شاشات</span>
                        <p>مع شحن</p>
                        <span>25.00 ريال</span>
                    </div>
                </div>
                <div class="card">
                    <div><img src="images/41BdSAAN5jL._AC_UF226,226_FMjpg_.jpg" alt=""></div>
                    <div class="about-card">
                        <span>شاشات</span>
                        <p>مع شحن</p>
                        <span>25.00 ريال</span>
                    </div>
                </div>
                <div class="card">
                    <div><img src="images/41MzPAypT-L._AC_UF452,452_FMjpg_.jpg" alt=""></div>
                    <div class="about-card">
                        <span>شاشات</span>
                        <p>مع شحن</p>
                        <span>25.00 ريال</span>
                    </div>
                </div>
            </div>
        </section>
        <section>
        </section>
    </div>
</body>
<script src="jquery-3.5.1.js"></script>
<script>
    $(document).ready(function(){
        //--دالة التحقق من وجود المنتج في السلة مسبقا
        function checkorder()
        {
            <?php
             $sql = "SELECT * from purchases where id_prud = $id and id_cust =" .$_COOKIE["user"]["id"];
              $rows = $con->query($sql);
              if($rows->num_rows > 0)
              {
                ?>
                return true;
                <?php
              }
                ?>
                return false;
        }
        let object = {

        }
        $("#addToBox").on("click" , function(){
            if(checkorder())
               {
                alert("المنتج تمت اضافتة مسبقا");
                return;
               }
            object.check = ($("#check-delivery").prop("checked"))? 1:0;
            object.quantity = $("#quantity").val();
            object.id_cust = <?php echo $_COOKIE["user"]["id"] ?>;
            object.id_prud = <?php echo $id?>;
            object.order_status = "لم يتم الدفع بعد";
            sendinfo();
        });
        $("#payment").on("click" , function(){

             if(checkorder())
               {
                object.quantity = $("#quantity").val();
                object.id_prud = <?php echo $id?>;
                object.id_cust = <?php echo $_COOKIE["user"]["id"]?>;
                 sendinfo();
                return;
               }
            object.check = ($("#check-delivery").prop("checked"))? 1:0;
            object.quantity = $("#quantity").val();
            object.id_cust = <?php echo $_COOKIE["user"]["id"]?>;
            object.id_prud = <?php echo $id?>;
            object.order_status = " تم الدفع ";
            sendinfo();
        });
 function sendinfo()
 {
    let objectjson = JSON.stringify(object);
     $.ajax({
        type:"GET",
        url:"addCate.php",
        data:{object:objectjson},
        success:function(e)
        {
            alert(e);
        }
    });
    
 }
    });
</script>

<!--------------->
<?php
 if(isset($_GET['id']))
                     {
                    ?>
                    <script>
                        document.querySelector('.same-prud').innerHTML = '';
                    </script>
                    <?php
                        $sql = "SELECT * from prudocts where id_cat = $id_cat";
                        $rows = $con->query($sql);
                        echo $rows->num_rows;
                        while($row = $rows->fetch_assoc())
                        {
                    ?>
                    <script>
                        var currentContent = document.querySelector('.same-prud').innerHTML;
                        var newContent = currentContent +  
                        `<div class="card">
                        <a href="prudoct.php?id='<?php echo $row["id_prud"]?>'">
                    <div><img src="<?php echo $row['sourc_img']?>" alt=""></div>
                    <div class="about-card">
                        <span><?php echo $row['name_prud']?></span>
                        <p>مع شحن</p>
                        <span><?php echo $row['price_prud']?>$</span>
                    </div>
                    </a>
                </div>`;
                        document.querySelector(".same-prud").innerHTML = newContent;
                    </script>
                    <?php
                     }
                     }
                    ?>
</html>
</html>