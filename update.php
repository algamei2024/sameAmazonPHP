<?php include("connect.php");
$id_prud = "";
if(isset($_GET["update"]))
{
    $id_prud = $_GET["id"];
    $sql = "SELECT * from prudocts where id_prud = $id_prud";
    $rows = $con->query($sql);
    $row = $rows->fetch_assoc();
    $name=$row["name_prud"];
    $desc =$row["desc_prud"];
    $desc = explode("," , $desc);
    $img=$row["sourc_img"];
    $price=$row["price_prud"];
    $cat=$row["id_cat"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="control.css">
    <title>update</title>
</head>
<body>
    <section class="background-cont">
        <h2>العملية : <span class="name_feature"></span></h2>
        <section class="add_prud">
            <form action="control.php" method="post">
                <div class="parenImgSelect">
                    <input type="file" name="image" id="image">
                    <img src="<?php echo $img?>" alt="img">
                </div>
            <div>
                <span>اسم المنتج :</span>
                <input type="text" placeholder="اسم المنتج" id="name_prud" value="<?php echo $name ?>">
            </div>
            <div>
                <span>فئة المنتج :</span>
                <?php
                $sql="SELECT * from category";
                $qury=$con->prepare($sql);
                $qury->execute();
                $result = $qury->get_result();
                echo '<select id="menuCats" >';
                while($row = $result->fetch_assoc())
                {
                    if($row["id_cat"] == $cat){
                ?>
                  <option selected value='<?php echo $row["id_cat"]?>'><?php echo $row["name_cat"]?></option>
                <?php
                    }
                    else 
                    {
                    ?>
                    <option value='<?php echo $row["id_cat"]?>'><?php echo $row["name_cat"]?></option>
                    <?php
                    }
                }
                echo "</select>";
                ?>
                <p  onclick="showCat()">فئة جديدة</p>
                <div id="mew_cat" style="display:none">
                    <span>الفئة الجديد:</span><input type="text" id="name_new_cat" class="name_new_cat"/>
                    <input type="button" value="إضافة" name="btn_add_cat" id="addCat"/>
                </div>
            </div>
            <div>
                <span>وصف المنتج :</span>
                <div id="desc_prud">
                    <?php
                     for($i=0; $i<count($desc); $i+=2)
                     {
                    ?>
                        <div>
                             <input type="text" value="<?php echo $desc[$i];?>" class="desc">
                             <input type="text" value="<?php echo $desc[$i+1]?>" class="desc">
                        </div>
                    <?php
                     }
                    ?>
                </div>
            </div>
             <div>
                <span>سعر المنتج  :</span>
                <input type="text" placeholder="سعر المنتج" value="<?php echo $price?>" id="pric_prud">
             </div>
             <input type="button" value="تعديل المنتج" id="addPrud">
            </form>
        </section>
    </section>
</body>
<script src="jquery-2.1.0.min.js"></script>
<script>
 var img = "";
$("#image").on("change", function(e)//حدث اضافة ملف
{
    if(document.querySelector("#image").nextElementSibling != null)
    document.querySelector("#image").nextElementSibling.remove();
    var temp = e.target.files[0];
    var path = URL.createObjectURL(temp);
        img = `<img src='${path}'>`;
    $("#image").parent().append(img);
});
function showCat()
{
   document.getElementById("mew_cat").style.display = "block";
}
$("#addCat").click(function()//عند الضغظ على زر إضافة فئة جديدة
            {
                $("#mew_cat").css({display:"none"});
                $lastid = $("#menuCats option:last").val();
                    $lastid++;//علشان يزود رقم الفئة
                $.get("addCate.php",{cate:$("#name_new_cat").val(),id_cat:$lastid},function(data){
                    $lastoption = `<option value='${$lastid}'>${$("#name_new_cat").val()}</option>`;
                    $("#menuCats").append($lastoption);
                    $("#name_new_cat").val("");
                    alert(data);
                });
            });
$("#addPrud").click(function()// عند الضغظ على تحديث
{
                let descr = document.querySelectorAll(".desc");
                let description = "";
                for(let i=0; i<Object.keys(descr).length; i+=2)
                {
                    description += descr[i].value + "," + descr[i+1].value + ",";
                }
                //-
                var fileData = document.querySelector("#image").files[0];
                var form = new FormData();
                var sourcimg = "<?php echo $img?>"
                description = description.slice(0 , -1);
                form.append("fileupdate" , fileData);
                form.append("name_cate" , $("#name_prud").val());
                form.append("cat" , $("#menuCats").val());
                form.append("desc" , description);
                form.append("price" , $("#pric_prud").val());
                form.append("oldimg" , sourcimg);
                form.append("id" , <?php echo $id_prud?>)
                $.ajax("addCate.php",{
                    type:"POST",
                    data:form,
                    processData:false,
                    contentType:false,
                    success:function(e){
                        console.log(e);
                        window.location.href="control.php";//الارسال يكون عبر الاجكس وتغيير الصفحة
                    }
                });
            });
</script>
</html>

