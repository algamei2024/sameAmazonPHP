<?php 
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>card</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>عربة التسوق</h1>
            
        </div>
        <div class="sall-samePrudect">
            <div class="sall">
                <h3>المجموع</h3>
                <small>500 ريال</small>
                <input type="button" value="تابع لإتمام عملية الشراء">
            </div>
        </div>
    </div>
</body>
<style>
    *{
        padding:0;
        margin:0;
        box-sizing: border-box;
    }
    body{
        direction: rtl;
        background-color: #EEE;
        font-family:"Tajawal";
    }
    .container{
        display: flex;
        flex:70% 30%;
        flex-wrap: wrap;
    }
    .box ,.prudect , .sall-samePrudect .sall{
        background-color: white;
        padding:10px;
        margin:10px;
    }
    .box{
        flex-basis: 70%;
    }
    .box >*{
        position: relative;
    }
    .box >*::after{
        position: absolute;
        content:"";
        bottom:0;
        right:0;
        height: 1px;
        width:100%;
        background-color: black;
        opacity: .2;
    }
    .prudect{
        display: flex;
        align-items: center;
    }
    .prudect img{
        width:150px;
        height:150px;
    }
    .information{
        margin:20px;
        display: flex;
        flex-direction: column;
    }
    .information > p:first-child{
        display: flex;
        flex-direction: column;
    }
    input{
        border:none;
        outline: none;
        border-radius: 10px;
        padding:10px;
        margin:10px;
        background-color: white;
        box-shadow: 0px 0px 2px;
        cursor: pointer;
    }
    .sall-samePrudect{
        display: block;
        min-width: 25%;
    }
    .sall-samePrudect .sall *{
       padding:5px;
       margin:5px;
    }
    .sall input{
        all:initial;
        cursor: pointer;
        display:inline-block;
        width:90%;
        background-color: gold;
        border-radius: 5px;
        text-align: center;
    }
</style>
<script src="jquery-3.5.1.js"></script>
<?php
    $sql = "SELECT purchases.* , prudocts.name_prud , prudocts.price_prud , prudocts.sourc_img from purchases JOIN prudocts ON purchases.id_prud = prudocts.id_prud where purchases.id_cust = ".$_COOKIE['user']['id'];
    $rows = $con->query($sql);
    $total = 0;
    while($row = $rows->fetch_assoc())
    {
        $delt = null;
        $status = "تم شراءة";
        if($row["status_order"] == "لم يتم الدفع بعد")
            {
                $status = "شراء";
                $total += $row['price_prud'] * $row["quantity_order"];
                 $delt = "<input type='button' name='".$row['id_prud']."' value='حذف'>";
            }
?>
<script>
    document.querySelector(".box").innerHTML +=
    `<div class="prudect">
                <div><img src="<?php echo $row['sourc_img']?>" alt="imge"></div>
                <div class="information">
                    <h1><?php echo $row['name_prud']?></h1>
                    <small><?php echo $row['price_prud']?> ريال</small>
                    <p>موهل للحصول على توصيل</p>
                    <div>
                        <input type="number" list="mylist" name="<?php echo $row['quantity_order']?>" placeholder="الكمية" name="<?php echo $row['quantity_order']?>" value="<?php echo $row['quantity_order']?>">
                        <datalist id="mylist">
                            <option value="1">
                            <option value="2">
                            <option value="5">
                            <option value="10">
                            <option value="15">
                        </datalist>
                        <?php echo $delt?>
                        <input type="button" value="<?php echo $status?>">
                    </div>
                </div>
            </div>`;
</script>
<?php
    }
?>
<script>
    document.querySelector(".sall>small").textContent = <?php echo $total?> + " ريال";
    let inputDel = [];
    document.querySelectorAll(".information>div input").forEach(function(element){
        if(element.value == "حذف")
        {
            inputDel.push(element)
        }

    });
    inputDel.forEach(function(e){
        let object = {
            id_cust:<?php echo $_COOKIE['user']['id']?>,
            id_prud:e.name,
        }
        object = JSON.stringify(object);
        e.onclick = function()
        {
            $.ajax({
                type:"GET",
                url:"addCate.php",
                data:{box_del_prud_id:object},
                success:function(e)
                {
                    alert(e);
                }
            });
            this.parentNode.parentNode.parentNode.remove();
            let ha = this.parentNode.parentNode.firstElementChild.nextElementSibling.innerHTML;
            let total = document.querySelector(".sall>small").textContent;
            total = total.split(" ");
            total = total[0];
            ha = ha.split(" ");
            ha = ha[0];
            document.querySelector(".sall>small").textContent = total - (ha * this.parentNode.firstElementChild.name);
        }
    });
</script>
</html>