
<?php
    require("connect.php");
    if(isset($_POST['enter'])){
        $email=test($_POST['email']);
        $password=test($_POST['password']);
        if(preg_match($pattern, $email)){
            $sql="SELECT * from customars where email='$email' AND password_cust = '$password'";
            $rows=$con->query($sql);
            if($rows->num_rows==1)
            {
                $row = $rows->fetch_assoc();
                 setcookie("user[name]" , $row["name_cust"] , strtotime("+1 year"));
                 setcookie("user[id]" , $row["id"] , strtotime("+1 year"));
                     echo "<script>window.location.href='project.php'</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <div class="container">
        <div class="pageLogin">
            <div>
                <h1>لوحة تسجيل الدخول</h3>
            </div>
            <div class="containerHom">
                <div class="creatLogin">
                    <div class="creatAccount" id="creatAccount" onclick="crFun()">
                        <h3>إنشاء حساب</h3>
                    </div>
                    <div class="login" id="login" onclick="loFun()">
                        <h3>تسجيل الدخول</h3>
                    </div>
                </div>
                <div class="containerCreatLogin">
                    <form id="formOne" action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post" autocomplete="on" class="creat" style="display:none">
                        <div>
                            <label for="email">البريد الالكتروني</label>
                            <div>
                                <input id="email" type="email" required placeholder="البريد الالكتروني" name="email">
                            </div>
                        </div>
                        <div>
                            <label for="pa">كلمة السر</label>
                            <div>
                                <input type="password" required placeholder="كلمة السر" name="password">
                            </div>
                        </div>
                        <div>
                            <a href="#">نسيت كلمة السر</a>
                        </div>
                        <div>
                            <input name="enter" type="submit" value="دخول">
                        </div>
                    </form>
                    <form id="formTow" action="<?php echo $_SERVER['PHP_SELF'];?>" method="Post" autocomplete="on" class="creat" style="display:block;">
                        <div>
                            <label for="username">الاسم</label>
                            <div>
                                <input id="username" type="text" required placeholder="اسم المستخدم" name="name">
                            </div>
                        </div>
                        <div>
                            <label for="phone">رقم الهاتف</label>
                            <div>
                                <input id="phone" type="text" required placeholder="رقم الهاتف" name="phone">
                            </div>
                        </div>
                        <div>
                            <label for="newemail">البريد الالكتروني</label>
                            <div>
                                <input id="newemail" type="email" required placeholder="البريد الالكتروني" name="newemail">
                            </div>
                        </div>
                        <div>
                            <label>كلمة المرور</label>
                            <div>
                                <input type="password" placeholder="كلمة المرور" id="pasOne" name="newpassword">
                            </div>
                        </div>
                        <div>
                            <label>تاكيد كلمة المرور</label>
                            <div>
                                <input type="password" placeholder="تاكيد كلمة المرور" id="pasTow">
                            </div>
                        </div>
                        <div>
                            <input type="submit" id="sub" value="تسجيل" name="sign">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="background-color:red; color:white; position:absolute; top:10%; right:60%; display: none; padding:10px; border-radius:3px;" id="eror">
        <span>X</span>
            <h2>كلمة المرور غير متطابقة</h2>
        </div>
    </div>
</body>
<style>
    *{
        padding:0;
        margin:0;
        box-sizing:border-box;
        direction:rtl;
        font-family: 'Cairo';
    }
    body
    {
        background-color: rgb(66, 105, 165);
    }
    .container{
        width:100%;
    }
    .pageLogin{
        padding:15px;
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items:center;
        align-content: space-around;
    }
    .pageLogin > div > h1{
        color:white;
        padding: 15px;
        margin:10px;
        position: relative;
    }
    .pageLogin > div > h1::before{
        content: '';
        position: absolute;
        width:10px;
        height: 3px;
        right: 0;
        bottom:50%;
        background-color: aliceblue;
        border-radius: 10px;
    }
    .pageLogin > div > h1::after{
        content: '';
        position: absolute;
        width:10px;
        height: 3px;
        left: 0;
        bottom:50%;
        background-color: aliceblue;
        border-radius: 10px;
    }
    .containerHom{
        background-color: #BD4B4B; 
        border-radius: 35px;
        padding: 24px;
        overflow: hidden;
        border: 1px solid whitesmoke;
        overflow: hidden;
        box-shadow: 14px 19px 1px #8d8d8d;;
    }
    .creatLogin
    {
        width:100%;
        text-align:center;
        padding:10px;
        display:grid;
        grid-template-columns:repeat(2,auto);
        gap:10px;
    }
    .creatLogin > div{
        padding:10px;
        margin:10px;
        color:white;
        border-radius: 5px;
    }
    .creatLogin .creatAccount{
        background-color: red;
    }
    .creatLogin .login{
        background-color: #e8f0fe;
        color: black;
    }
    .containerCreatLogin{
        width:100%;
        padding:15px;
    }
    .creat{
        width:100%;
    }
    .creat > div{
        padding:10px;
    }
    .creat > div input{
        width:100%;
        height: 50px;
        padding:20px;
        outline: none;
        border: none;
        background-color:  #e8f0fe;
        border-radius: 25px;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        
        border: 2px solid transparent;
    }
    .creat > div input:focus{
        border-color:gold;
    }
    .creat > div input[type="submit"]{
        line-height: 0px;
    }
</style>
<script src="jquery-3.5.1.js"></script>
<script>
    function crFun()
    {
        document.getElementById("creatAccount").style.backgroundColor = '#e8f0fe';
        document.getElementById("creatAccount").style.color = 'Black';
        document.getElementById("login").style.backgroundColor = 'Red';
        document.getElementById("login").style.color = 'white';
        formTow.style.display = 'Block';
        formOne.style.display = 'none';
    }
    function loFun()
    {
        document.getElementById("login").style.backgroundColor = '#e8f0fe';
        document.getElementById("login").style.color = 'Black';
        document.getElementById("creatAccount").style.backgroundColor = 'Red';
        document.getElementById("creatAccount").style.color = 'white';
        formTow.style.display = 'none';
        formOne.style.display = 'block';
    }
    
    let form= document.getElementById("formTow");
            let msgerror =  document.getElementById("eror");

    form.addEventListener("submit",function (d) {
        let passone= document.getElementById("pasOne").value;
        let passtow= document.getElementById("pasTow").value;
        if(passone != passtow)
        {
            d.preventDefault();
           $(msgerror).slideDown(500);
        }
        console.log("dls");
    });
msgerror.addEventListener("click",function(){
    $(msgerror).hide(500);
});
</script>
<?php
   if(isset($_POST["sign"])){
    $email = test($_POST["newemail"]);
       if (preg_match($pattern, $email))
       {
            $name = test($_POST["name"]);
            $phon = test($_POST["phone"]);
            $password = test($_POST["newpassword"]);
            $sql = "INSERT into customars(name_cust,phone_cust , email , password_cust ) values('$name','$phon' , '$email', '$password')";
            if($con->query($sql)===TRUE){
               echo "<script>window.location.href='project.php'</script>";
            } else {
                echo "eorro";
            }
          $con->close();
       }
       else{ ?>
       <script>
           let cop = msgerror.cloneNode(true);
           cop.textContent = "بريد الكتروني غير صالح";
            document.body.appendChild(cop);
            $(cop).show(500);
             window.addEventListener("click" , function(){
            $(cop).hide(500);
             });
       </script>
       
       <?php

       }
    }
?>
</html>