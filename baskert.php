<?php include("connect.php");
 if(isset($_GET["buy_prud"]))
          {
        $sql = "UPDATE purchases set status_order = 'تم الدفع' where id_prud =".$_GET["id"] ." and id_cust = ". $_COOKIE["user"]["id"];
         if($con->query($sql) == TRUE)
         {
            echo"<script>alert('تم الشراء')<script>";
         }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>basket</title>
</head>
<body>
    <div>
        <h1>سلة المشتريات</h1>
        <i class="fa fa-shopping-bag"></i>
    </div>
    <div class="notfound">
        <p>لا يوجد منتجات مضافة</p>
    </div>
    <table class="container">
        <thead>
            <tr>
                <th>اسم المنتج</th>
                <th>سعر المنتج</th>
                <th>الكمية</th>
                <th>صورة المنتج</th>
                <th>الشراء</th>
            </tr>
        </thead>
        <tbody>
      <?php
         $sql = "SELECT purchases.* , prudocts.name_prud , price_prud , prudocts.sourc_img from purchases JOIN prudocts ON purchases.id_prud = prudocts.id_prud where purchases.id_cust = ".$_COOKIE['user']['id'];
         $rows = $con->query($sql);
         ?>
          <script>
            let num = <?php echo $rows->num_rows?>;
            if(num <= 0)
            {
                document.querySelector(".container").style.display = "none";
                document.querySelector(".notfound").style.display = "block";
                document.querySelector("input").style.display = "none";
            }
          </script>
         <?php
         while($row = $rows->fetch_assoc())
         {
            echo "<tr>";
            echo "<td>".$row['name_prud']."</td>";
            echo "<td>".$row['price_prud']."</td>";
            echo "<td>".$row['quantity_order']."</td>";
            echo "<td><img src='".$row['sourc_img']."'/></td>";
            if($row["status_order"] == "لم يتم الدفع بعد")
            {
                echo "<td>";
                echo "<a href = 'baskert.php?id='".$row["id_prud"]."''> شراء";
                echo"</a>";
                echo"</td>";
            }
            else
            { 
                echo "<td>تم الشراء</td>";
            }
            echo "</tr>";
         }
        ?>
        </tbody>
    </table>
    <input type="button" value="شراء الكل">
</body>
<script>
</script>
<style>
    *{
        padding:0;
        margin:0;
        box-sizing: border-box;
        direction:rtl;
    }
    :root {
    --backmaincolor: #EEEEEE;
    --one: #EFB7B7;
    --tow: #BD4B4B;
    --three: #000000;
    direction: rtl;
}
body{
    background-color: var(--backmaincolor);
}
body>div>h1{
    margin-right:15px;
    color:var(--backmaincolor);
}
body>div:first-child{
    display: flex;
    justify-content: space-between;
    width:90%;
    margin:0 auto;
    background-color: var(--tow);
    align-items: center;
    align-content: center;
    margin-bottom: 45px;
}
.container{
    width:100%;
    border-collapse: collapse;
}
table thead tr th{
    background-color: var(--tow);
    padding:10px;
    color:var(--backmaincolor);
}
table tbody tr td{
 padding:10px;
 text-align:center;
}
.fa-shopping-bag{
    font-size: 50px;
    margin:10px;
    color:var(--one);
}
input[type="button"]{
    padding:10px;
    margin:10px 30px 10px 10px;
    background-color: var(--one);
    outline:none;
    border: none;
    border-radius: 5px;
}
.notfound{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    display: none;
}
.notfound>p{
    background-color: var(--one);
    border-radius: 5px;
    padding:10px;
    margin:10px;
}
img{
    width:100px;
    height:100px;
}
.prud-in-box{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 10px;
    margin: 10px;
    border-bottom: 1px solid;
}
</style>
</html>