<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="control.css">
    
    <title>Control</title>
</head>
<body>
    <section class="title">
        <div>
            <ul>
                <li>إضافة منتج</li>
                <li onclick="showPrudocts()">عرض المنتجات</li>
                <li onclick="showCustomers()">حسابات المستخدمين</li>
                <li>طلبات الشراء</li>
            </ul>
        </div>
    </section>
    <section class="background-cont" style="display:none">
        <h2>العملية : <span class="name_feature"></span></h2>
        <section class="add_prud">
            <form action="control.php" method="post">
                <div class="parenImgSelect">
                <input type="file" name="image" id="image">
                </div>
            <div>
                <span>اسم المنتج :</span>
                <input type="text" placeholder="اسم المنتج" id="name_prud">
            </div>
            <div>
                <span>فئة المنتج :</span>
                <?php
                $sql="SELECT * from category";
                $qury=$con->prepare($sql);
                $qury->execute();
                $result = $qury->get_result();
                echo '<select id="menuCats">';
                while($row = $result->fetch_assoc())
                {
                ?>
                  <option value='<?php echo $row["id_cat"]?>'><?php echo $row["name_cat"]?></option>
                <?php
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
                <div>
                    <span>اسم الخاصية :</span><input type="text" class="prop">
                    <span>القيمة :</span><input type="text" class="valprop">
                    <input type="text" hidden class="hide" id="descPrud">
                    <p id="propertis">الخاصية التالية  ></p>
                </div>
            </div>
             <div>
                <span>سعر المنتج  :</span>
                <input type="text" placeholder="سعر المنتج" id="pric_prud">
             </div>
             <input type="button" value="إضافة المنتج" id="addPrud">
            </form>
        </section>
    </section>
    <section class="shows">
        <h1>المنتجات</h1>
        <section class="showsPrud">
            <table>
                <thead>
                    <tr>
                        <th>رقم المنتج</th>
                        <th>اسم المنتج</th>
                        <!-- <th>سعر المنتج</th>
                        <th>وصف المنتج</th> -->
                        <th>تاريخ الاضافة</th>
                        <th>الصنف</th>
                        <!-- <th>صورة المنتج</th> -->
                        <th>تحديث</th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="parentDesc"><!-- الصورة الذي بجانب المنتج ومعلومات عنة--->
                <div><img id="idImage" src="images/31GmCJTD0GL._AC_UF452,452_FMjpg_.jpg" alt=""></div>
                <p id="descprition">ejkkdjf nij id aa if </p>
                <p id="priceprud">2367$</p>
            </div>
        </section>
    </section>
      <!-- الزبائن -->
    <section class="shows">
        <h1>الزبائن</h1>
        <section class="customets">
            <table id="tableCustomers">
                <thead>
                    <tr>
                        <th>اسم الزبون</th>
                        <th>ايميل الزبون</th>
                        <th>كلمة السر </th>
                        <th>هاتف الزبون</th>

                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </section>
    </section>
    <section>
        
    </section>
    <script>
        function showCat(){
           document.getElementById("mew_cat").style.display = "block";
        }
</script>
</body>
<script src="jquery-2.1.0.min.js"></script>
<script src="control.js"></script>
<script>
        $(document).ready(function(){
            $("#addCat").click(function()//حدث إضافة فئة جديدة للمنتج
            {
                $("#mew_cat").css({display:"none"});
                $lastid = $("#menuCats option:last").val();
                    $lastid++;
                $.get("addCate.php",{cate:$("#name_new_cat").val(),id_cat:$lastid},function(data){
                    $lastoption = `<option value='${$lastid}'>${$("#name_new_cat").val()}</option>`;
                    $("#menuCats").append($lastoption);
                    $("#name_new_cat").val("");
                    alert(data);
                });
            });
            var img = "";
            $("#image").on("change", function(e)//حدث اضافة صورة جديدة عند الاضافة يتم حذف السابقة اذا وجدت
            {
                if(document.querySelector("#image").nextElementSibling != null)
                document.querySelector("#image").nextElementSibling.remove();
                var temp = e.target.files[0];//اخذ الصورة الجديدة المرفوعة
                var path = URL.createObjectURL(temp);
                 img = `<img src='${path}'>`;
                $("#image").parent().append(img);
            });
            $("#addPrud").click(function()//حدث إضافة المنتج الي قاعدة البيانات
            {
                var description = $("#descPrud").val() + $(".prop").val() + "," + $(".valprop").val();
                $("#descPrud").val(description);
                //-إضافة المعلومات الي فورم وارسالة عبر الاجكس الي صفحة استقبال المعلومات
                var fileData = document.querySelector("#image").files[0];
                var form = new FormData();//هنا إنشاء فورم
                form.append("file" , fileData);
                form.append("name" , $("#name_prud").val());
                form.append("cat" , $("#menuCats").val());
                form.append("desc" , $("#descPrud").val());
                form.append("price" , $("#pric_prud").val());
                $.ajax("addCate.php",{
                    type:"POST",
                    data:form,
                    processData:false,
                    contentType:false,
                    success:function(e){
                        console.log(e);
                    }
                });
                //دالة حذف المدخلات بعد إضافة المنتج
                document.querySelector("#image").nextElementSibling.remove();
                $("#descPrud").val("");
                $(".prop").val('');
                $(".valprop").val('');
                $("#name_prud").val('');
                $("#pric_prud").val('');
            });
            //-------

        });
        //دالة عرض المنتجات
     function showPrudocts()
     {
      var table = document.querySelector(".showsPrud>table>tbody");//تحديد جدول العرض
      table.innerHTML = "";
    <?php
        $sql="select * from prudocts";
        $rows =$con->query($sql);
        while($row = $rows->fetch_assoc())
        { 
            
    ?>
        var tr=document.createElement("tr");
        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["id_prud"] ?>';
        tr.appendChild(td);
        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["name_prud"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["date_prud"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["id_cat"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        var a=document.createElement("a");
        a.href="update.php?id=<?php echo $row['id_prud']?>&update=''";
        a.innerHTML="تحديث";
        td.appendChild(a);
        tr.appendChild(td);

        var td=document.createElement("td");
        var button=document.createElement("input");
        button.type = "button";
        button.name = <?php echo $row['id_prud']?>;
        button.value="X";
        button.onclick = function()//حدث الضغط على زر حذف المنتج
        {
            $.get("addCate.php" , {id:this.name , delete:""} ,function(e){
                alert(e);
            });
            this.parentNode.parentNode.remove();
        }
        td.appendChild(button);//إضافة الزر الي الخلية
        tr.appendChild(td);
        table.appendChild(tr);//إضافة الصف الي الجدول
        var img=document.getElementById("idImage");
        img.src="<?php  echo $row["sourc_img"] ?>";

        var desc=document.getElementById("descprition");
        var descPart='<?php echo $row["desc_prud"] ?>';
        descPart = descPart.split(",");
        //---------------------المعلومات الذي بالجنب حق المنتج
            desc.textContent = "";
            var span=document.createElement("span");
            span.textContent="اسم الخاصية";
            span.style.padding = "5px";
            span.style.margin = "5px";
            span.style.backgroundColor = "#EEE";
            desc.appendChild(span);
            var span=document.createElement("span");
            span.textContent="الوصف";
            span.style.padding = "5px";
            span.style.margin = "5px";
            span.style.backgroundColor = "#EEE";
            desc.appendChild(span);
        for(let i=0; i<descPart.length; i+=2)
        {
            var span=document.createElement("span");
            span.textContent=descPart[i];
            desc.appendChild(span);
            var span=document.createElement("span");
            span.textContent=descPart[i+1];
            desc.appendChild(span);
        }

        var price=document.getElementById("priceprud");
         var pricePart='<?php echo $row["price_prud"] ?>';
        price.textContent=`السعر : ${pricePart}$`;
        tr.addEventListener("click",function(e)
        {
            var valueid = this.firstElementChild.textContent; //إرجاع رقم المنتج لكي يتم اخذ المعلومات عنة ثم عرضها
             $.get("addCate.php" , {value:valueid},function(ss)
             {
                var infoselectprud = ss.split("#$");//هنا عمل مصفوفة للمعلومات
                 var img=document.getElementById("idImage");
                 img.src=infoselectprud[0];
                 var price=document.getElementById("priceprud");
                 price.textContent="السعر : " + infoselectprud[1] + "$";
                 //-------
                 var descPart = infoselectprud[2].split(",");
                  var desc=document.getElementById("descprition");
            desc.textContent = "";
            var span=document.createElement("span");
            span.textContent="اسم الخاصية";
            span.style.padding = "5px";
            span.style.margin = "5px";
            span.style.backgroundColor = "#EEE";
            desc.appendChild(span);
            var span=document.createElement("span");
            span.textContent="الوصف";
            span.style.padding = "5px";
            span.style.margin = "5px";
            span.style.backgroundColor = "#EEE";
            desc.appendChild(span);
        for(let i=0; i<descPart.length; i+=2)
        {
            var span=document.createElement("span");
            span.textContent=descPart[i];
            desc.appendChild(span);
            var span=document.createElement("span");
            span.textContent=descPart[i+1];
            desc.appendChild(span);
        }
             })
        });
    <?php
        }
    ?>
}
  //---------- دالة عرض الزبائن
function showCustomers(){
      var table = document.querySelector("#tableCustomers>tbody");//تحديد جدول الزبائن
      table.innerHTML = "";//تفريغة من المنتجات السابقة إذا وجد
    <?php
        $sql="select * from customars";
        $rows =$con->query($sql);
        while($row = $rows->fetch_assoc())
        { 
            
    ?>
        var tr=document.createElement("tr");
        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["name_cust"] ?>';
        tr.appendChild(td);
        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["email"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["password_cust"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        td.innerHTML= '<?php echo $row["phone_cust"] ?>';
        tr.appendChild(td);

        var td=document.createElement("td");
        var a=document.createElement("a");
        a.href="addCate.php?id_cust=<?php echo $row['id']?>";
        a.innerHTML="X";
        td.appendChild(a);
        tr.appendChild(td);
        table.appendChild(tr);
    <?php
        }
    ?>
}

</script>
</html>